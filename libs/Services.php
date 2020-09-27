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
}