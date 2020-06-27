<?php
error_reporting(E_ALL);
include 'header.php';
include 'menu.php';

date_default_timezone_set('PRC');

$_options = Helper::options();
$_cfg = $_options->plugin('Integration');
$_db = Typecho_Db::get();
$_prefix = $_db->getPrefix();
$stat = Typecho_Widget::widget('Widget_Stat');
$current = $request->get('act', 'RobotsPlus');
switch ($current) {
    case "RobotsPlus":
        $title = '查看蜘蛛日志';
        break;
    case "BaiduSubmit":
        $title = '百度结构化日志';
        break;
}
?>

<div class="main">
    <div class="body container">
        <div class="typecho-page-title">
            <h2><?= $title ?></h2>
        </div>
        <div class="row typecho-page-main" role="main">
            <div class="col-mb-12">
                <ul class="typecho-option-tabs fix-tabs clearfix">
                    <li<?= ($current == 'RobotsPlus' ? ' class="current"' : '') ?>>
                        <a href="<?php $_options->adminUrl('extending.php?panel=' . Integration_Plugin::$panel . '&act=RobotsPlus'); ?>">
                            <?php _e('查看蜘蛛日志'); ?>
                        </a>
                    </li>
                    <li<?= ($current == 'BaiduSubmit' ? ' class="current"' : '') ?>>
                        <a href="<?php $_options->adminUrl('extending.php?panel=' . Integration_Plugin::$panel . '&act=BaiduSubmit'); ?>">
                            <?php _e('百度结构化日志'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php $_options->adminUrl('options-plugin.php?config=Integration') ?>">
                            <?php _e('插件设置'); ?>
                        </a>
                    </li>
                </ul>
            </div>
            <?php if ($current == 'RobotsPlus'):require_once 'RobotsPlus.php'; endif; ?>
            <?php if ($current == 'BaiduSubmit'):require_once 'BaiduSubmit.php'; endif; ?>
        </div>
    </div>
</div>

<?php
include 'copyright.php';
include 'common-js.php';
include 'table-js.php';
?>
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
