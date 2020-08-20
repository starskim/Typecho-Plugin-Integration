<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * <strong style="color:#56a0e0;">Stars Kim'blog 整合功能插件</strong>
 *
 * @package Integration
 * @author Satrs_Kim
 * @version 1.4.0
 * @link https://blog.starskim.cn
 */

require_once 'libs/PanelConfig.php';
require_once 'libs/HeaderConfig.php';
require_once 'libs/FooterConfig.php';

class Integration_Plugin implements Typecho_Plugin_Interface
{
    /** @var string 控制菜单链接 */
    public static $panel = 'Integration/page/Console.php';

    public static function activate()
    {
        $meg = self::addTable();
        self::addRoute();
        self::addFactory();
        return _t($meg);
    }

    /**
     * @throws Typecho_Db_Exception
     */
    public static function addTable()
    {
        $Db = Typecho_Db::get();
        $sql = self::getSql($Db);
        $Db->query($sql);
        return '成功创建数据表，插件启用成功。';
    }

    /**
     * @param $db
     * @param string $path
     * @return string|string[]
     */
    private static function getSql($db)
    {
        $adapter = $db->getAdapterName();
        $prefix = $db->getPrefix();

        if ($adapter === 'Pdo_Mysql' || $adapter === 'Mysql' || $adapter === 'Mysqli') {
            $sqlTemplate = file_get_contents(__DIR__ . '/sql/Install/Mysql.sql');
        }

        if ($adapter === 'Pdo_SQLite') {
            $sqlTemplate = file_get_contents(__DIR__ . '/sql/Install/SQLite.sql');
        }

        if ($adapter === 'Pdo_Pgsql') {
            $sqlTemplate = file_get_contents(__DIR__ . '/sql/Install/Pgsql.sql');
        }

        if (empty($sqlTemplate)) throw new Exception('暂不支持你的数据库');

        $sql = str_replace('typecho_', $prefix, $sqlTemplate);
        $sql = str_replace('{charset}', 'utf8mb4', $sql);
        return $sql;
    }

    public static function addRoute()
    {
        Helper::addRoute('sitemap', '/sitemap.xml', 'Integration_Action', 'sitemap');
        Helper::addPanel(1, self::$panel, 'Integration控制台', '查看蜘蛛日志', 'administrator');
        Helper::addRoute('baidu_sitemap_advanced', __TYPECHO_ADMIN_DIR__ . 'baidu_sitemap/advanced', 'Integration_Action', 'send_all');
    }

    public static function addFactory()
    {
        Typecho_Plugin::factory('Widget_Archive')->header = array(__CLASS__, 'isbot');
        Typecho_Plugin::factory('Widget_Archive')->header = array(__CLASS__, 'header');
        Typecho_Plugin::factory('Widget_Archive')->footer = array(__CLASS__, 'footer');
        Typecho_Plugin::factory('Widget_Feedback')->comment = array(__CLASS__, 'filter');
        Typecho_Plugin::factory('admin/write-post.php')->bottom = array(__CLASS__, 'pfooter');
        Typecho_Plugin::factory('admin/write-page.php')->bottom = array(__CLASS__, 'pfooter');
        Typecho_Plugin::factory('Widget_Contents_Post_Edit')->write = array(__CLASS__, 'write');
        Typecho_Plugin::factory('Widget_Contents_Post_Edit')->finishPublish = array('Integration_Action', 'send');
        Typecho_Plugin::factory('Widget_Contents_Page_Edit')->finishPublish = array('Integration_Action', 'send');
    }

    public static function deactivate()
    {
        self::removeRoute();
        $config = Helper::options()->plugin('Integration');
        if ($config->isDelete == 1) {
            $meg = self::removeTable();
        }
        return _t($meg);
    }

    public static function removeRoute()
    {
        Helper::removeRoute('sitemap');
        Helper::removeRoute('baidu_sitemap_advanced');
        Helper::removePanel(1, self::$panel);
    }

    /**
     * @return string
     * @throws Typecho_Db_Exception
     */
    public function removeTable()
    {
        $Db = Typecho_Db::get();
        $prefix = $Db->getPrefix();
        $sql = file_get_contents(__DIR__ . '/sql/Uninstall.sql');
        $sql = str_replace('typecho_', $prefix, $sql);
        try {
            $Db->query($sql, Typecho_Db::WRITE);
        } catch (Typecho_Exception $e) {
            return "删除数据库失败！";
        }
        return "插件禁用成功，删除数据库成功！";
    }

    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        PanelConfig::config($form);
    }

    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
    }

    public static function isbot()
    {
        $config = Helper::options()->plugin('Integration');
        $bot = NULL;
        $botlist = $config->botlist;
        if (sizeof($botlist) > 0) {
            @ $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
            foreach ($botlist as $value) {
                if (strpos($useragent, $value) !== false) {
                    $bot = $value;
                }
            }
            if ($bot !== NULL) {
                $request = new Typecho_Request;
                $ip = $request->getIp();
                $url = $_SERVER['REQUEST_URI'];
                if ($ip == NULL) {
                    $ip = 'UnKnow';
                }
                $options = Helper::options();
                $timeStamp = $options->gmtTime;
                $offset = $options->timezone - $options->serverTimezone;
                $gtime = $timeStamp + $offset;
                $db = Typecho_Db::get();
                $rows = array(
                    'bot' => $bot,
                    'url' => $url,
                    'ip' => $ip,
                    'ltime' => $gtime,
                );
                $db->query($db->insert('table.robots_logs')->rows($rows));
            }
        }
    }

    /**
     * 发布文章时自动提取标签
     *
     * @access public
     * @return void
     */
    public static function write($contents, $edit)
    {
        $html = $contents['text'];
        $isMarkdown = (0 === strpos($html, '<!--markdown-->'));
        if ($isMarkdown) {
            $html = Markdown::convert($html);
        }
        $text = str_replace("\n", '', trim(strip_tags(html_entity_decode($html))));
        $options = Helper::options();
        $autoTags = $options->plugin('Integration');
        //插件启用,且未手动设置标签
        if ($autoTags->isActive == 1 && !$contents['tags']) {
            Typecho_Widget::widget('Widget_Metas_Tag_Admin')->to($tags);
            foreach ($tags->stack as $tag) {
                $tagNames[] = $tag['name'];
            }
            //str_replace("\n", '', trim(strip_tags($contents['text'])))
            //过滤 html 标签等无用内容
            $postString = json_encode($text);
            $context = stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => array(
                        'Content-Type: application/json',
                        'Accept: application/json',
                        'X-Token: fpm1fDvA.5220.GimJs8QvViSK'
                    ),
                    'content' => $postString
                ]
            ]);
            $result = file_get_contents('http://api.bosonnlp.com/tag/analysis?space_mode=0&oov_level=0&t2s=0', false, $context);
            $result = json_decode($result);
            $ignoreTag = array('w', 'wkz', 'wky', 'wyz', 'wyy', 'wj', 'ww', 'wt', 'wd', 'wf', 'wn', 'wm', 'ws', 'wp', 'wb', 'wh', 'email', 'tel', 'id', 'ip', 'url', 'o', 'y', 'u', 'uzhe', 'ule', 'ugou', 'ude', 'usou', 'udeng', 'uyy', 'udh', 'uzhi', 'ulian', 'c', 'p', 'pba', 'pbei', 'd', 'dl', 'q', 'm', 'r', 'z', 'b', 'bl', 'a', 'ad', 'an', 'al', 'v', 'vd', 'vshi', 'vyou', 'vl', 'f', 's', 't', 'nl');
            $sourceTags = array();
            foreach ($result[0]->tag as $key => $tag) {
                if (!in_array($tag, $ignoreTag)) {
                    if (in_array($result[0]->word[$key], $tagNames)) {
                        if (in_array($result[0]->word[$key], $sourceTags)) continue;
                        $sourceTags[] = $result[0]->word[$key];
                    }
                }
            }
            $contents['tags'] = implode(',', array_unique($sourceTags));
            if (count($contents['tags']) < 3) {
                $context = stream_context_create([
                    'http' => [
                        'method' => 'POST',
                        'header' => array(
                            'Content-Type: application/json',
                            'Accept: application/json',
                            'X-Token: fpm1fDvA.5220.GimJs8QvViSK'
                        ),
                        'content' => $postString
                    ]
                ]);
                $result = file_get_contents('http://api.bosonnlp.com/keywords/analysis?top_k=5', false, $context);
                $result = json_decode($result);
                foreach ($result as $re) {
                    $a[] = $re[1];
                }
                $contents['tags'] = $contents['tags'] ? $contents['tags'] . ',' . implode(',', $a) : implode(',', $a);
            }
        }
        return $contents;
    }

    /**
     * 页头输出相关代码
     *
     * @access public
     * @param unknown header
     * @return unknown
     */
    public static function header()
    {
        headerConfig::header();

    }

    /**
     * 页脚输出相关代码
     *
     * @access public
     * @param unknown footer
     * @return unknown
     */
    public static function footer()
    {
        footerConfig::footer();
    }

    /**
     * 页脚输出相关代码
     *
     * @access public
     * @param unknown pfooter
     * @return unknown
     */
    public static function pfooter()
    {
        $options = Helper::options();
        $config = $options->plugin('Integration');
        $Path = $options->pluginUrl . '/Integration/';
        $Js = $Path . 'assets/js';
        $activeineditor = $config->activeineditor;
        if ($activeineditor) {
            $colorful = $config->colorful;
            $shake = $config->shake;
            if ($colorful || $shake) {
                $jsUrl = $Js . '/activate-power-mode.js';
                printf("<script type='text/javascript' src='%s'></script>\n", $jsUrl); // 加载JS库
                $colorful = $colorful ? $colorful[0] : 'false';
                $shake = $shake ? $shake[0] : 'false';
                echo "<script type='text/javascript'>
                    $(function() {
                        try {
                            (function(){
                                // input
                                POWERMODE.colorful = {$colorful}; // make power mode colorful 颜色
                                POWERMODE.shake = {$shake}; // turn off shake 振动
                                document.body.addEventListener('input', POWERMODE);
                            })();
                        } catch (e) {
                            console.log('打字特效插件出现错误');
                        }
                    });
                    </script>\n";
            }
        }
    }

    /**
     * 评论过滤器
     *
     */
    public static function filter($comment, $post)
    {
        $options = Helper::options();
        $filter_set = $options->plugin('Integration');
        $opt = "none";
        $error = "";


        //屏蔽评论内容包含文章标题
        if ($opt == "none" && $filter_set->opt_title != "none") {
            $db = Typecho_Db::get();
            // 获取评论所在文章
            $po = $db->fetchRow($db->select('title')->from('table.contents')->where('cid = ?', $comment['cid']));
            if (strstr($comment['text'], $po['title'])) {
                $error = "对不起，评论内容不允许包含文章标题";
                $opt = $filter_set->opt_title;
            }
        }


        //屏蔽IP段处理
        if ($opt == "none" && $filter_set->opt_ip != "none") {
            if (self::check_ip($filter_set->words_ip, $comment['ip'])) {
                $error = "评论发布者的IP已被管理员屏蔽";
                $opt = $filter_set->opt_ip;
            }
        }


        //屏蔽邮箱处理
        if ($opt == "none" && $filter_set->opt_mail != "none") {
            if (self::check_in($filter_set->words_mail, $comment['mail'])) {
                $error = "评论发布者的邮箱地址被管理员屏蔽";
                $opt = $filter_set->opt_mail;
            }
        }

        //屏蔽网址处理
        if (!empty($filter_set->words_url)) {
            if ($opt == "none" && $filter_set->opt_url != "none") {
                if (self::check_in($filter_set->words_url, $comment['url'])) {
                    $error = "评论发布者的网址被管理员屏蔽";
                    $opt = $filter_set->opt_url;
                }
            }
        }


        //屏蔽昵称关键词处理
        if ($opt == "none" && $filter_set->opt_au != "none") {
            if (self::check_in($filter_set->words_au, $comment['author'])) {
                $error = "对不起，昵称的部分字符已经被管理员屏蔽，请更换";
                $opt = $filter_set->opt_au;
            }
        }


        //日文评论处理
        if ($opt == "none" && $filter_set->opt_nojp != "none") {
            if (preg_match("/[\x{3040}-\x{31ff}]/u", $comment['text']) > 0) {
                $error = "禁止使用日文";
                $opt = $filter_set->opt_nojp;
            }
        }


        //日文用户昵称处理
        if ($opt == "none" && $filter_set->opt_nojp_au != "none") {
            if (preg_match("/[\x{3040}-\x{31ff}]/u", $comment['author']) > 0) {
                $error = "用户昵称禁止使用日文";
                $opt = $filter_set->opt_nojp_au;
            }
        }


        //昵称长度检测
        if ($opt == "none" && $filter_set->opt_au_length != "none") {
            if (self::strLength($comment['author']) < $filter_set->au_length_min) {
                $error = "昵称请不得少于" . $filter_set->au_length_min . "个字符";
                $opt = $filter_set->opt_au_length;
            } else
                if (self::strLength($comment['author']) > $filter_set->au_length_max) {
                    $error = "昵称请不得多于" . $filter_set->au_length_max . "个字符";
                    $opt = $filter_set->opt_au_length;
                }

        }

        //用户昵称网址判断处理
        if ($opt == "none" && $filter_set->opt_nourl_au != "none") {
            if (preg_match(" /^((https?|ftp|news):\/\/)?([a-z]([a-z0-9\-]*[\.。])+([a-z]{2}|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))(\/[a-z0-9_\-\.~]+)*(\/([a-z0-9_\-\.]*)(\?[a-z0-9+_\-\.%=&]*)?)?(#[a-z][a-z0-9_]*)?$/ ", $comment['author']) > 0) {
                $error = "用户昵称不允许为网址";
                $opt = $filter_set->opt_nourl_au;
            }
        }


        //纯中文评论处理
        if ($opt == "none" && $filter_set->opt_nocn != "none") {
            if (preg_match("/[\x{4e00}-\x{9fa5}]/u", $comment['text']) == 0) {
                $error = "评论内容请不少于一个中文汉字";
                $opt = $filter_set->opt_nocn;
            }
        }


        //字符长度检测
        if ($opt == "none" && $filter_set->opt_length != "none") {
            if (self::strLength($comment['text']) < $filter_set->length_min) {
                $error = "评论内容请不得少于" . $filter_set->length_min . "个字符";
                $opt = $filter_set->opt_length;
            } else
                if (self::strLength($comment['text']) > $filter_set->length_max) {
                    $error = "评论内容请不得多于" . $filter_set->length_max . "个字符";
                    $opt = $filter_set->opt_length;
                }

        }

        //检查禁止词汇
        if ($opt == "none" && $filter_set->opt_ban != "none") {
            if (self::check_in($filter_set->words_ban, $comment['text'])) {
                $error = "评论内容中包含禁止词汇";
                $opt = $filter_set->opt_ban;
            }
        }
        //检查敏感词汇
        if ($opt == "none" && $filter_set->opt_chk != "none") {
            if (self::check_in($filter_set->words_chk, $comment['text'])) {
                $error = "评论内容中包含敏感词汇";
                $opt = $filter_set->opt_chk;
            }
        }

        //执行操作
        if ($opt == "abandon") {
            Typecho_Cookie::set('__typecho_remember_text', $comment['text']);
            throw new Typecho_Widget_Exception($error);
        } else if ($opt == "spam") {
            $comment['status'] = 'spam';
        } else if ($opt == "waiting") {
            $comment['status'] = 'waiting';
        }
        Typecho_Cookie::delete('__typecho_remember_text');
        return $comment;
    }

    /**
     * 检查$ip中是否在$words_ip的IP段中
     *
     */
    private static function check_ip($words_ip, $ip)
    {
        $words = explode("\n", $words_ip);
        if (empty($words)) {
            return false;
        }
        foreach ($words as $word) {
            $word = trim($word);
            if (false !== strpos($word, '*')) {
                $word = "/^" . str_replace('*', '\d{1,3}', $word) . "$/";
                if (preg_match($word, $ip)) {
                    return true;
                }
            } else {
                if (false !== strpos($ip, $word)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * 检查$str中是否含有$words_str中的词汇
     *
     */
    private static function check_in($words_str, $str)
    {
        $words = explode("\n", $words_str);
        if (empty($words)) {
            return false;
        }
        foreach ($words as $word) {
            if (false !== strpos($str, trim($word))) {
                return true;
            }
        }
        return false;
    }

    /**
     * PHP获取字符串中英文混合长度
     */
    private static function strLength($str)
    {
        preg_match_all('/./us', $str, $match);
        return count($match[0]);  // 输出9
    }
}