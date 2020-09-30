<?php

class ActivatePowerMode extends Services
{
    public function footer($plugin)
    {
        $colorful = $plugin->colorful;
        $shake = $plugin->shake;
        if ($colorful || $shake) {
            $jsUrl = Integration_STATIC_PATH . 'js/activate-power-mode.js';
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

    public function pfooter($plugin)
    {
        $activeineditor = $plugin->activeineditor;
        if ($activeineditor) {
            $colorful = $plugin->colorful;
            $shake = $plugin->shake;
            if ($colorful || $shake) {
                $jsUrl = Integration_STATIC_PATH . 'js/activate-power-mode.js';
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
}