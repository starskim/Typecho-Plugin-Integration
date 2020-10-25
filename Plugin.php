<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * <strong style="color:#66ccff;">Stars Kim'blog 整合功能插件</strong>
 *
 * @package Integration
 * @author Satrs_Kim
 * @version 2.0.0
 * @link https://blog.starskim.cn
 */


require_once 'libs/Services.php';
require_once 'libs/PanelConfig.php';
require_once 'libs/HeaderConfig.php';
require_once 'libs/FooterConfig.php';
require_once 'libs/Services/AutoTags.php';
require_once 'libs/Services/SmartSpam.php';

class Integration_Plugin extends Services implements Typecho_Plugin_Interface
{
    /** @var string 提交路由前缀 */
    public static $action = 'Integration-edit';

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

//        if ($adapter === 'Pdo_Pgsql') {
//            $sqlTemplate = file_get_contents(__DIR__ . '/sql/Install/Pgsql.sql');
//        }

        if (empty($sqlTemplate)) throw new Exception('暂不支持你的数据库');

        $sql = str_replace('typecho_', $prefix, $sqlTemplate);
        $sql = str_replace('{charset}', 'utf8mb4', $sql);
        return $sql;
    }

    public static function addRoute()
    {
        Helper::addRoute('sitemap', '/sitemap.xml', 'Integration_Action', 'sitemap');
        Helper::addAction(self::$action, 'Integration_Action');
        Helper::addPanel(1, self::$panel, 'Integration控制台', 'Integration控制台', 'administrator');
        Helper::addRoute('baidu_sitemap_advanced', __TYPECHO_ADMIN_DIR__ . 'baidu_sitemap/advanced', 'Integration_Action', 'send_all');
    }

    public static function addFactory()
    {
        Typecho_Plugin::factory('admin/menu.php')->navBar = array(__CLASS__, 'render');
        Typecho_Plugin::factory('Widget_Archive')->header = array(__CLASS__, 'header');
        Typecho_Plugin::factory('Widget_Archive')->footer = array(__CLASS__, 'footer');
        Typecho_Plugin::factory('Widget_Feedback')->comment = array(__CLASS__, 'filter');
        Typecho_Plugin::factory('Widget_Contents_Post_Edit')->write = array(__CLASS__, 'write');
        Typecho_Plugin::factory('Widget_Contents_Post_Edit')->finishPublish = array('Integration_Action', 'send');
        Typecho_Plugin::factory('Widget_Contents_Page_Edit')->finishPublish = array('Integration_Action', 'send');
    }

    public static function deactivate()
    {
        self::removeRoute();
        $config = Helper::options()->plugin('Integration');
        if (self::exist_value('isDelete', $config->Console)) {
            $meg = self::removeTable();
        }
        return _t($meg);
    }

    public static function removeRoute()
    {
        Helper::removeAction(self::$action);
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

    /**
     * 插件实现方法
     *
     * @access public
     * @return void
     */
    public static function render()
    {
        echo '
            <a href="options-plugin.php?config=Integration" id="Integration">Integration插件管理</a>
            <script>
                window.onload = function () {
                    $("#Integration").attr("target","_self");
                }
            </script>
        ';
    }

    /**
     * 发布文章时自动提取标签
     *
     * @access public
     * @return void
     */
    public static function write($contents)
    {
        return AutoTags::write($contents);
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
     * 评论过滤器
     *
     */
    public static function filter($comment)
    {
        $config = Helper::options()->plugin('Integration');
        if (self::exist_value('SmartSpam', $config->Console)) {
            return SmartSpam::filter($comment);
        }
        return $comment;
    }
}