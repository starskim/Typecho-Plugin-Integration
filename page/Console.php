<?php
error_reporting(E_ALL);
include 'header.php';
include 'menu.php';

$current = $request->get('act');
Typecho_Widget::widget('Integration_libs_Console_RobotsPlus')->to($RobotsPlus);
Typecho_Widget::widget('Integration_libs_Console_BaiduSubmit')->to($BaiduSubmit);
?>

<div class="main">
    <div class="body container">
        <?php include 'page-title.php'; ?>
        <div class="row typecho-page-main" role="main">
            <div class="col-mb-12 typecho-list">
                <div class="clearfix">
                    <ul class="typecho-option-tabs">
                        <li<?php if (!isset($request->act)): ?> class="current"<?php endif; ?>>
                            <a href="<?php $options->adminUrl('extending.php?panel=' . Integration_Plugin::$panel); ?>">
                                <?php _e('查看蜘蛛日志'); ?>
                            </a>
                        </li>
                        <li<?php if ('BaiduSubmit' == $current): ?> class="current"<?php endif; ?>>
                            <a href="<?php $options->adminUrl('extending.php?panel=' . Integration_Plugin::$panel . '&act=BaiduSubmit'); ?>">
                                <?php _e('百度结构化日志'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php $options->adminUrl('options-plugin.php?config=Integration'); ?>">
                                <?php _e('插件设置'); ?>
                            </a>
                        </li>
                    </ul>
                </div>

                <?php

                if (!isset($request->act)) {
                    require_once 'RobotsPlus.php';
                } elseif ('BaiduSubmit' == $current) {
                    require_once 'BaiduSubmit.php';
                }
                ?>

            </div><!-- end .typecho-list -->
        </div><!-- end .typecho-page-main -->
    </div>
</div>
<style>
    .search-ip-group {
        position: relative;
        float: left;
        margin-right: 10px;
    }

    .clear-search-ip {
        background: #fff;
        padding: 2px 7px;
        position: absolute;
        right: 0;
        margin: 1px;
    }

    [id^="robots-log"] {
        cursor: move;
    }

    .check-ip-location {
        padding-left: 12px;
        cursor: pointer;
    }

    .robotx-bot-name,
    .robotx-ip {
        cursor: pointer;
    }
</style>
<?php
include 'copyright.php';
include 'common-js.php';
include 'table-js.php';
?>
<script>
    function showIpLocation() {
        $(".robotx-location").text("正在查询...");
        $(".robotx-ip").each(function () {
            var myd = $(this);
            $.ajax({
                url: "https://ip.huomao.com/ip?ip=" + myd.text(),
                type: 'get',
                dataType: 'json',
                success: function (str) {
                    data = eval(str);
                    myd.next().text(data.country + data.province + data.city + data.isp).css("color", "#BD6800");
                },
                error: function (e) {
                    myd.next().text("无该 IP 详细信息").css("color", "#f00");
                }
            });
        });
    }

    $(document).ready(function () {
        $(".check-ip-location").click(showIpLocation);
        $(".robotx-ip").click(function () {
            $('.search-ip').val($(this).data('ip'));
            $('.search-btn').trigger('click');
        });
        $(".robotx-bot-name").click(function () {
            $('.search-bot').val($(this).data('bot'));
            $('.search-btn').trigger('click');
        });
        $(".clear-search-ip").click(function () {
            $('.search-ip').val("");
            $('.search-btn').trigger('click');
        });
    });
</script>
<script>
    $(function () {
        var show = $('.show-hide')
        var pre = $('.org-value')

        show.css('color', 'blue');
        show.css('cursor', 'cursor');
        $('.org-value pre').css('background-color', '#E3FFDA');

        pre.hide();

        show.on('click', function () {
            $(this).hide().parent().find('.org-value').show();
        });

        pre.on('click', function () {
            $(this).hide().parent().find('.show-hide').show();
        });
    });
</script>
<?php
include 'footer.php';
?>
