<?php

require_once 'Services.php';

class HoerMouse extends Services
{

    /**
     * 页头输出相关代码
     *
     * @access public
     * @param unknown header
     * @return unknown
     */
    public static function header($plugin, $Path)
    {
        // TODO: Implement header() method.
    }

    /**
     * 页脚输出相关代码
     *
     * @access public
     * @param unknown footer
     * @return unknown
     */
    public static function footer($plugin, $Path)
    {
        //点击爱心
        $arr = self::handleBubbleType($plugin, $Path);
        echo $arr['html'];
        echo $arr['js'];
        echo "<script>console.log('%c 炫彩鼠标插件 https://gitee.com/HoeXhe/HoerMouse %c www.hoehub.com 😊 HoerMouse By Hoe ', 'font-family:\'Microsoft YaHei\',\'SF Pro Display\',Roboto,Noto,Arial,\'PingFang SC\',sans-serif;color:white;background:#ffa099;padding:5px 0;', 'font-family:\'Microsoft YaHei\',\'SF Pro Display\',Roboto,Noto,Arial,\'PingFang SC\',sans-serif;color:#ffa099;background:#404040;padding:5px 0;'); // 你能留下我的信息, 我会很高兴的 ^_^</script>";
    }

    private static function handleBubbleType($HoerMouse, $Path)
    {
        $bubbleType = $HoerMouse->bubbleType;
        $dir = $Path . '/Integration/assets';
        $js = '';
        $html = '';
        switch ($bubbleType) {
            case 'text':
                $bubbleColor = $HoerMouse->bubbleColor;
                $bubbleSpeed = (int)$HoerMouse->bubbleSpeed;
                $bubbleText = $HoerMouse->bubbleText;
                $js .= '<script>';
                $js .= <<<JS
var index = 0;
jQuery(document).ready(function() {
    $(window).click(function(e) {
        var string = "{$bubbleText}";
        var strings = string.split('');
        var span = $("<span>").text(strings[index]);
        index = (index + 1) % strings.length;
        var x = e.pageX,
        y = e.pageY;
        var color = "{$bubbleColor}";
        if (color == "随机") {
            var colorValue="0,1,2,3,4,5,6,7,8,9,a,b,c,d,e,f";
            var colorArray = colorValue.split(",");
            color="#";
            for(var i=0;i<6;i++){
                color+=colorArray[Math.floor(Math.random()*16)];
            }
        }
        span.css({
            "z-index": 999,
            "top": y - 20,
            "left": x,
            "position": "absolute",
            "font-weight": "bold",
            "color": color
        });
        $("body").append(span);
        var styles = {
            "top": y - 160,
            "opacity": 0
        };
        span.animate(styles, {$bubbleSpeed}, function() {
            span.remove();
        })
    });
});
JS;
                $js .= '</script>';
                break;
            case 'heart':
                $js .= '<script>';
                $js .= <<<JS
    // 鼠标点击爱心特效
    !function (e, t, a) {
        function r() {
            for (var e = 0; e < s.length; e++) {
                s[e].alpha <= 0 ? (t.body.removeChild(s[e].el), s.splice(e, 1)) : (s[e].y--, s[e].scale += .004, s[e].alpha -= .013, s[e].el.style.cssText = "left:" + s[e].x + "px;top:" + s[e].y + "px;opacity:" + s[e].alpha + ";transform:scale(" + s[e].scale + "," + s[e].scale + ") rotate(45deg);background:" + s[e].color + ";z-index:99999");
            }
            requestAnimationFrame(r)
        }

        function n() {
            var t = "function" == typeof e.onclick && e.onclick;
            e.onclick = function (e) {
                t && t(),
                    o(e)
            }
        }

        function o(e) {
            var a = t.createElement("div");
            a.className = "heart",
                s.push({
                    el: a,
                    x: e.clientX - 5,
                    y: e.clientY - 5,
                    scale: 1,
                    alpha: 1,
                    color: c()
                }),
                t.body.appendChild(a)
        }

        function i(e) {
            var a = t.createElement("style");
            a.type = "text/css";
            try {
                a.appendChild(t.createTextNode(e))
            } catch (t) {
                a.styleSheet.cssText = e
            }
            t.getElementsByTagName("head")[0].appendChild(a)
        }

        function c() {
            return "rgb(" + ~~(255 * Math.random()) + "," + ~~(255 * Math.random()) + "," + ~~(255 * Math.random()) + ")"
        }

        var s = [];
        e.requestAnimationFrame = e.requestAnimationFrame || e.webkitRequestAnimationFrame || e.mozRequestAnimationFrame || e.oRequestAnimationFrame || e.msRequestAnimationFrame ||
            function (e) {
                setTimeout(e, 1e3 / 60)
            },
            i(".heart{width: 10px;height: 10px;position: fixed;background: #f00;transform: rotate(45deg);-webkit-transform: rotate(45deg);-moz-transform: rotate(45deg);}.heart:after,.heart:before{content: '';width: inherit;height: inherit;background: inherit;border-radius: 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;position: fixed;}.heart:after{top: -5px;}.heart:before{left: -5px;}"),
            n(),
            r()
    }(window, document);
JS;
                $js .= '</script>';
                break;
            case 'fireworks':
                $html .= '<canvas id="fireworks" style="position:fixed;left:0;top:0;pointer-events:none;"></canvas>';
                $js .= '<script type="text/javascript" src="https://cdn.bootcss.com/animejs/2.2.0/anime.min.js"></script>';
                $js .= "<script type='text/javascript' src='{$dir}/js/fireworks.js'></script>";
                break;
        }
        $mouseType = $HoerMouse->mouseType;
        $imageDir = Helper::options()->pluginUrl . '/Integration/assets/images';
        if ($mouseType != 'none') {
            $js .= '<script>';
            $js .= <<<JS
$("body").css("cursor", "url('{$imageDir}/{$mouseType}/normal.cur'), default");
$("a").css("cursor", "url('{$imageDir}/{$mouseType}/link.cur'), pointer");
JS;
            $js .= '</script>';
        }
        return compact('js', 'html');
    }

}