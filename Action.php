<?php

class Integration_Action extends Typecho_Widget implements Widget_Interface_Do
{

    /** @var  数据操作对象 */
    private $_db;

    /** @var  插件配置信息 */
    private $_cfg;

    /** @var  系统配置信息 */
    private $_options;

    public function send_all()
    {
        $this->init();

        //获取分组
        $group_volume = $this->_cfg->group;

        $group = isset($_REQUEST['group']) ? ($_REQUEST['group'] + 0) : 1;

        //获取所有链接数组
        $url_array = $this->gen_all_url();

        $urls = array_slice($url_array, ($group - 1) * $group_volume, $group_volume);

        //设置超时
        set_time_limit(600);

        $this->post($urls, $group);

        header('Location: ' . $_SERVER['HTTP_REFERER'], false, 302);
        exit;
    }

    public function init()
    {
        $this->_db = Typecho_Db::get();
        $this->_options = $this->widget('Widget_Options');
        $this->_cfg = $this->_options->plugin('Integration');
    }

    public function gen_all_url()
    {

        $urls = array();

        $this->init();

        $pages = $this->_db->fetchAll($this->_db->select()->from('table.contents')
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.created < ?', $this->_options->gmtTime)
            ->where('table.contents.type = ?', 'page')
            ->order('table.contents.created', Typecho_Db::SORT_DESC));

        $articles = $this->_db->fetchAll($this->_db->select()->from('table.contents')
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.created < ?', $this->_options->gmtTime)
            ->where('table.contents.type = ?', 'post')
            ->order('table.contents.created', Typecho_Db::SORT_DESC));

        foreach ($pages as $page) {
            $type = $page['type'];
            $routeExists = (NULL != Typecho_Router::get($type));
            $page['pathinfo'] = $routeExists ? Typecho_Router::url($type, $page) : '#';
            $urls[] = Typecho_Common::url($page['pathinfo'], $this->_options->index);
        }
        foreach ($articles as $article) {
            $type = $article['type'];
            $routeExists = (NULL != Typecho_Router::get($type));
            if (!is_null($routeExists)) {
                $article['categories'] = $this->_db->fetchAll($this->_db->select()->from('table.metas')
                    ->join('table.relationships', 'table.relationships.mid = table.metas.mid')
                    ->where('table.relationships.cid = ?', $article['cid'])
                    ->where('table.metas.type = ?', 'category')
                    ->order('table.metas.order', Typecho_Db::SORT_ASC));
                $article['category'] = urlencode(current(Typecho_Common::arrayFlatten($article['categories'], 'slug')));
                $article['slug'] = urlencode($article['slug']);
                $article['date'] = new Typecho_Date($article['created']);
                $article['year'] = $article['date']->year;
                $article['month'] = $article['date']->month;
                $article['day'] = $article['date']->day;
            }
            $article['pathinfo'] = $routeExists ? Typecho_Router::url($type, $article) : '#';
            $urls[] = Typecho_Common::url($article['pathinfo'], $this->_options->index);
        }

        return $urls;
    }

    /**
     * 发送数据
     * @param $url 准备发送的url
     * @param $group 分组信息
     */
    public function post($url, $group = null)
    {
        $this->init();

        //获取API
        $api = $this->_cfg->api;

        //准备数据
        if (is_array($url)) {
            $urls = $url;
        } else {
            $urls = array($url);
        }

        //日志信息

        $log['subject'] = '我';
        $log['action'] = '发送';
        $log['object'] = 'URL';


        if ($group) $log['more']['group'] = $group;

        $log['more']['url'] = $urls;

        try {
            //为了保证成功调用，老高先做了判断
            if (false == Typecho_Http_Client::get()) {
                throw new Typecho_Plugin_Exception(_t('对不起, 您的主机不支持 php-curl 扩展而且没有打开 allow_url_fopen 功能, 无法正常使用此功能'));
            }

            //发送请求
            $http = Typecho_Http_Client::get();
            $http->setData(implode("\n", $urls));
            $http->setHeader('Content-Type', 'text/plain');
            $json = $http->send($api);
            $return = json_decode($json, 1);
            $log['more']['info'] = $return;
            if (isset($return['error'])) {
                $log['result'] = '失败';
            } else {
                $log['result'] = '成功';
            }

        } catch (Typecho_Exception $e) {
            $log['more']['info'] = $e->getMessage();
            $log['result'] = '失败';
        }

        $this->logger($log);
    }

    public function logger($data)
    {
        $this->init();
        $this->_db->query($this->_db->insert('table.baidusubmit')
            ->rows(array(
                'subject' => $data['subject'],
                'action' => $data['action'],
                'object' => $data['object'],
                'result' => $data['result'],
                'more' => var_export($data['more'], 1),
                'time' => time()
            )));
    }

    /**
     * 准备数据
     * @param $contents 文章内容
     * @param $class 调用接口的类
     * @throws Typecho_Plugin_Exception
     */
    public function send($contents, $class)
    {
        //初始化配置
        $this->init();

        //如果文章属性为隐藏或滞后发布
        if ('publish' != $contents['visibility'] || $contents['created'] > time()) {
            return;
        }

        //判断是否配置好API
        if (is_null($this->_cfg->api)) {
            throw new Typecho_Plugin_Exception(_t('api未配置'));
        }

        //获取文章类型
        $type = $contents['type'];

        //获取路由信息
        $routeExists = (NULL != Typecho_Router::get($type));

        if (!is_null($routeExists)) {
            $contents['cid'] = $class->cid;
            $contents['categories'] = $this->_db->fetchAll($this->_db->select()->from('table.metas')
                ->join('table.relationships', 'table.relationships.mid = table.metas.mid')
                ->where('table.relationships.cid = ?', $contents['cid'])
                ->where('table.metas.type = ?', 'category')
                ->order('table.metas.order', Typecho_Db::SORT_ASC));
            $contents['category'] = urlencode(current(Typecho_Common::arrayFlatten($contents['categories'], 'slug')));
            $contents['slug'] = urlencode($contents['slug']);
            $contents['date'] = new Typecho_Date($contents['created']);
            $contents['year'] = $contents['date']->year;
            $contents['month'] = $contents['date']->month;
            $contents['day'] = $contents['date']->day;
        }

        //生成永久连接
        $path_info = $routeExists ? Typecho_Router::url($type, $contents) : '#';
        $permalink = Typecho_Common::url($path_info, $this->_options->index);

        //调用post方法
        $this->post($permalink);
    }

    public function action()
    {
    }

    public function sitemap()
    {
        $this->init();
        $pages = $this->_db->fetchAll($this->_db->select()->from('table.contents')
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.created < ?', $this->_options->gmtTime)
            ->where('table.contents.type = ?', 'page')
            ->order('table.contents.created', Typecho_Db::SORT_DESC));

        $articles = $this->_db->fetchAll($this->_db->select()->from('table.contents')
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.created < ?', $this->_options->gmtTime)
            ->where('table.contents.type = ?', 'post')
            ->order('table.contents.created', Typecho_Db::SORT_DESC));

        header("Content-Type: application/xml");
        echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        echo "<?xml-stylesheet type='text/xsl' href='" . $this->_options->pluginUrl . "/Integration/sitemap.xsl'?>\n";
        echo "<urlset xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\nxsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\"\nxmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";
        foreach ($pages as $page) {
            $type = $page['type'];
            $routeExists = (NULL != Typecho_Router::get($type));
            $page['pathinfo'] = $routeExists ? Typecho_Router::url($type, $page) : '#';
            $page['permalink'] = Typecho_Common::url($page['pathinfo'], $this->_options->index);

            echo "\t<url>\n";
            echo "\t\t<loc>" . $page['permalink'] . "</loc>\n";
            echo "\t\t<lastmod>" . date('Y-m-d', $page['modified']) . "</lastmod>\n";
            echo "\t\t<changefreq>always</changefreq>\n";
            echo "\t\t<priority>0.8</priority>\n";
            echo "\t</url>\n";
        }
        foreach ($articles as $article) {
            $type = $article['type'];
            $article['categories'] = $this->_db->fetchAll($this->_db->select()->from('table.metas')
                ->join('table.relationships', 'table.relationships.mid = table.metas.mid')
                ->where('table.relationships.cid = ?', $article['cid'])
                ->where('table.metas.type = ?', 'category')
                ->order('table.metas.order', Typecho_Db::SORT_ASC));
            $article['category'] = urlencode(current(Typecho_Common::arrayFlatten($article['categories'], 'slug')));
            $article['slug'] = urlencode($article['slug']);
            $article['date'] = new Typecho_Date($article['created']);
            $article['year'] = $article['date']->year;
            $article['month'] = $article['date']->month;
            $article['day'] = $article['date']->day;
            $routeExists = (NULL != Typecho_Router::get($type));
            $article['pathinfo'] = $routeExists ? Typecho_Router::url($type, $article) : '#';
            $article['permalink'] = Typecho_Common::url($article['pathinfo'], $this->_options->index);

            echo "\t<url>\n";
            echo "\t\t<loc>" . $article['permalink'] . "</loc>\n";
            echo "\t\t<lastmod>" . date('Y-m-d', $article['modified']) . "</lastmod>\n";
            echo "\t\t<changefreq>always</changefreq>\n";
            echo "\t\t<priority>0.5</priority>\n";
            echo "\t</url>\n";
        }
        echo "</urlset>";
    }
}
