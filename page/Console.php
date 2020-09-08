<?php
error_reporting(E_ALL);
include 'header.php';
include 'menu.php';

$_options = Helper::options();
$_cfg = $_options->plugin('Integration');
$_db = Typecho_Db::get();
$_prefix = $_db->getPrefix();
$current = $request->get('act');
?>

<div class="main">
    <div class="body container">
        <?php include 'page-title.php'; ?>
        <div class="row typecho-page-main" role="main">
            <div class="col-mb-12 typecho-list">
                <div class="clearfix">
                    <ul class="typecho-option-tabs">
                        <li<?php if (!isset($request->act) || 'RobotsPlus' == $current): ?> class="current"<?php endif; ?>>
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
                if (!isset($request->act) || 'RobotsPlus' == $current){
                    require_once 'RobotsPlus.php';
                }elseif ('BaiduSubmit' == $current){
                    require_once 'BaiduSubmit.php';
                }
                ?>

            </div><!-- end .typecho-list -->
        </div><!-- end .typecho-page-main -->
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
