<?php

require_once 'Contract/ServiceInterfaces.php';

abstract class Services implements ServiceInterfaces
{
    /**
     * 页头输出相关代码
     *
     * @access public
     * @param unknown header
     * @return unknown
     */
    abstract public static function header($plugin, $Path);

    /**
     * 页脚输出相关代码
     *
     * @access public
     * @param unknown footer
     * @return unknown
     */
    abstract public static function footer($plugin, $Path);
}