<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * <strong style="color:#56a0e0;">Stars Kim'blog 整合功能插件</strong>
 *
 * @package Integration
 * @author Satrs_Kim
 * @version 1.1.0
 * @link https://blog.starskim.cn
 */

require_once "libs/FormElements.php";
/*表单组件*/
require_once 'libs/Checkbox_Integration.php';
require_once 'libs/Text_Integration.php';
require_once 'libs/Radio_Integration.php';
require_once 'libs/Select_Integration.php';
require_once 'libs/Textarea_Integration.php';

class Integration_Plugin implements Typecho_Plugin_Interface
{
    /** @var string 控制菜单链接 */
    public static $panel = 'Integration/page/Console.php';

    public static function activate()
    {
        $meg = self::addTable();
        self::addRoute();
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

        if (empty($sqlTemplate)) throw new \Exception('暂不支持你的数据库');

        $sql = str_replace('typecho_', $prefix, $sqlTemplate);
        $sql = str_replace('{charset}', 'utf8mb4', $sql);
        return $sql;

    }

    public static function addRoute()
    {
        Helper::addRoute('sitemap', '/sitemap.xml', 'Integration_Action', 'sitemap');
        Helper::addPanel(1, self::$panel, 'Integration控制台', '查看蜘蛛日志', 'administrator');
        Typecho_Plugin::factory('Widget_Archive')->header = array(__CLASS__, 'isbot');
        Typecho_Plugin::factory('Widget_Archive')->header = array(__CLASS__, 'header');
        Typecho_Plugin::factory('Widget_Archive')->footer = array(__CLASS__, 'footer');
        Typecho_Plugin::factory('admin/write-post.php')->bottom = array(__CLASS__, 'pfooter');
        Typecho_Plugin::factory('admin/write-page.php')->bottom = array(__CLASS__, 'pfooter');
        Typecho_Plugin::factory('Widget_Contents_Post_Edit')->write = array(__CLASS__, 'write');
        //挂载发布文章和页面的接口
        Typecho_Plugin::factory('Widget_Contents_Post_Edit')->finishPublish = array('Integration_Action', 'send');
        Typecho_Plugin::factory('Widget_Contents_Page_Edit')->finishPublish = array('Integration_Action', 'send');
        Helper::addRoute('baidu_sitemap_advanced', __TYPECHO_ADMIN_DIR__ . 'baidu_sitemap/advanced', 'Integration_Action', 'send_all');

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
        $Path = Helper::options()->pluginUrl . '/Integration/';
        $Css = $Path . 'assets/css';
        $Js = $Path . 'assets/js';
        $isDelete = new Radio_integration('isDelete', [0 => '不删除', 1 => '删除'], 1, _t('卸载是否删除数据表'));
        echo <<<EOF
<link href="https://cdn.bootcdn.net/ajax/libs/mdui/0.4.3/css/mdui.min.css" rel="stylesheet">
<link href="$Css/admin.min.css" rel="stylesheet">
<script src="https://cdn.bootcdn.net/ajax/libs/mdui/0.4.3/js/mdui.min.js"></script>
<div class="mdui-card">
 <div class="mdui-progress">
 </div> 
 <div class="mdui-container">
  <div class="mdui-tab mdui-tab-scrollable mdui-tab-centered mdui-tab-full-width" mdui-tab>
    <a href="#example1-tab1" class="mdui-ripple">著作</a>
    <a href="#example1-tab2" class="mdui-ripple">说明</a>
    <a href="#example1-tab3" class="mdui-ripple">建议</a>
  </div>

  <div id="example1-tab1" class="mdui-p-a-2"> 
  <p>Sitemap：作者：<a href="https://www.bayun.org" target="_blank">八云酱</a></p>
  <p>蛛来访日志：作者：<a href="http://www.yovisun.com" target="_blank">Yovi Sun</a>；修复人：<a href="https://www.catbei.com" target="_blank">猫贝</a></p>
<!--  <p>评论拦截：作者：<a href="http://www.yovisun.com/archive/typecho-plugin-smartspam.html/" target="_blank">Yovis Blog</a></p>-->
<!--  <p>如果以下内容侵权了您的利益请联系：<a href="https://803344.xyz/" target="_blank">小宇宙</a></p>-->
  </div>
  <div id="example1-tab2" class="mdui-p-a-2">
      <p>我写这个插件主要是为了给自己方便，不用每次主题更新都需要手动修改文件的问题</p>
    <p>有部分功能是搬自其它的插件</p>
    <p>因为不想安装多个插件，或者原插件不合适自己</p>
  </div>
  <div id="example1-tab3" class="mdui-p-a-2">
    <p>可以通过您的建议的添加功能进来</p>
    <p>初衷：美化个人博客，不会添加一些不实际的</p>
<!--    <p>联系方式.博客上留言：<a href="https://803344.xyz/" target="_blank">小宇宙</a></p>-->
  </div>
</div>
</div>
EOF;
        $form->addItem(new Integration('<div class="mdui-panel" mdui-panel="">'));
        $form->addInput($isDelete);
        self::RobotsPlus($form);
        self::AutoTags($form);
        self::GoTop($form);
        self::ActivatePowerMode($form);
        self::BaiduSubmit($form);
    }


    /**
     * 蛛来访日志配置面板
     * @param Typecho_Widget_Helper_Form $form
     */
    private static function RobotsPlus(Typecho_Widget_Helper_Form $form)
    {
        $options = array(
            'baidu' => '百度',
            'google' => '谷歌',
            'sogou' => '搜狗',
            'youdao' => '有道',
            'soso' => '搜搜',
            'bing' => '必应',
            'yahoo' => '雅虎',
            '360' => '360搜索'
        );
        $botlist = new Checkbox_integration('botlist', $options, array('baidu', 'google', 'sogou', 'youdao', 'soso', 'bing', 'yahoo', '360'), '蜘蛛记录设置', '请选择要记录的蜘蛛日志');
        $pagecount = new Text_integration('pagecount', NULL, '100', '分页数量', '每页显示的日志数量');
        $dbool = array(
            '0' => '删除',
            '1' => '不删除'
        );
        $form->addItem(new Title_Integration('蛛来访日志'));
        $form->addInput($botlist);
        $form->addInput($pagecount);
        $form->addItem(new EndSymbol_Integration(2));
    }

    /**
     * 蛛来访日志配置面板
     * @param Typecho_Widget_Helper_Form $form
     */
    private static function AutoTags(Typecho_Widget_Helper_Form $form)
    {
        $GoTop = new Radio_integration('GoTop', array('1' => '是', '0' => '否',), '1', _t('页面顶部出现悬挂喵'), _t('页面顶部出现悬挂喵~点击触发至顶功能'));
        $form->addInput($GoTop);
    }

    /**
     * 页面顶部出现悬挂喵配置面板
     * @param Typecho_Widget_Helper_Form $form
     */
    private static function GoTop(Typecho_Widget_Helper_Form $form)
    {
        $isActive = new Radio_integration('isActive', array('1' => '是', '0' => '否',), '0', _t('自动标签'), _t('自动提取功能在文章已存在标签时不生效.'));
        $form->addInput($isActive);
    }

    /**
     * 打字特效配置面板
     * @param Typecho_Widget_Helper_Form $form
     */
    private static function ActivatePowerMode(Typecho_Widget_Helper_Form $form)
    {
        $activeineditor = new Radio_integration('activeineditor', ['0' => _t('不启用'), '1' => _t('启用')], '1', _t('是否在后台启用'), _t('选择是否在文章与页面编辑界面启用本插件。'));
        $colorful = new Checkbox_integration('colorful', ['true' => _t('颜色效果')], ['true'], _t('开启颜色效果'));
        $shake = new Checkbox_integration('shake', ['true' => _t('振动效果')], ['true'], _t('开启振动效果'));
        $form->addItem(new Title_Integration('打字特效插件'));
        $form->addInput($activeineditor);
        $form->addInput($colorful);
        $form->addInput($shake);
        $form->addItem(new EndSymbol_Integration(2));
    }

    /**
     * 百度结构化配置面板
     * @param Typecho_Widget_Helper_Form $form
     */
    private static function BaiduSubmit(Typecho_Widget_Helper_Form $form)
    {
        $form->addItem(new Title_Integration('百度结构化'));
        $element = new Text_integration('api', null, null, _t('接口调用地址'), '请登录百度站长平台获取');
        $form->addInput($element);

        $element = new Text_integration('group', null, 15, _t('分组URL数'), '每天最多只能发送50条，请酌情设置');
        $form->addInput($element);
        $form->addItem(new EndSymbol_Integration(2));
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

    public static function isbot($rule = NULL)
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
        $options = Helper::options();
        $config = $options->plugin('Integration');
        $Path = $options->pluginUrl . '/Integration/';
        $Css = $Path . 'assets/css';
        if ($config->GoTop) {
            echo '<link rel="stylesheet" type="text/css" href="' . $Css . '/szgotop.css" />';
        }

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
        $options = Helper::options();
        $config = $options->plugin('Integration');
        $Path = $options->pluginUrl . '/Integration/';
        $Js = $Path . 'assets/js';
        $colorful = $config->colorful;
        $shake = $config->shake;
        if ($config->GoTop) {
            echo '<div class="back-to-top cd-top faa-float animated cd-is-visible" style="top: -900px;"></div>';
            echo '<script type="text/javascript" src="' . $Js . '/szgotop.js"></script>';
        }
        if ($colorful || $shake) {
            $jsUrl = $Js . '/activate-power-mode.js';
            printf("<script type='text/javascript' src='%s'></script>\n", $jsUrl); // 加载JS库
            $colorful = $colorful ? $colorful[0] : 'false';
            $shake = $shake ? $shake[0] : 'false';
            echo "<script type='text/javascript'>
                $(function() {
                    try {
                        console.log(` %c ActivatePowerMode %c https:\/\/blog.imalan.cn/archives/208/ `, `color: #fadfa3; background: #23b7e5; padding:5px;`, `background: #1c2b36; padding:5px;`);
                        (function(){
                            // input
                            POWERMODE.colorful = {$colorful}; // make power mode colorful 颜色
                            POWERMODE.shake = {$shake}; // turn off shake 振动
                            document.body.addEventListener('input', POWERMODE);
                        })();
                    } catch (e) {
                        console.log('打字特效插件出现错误:请联系www.hoehub.com');
                    }
                });
                </script>\n";
        }
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
                            console.log(` %c ActivatePowerMode %c https:\/\/blog.imalan.cn/archives/208/ `, `color: #fadfa3; background: #23b7e5; padding:5px;`, `background: #1c2b36; padding:5px;`);
                            (function(){
                                // input
                                POWERMODE.colorful = {$colorful}; // make power mode colorful 颜色
                                POWERMODE.shake = {$shake}; // turn off shake 振动
                                document.body.addEventListener('input', POWERMODE);
                            })();
                        } catch (e) {
                            console.log('打字特效插件出现错误:请联系www.hoehub.com');
                        }
                    });
                    </script>\n";
            }
        }
    }
}