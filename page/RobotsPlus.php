<div class="typecho-list-operate clearfix">
    <form method="get">
        <input type="hidden" name="panel" value="<?php echo htmlspecialchars($request->get('panel')); ?>">
        <div class="operate">
            <label>
                <i class="sr-only">
                    <?php _e('全选'); ?>
                </i>
                <input type="checkbox" class="typecho-table-select-all"/>
            </label>
            <div class="btn-group btn-drop">
                <button class="btn dropdown-toggle btn-s" type="button">
                    <i class="sr-only">
                        <?php _e('操作'); ?>
                    </i>
                    <?php _e('选中项'); ?>
                    <i class="i-caret-down"></i>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a lang="<?php _e('您确认要删除这些日志吗?'); ?>"
                           href="<?php $security->index('/action/integration-edit?do=delete'); ?>">
                            <?php _e('删除'); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="search" role="search">
            <div class="search-ip-group">
                <input type="text" class="search-ip text-s" value="<?php echo htmlspecialchars($request->ip); ?>"
                       name="ip" placeholder="<?php _e('请输入 IP 搜索'); ?>">
                <a class="clear-search-ip" href="#" title="取消 IP 筛选">x</a>
            </div>
            <select class="search-bot" name="bot">
                <option value=""><?php _e('所有'); ?></option>
                <?php $RobotsPlus->botlist() ?>
            </select>
            <button type="submit" class="search-btn btn btn-s"> <?php _e('筛选'); ?></button>
        </div>
    </form>
</div><!-- end .typecho-list-operate -->

<form method="post" name="manage_posts" class="operate-form">
    <div class="typecho-table-wrap">
        <table class="typecho-list-table">
            <colgroup>
                <col width="25">
                <col width="260">
                <col width="60">
                <col width="30">
                <col width="110">
                <col width="205">
                <col width="150">
            </colgroup>
            <thead>
            <tr>
                <th class="nodrag"></th>
                <th><?php _e('受访地址'); ?></th>
                <th></th>
                <th></th>
                <th><?php _e('蜘蛛名称'); ?></th>
                <th><?php _e('IP地址'); ?>
                    <a class="check-ip-location" target="_blank" rel="noopener noreferrer">
                        <?php _e('查询位置') ?>
                    </a>
                </th>
                <th class="typecho-radius-topright"><?php _e('日期'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if ($RobotsPlus->have()): ?>
                <?php while ($RobotsPlus->next()): ?>
                    <tr id="<?php $RobotsPlus->theId(); ?>" class="even">
                        <td><input type="checkbox" value="<?php $RobotsPlus->lid(); ?>" name="lid[]"/></td>
                        <td colspan="3"><a
                                    href="<?php $RobotsPlus->url(); ?>"><?php echo urldecode(str_replace("%23", "#", $RobotsPlus->url)); ?></a>
                        </td>
                        <td data-bot="<?php $RobotsPlus->bot(); ?>"
                            class="robotx-bot-name"><?php $RobotsPlus->botnames(); ?></td>
                        <td>
                            <div class="robotx-ip"
                                 data-ip="<?php $RobotsPlus->ip(); ?>"><?php $RobotsPlus->ip(); ?></div>
                            <div class="robotx-location"></div>
                        </td>
                        <td><?php $RobotsPlus->date('Y-m-d H:i:s'); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7"><h6 class="typecho-list-table-title"><?php _e('当前无蜘蛛日志'); ?></h6></td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</form><!-- end .operate-form -->

<div class="typecho-list-operate clearfix">
    <form method="get">
        <div class="operate">
            <label><i class="sr-only">
                    <?php _e('全选'); ?>
                </i>
                <input type="checkbox" class="typecho-table-select-all"/>
            </label>
            <div class="btn-group btn-drop">
                <button class="btn dropdown-toggle btn-s" type="button">
                    <i class="sr-only">
                        <?php _e('操作'); ?>
                    </i>
                    <?php _e('选中项'); ?>
                    <i class="i-caret-down"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a lang="<?php _e('您确认要删除这些日志吗?'); ?>"
                           href="<?php $security->index('/action/integration-edit?do=delete'); ?>"><?php _e('删除'); ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <?php if ($RobotsPlus->have()): ?>
            <ul class="typecho-pager">
                <?php $RobotsPlus->pageNav(); ?>
            </ul>
        <?php endif; ?>
    </form>
</div><!-- end .typecho-list-operate -->