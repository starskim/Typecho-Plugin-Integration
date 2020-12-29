<div class="typecho-list-operate clearfix">
    <form action="<?php $options->adminUrl('baidu_sitemap/advanced'); ?>" method="post">
        <div class="operate">
            <select name="group">
                <?php $BaiduSubmit->group_num() ?>
            </select>
            <button class="btn btn-s" type="submit"><?php _e('发送分组URL'); ?></button>
        </div>
    </form>
</div><!-- end .typecho-list-operate -->

<form method="post" name="manage_posts" class="operate-form">
    <div class="typecho-table-wrap">
        <table class="typecho-list-table">
            <colgroup>
                <col width="15%"/>
                <col width="15%"/>
                <col width="15%"/>
                <col width="15%"/>
                <col width="25%"/>
                <col width="15%"/>
            </colgroup>
            <thead>
            <tr>
                <th><?php _e('主体'); ?></th>
                <th><?php _e('动作'); ?></th>
                <th><?php _e('对象'); ?></th>
                <th><?php _e('成功'); ?></th>
                <th><?php _e('更多信息'); ?></th>
                <th><?php _e('时间'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php while ($BaiduSubmit->next()): ?>
                <tr>
                    <td><?php $BaiduSubmit->subject(); ?></td>
                    <td><?php $BaiduSubmit->action(); ?></td>
                    <td><?php $BaiduSubmit->object(); ?></td>
                    <td <?php if ($BaiduSubmit->result == '失败'): ?> style="color: #ff0000" <?php endif; ?>><?php $BaiduSubmit->result() ?></td>
                    <td><span class="show-hide">显示</span><span class="org-value"><pre><?php $BaiduSubmit->more(); ?></pre></span>
                    </td>
                    <td><?php $BaiduSubmit->date('Y-m-d H:i:s'); ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</form><!-- end .operate-form -->

<div class="typecho-list-operate clearfix">
    <form method="get">
        <?php if ($BaiduSubmit->have()): ?>
            <ul class="typecho-pager">
                <?php $BaiduSubmit->pageNav(); ?>
            </ul>
        <?php endif; ?>
    </form>
</div><!-- end .typecho-list-operate -->