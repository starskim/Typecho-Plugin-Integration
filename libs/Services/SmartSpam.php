<?php


class SmartSpam
{
    /**
     * 评论过滤器
     *
     */
    public static function filter($comment)
    {
        $options = Helper::options();
        $filter_set = $options->plugin('Integration');
        $opt = "none";
        $error = "";


        //屏蔽评论内容包含文章标题
        if ($opt == "none" && $filter_set->opt_title != "none") {
            $db = Typecho_Db::get();
            // 获取评论所在文章
            $po = $db->fetchRow($db->select('title')->from('table.contents')->where('cid = ?', $comment['cid']));
            if (strstr($comment['text'], $po['title'])) {
                $error = "对不起，评论内容不允许包含文章标题";
                $opt = $filter_set->opt_title;
            }
        }


        //屏蔽IP段处理
        if ($opt == "none" && $filter_set->opt_ip != "none") {
            if (self::check_ip($filter_set->words_ip, $comment['ip'])) {
                $error = "评论发布者的IP已被管理员屏蔽";
                $opt = $filter_set->opt_ip;
            }
        }


        //屏蔽邮箱处理
        if ($opt == "none" && $filter_set->opt_mail != "none") {
            if (self::check_in($filter_set->words_mail, $comment['mail'])) {
                $error = "评论发布者的邮箱地址被管理员屏蔽";
                $opt = $filter_set->opt_mail;
            }
        }

        //屏蔽网址处理
        if (!empty($filter_set->words_url)) {
            if ($opt == "none" && $filter_set->opt_url != "none") {
                if (self::check_in($filter_set->words_url, $comment['url'])) {
                    $error = "评论发布者的网址被管理员屏蔽";
                    $opt = $filter_set->opt_url;
                }
            }
        }


        //屏蔽昵称关键词处理
        if ($opt == "none" && $filter_set->opt_au != "none") {
            if (self::check_in($filter_set->words_au, $comment['author'])) {
                $error = "对不起，昵称的部分字符已经被管理员屏蔽，请更换";
                $opt = $filter_set->opt_au;
            }
        }


        //日文评论处理
        if ($opt == "none" && $filter_set->opt_nojp != "none") {
            if (preg_match("/[\x{3040}-\x{31ff}]/u", $comment['text']) > 0) {
                $error = "禁止使用日文";
                $opt = $filter_set->opt_nojp;
            }
        }


        //日文用户昵称处理
        if ($opt == "none" && $filter_set->opt_nojp_au != "none") {
            if (preg_match("/[\x{3040}-\x{31ff}]/u", $comment['author']) > 0) {
                $error = "用户昵称禁止使用日文";
                $opt = $filter_set->opt_nojp_au;
            }
        }


        //昵称长度检测
        if ($opt == "none" && $filter_set->opt_au_length != "none") {
            if (self::strLength($comment['author']) < $filter_set->au_length_min) {
                $error = "昵称请不得少于" . $filter_set->au_length_min . "个字符";
                $opt = $filter_set->opt_au_length;
            } else
                if (self::strLength($comment['author']) > $filter_set->au_length_max) {
                    $error = "昵称请不得多于" . $filter_set->au_length_max . "个字符";
                    $opt = $filter_set->opt_au_length;
                }

        }

        //用户昵称网址判断处理
        if ($opt == "none" && $filter_set->opt_nourl_au != "none") {
            if (preg_match(" /^((https?|ftp|news):\/\/)?([a-z]([a-z0-9\-]*[\.。])+([a-z]{2}|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))(\/[a-z0-9_\-\.~]+)*(\/([a-z0-9_\-\.]*)(\?[a-z0-9+_\-\.%=&]*)?)?(#[a-z][a-z0-9_]*)?$/ ", $comment['author']) > 0) {
                $error = "用户昵称不允许为网址";
                $opt = $filter_set->opt_nourl_au;
            }
        }


        //纯中文评论处理
        if ($opt == "none" && $filter_set->opt_nocn != "none") {
            if (preg_match("/[\x{4e00}-\x{9fa5}]/u", $comment['text']) == 0) {
                $error = "评论内容请不少于一个中文汉字";
                $opt = $filter_set->opt_nocn;
            }
        }


        //字符长度检测
        if ($opt == "none" && $filter_set->opt_length != "none") {
            if (self::strLength($comment['text']) < $filter_set->length_min) {
                $error = "评论内容请不得少于" . $filter_set->length_min . "个字符";
                $opt = $filter_set->opt_length;
            } else
                if (self::strLength($comment['text']) > $filter_set->length_max) {
                    $error = "评论内容请不得多于" . $filter_set->length_max . "个字符";
                    $opt = $filter_set->opt_length;
                }

        }

        //检查禁止词汇
        if ($opt == "none" && $filter_set->opt_ban != "none") {
            if (self::check_in($filter_set->words_ban, $comment['text'])) {
                $error = "评论内容中包含禁止词汇";
                $opt = $filter_set->opt_ban;
            }
        }
        //检查敏感词汇
        if ($opt == "none" && $filter_set->opt_chk != "none") {
            if (self::check_in($filter_set->words_chk, $comment['text'])) {
                $error = "评论内容中包含敏感词汇";
                $opt = $filter_set->opt_chk;
            }
        }

        //执行操作
        if ($opt == "abandon") {
            Typecho_Cookie::set('__typecho_remember_text', $comment['text']);
            throw new Typecho_Widget_Exception($error);
        } else if ($opt == "spam") {
            $comment['status'] = 'spam';
        } else if ($opt == "waiting") {
            $comment['status'] = 'waiting';
        }
        Typecho_Cookie::delete('__typecho_remember_text');
        return $comment;
    }

    /**
     * 检查$ip中是否在$words_ip的IP段中
     *
     */
    private static function check_ip($words_ip, $ip)
    {
        $words = explode("\n", $words_ip);
        if (empty($words)) {
            return false;
        }
        foreach ($words as $word) {
            $word = trim($word);
            if (false !== strpos($word, '*')) {
                $word = "/^" . str_replace('*', '\d{1,3}', $word) . "$/";
                if (preg_match($word, $ip)) {
                    return true;
                }
            } else {
                if (false !== strpos($ip, $word)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * 检查$str中是否含有$words_str中的词汇
     *
     */
    private static function check_in($words_str, $str)
    {
        $words = explode("\n", $words_str);
        if (empty($words)) {
            return false;
        }
        foreach ($words as $word) {
            if (false !== strpos($str, trim($word))) {
                return true;
            }
        }
        return false;
    }

    /**
     * PHP获取字符串中英文混合长度
     */
    private static function strLength($str)
    {
        preg_match_all('/./us', $str, $match);
        return count($match[0]);  // 输出9
    }
}