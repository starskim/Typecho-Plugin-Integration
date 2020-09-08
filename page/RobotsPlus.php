<?php
/**
 * 蜘蛛来访日志查看
 *
 * @package RobotsPlus
 * @author  catbei
 * @version 2.1.0
 * @update: 2020.04.17
 * @link https://www.catbei.com
 */

$botlist = $_cfg->botlist;
$pagecount = $_cfg->pagecount;
if ($botlist == null || $pagecount == null) {
    throw new Typecho_Plugin_Exception('请先设置插件！');
}
$p = 1;
$rtype = '';
$oldtype = '';
if (isset($_POST['rpage'])) {
    $p = $_POST['rpage'];
}
if (isset($_GET['do']) && $_GET['do']) {
    $_POST['do'] = $_GET['do'];
}
if (isset($_POST['do'])) {
    $do = $_POST['do'];
    if ($do == 'delete') {
        if (isset($_POST['lid'])) {
            $lids = $_POST['lid'];
            $deleteCount = 0;
            if ($lids && is_array($lids)) {
                foreach ($lids as $lid) {
                    if ($_db->query($_db->delete($_prefix . 'robots_logs')->where('lid = ?', $lid))) {
                        $deleteCount++;
                    }
                }
            }
            Typecho_Widget::widget('Widget_Notice')->set('成功删除蜘蛛日志', NULL, 'success');
            Typecho_Response::redirect(Typecho_Common::url('extending.php?panel=' . Integration_Plugin::$panel . '&act=RobotsPlus', $_options->adminUrl));
        } else {
            Typecho_Widget::widget('Widget_Notice')->set('当前没有选择的日志', NULL, 'notice');
            Typecho_Response::redirect(Typecho_Common::url('extending.php?panel=' . Integration_Plugin::$panel . '&act=RobotsPlus', $_options->adminUrl));
        }
    }
    if (strpos($do, 'clear') !== false) {
        try {
            $cleartype = substr($do, 6);
            $timeStamp = $_options->gmtTime;
            $offset = $_options->timezone - $_options->serverTimezone;
            $gtime = $timeStamp + $offset;
            $lowtime = $gtime - ($cleartype * 86400);
            $_db->query($_db->delete($_prefix . 'robots_logs')->where('ltime < ?', $lowtime));
            Typecho_Widget::widget('Widget_Notice')->set('清除日志成功', NULL, 'success');
            Typecho_Response::redirect(Typecho_Common::url('extending.php?panel=' . Integration_Plugin::$panel . '&act=RobotsPlus', $_options->adminUrl));
        } catch (Typecho_Db_Exception $e) {
            Typecho_Widget::widget('Widget_Notice')->set('清除日志失败', NULL, 'notice');
            Typecho_Response::redirect(Typecho_Common::url('extending.php?panel=' . Integration_Plugin::$panel . '&act=RobotsPlus', $_options->adminUrl));
        }
    }
}
if (isset($_POST['oldtype'])) {
    $oldtype = $_POST['oldtype'];
}
if (isset($_POST['rpage']) && $_POST['rtype'] !== '') {
    $rtype = $_POST['rtype'];
    if ($oldtype !== $rtype) {
        $p = 1;
    }
    $logs = $_db->fetchAll($_db->select()->from($_prefix . 'robots_logs')->where('bot = ?', $rtype)->order($_prefix . 'robots_logs.lid', Typecho_Db::SORT_DESC)->page($p, $pagecount));
    $rows = count($_db->fetchAll($_db->select('lid')->from($_prefix . 'robots_logs')->where('bot = ?', $rtype)));
} else {
    $logs = $_db->fetchAll($_db->select()->from($_prefix . 'robots_logs')->order($_prefix . 'robots_logs.lid', Typecho_Db::SORT_DESC)->page($p, $pagecount));
    $rows = count($_db->fetchAll($_db->select('lid')->from($_prefix . 'robots_logs')));
}
$co = $rows % $pagecount;
$pageno = floor($rows / $pagecount);
if ($co !== 0) {
    $pageno += 1;
}
?>
<div class="col-mb-12 start-01 typecho-list">
    <div class="typecho-list-operate clearfix">
        <form method="post"
              action="<?php $_options->adminUrl('extending.php?panel=' . Integration_Plugin::$panel . '&act=RobotsPlus'); ?>">
            <div class="operate">
                <label>
                    <i class="sr-only">
                        <?php _e('全选'); ?>
                    </i>
                    <input type="checkbox" class="typecho-table-select-all"/>
                </label>
                <div class="btn-group btn-drop">
                    <button class="btn dropdown-toggle btn-s" type="button"><i class="sr-only">
                            <?php _e('操作'); ?></i><?php _e('选中项'); ?>
                        <i class="i-caret-down"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a lang="<?php _e('您确认要删除这些日志吗?'); ?>" type="submit"><?php _e('删除'); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="search" role="search">
                <select name="rpage">
                    <?php for ($i = 1; $i <= $pageno; $i++): ?>
                        <option value="<?php echo $i ?>"
                                <?php if ($i == $p): ?>selected="selected"<?php endif; ?>>
                            第<?php echo $i ?>页
                        </option>
                    <?php endfor; ?>
                </select>
                <select name="rtype">
                    <option value="">所有蜘蛛</option>
                    <?php
                    if (sizeof($botlist) > 0) {
                        foreach ($botlist as $bot) {
                            $selected = $rtype == $bot ? ' selected="selected"' : NULL;
                            echo '<option value="' . $bot . '"' . $selected . '>' . botname($bot) . '</option>';
                        }
                    }
                    function botname($bot)
                    {
                        switch ($bot) {
                            case "baidu":
                                return '百度';
                                break;
                            case "google":
                                return '谷歌';
                                break;
                            case "yahoo":
                                return '雅虎';
                                break;
                            case "sogou":
                                return '搜狗';
                                break;
                            case "youdao":
                                return '有道';
                                break;
                            case "soso":
                                return '搜搜';
                                break;
                            case "bing":
                                return '必应';
                                break;
                            case "360":
                                return '360搜索';
                                break;
                        }
                    }

                    ?>
                </select>
                <button type="submit">查看</button>
            </div>
            <input type="hidden" name="do" value="select"/>
            <input type="hidden" name="oldtype" value="<?php echo $rtype; ?>"/>
        </form>
    </div>

    <form method="post" name="manage_medias" class="operate-form">
        <div class="typecho-table-wrap">
            <table class="typecho-list-table">
                <colgroup>
                    <col width="25"/>
                    <col width="50"/>
                    <col width="260"/>
                    <col width="60"/>
                    <col width="30"/>
                    <col width="110"/>
                    <col width="205"/>
                    <col width="150"/>
                </colgroup>
                <thead>
                <tr>
                    <th class="typecho-radius-topleft"></th>
                    <th></th>
                    <th>受访地址</th>
                    <th></th>
                    <th></th>
                    <th>蜘蛛名称</th>
                    <th>IP地址</th>
                    <th class="typecho-radius-topright">日期</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($logs)): ?>
                    <?php foreach ($logs as $log): ?>
                        <tr class="even" id="post-5">
                            <td><input type="checkbox" value="<?php echo $log['lid']; ?>" name="lid[]"/>
                            </td>
                            <td></td>
                            <td colspan="2"><a
                                        href="<?php echo str_replace("%23", "#", $log['url']); ?>"><?php echo urldecode(str_replace("%23", "#", $log['url'])); ?></a>
                            </td>
                            <td></td>
                            <td><?php echo botname($log['bot']); ?></td>
                            <td><?php echo $log['ip']; ?></td>
                            <td><?php echo date('Y-m-d H:i:s', $log['ltime']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr class="even">
                        <td colspan="8"><h6
                                    class="typecho-list-table-title"><?php _e('当前无蜘蛛日志'); ?></h6></td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <input type="hidden" name="do" value="delete"/>
    </form>
</div>
