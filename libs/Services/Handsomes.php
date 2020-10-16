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
        if ($plugin->pjax) {
            //彩色标签云及数字
            if (self::exist_value('colorfulTags.', $plugin->handsome)) {
                $options->ChangeAction .= "colorfulTags()";
            }
            //访问总数
            if (self::exist_value('TotalVisit.', $plugin->handsome)) {
                $options->ChangeAction .= "TotalVisit()";
            }
            //响应耗时
            if (self::exist_value('ResponseTime.', $plugin->handsome)) {
                $options->ChangeAction .= "ResponseTime()";
            }
            //评论打卡
            if (self::exist_value('CommentPunch.', $plugin->handsome)) {
                $options->ChangeAction .= "CommentPunch()";
            }
        }
    }
}