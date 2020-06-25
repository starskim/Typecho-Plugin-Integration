<?php
include 'header.php';
include 'menu.php';

$_options = Helper::options();
$_cfg = $_options->plugin('Integration');
$_db = Typecho_Db::get();
$prefix = $_db->getPrefix();
$current = $request->get('act', 'RobotsPlus');
switch ($current) {
    case "RobotsPlus":
        $title = '查看蜘蛛日志';
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
                        <a href="<?php $options->adminUrl('extending.php?panel=' . Integration_Plugin::$panel . '&act=RobotsPlus'); ?>">
                            <?php _e('查看蜘蛛日志'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php $options->adminUrl('options-plugin.php?config=Integration') ?>">
                            <?php _e('插件设置'); ?>
                        </a>
                    </li>
                </ul>
            </div>
            <?php if ($current == 'RobotsPlus'):require_once 'RobotsPlus.php'; endif; ?>
        </div>
    </div>
</div>

<?php
include 'copyright.php';
include 'common-js.php';
include 'table-js.php';
include 'footer.php';
?>
