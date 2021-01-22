<?php

require_once "Forms/FormElements.php";
/*表单组件*/
require_once 'Forms/Checkbox_Integration.php';
require_once 'Forms/Text_Integration.php';
require_once 'Forms/Radio_Integration.php';
require_once 'Forms/Select_Integration.php';
require_once 'Forms/Textarea_Integration.php';

class PanelConfig extends Services
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
        $Path = sprintf("%s/Integration/assets", Helper::options()->pluginUrl);
        echo <<<EOF
<link href="https://cdn.bootcdn.net/ajax/libs/mdui/1.0.0/css/mdui.min.css" rel="stylesheet">
<link href="$Path/css/admin.min.css" rel="stylesheet">
<script src="https://cdn.bootcdn.net/ajax/libs/mdui/1.0.0/js/mdui.min.js"></script>
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
        //一、基本配置
        $layout = new Typecho_Widget_Helper_Layout();
        $layout->html(_t('<h4>基本配置:</h4><hr>'));
        $form->addItem($layout);
        self::PrettifyStyle($form);
        self::ActivatePowerMode($form);
        self::HoerMouse($form, $Path);

        //二、增强配置
        $layout = new Typecho_Widget_Helper_Layout();
        $layout->html(_t('<h4>增强配置:</h4><hr>'));
        $form->addItem($layout);
        self::Console($form);
        self::RobotsPlus($form);
        self::BaiduSubmit($form);
        self::ReturnTop($form);
        self::SmartSpam($form);
        self::LocalResourceSrc($form);


    }

    private static function PrettifyStyle($form)
    {
        $form->addItem(new Title_Integration(_t('主题美化')));
        self::DynamicBackground($form);
        self::Generalfunction($form);
        if (self::GetTheme() == 'handsome') {
            self::handsome($form);
        }
        $form->addItem(new EndSymbol_Integration(2));

    }

    public static function DynamicBackground($form)
    {
        $list = [
            'none' => '不使用动态背景',
            'a1.js' => '黑客帝国001',
            'a2.js' => '黑客帝国002',
            'a3.js' => '磁力线条',
            'a4.js' => '浮动气泡',
            'a5.js' => '七色彩虹',
            'a6.js' => '下雨背景',
            'a7.js' => '彩色气球[推荐]',
            'a8.js' => '彩色爱心',
            'a9.js' => '科技背景',
            'b1.js' => '蓝色气泡',
            'b2.js' => '漫漫星空[推荐]',
            'b3.js' => '海平面',
            'b4.js' => '随机色带',
            'b5.js' => '气泡背景[推荐]',
            'b6.js' => '旋转特效',
            'b7.js' => '磁感线',
            'b8.js' => '互动星空',
            'b9.js' => '旋转星空',
        ];
        $DynamicBackground = new Select_Integration('DynamicBackground', $list, 'a7.js', _t('动态背景'), _t('动态背景的渲染会占用终端用户的内存，如果您的用户不是十几年前的机型，影响可以忽略不计'));
        $form->addInput($DynamicBackground);

    }

    private static function Generalfunction($form)
    {
        $list = [
            "MoeTitle." => _t("标题卖萌"),
            "TextBan." => _t("文字禁止选中"),
            "PicturesBan." => _t("图片禁止拖动"),
            "PicturesLight." => _t("图片呼吸灯"),
            "Copy." => _t("复制提醒"),
            "Copy2." => _t("复制提醒2"),
            "Copy3." => _t("复制提醒3"),
            "PlayRemind." => _t("播放提醒"),
            "InboundWelcome." => _t("入站欢迎"),
            "InboundWelcome2." => _t("入站欢迎（定位）"),
            "MySSL." => _t("MySSL安全认证签章"),
            "BanF12." => _t("禁用F12"),
            "BanDeBug." => _t("禁止调试"),
        ];
        $options = [
            "MoeTitle.",
            "Copy.",
            "MySSL.",
        ];
        $General = new Checkbox_Integration('General', $list, $options, _t('通用功能'));
        $form->addInput($General);
    }

    private static function handsome($form)
    {
        $list = [
            "TransparentStyle." => _t("透明样式"),
            "BoxModel." => _t("盒子模型"),
            "TitleCentered." => _t("标题居中"),
            "AvatarRotationZoom." => _t("头像转动并放大"),
            "AvatarRotation." => _t("头像转动"),
            "AvatarCrazyRotation." => _t("头像疯狂转动"),
            "AvatarBreathingLight." => _t("头像呼吸灯"),
            "ArticleCard." => _t("文章选择卡"),
            "ArticleShadowing." => _t("文章阴影化"),
            "TopLamp." => _t("顶部跑马灯"),
            "RewardStyle." => _t("打赏图片"),
            "RewardBeating." => _t("打赏跳动"),
            "ScrollStyle." => _t("滚动条美化"),
            "TitleStyle." => _t("文章标题美化"),
            "HS_Copy." => _t("复制提醒"),
            "HS_InboundWelcome." => _t("入站欢迎"),
            "HS_InboundWelcome2." => _t("入站欢迎（定位）"),
            "BlogJob1." => _t("博主介绍闪烁1"),
            "BlogJob2." => _t("博主介绍闪烁2"),
            "KnewWeather." => _t("心知天气"),
            "BaiduIncluded." => _t("百度收录"),
            "Pixiv." => _t("P站每日热门"),
            "TotalVisit." => _t("访问总数"),
            "ResponseTime." => _t("响应耗时"),
            "CommentPunch." => _t("评论打卡"),
            "ColorfulIcon." => _t("彩色图标"),
            "ColorfulTags." => _t("彩色标签云及数字"),
        ];
        $options = [
            "TitleCentered.",
            "AvatarRotationZoom.",
            "TitleStyle.",
            "BlogJob2.",
            "Pixiv.",
            "CommentPunch.",
            "ColorfulIcon.",
            "ColorfulTags."
        ];
        $handsome = new Checkbox_Integration('handsome', $list, $options, 'Handsome功能', 'handsome主题专属功能，只适用handsome主题');
        // 右下角版权样式
        $copyrightType = new Radio_Integration('copyrightType', ['0' => _t('美化样式'), '1' => _t('文本样式'),], '0', _t('右下角版权样式'));
        $form->addInput($handsome);
        $form->addInput($copyrightType);
    }

    /**
     * 打字特效配置面板
     * @param $form
     */
    private static function ActivatePowerMode($form)
    {
        $list = [
            "colorful" => _t("颜色效果"),
            "shake" => _t("振动效果"),
        ];
        $options = [
            "colorful",
        ];
        $ActivatePowerMode = new Checkbox_Integration('ActivatePowerMode', $list, $options, '打字特效');
        $form->addInput($ActivatePowerMode);
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
        $bubbleType = new Radio_Integration('mouseType', $options, 'none', _t('鼠标样式'));
        $form->addInput($bubbleType);

        $form->addItem(new Title_Integration(_t('鼠标点击特效'), _t('气泡类型、文字气泡、气泡颜色、气泡速度')));
        // 气泡类型
        $options = [
            'none' => _t('无'),
            'text' => _t('文字气泡'),
            'heart' => _t('爱心气泡'),
            'fireworks' => _t('fireworks+anime喷墨气泡'),
        ];
        $bubbleType = new Radio_Integration('bubbleType', $options, 'none', _t('气泡类型'));
        $form->addInput($bubbleType);

        // 气泡文字
        $bubbleText = new Text_Integration('bubbleText', null, _t('富强-民主-文明-和谐-自由-平等-公正-法治-爱国-敬业-诚信-友善'), _t('文字气泡填写'), _t('如果选择文字气泡类型，请填写文字，并以 - 分隔'));
        $form->addInput($bubbleText);

        // 气泡颜色
        $bubbleColor = new Text_Integration('bubbleColor', null, _t('随机'), _t('文字气泡颜色'), _t('如果选择文字气泡类型, 请填写气泡颜色, 可填入"随机"或十六进制颜色值 如#2db4d8'));
        $form->addInput($bubbleColor);

        // 气泡速度
        $bubbleSpeed = new Text_Integration('bubbleSpeed', null, _t('3000'), _t('文字气泡速度'), _t('如果选择文字气泡类型, 请填写气泡速度 默认3秒'));
        $form->addInput($bubbleSpeed);
        $form->addItem(new EndSymbol_Integration(2));
    }

    private static function Console($form)
    {
        $list = [
            'isDelete' => '删除数据表',
            'AutoTags' => '自动标签',
            'RobotsPlus' => '蛛来访日志',
            'BaiduSubmit' => '百度结构化',
            'SmartSpam' => '评论拦截'
        ];
        $options = [
            'RobotsPlus'
        ];

        $Console = new Checkbox_Integration('Console', $list, $options, _t('控制台'));
        $form->addInput($Console);
    }

    /**
     * 蛛来访日志配置面板
     * @param $form
     */
    private static function RobotsPlus($form)
    {
        $list = [
            'baidu' => _t('百度'),
            'google' => _t('谷歌'),
            'sogou' => _t('搜狗'),
            'youdao' => _t('有道'),
            'soso' => _t('搜搜'),
            'bing' => _t('必应'),
            'yahoo' => _t('雅虎'),
            '360' => _t('360搜索')
        ];
        $options = [
            'baidu',
            'google',
            'sogou',
            'youdao',
            'soso',
            'bing',
            'yahoo',
            '360'
        ];
        $botlist = new Checkbox_Integration('botlist', $list, $options, _t('蜘蛛记录设置'), _t('请选择要记录的蜘蛛日志'));
        $pagecount = new Text_Integration('pagecount', NULL, '20', _t('分页数量'), _t('每页显示的日志数量'));
        $form->addItem(new Title_Integration(_t('蛛来访日志'), _t('请在控制台设置 默认：启动')));
        $form->addInput($botlist);
        $form->addInput($pagecount);
        $form->addItem(new EndSymbol_Integration(2));
    }

    /**
     * 百度结构化配置面板
     * @param $form
     */
    private static function BaiduSubmit($form)
    {
        $form->addItem(new Title_Integration(_t('百度结构化'), _t('请在控制台设置 默认：禁用')));
        $element = new Text_Integration('api', null, null, _t('接口调用地址'), '请登录百度站长平台获取');
        $form->addInput($element);

        $element = new Text_Integration('group', null, 15, _t('分组URL数'), '每天最多只能发送50条，请酌情设置');
        $form->addInput($element);
        $form->addItem(new EndSymbol_Integration(2));
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
        $Result = new Radio_Integration('ReturnTop', $list, '0', _t('返回顶部'), _t('这是两个很萌的返回顶部控件'));
        $form->addInput($Result);
    }

    /**
     * SmartSpam配置面板
     * @param $form
     */
    private static function SmartSpam($form)
    {
        $opt_length = new Radio_Integration('opt_length', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #de1cc6'>评论字符长度操作</span>", "如果评论中长度不符合条件，则强行按该操作执行。如果选择[无动作]，将忽略下面长度的设置");
        $length_min = new Text_Integration('length_min', NULL, '1', "<span style='color: #de1cc6'>最短字符</span>", '允许评论的最短字符数。');
        $length_max = new Text_Integration('length_max', NULL, '200', "<span style='color: #de1cc6'>最长字符</span>", '允许评论的最长字符数');
        $opt_ban = new Radio_Integration('opt_ban', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #FF0000'>禁止词汇操作</span>", "如果评论中包含禁止词汇列表中的词汇，将执行该操作");
        $words_ban = new Textarea_Integration('words_ban', NULL, "傻逼\n操你妈\n智障\n傻子",
            "<span style='color: #FF0000'>禁止词汇表</span>", _t('多条词汇请用换行符隔开'));
        $opt_chk = new Radio_Integration('opt_chk', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #FF9797'>敏感词汇操作</span>", "如果评论中包含敏感词汇列表中的词汇，将执行该操作");
        $words_chk = new Textarea_Integration('words_chk', NULL, "http://",
            "<span style='color: #FF9797'>敏感词汇表</span>", _t('多条词汇请用换行符隔开<br />注意：如果词汇同时出现于禁止词汇，则执行禁止词汇操作'));
        $opt_au_length = new Radio_Integration('opt_au_length', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #FF44FF'>昵称字符长度操作</span>", "如果昵称长度不符合条件，则强行按该操作执行。如果选择[无动作]，将忽略下面长度的设置");
        $au_length_min = new Text_Integration('au_length_min', NULL, '1', "<span style='color: #FF44FF'>昵称最短字符数</span>", '昵称允许的最短字符数。');
        $au_length_max = new Text_Integration('au_length_max', NULL, '20', "<span style='color: #FF44FF'>昵称最长字符数</span>", '昵称允许的最长字符数');
        $opt_nojp_au = new Radio_Integration('opt_nojp_au', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #84C1FF'>昵称日文操作</span>", "如果用户昵称中包含日文，则强行按该操作执行");
        $opt_nourl_au = new Radio_Integration('opt_nourl_au', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #0072E3'>昵称网址操作</span>", "如果用户昵称是网址，则强行按该操作执行");
        $opt_au = new Radio_Integration('opt_au', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #B15BFF'>屏蔽昵称关键词操作</span>", "如果评论发布者的昵称含有该关键词，将执行该操作");
        $words_au = new Textarea_Integration('words_au', NULL, "",
            "<span style='color: #B15BFF'>屏蔽昵称关键词表</span>", _t('多个关键词请用换行符隔开'));
        $opt_ip = new Radio_Integration('opt_ip', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #FF5809'>屏蔽IP操作</span>", "如果评论发布者的IP在屏蔽IP段，将执行该操作");
        $words_ip = new Textarea_Integration('words_ip', NULL, "0.0.0.0",
            "<span style='color: #FF5809'>屏蔽IP</span>", _t('多条IP请用换行符隔开<br />支持用*号匹配IP段，如：192.168.*.*'));
        $opt_mail = new Radio_Integration('opt_mail', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #4F9D9D'>屏蔽邮箱操作</span>", "如果评论发布者的邮箱与禁止的一致，将执行该操作");
        $words_mail = new Textarea_Integration('words_mail', NULL, "",
            "<span style='color: #4F9D9D'>邮箱关键词</span>", _t('多个邮箱请用换行符隔开<br />可以是邮箱的全部，或者邮箱部分关键词'));
        $opt_url = new Radio_Integration('opt_url', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #AFAF61'>屏蔽网址操作</span>", "如果评论发布者的网址与禁止的一致，将执行该操作。如果网址为空，该项不会起作用。");
        $words_url = new Textarea_Integration('words_url', NULL, "",
            "<span style='color: #AFAF61'>网址关键词</span>", _t('多个网址请用换行符隔开<br />可以是网址的全部，或者网址部分关键词。如果网址为空，该项不会起作用。'));
        $opt_title = new Radio_Integration('opt_title', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #743A3A'>内容含有文章标题</span>", "如果评论内容中含有本页面的文章标题，则强行按该操作执行");
        $opt_nojp = new Radio_Integration('opt_nojp', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #CF9E9E'>日文评论操作</span>", "如果评论中包含日文，则强行按该操作执行");
        $opt_nocn = new Radio_Integration('opt_nocn', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
            "<span style='color: #CF9E9E'>非中文评论操作</span>", "如果评论中不包含中文，则强行按该操作执行");
        $form->addItem(new Title_Integration('评论拦截', '颜色区分（默认开启,自行配置）作者：<a href="http://www.yovisun.com/archive/typecho-plugin-smartspam.html/" target="_blank"> Yovis Blog</a>'));
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
        $form->addItem(new EndSymbol_Integration(2));
    }

    private static function LocalResourceSrc($form)
    {
        $LocalResourceSrc = new Text_Integration('LocalResourceSrc', NULL, NULL, _t(' 云加速CDN'), _t('使用该项设置前，你必须有自己搭建的cdn服务器（不是指当前服务器）</br> 插件目录下的<code>/assets/</code>目录下有 
<code>css、js、images</code>四个静态资源文件夹。</br>你需要把<code>assets</code>目录上传到你的cdn服务器上，比如CDN服务器的 
<code>Integration目录</code>里，地址即为 
<code>https://cdn.starskim.com/Integration/assets</code></br>在当前框中就填入该地址，插件就会引用你搭建的cdn上面的资源，而不再引用当前服务器上的资源'));
        $form->addInput($LocalResourceSrc);
    }
}