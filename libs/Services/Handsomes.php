<?php
/**
 * Created by stars_kim on 2020/10/14 5:04 下午
 */


class Handsomes extends Services
{
    public function TotalVisit()
    {

        $db = Typecho_Db::get();

        $query = $db->select('SUM(views)')->from('table.contents');

        $result = $db->fetchAll($query);

        return number_format($result[0]['SUM(`views`)']);
    }

    public function Pjax($plugin)
    {
        $options = Helper::options();
        //访问总数
        if (self::exist_value('TotalVisit.', $plugin->handsome)) $options->ChangeAction .= "\nTotalVisit();";
        //响应耗时
        if (self::exist_value('ResponseTime.', $plugin->handsome)) $options->ChangeAction .= "\nResponseTime();domTime();";
        //彩色标签云及数字
        if (self::exist_value('ColorfulTags.', $plugin->handsome)) $options->ChangeAction .= "\nColorfulTags();";
        //评论打卡
        if (self::exist_value('CommentPunch.', $plugin->handsome)) $options->ChangeAction .= "\nCommentPunch();";
        //P站每日热门
        if (self::exist_value('Pixiv.', $plugin->handsome)) $options->ChangeAction .= "\nPixiv();";
    }
}