<?php


class AutoTags extends Services
{
    /**
     * 发布文章时自动提取标签
     *
     * @access public
     * @return void
     */
    public static function write($contents)
    {
        $html = $contents['text'];
        $isMarkdown = (0 === strpos($html, '<!--markdown-->'));
        if ($isMarkdown) {
            $html = Markdown::convert($html);
        }
        $text = str_replace("\n", '', trim(strip_tags(html_entity_decode($html))));
        $options = Helper::options();
        $autoTags = $options->plugin('Integration');
        //插件启用,且未手动设置标签
        if (self::exist_value('AutoTags', $autoTags->Console) && !$contents['tags']) {
            Typecho_Widget::widget('Widget_Metas_Tag_Admin')->to($tags);
            foreach ($tags->stack as $tag) {
                $tagNames[] = $tag['name'];
            }
            //str_replace("\n", '', trim(strip_tags($contents['text'])))
            //过滤 html 标签等无用内容
            $postString = json_encode($text);
            $context = stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => array(
                        'Content-Type: application/json',
                        'Accept: application/json',
                        'X-Token: fpm1fDvA.5220.GimJs8QvViSK'
                    ),
                    'content' => $postString
                ]
            ]);
            $result = file_get_contents('http://api.bosonnlp.com/tag/analysis?space_mode=0&oov_level=0&t2s=0', false, $context);
            $result = json_decode($result);
            $ignoreTag = [
                'w',
                'wkz',
                'wky',
                'wyz',
                'wyy',
                'wj',
                'ww',
                'wt',
                'wd',
                'wf',
                'wn',
                'wm',
                'ws',
                'wp',
                'wb',
                'wh',
                'email',
                'tel',
                'id',
                'ip',
                'url',
                'o',
                'y',
                'u',
                'uzhe',
                'ule',
                'ugou',
                'ude',
                'usou',
                'udeng',
                'uyy',
                'udh',
                'uzhi',
                'ulian',
                'c',
                'p',
                'pba',
                'pbei',
                'd',
                'dl',
                'q',
                'm',
                'r',
                'z',
                'b',
                'bl',
                'a',
                'ad',
                'an',
                'al',
                'v',
                'vd',
                'vshi',
                'vyou',
                'vl',
                'f',
                's',
                't',
                'nl'];
            $sourceTags = array();
            foreach ($result[0]->tag as $key => $tag) {
                if (!in_array($tag, $ignoreTag)) {
                    if (in_array($result[0]->word[$key], $tagNames)) {
                        if (in_array($result[0]->word[$key], $sourceTags)) continue;
                        $sourceTags[] = $result[0]->word[$key];
                    }
                }
            }
            $contents['tags'] = implode(',', array_unique($sourceTags));
            if (count($contents['tags']) < 3) {
                $context = stream_context_create([
                    'http' => [
                        'method' => 'POST',
                        'header' => array(
                            'Content-Type: application/json',
                            'Accept: application/json',
                            'X-Token: fpm1fDvA.5220.GimJs8QvViSK'
                        ),
                        'content' => $postString
                    ]
                ]);
                $result = file_get_contents('http://api.bosonnlp.com/keywords/analysis?top_k=5', false, $context);
                $result = json_decode($result);
                foreach ($result as $re) {
                    $a[] = $re[1];
                }
                $contents['tags'] = $contents['tags'] ? $contents['tags'] . ',' . implode(',', $a) : implode(',', $a);
            }
        }
        return $contents;
    }
}