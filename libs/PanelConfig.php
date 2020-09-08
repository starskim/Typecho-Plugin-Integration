<?php

require_once "Forms/FormElements.php";
/*表单组件*/
require_once 'Forms/Checkbox_Integration.php';
require_once 'Forms/Text_Integration.php';
require_once 'Forms/Radio_Integration.php';
require_once 'Forms/Select_Integration.php';
require_once 'Forms/Textarea_Integration.php';

class PanelConfig
{
    /**
     * 获取插件配置面板
     *
     * @access public
     * @param $form
     * @return void
     */
    public static function config($form)
    {
        $Path = Helper::options()->pluginUrl . '/Integration/assets';
        $isDelete = new Radio_integration('isDelete', [0 => '不删除', 1 => '删除'], 1, _t('卸载是否删除数据表'));
        echo <<<EOF
<link href="https://cdn.bootcdn.net/ajax/libs/mdui/0.4.3/css/mdui.min.css" rel="stylesheet">
<link href="$Path/css/admin.min.css" rel="stylesheet">
<script src="https://cdn.bootcdn.net/ajax/libs/mdui/0.4.3/js/mdui.min.js"></script>
<div class="mdui-card">
 <div class="mdui-progress">
 </div> 
 <div class="mdui-container">
  <div class="mdui-tab mdui-tab-scrollable mdui-tab-centered mdui-tab-full-width" mdui-tab>
<!--    <a href="#example1-tab1" class="mdui-ripple">著作</a>-->
    <a href="#example1-tab2" class="mdui-ripple">说明</a>
    <a href="#example1-tab3" class="mdui-ripple">建议</a>
  </div>

<!--  <div id="example1-tab1" class="mdui-p-a-2"> -->
<!--  <p>Sitemap：作者：<a href="https://www.bayun.org" target="_blank">八云酱</a></p>-->
<!--  <p>蛛来访日志：作者：<a href="http://www.yovisun.com" target="_blank">Yovi Sun</a>；修复人：<a href="https://www.catbei.com" target="_blank">猫贝</a></p>-->
<!--  <p>评论拦截：作者：<a href="http://www.yovisun.com/archive/typecho-plugin-smartspam.html/" target="_blank">Yovis Blog</a></p>-->
<!--  <p>如果以下内容侵权了您的利益请联系：<a href="https://803344.xyz/" target="_blank">小宇宙</a></p>-->
<!--  </div>-->
  <div id="example1-tab2" class="mdui-p-a-2">
      <p>我写这个插件主要是为了给自己方便，不用每次主题更新都需要手动修改文件的问题</p>
    <p>有部分功能是搬自其它的插件</p>
    <p>因为不想安装多个插件，或者原插件不合适自己</p>
  </div>
  <div id="example1-tab3" class="mdui-p-a-2">
    <p>可以通过您的建议的添加功能进来</p>
    <p>初衷：美化个人博客，不会添加一些不实际的</p>
<!--    <p>联系方式.博客上留言：<a href="https://803344.xyz/" target="_blank">小宇宙</a></p>-->
  </div>
</div>
</div>
EOF;
        $form->addItem(new Integration('<div class="mdui-panel" mdui-panel="">'));
        $form->addInput($isDelete);
        self::RobotsPlus($form);
        self::AutoTags($form);
        self::ReturnTop($form);
        self::ActivatePowerMode($form);
        self::BaiduSubmit($form);
        self::HoerMouse($form, $Path);
        self::SmartSpam($form);
    }


    /**
     * 蛛来访日志配置面板
     * @param $form
     */
    private static function RobotsPlus($form)
    {
        $options = array(
            'baidu' => '百度',
            'google' => '谷歌',
            'sogou' => '搜狗',
            'youdao' => '有道',
            'soso' => '搜搜',
            'bing' => '必应',
            'yahoo' => '雅虎',
            '360' => '360搜索'
        );
        $botlist = new Checkbox_integration('botlist', $options, array('baidu', 'google', 'sogou', 'youdao', 'soso', 'bing', 'yahoo', '360'), '蜘蛛记录设置', '请选择要记录的蜘蛛日志');
        $pagecount = new Text_integration('pagecount', NULL, '20', '分页数量', '每页显示的日志数量');
        $dbool = array(
            '0' => '删除',
            '1' => '不删除'
        );
        $form->addItem(new Title_Integration('蛛来访日志'));
        $form->addInput($botlist);
        $form->addInput($pagecount);
        $form->addItem(new EndSymbol_Integration(2));
    }

    /**
     * 自动标签配置面板
     * @param $form
     */
    private static function AutoTags($form)
    {
        $isActive = new Radio_integration('isActive', array('1' => '是', '0' => '否',), '0', _t('自动标签'), _t('自动提取功能在文章已存在标签时不生效.'));
        $form->addInput($isActive);
    }

    /**
     * 返回顶部配置面板
     * @param $form
     */
    private static function ReturnTop($form)
    {
        $list = [
            '0' => '关闭',
            '1' => '拉姆雷姆',
            '2' => '夏目的喵'
        ];
        $Result = new Radio_integration('ReturnTop', $list, '0', _t('返回顶部'), _t('这是两个很萌的返回顶部控件'));
        $form->addInput($Result);
    }

    /**
     * 打字特效配置面板
     * @param $form
     */
    private static function ActivatePowerMode($form)
    {
        $activeineditor = new Radio_integration('activeineditor', ['0' => _t('不启用'), '1' => _t('启用')], '1', _t('是否在后台启用'), _t('选择是否在文章与页面编辑界面启用本插件。'));
        $colorful = new Checkbox_integration('colorful', ['true' => _t('颜色效果')], ['true'], _t('开启颜色效果'));
        $shake = new Checkbox_integration('shake', ['true' => _t('振动效果')], ['true'], _t('开启振动效果'));
        $form->addItem(new Title_Integration('打字特效'));
        $form->addInput($activeineditor);
        $form->addInput($colorful);
        $form->addInput($shake);
        $form->addItem(new EndSymbol_Integration(2));
    }

    /**
     * 百度结构化配置面板
     * @param $form
     */
    private static function BaiduSubmit($form)
    {
        $form->addItem(new Title_Integration('百度结构化'));
        $element = new Text_integration('api', null, null, _t('接口调用地址'), '请登录百度站长平台获取');
        $form->addInput($element);

        $element = new Text_integration('group', null, 15, _t('分组URL数'), '每天最多只能发送50条，请酌情设置');
        $form->addInput($element);
        $form->addItem(new EndSymbol_Integration(2));
    }

    /**
     * 炫彩鼠标配置面板
     * @param $form
     */
    private static function HoerMouse($form, $Path)
    {
        // 鼠标样式
        $options = [
            'none' => _t('系统默认'),
            'dew' => "<img src='{$Path}/images/dew/normal.cur'><img src='{$Path}/images/dew/link.cur'>",
            'carrot' => "<img src='{$Path}/images/carrot/normal.cur'><img src='{$Path}/images/carrot/link.cur'>",
            'exquisite' => "<img src='{$Path}/images/exquisite/normal.cur'><img src='{$Path}/images/exquisite/link.cur'>",
            'marisa' => "<img src='{$Path}/images/marisa/normal.cur'><img src='{$Path}/images/marisa/link.cur'>",
            'shark' => "<img src='{$Path}/images/shark/normal.cur'><img src='{$Path}/images/shark/link.cur'>",
            'sketch' => "<img src='{$Path}/images/sketch/normal.cur'><img src='{$Path}/images/sketch/link.cur'>",
            'star' => "<img src='{$Path}/images/star/normal.cur'><img src='{$Path}/images/star/link.cur'>",
        ];
        $bubbleType = new Radio_integration('mouseType', $options, 'none', _t('鼠标样式'));
        $form->addInput($bubbleType);

        $form->addItem(new Title_Integration('鼠标点击特效', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;加载jQuery库、气泡类型、文字气泡、气泡颜色、气泡速度'));
        // 气泡类型
        $options = [
            'none' => _t('无'),
            'text' => _t('文字气泡'),
            'heart' => _t('爱心气泡'),
            'fireworks' => _t('fireworks+anime喷墨气泡'),
        ];
        $bubbleType = new Radio_integration('bubbleType', $options, 'none', _t('气泡类型'));
        $form->addInput($bubbleType);

        // 气泡文字
        $bubbleText = new Text_integration('bubbleText', null, _t('欢迎来到我的小站!'), _t('文字气泡填写'), _t('如果选择文字气泡类型, 请填写文字'));
        $form->addInput($bubbleText);

        // 气泡颜色
        $bubbleColor = new Text_integration('bubbleColor', null, _t('随机'), _t('文字气泡颜色'), _t('如果选择文字气泡类型, 请填写气泡颜色, 可填入"随机"或十六进制颜色值 如#2db4d8'));
        $form->addInput($bubbleColor);

        // 气泡速度
        $bubbleSpeed = new Text_integration('bubbleSpeed', null, _t('3000'), _t('文字气泡速度'), _t('如果选择文字气泡类型, 请填写气泡速度 默认3秒'));
        $form->addInput($bubbleSpeed);
        $form->addItem(new EndSymbol_Integration(2));
    }

    /**
     * SmartSpam配置面板
     * @param $form
     */
    private static function SmartSpam($form)
    {
        $opt_length = new Radio_integration('opt_length', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #de1cc6'>评论字符长度操作</span>", "如果评论中长度不符合条件，则强行按该操作执行。如果选择[无动作]，将忽略下面长度的设置");
        $length_min = new Text_integration('length_min', NULL, '1', "<span style='color: #de1cc6'>最短字符</span>", '允许评论的最短字符数。');
        $length_max = new Text_integration('length_max', NULL, '200', "<span style='color: #de1cc6'>最长字符</span>", '允许评论的最长字符数');
        $opt_ban = new Radio_integration('opt_ban', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #FF0000'>禁止词汇操作</span>", "如果评论中包含禁止词汇列表中的词汇，将执行该操作");
        $words_ban = new Textarea_integration('words_ban', NULL, "傻逼\n操你妈\n智障\n傻子",
            "<span style='color: #FF0000'>禁止词汇表</span>", _t('多条词汇请用换行符隔开'));
        $opt_chk = new Radio_integration('opt_chk', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #FF9797'>敏感词汇操作</span>", "如果评论中包含敏感词汇列表中的词汇，将执行该操作");
        $words_chk = new Textarea_integration('words_chk', NULL, "http://",
            "<span style='color: #FF9797'>敏感词汇表</span>", _t('多条词汇请用换行符隔开<br />注意：如果词汇同时出现于禁止词汇，则执行禁止词汇操作'));
        $opt_au_length = new Radio_integration('opt_au_length', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #FF44FF'>昵称字符长度操作</span>", "如果昵称长度不符合条件，则强行按该操作执行。如果选择[无动作]，将忽略下面长度的设置");
        $au_length_min = new Text_integration('au_length_min', NULL, '1', "<span style='color: #FF44FF'>昵称最短字符数</span>", '昵称允许的最短字符数。');
        $au_length_max = new Text_integration('au_length_max', NULL, '20', "<span style='color: #FF44FF'>昵称最长字符数</span>", '昵称允许的最长字符数');
        $opt_nojp_au = new Radio_integration('opt_nojp_au', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #84C1FF'>昵称日文操作</span>", "如果用户昵称中包含日文，则强行按该操作执行");
        $opt_nourl_au = new Radio_integration('opt_nourl_au', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #0072E3'>昵称网址操作</span>", "如果用户昵称是网址，则强行按该操作执行");
        $opt_au = new Radio_integration('opt_au', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #B15BFF'>屏蔽昵称关键词操作</span>", "如果评论发布者的昵称含有该关键词，将执行该操作");
        $words_au = new Textarea_integration('words_au', NULL, "",
            "<span style='color: #B15BFF'>屏蔽昵称关键词表</span>", _t('多个关键词请用换行符隔开'));
        $opt_ip = new Radio_integration('opt_ip', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #FF5809'>屏蔽IP操作</span>", "如果评论发布者的IP在屏蔽IP段，将执行该操作");
        $words_ip = new Textarea_integration('words_ip', NULL, "0.0.0.0",
            "<span style='color: #FF5809'>屏蔽IP</span>", _t('多条IP请用换行符隔开<br />支持用*号匹配IP段，如：192.168.*.*'));
        $opt_mail = new Radio_integration('opt_mail', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #4F9D9D'>屏蔽邮箱操作</span>", "如果评论发布者的邮箱与禁止的一致，将执行该操作");
        $words_mail = new Textarea_integration('words_mail', NULL, "",
            "<span style='color: #4F9D9D'>邮箱关键词</span>", _t('多个邮箱请用换行符隔开<br />可以是邮箱的全部，或者邮箱部分关键词'));
        $opt_url = new Radio_integration('opt_url', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #AFAF61'>屏蔽网址操作</span>", "如果评论发布者的网址与禁止的一致，将执行该操作。如果网址为空，该项不会起作用。");
        $words_url = new Textarea_integration('words_url', NULL, "",
            "<span style='color: #AFAF61'>网址关键词</span>", _t('多个网址请用换行符隔开<br />可以是网址的全部，或者网址部分关键词。如果网址为空，该项不会起作用。'));
        $opt_title = new Radio_integration('opt_title', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #743A3A'>内容含有文章标题</span>", "如果评论内容中含有本页面的文章标题，则强行按该操作执行");
        $opt_nojp = new Radio_integration('opt_nojp', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #CF9E9E'>日文评论操作</span>", "如果评论中包含日文，则强行按该操作执行");
        $opt_nocn = new Radio_integration('opt_nocn', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #CF9E9E'>非中文评论操作</span>", "如果评论中不包含中文，则强行按该操作执行");
        $form->addItem(new Title_integration('评论拦截', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;颜色区分（默认开启,自行配置）&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者：<a href="http://www.yovisun.com/archive/typecho-plugin-smartspam.html/" target="_blank"> Yovis Blog</a>'));
        $form->addInput($opt_length);
        $form->addInput($length_min);
        $form->addInput($length_max);
        $form->addInput($opt_ban);
        $form->addInput($words_ban);
        $form->addInput($opt_chk);
        $form->addInput($words_chk);
        $form->addInput($opt_au_length);
        $form->addInput($au_length_min);
        $form->addInput($au_length_max);
        $form->addInput($opt_nojp_au);
        $form->addInput($opt_nourl_au);
        $form->addInput($opt_au);
        $form->addInput($words_au);
        $form->addInput($opt_ip);
        $form->addInput($words_ip);
        $form->addInput($opt_mail);
        $form->addInput($words_mail);
        $form->addInput($opt_url);
        $form->addInput($words_url);
        $form->addInput($opt_title);
        $form->addInput($opt_nojp);
        $form->addInput($opt_nocn);
        $form->addItem(new EndSymbol_integration(2));
    }
}