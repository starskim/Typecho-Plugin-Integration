<?php
/**
 * @author stars_kim <stars_kim@163.com>
 */

class Services
{
    /**
     * 判断值是否有效存在
     * @access public
     * @param $value
     * @return 返回bool类型
     */
    public static function exist_value($value, $array, $type = null)
    {
        if (isset($array)) {
            return in_array($value, $array, $type);
        }
        return false;
    }

    public static function init()
    {
        $options = Helper::options();
        $config = $options->plugin('Integration');
        if (!defined('Integration_URL')) {//主题目录的绝对地址
            define("Integration_URL", $options->pluginUrl);
        }
        if (!defined("BLOG_URL")) {
            define("BLOG_URL", $options->rootUrl);
        }
        if (strlen(trim($config->LocalResourceSrc)) > 0) {//主题静态资源的绝对地址
            @define('Integration_STATIC_PATH', $config->LocalResourceSrc);
        } else {
            @define('Integration_STATIC_PATH', Integration_URL . '/Integration/assets/');
        }
    }
}