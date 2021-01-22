<?php

class HoerMouse extends Services
{
    /**
     * 页脚输出相关代码
     *
     * @access public
     * @param unknown footer
     * @return unknown
     */
    public function footer($plugin)
    {
        //点击爱心
        $arr = self::handleBubbleType($plugin);
        echo $arr['js'];
    }

    private function handleBubbleType($HoerMouse)
    {
        $bubbleType = $HoerMouse->bubbleType;
        $dir = INTEGRATION_STATIC_PATH;
        switch ($bubbleType) {
            case 'text':
                $js = "<script type='text/javascript'>handleBubbleType_text()</script>\n";
                break;
            case 'heart':
                $js = "<script type='text/javascript'>handleBubbleType_heart()</script>\n";
                break;
            case 'fireworks':
                $js = "<script type='text/javascript' src='" . $dir . "/js/fireworks.js'></script>\n";
                break;
            default:
                break;
        }
        if ($bubbleType == 'fireworks') {
            $js = "<script type='text/javascript' src='" . $dir . "/js/fireworks.js'></script>\n";
        }
        return compact('js');
    }

}