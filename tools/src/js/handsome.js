'use strict';
import Typed from 'typed.js'
import '../css/handsome.scss'
//透明样式
window.TransparentStyle = () => {
    const style = document.createElement(`style`)
    style.type = 'text/css'
    style.appendChild(document.createTextNode(`
    @media (min-width:768px){.app-aside-fixed .aside-wrap{opacity:0.8;}}
    #post-panel{background:rgba(241,243,244,.3)}
    .list-group-item{background-color:rgba(255,255,255,.6)}
    .bg-white{background-color:rgba(255,255,255,1)}
    .bg-light .lter,.bg-light.lter,.bg-info .dker,.bg-info.dker,.bg-info,.bg-black,.bg-dark,.bg-primary,.bg-info .dk,.bg-info.dk,.bg-success,.bg-danger,.bg-white-only,.alert-warning{opacity:.8}
    @media (max-width:767px){.navbar-nav .open .dropdown-menu{background-color:rgba(255,255,255,.8)}.settings>.btn,.topButton>.btn,.tocify-mobile-panel>.btn{background-color:rgba(255,255,255,0.8)!important}aside#aside{opacity:0.8;}.bg-light .lter,.bg-light.lter,.bg-info .dker,.bg-info.dker,.bg-info,.bg-black,.bg-dark,.bg-primary,.bg-info .dk,.bg-info.dk,.bg-success,.bg-danger,.bg-white-only,.alert-warning{opacity:0.98}}
    @media (min-width:768px){.app.container.app-aside-folded .app-aside{opacity:0.8;}}
    @media (min-width:1200px){.app.container .app-aside,.app.container .app-header{opacity:0.8;}}
    @media (min-width:992px){.app.container .app-aside,.app.container .app-header{opacity:0.8;}}
    @media (min-width:768px){.app.container .app-aside,.app.container .app-header{opacity:0.8;}}
    .bg-auto:before {display: none!important;}    
    `))
    document.getElementsByTagName('head')[0].appendChild(style)
}
//盒子模型
window.BoxModel = () => {
    const style = document.createElement(`style`)
    style.type = 'text/css'
    style.appendChild(document.createTextNode(`
    .link-main{padding:50px 0 50px 20px;text-align:center}
    .link-main h3{margin-top:0}
    .link-main .item{display:inline-block;letter-spacing:0;margin-right:20px;margin-bottom:20px;width:289px;height:240px;font-size:14px;overflow:hidden;border-radius:5px;background:rgba(255,255,255,.35);border:1px solid #e1e8ed;transition:background .2s}
    .link-main .link-bg{position:relative;height:90px;padding:0 1em;background-color:#777}
    .link-main .link-bg .bg:before{display:block;content:"";position:absolute;left:0;height:100%;width:100%;background:rgba(0,0,0,.5)}
    .link-main .link-bg .link-avatar{position:absolute;bottom:-50px;border:4px solid #fff;border-radius:100%;background-color:#fff;box-shadow:0 0 5px rgba(0,0,0,.5)}
    .link-main .link-bg .link-avatar img{border-radius:100%}
    .link-main .avatar{display:block;object-fit:cover}
    .link-main .bg,.link-main .link-bg{background-repeat:no-repeat;background-position:center;background-size:cover;display:block}
    .link-main .bg{position:absolute;top:0;bottom:0;left:0;right:0;filter:blur(1.5px);background-color:#fff}
    .link-main .meta{padding:.9em 1em;text-align:right}
    .link-main .info{color:#525766;padding:0 1em 1em}
    .link-main .info .name{font-weight:600;font-size:16px}
    @media screen and (max-width:330px){.link-main{padding:50px 0 50px 0}.link-main .item{margin-right:0}}
    .link-main .item:hover{background:rgba(255,255,255,1)}
    .link-main .item:hover .bg{filter:blur(.1px)}
    #comments pre code{display:inline}.wrapper-md>#comments{border:solid 1px #fff;padding:10px 30px 20px 30px}
    .hideContent{background-color:transparent;padding:10px 0}
    .agent{display:inline-block;margin-left:5px;padding:0 3px;border-radius:2px;color:#58666e;font-size:12px;opacity:.8}
    img[mw400]{max-width:400px!important;width:100%}
    .mw400{max-width:400px}
    @media screen and (min-width:1200px){.sticky{position:absolute;top:10px;left:15px}.panel .item-thumb{height:300px}#post-panel .blog-post{position:relative}#post-panel .panel{overflow:hidden}#post-panel .panel .post-meta{position:relative;margin-top:-300px;height:300px;padding-top:133px!important;padding-bottom:0!important;background-color:rgba(0,0,0,.15);color:#fff!important;transition:all .3s}#post-panel .panel .post-meta,#post-panel .panel-small .post-meta{border-radius:5px}#post-panel .panel .post-meta *,#post-panel .panel-small .post-meta *{color:#fff!important}#post-panel .panel .post-meta>h2,#post-panel .panel-small .post-meta>h2{text-align:center;text-shadow:0 0 3px #fff}#post-panel .panel .post-meta>div,#post-panel .panel .post-meta>p,#post-panel .panel-small .post-meta>div,#post-panel .panel-small .post-meta>p{transition:all .3s;transform:translateY(-10px);opacity:0}#post-panel .panel .post-meta>.text-muted,#post-panel .panel-small .post-meta>.text-muted{position:absolute;bottom:20px}#post-panel .panel .post-meta>.line{position:absolute;bottom:40px;width:740px}#post-panel .panel-small .post-meta>.line{position:absolute;bottom:40px;width:350px}#post-panel .panel .post-meta>.summary{position:absolute;bottom:60px;width:740px}#post-panel .panel-small .post-meta>.summary{position:absolute;bottom:60px;width:350px}#post-panel .panel-small{display:inline-block;height:300px;width:calc(50% - 10px);margin-right:20px}#post-panel .panel-small:nth-child(2n){margin-right:0}#post-panel .panel-small .index-img-small,#post-panel .panel-small .index-img-small .item-thumb-small{height:100%;width:100%}#post-panel .panel-small .post-meta{position:absolute;height:300px;width:calc(50% - 10px);padding:133px 20px 0 20px!important;background-color:rgba(0,0,0,.3);color:#fff!important;transition:all .3s}#post-panel .panel-small:hover .post-meta,#post-panel .panel:hover .post-meta{background-color:rgba(0,0,0,.6)}#post-panel .panel-small:hover .post-meta>div,#post-panel .panel-small:hover .post-meta>p,#post-panel .panel:hover .post-meta>div,#post-panel .panel:hover .post-meta>p{opacity:1;transform:translateY(0)}#post-panel .panel-small:hover .post-meta,#post-panel .panel:hover .post-meta{padding-top:80px!important}#post-panel .ahover{display:block;position:absolute;top:0;left:0;right:0;bottom:0}.blog-post>.panel-small:hover .index-post-img-small,.blog-post>.panel:hover .index-post-img{filter:blur(3px)}}
    `))
    document.getElementsByTagName(`head`)[0].appendChild(style)
}
// 标题居中
window.TitleCentered = () => {
    const style = document.createElement(`style`)
    style.type = "text/css"
    style.appendChild(document.createTextNode(`
    header.bg-light.lter.wrapper-md {text-align: center;}
    `))
    document.getElementsByTagName('head')[0].appendChild(style)
}
// 头像转动
window.AvatarRotation = () => {
    const style = document.createElement(`style`)
    style.type = "text/css"
    style.appendChild(document.createTextNode(`
    .img-full,.img-40px { transition: all 2.0s; }
    .img-full:hover,.img-40px:hover { transform: rotate(360deg); }
    `))
    document.getElementsByTagName(`head`)[0].appendChild(style)
}
// 头像疯狂转动
window.AvatarCrazyRotation = () => {
    const style = document.createElement(`style`)
    style.type = "text/css"
    style.appendChild(document.createTextNode(`
    .img-full:hover,.img-40px:hover{transform:rotate(666turn);transition-duration:59s;transition-timing-function:cubic-bezier(.34,0,.84,1)}
    `))
    document.getElementsByTagName('head')[0].appendChild(style)
}
// 头像呼吸灯
window.AvatarBreathingLight = () => {
    const style = document.createElement(`style`)
    style.type = "text/css"
    style.appendChild(document.createTextNode(`
    .img-full,.img-40px{-webkit-animation:ani 2s linear infinite;}
    @keyframes ani{0%{box-shadow:0 0 0px #00BCD4;}25%{box-shadow:0 0 10px #00BCD4;}50%{box-shadow:0 0 20px #00BCD4;}75%{box-shadow:0 0 10px #00BCD4;}100%{box-shadow:0 0 0px #00BCD4;}}
    `))
    document.getElementsByTagName(`head`)[0].appendChild(style)
}
//文章选择卡
window.ArticleCard = () => {
    const style = document.createElement(`style`)
    style.type = "text/css"
    style.appendChild(document.createTextNode(`
    .panel{cursor:pointer;transition:all 0.6s;}
    .blog-post .panel:not(article):hover{transform:translateY(-10px);}
    .panel-small{cursor:pointer;transition:all 0.6s;}
    .panel-small:hover{transform:scale(1.05);}
    .item-thumb{cursor:pointer;transition:all 0.6s;}
    .item-thumb:hover{transform:scale(1.05);}
    .item-thumb-small{cursor:pointer;transition:all 0.6s;}
    .item-thumb-small:hover{transform:scale(1.05);}
    `))
    document.getElementsByTagName(`head`)[0].appendChild(style)
}
// 文章阴影化
window.ArticleShadowing = () => {
    const style = document.createElement(`style`)
    style.type = "text/css"
    style.appendChild(document.createTextNode(`
    .panel{-moz-box-shadow:0 8px 10px rgba(255,112,173,0.35);}
    .panel-small{box-shadow:0 8px 10px rgba(255,112,173,0.35);-moz-box-shadow:0 8px 10px rgba(255,112,173,0.35);}
    .panel:hover{box-shadow:0 8px 10px rgba(62,147,241,0.37)!important;-moz-box-shadow:0 8px 10px rgba(62,147,241,0.35)!important;}
    .panel-small:hover{box-shadow:0 8px 10px rgba(255,112,173,0.35)!important;-moz-box-shadow:0 8px 10px rgba(255,112,173,0.35)!important;}
    .app.container{box-shadow:0 0 30px rgba(255,112,173,0.35);}
    .index-post-img,.entry-thumbnail{overflow:hidden;}
    `))
    document.getElementsByTagName(`head`)[0].appendChild(style)
}
//顶部跑马灯
window.TopLamp = () => {
    const div = document.createElement(`div`);
    div.id = "top-grrk"
    document.body.appendChild(div);
    const style = document.createElement(`style`)
    style.type = "text/css"
    style.appendChild(document.createTextNode(`
    #top-grrk {background:url(${Integration_LocalConst.STATIC_PATH}images/HorseRaceLamp.gif);height:2px;top:0px;position:fixed;width:100%;Z-index:10000;}
    `))
    document.getElementsByTagName(`head`)[0].appendChild(style)
}
//打赏图片
window.RewardStyle = () => {
    const style = document.createElement(`style`)
    style.type = "text/css"
    style.appendChild(document.createTextNode(`
    .support-author{background-repeat:round;background-image:url(${Integration_LocalConst.STATIC_PATH}images/MenheraSauce.png);}
    .article__reward-info{color:#00a0ed!important;font-weight:bold;}
    `))
    document.getElementsByTagName(`head`)[0].appendChild(style)
}
//打赏跳动
window.RewardBeating = () => {
    const style = document.createElement(`style`)
    style.type = "text/css"
    style.appendChild(document.createTextNode(`
    .btn-pay{animation:star 0.5s ease-in-out infinite alternate;}
    @keyframes star{from{transform:scale(1);}to{transform:scale(1.1);}}
    `))
    document.getElementsByTagName(`head`)[0].appendChild(style)
}
//滚动条美化
window.ScrollStyle = () => {
    const style = document.createElement(`style`)
    style.type = "text/css"
    style.appendChild(document.createTextNode(`
    div#toc{opacity:0.6;}
    div#toc::-webkit-scrollbar{width:6px;}
    div#toc::-webkit-scrollbar-thumb{background-color:#ccc;border-radius:6px;}
    div#toc::-webkit-scrollbar-track{background-color:#e8eaeb;border-radius:6px;}
    `))
    document.getElementsByTagName(`head`)[0].appendChild(style)
}
//文章标题美化
window.TitleStyle = () => {
    const style = document.createElement(`style`)
    style.type = "text/css"
    style.appendChild(document.createTextNode(`
    /*
    * 文章一二三四级标题美化
    */
    #post-content h1{font-size:30px}
    #post-content h2{position:relative;margin:20px 0 32px!important;font-size:1.55em;}
    #post-content h3{font-size:20px}#post-content h4{font-size:15px}
    #post-content h2::after{transition:all .35s;content:"";position:absolute;background:linear-gradient(#3c67bd8c 30%,#3c67bd 70%);width:1em;left:0;box-shadow:0 3px 3px rgba(32,160,255,.4);height:3px;bottom:-8px;}
    #post-content h2::before{content:"";width:100%;border-bottom:1px solid #eee;bottom:-7px;position:absolute}
    #post-content h2:hover::after{width:2.5em;}
    #post-content h1,#post-content h2,#post-content h3,#post-content h4,#post-content h5,#post-content h6{color:#666;line-height:1.4;font-weight:700;margin:30px 0 10px 0}
    `))
    document.getElementsByTagName(`head`)[0].appendChild(style)
}
//复制提醒
window.HS_Copy = () => {
    document.body.oncopy = () => {
        $.message({
            message: `若要转载请务必保留原文链接！`,
            title: `复制成功`,
            type: `success`,
            autoHide: !1,
            time: `3000`
        })
    }
}
//入站欢迎
window.HS_InboundWelcome = () => {
    if (sessionStorage.getItem(`isReload`) == null) {
        setTimeout(() => {
            $.message({
                title: getTimeState(),
                message: `欢迎访问${$(`.m-t-sm`).find(`.text-lt`).text()}！`,
                type: `success`,
                autoHide: !1,
                time: `5000`
            })
        }, 1000)
        sessionStorage.setItem(`isReload`, true)
    }
}
//入站欢迎（定位）
window.HS_InboundWelcome2 = () => {
    if (sessionStorage.getItem(`isReload`) == null) {
        setTimeout(() => {
            $.message({
                title: `欢迎来自${returnCitySN["cname"]}的小伙伴！`,
                message: `您的IP：${returnCitySN["cip"]}`,
                type: `success`,
                autoHide: !1,
                time: `5000`
            })
        }, 1000)
        sessionStorage.setItem(`isReload`, true)
    }
}
//博主介绍闪烁1
window.BlogJob1 = () => {
    $(`span.text-muted.text-xs.block`).replaceWith(`<span class="text-muted text-xs block">
    <div id="BlogJob"></div>
</span>
`)
    const l = ``,
        o = [Integration_LocalConst.HANDSOME.BlogJob].map(function (r) {
            return `${r}`
        }),
        a = 2,
        g = 1,
        s = 5,
        d = 75,
        b = [
                `rgb(110, 64, 170)`, `rgb(150, 61, 179)`, `rgb(191, 60, 175)`, `rgb(228, 65, 157)`, `rgb(254, 75, 131)`,
                `rgb(255, 94, 99)`, `rgb(255, 120, 71)`, `rgb(251, 150, 51)`, `rgb(226, 183, 47)`, `rgb(198, 214, 60)`,
                `rgb(175, 240, 91)`, `rgb(127, 246, 88)`, `rgb(82, 246, 103)`, `rgb(48, 239, 130)`, `rgb(29, 223, 163)`,
                `rgb(26, 199, 194)`, `rgb(35, 171, 216)`, `rgb(54, 140, 225)`, `rgb(76, 110, 219)`, `rgb(96, 84, 200)`
        ],
        c = {
            text: ``,
            prefixP: -s,
            skillI: 0,
            skillP: 0,
            direction: `forward`,
            delay: a,
            step: g
        }

    function n(r) {
        const n = document.createDocumentFragment(), l = document.createElement(`span`)
        for (let i = 0; r > i; i++) {
            l.textContent = String.fromCharCode(94 * Math.random() + 33)
            l.style.color = b[Math.floor(Math.random() * b.length)]
            n.appendChild(l)
        }
        return n
    }

    function i() {
        const t = o[c.skillI]
        if (c.step) {
            c.step--
        } else {
            c.step = g
            if (c.prefixP < l.length) {
                c.prefixP >= 0 && (c.text += l[c.prefixP])
                c.prefixP++
            } else if ("forward" === c.direction) {
                if (c.skillP < t.length) {
                    c.text += t[c.skillP]
                    c.skillP++
                } else if (c.delay) {
                    c.delay--
                } else {
                    c.direction = "backward"
                    c.delay = a
                }
            } else if (c.skillP > 0) {
                c.text = c.text.slice(0, -1)
                c.skillP--
            } else {
                c.skillI = (c.skillI + 1) % o.length
                c.direction = "forward"
            }
        }
        document.getElementById(`BlogJob`).textContent = c.text
        if (c.prefixP < l.length) {
            document.getElementById(`BlogJob`).appendChild(n(Math.min(s, s + c.prefixP)))
        } else {
            document.getElementById(`BlogJob`).appendChild(n(Math.min(s, t.length - c.skillP)))
        }
        setTimeout(i, d)
    }

    i()
}
//博主介绍闪烁2
window.BlogJob2 = () => {
    $(`span.text-muted.text-xs.block`).replaceWith(`<span class="text-muted text-xs block">
    <span id="BlogJob"></span>
</span>
`)
    const typed = new Typed(`#BlogJob`, {
        strings: [Integration_LocalConst.HANDSOME.BlogJob],
        startDelay: 1000,
        typeSpeed: 100,
        loop: !0,
        backSpeed: 60,
        backDelay: 2000,
        showCursor: !0
    })
}
//P站每日热门
window.Pixiv = () => {
    $("#blog_info").after(`<section class="widget widget_categories wrapper-md clear" id="a_d_sidebar">
    <h5 class="widget-title m-t-none text-md">P站每日热门</h5>
    <iframe frameborder="0" src="https://cloud.mokeyjay.com/pixiv" style="width:200px; height:380px;"></iframe>
</section>
`)
}
//访问总数
window.TotalVisit = () => {
    $("ul.list-group.box-shadow-wrap-normal").append(`<li class="list-group-item text-second">
    <span class="blog-info-icons">${Ico().user}</span>
    <span class="badge pull-right">${Integration_LocalConst.HANDSOME.TotalVisit}</span>
    访客总数
</li>
`)
}

//响应耗时
const ResTime = window.performance
const userAgent = navigator.userAgent

function consume(time) {
    return time + "ms"
}

function RAM(size) {

    return `${Math.floor(size / 1024 / 1024, 4)}MB`;
}

window.domTime = () => {
    $(`ul.list-group.box-shadow-wrap-normal`).append(`<li class="list-group-item text-second">
    <span class="blog-info-icons">${Ico().rend}</span>
    <span class="badge pull-right">${consume(ResTime.timing.domComplete - window.performance.timing.domLoading)}</span>
    渲染耗时
</li>
`)
}
window.ResponseTime = () => {
    $('ul.list-group.box-shadow-wrap-normal').append(`<li class="list-group-item text-second">
    <span class="blog-info-icons">${Ico().time}</span>
    <span class="badge pull-right">${consume(ResTime.timing.responseEnd - ResTime.timing.responseStart)}</span>
    响应耗时
</li>
`)
    if (userAgent.indexOf("Chrome") > -1) {
        $("ul.list-group.box-shadow-wrap-normal").append(`<li class="list-group-item text-second">
    <span class="blog-info-icons">${Ico().ram}</span>
    <span class="badge pull-right">${RAM(ResTime.memory.usedJSHeapSize)}</span>
    内存占用
</li>
`)
    }
    window.onload = () => {
        domTime()
    }
}
//评论打卡
window.CommentPunch = () => {
    const style = document.createElement(`style`);
    style.type = 'text/css';
    style.appendChild(document.createTextNode(`
    .secret_comment{top:5px;}
    .OwO {margin-right: 10px;}
    .OwO.padder-v-sm{display:initial;}
    .OwO.OwO-open .OwO-body{display:table}
    div#secret_comment{position:inherit;margin-top:5px;}
    `));
    document.getElementsByTagName('head')[0].appendChild(style);

    function a(comment, data, c) {
        if (document.selection) {
            comment.focus()
            const sel = document.selection.createRange()
            if (c) {
                sel.text = data + sel.text + c
                comment.focus()
            } else {
                sel.text = data
                comment.focus()
            }
        } else if (comment.selectionStart || "0" == comment.selectionStart) {
            let l = comment.selectionStart,
                m = comment.selectionEnd,
                n = m
            if (c) {
                comment.value = comment.value.substring(0, l) + data + comment.value.substring(l, m) + c + comment.value.substring(m, comment.value.length)
                n += data.length + c.length
            } else {
                comment.value = comment.value.substring(0, l) + data + comment.value.substring(m, comment.value.length)
                n += data.length - m + l
            }
            l === m && c && (n -= c.length)
            comment.focus()
            comment.selectionStart = n
            comment.selectionEnd = n
        } else {
            comment.value += data + c
            comment.focus()
        }
    }

    const date = (new Date).toLocaleTimeString(), comment = document.getElementById(`comment`) || 0
    window.Editor = {
        Punch() {
            a(comment, `滴！学生卡！打卡时间：${date}`, '，请上车的乘客系好安全带~')
        },
        Great() {
            a(comment, `写得好好哟,我要给你生猴子！::aru:flower::`)
        },
        Tread() {
            a(comment, `骚年,我怀疑你写了一篇假的文章！::aru:flower::`)
        }
    }
    $(`.OwO.padder-v-sm`).after(`<div class="OwO" onclick="Editor.Punch();this.style.display='none'" style="display: inline;" title="打卡">
    <div class="OwO-logo"><i class="fontello-pencil"></i><span class="OwOlogotext">打卡</span></div>
</div>
<div class="OwO" onclick="Editor.Great();this.style.display='none'" style="display: inline;" title="赞">
    <div class="OwO-logo"><i class="glyphicon glyphicon-thumbs-up"></i><span class="OwOlogotext"></span></div>
</div>
<div class="OwO" onclick="Editor.Tread();this.style.display='none'" style="display: inline;" title="踩">
    <div class="OwO-logo"><i class="glyphicon glyphicon-thumbs-down"></i><span class="OwOlogotext"></span></div>
</div>`)
}
// 彩色图标
window.ColorfulIcon = () => {
    document.querySelectorAll(`span.nav-icon > svg, span.nav-icon > i`).forEach(tag => {
        tag.style.color = randomColor()
    })
}
// 彩色标签云及数字
window.ColorfulTags = () => {
    document.querySelectorAll(`.badge, #tag_cloud-2 a`).forEach(tag => {
        tag.style.backgroundColor = randomColor()
    })
}
// 页脚添加版权信息
window.setCopyright = function (type) {
    // 页脚添加版权信息 '&nbsp;|&nbsp;Theme modified by <a href="https://moe.best" target="_blank">Jindai Kirin</a>&nbsp;|&nbsp;'
    const badgeInfo = `&nbsp;|&nbsp; 
<div class="github-badge">
<a href="https://blog.starskim.cn/" target="_blank" title="由Stars_Kim魔改">
<span class="badge-subject">Modified</span><span class="badge-value bg-red">Stars_Kim</span>
</a>
</div>
&nbsp;&nbsp; 
`
    const textInfo = `&nbsp;|&nbsp; 
<a href="https://blog.starskim.cn/" target="_blank" title="handsome主题由Stars_Kim魔改">
Modified&nbsp;&nbsp;Stars_Kim
</a>
&nbsp;&nbsp; 
`
    // var copyrightInfo = type?textInfo:badgeInfo;
    $('#footer span.pull-right').append(type ? textInfo : badgeInfo)
}

function Ico() {
    return {
        user: `<svg t="1595231685089" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2613"
     width="16" height="16">
    <path d="M656.79 499.92A241.63 241.63 0 0 0 754 306c0-133.65-108.35-242-242-242S270 172.35 270 306a241.63 241.63 0 0 0 97.21 193.92C190.84 560.12 64 727.25 64 924a36 36 0 0 0 72 0c0-207.66 168.34-376 376-376s376 168.34 376 376a36 36 0 0 0 72 0c0-196.75-126.84-363.88-303.21-424.08zM342 306a170 170 0 1 1 170 170 170 170 0 0 1-170-170z"
          p-id="2614" fill="#515151"></path>
</svg>`,
        time: `<svg t="1595232641264" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4026"
     width="16" height="16">
    <path d="M511.98464 66.56c-118.97856 0-230.83008 46.35136-314.95168 130.4832C112.90624 281.15968 66.56 393.04192 66.56 511.99488c0 118.9632 46.34624 230.84544 130.47296 314.9568C281.15456 911.09376 393.00608 957.44 511.98464 957.44c118.98368 0 230.84032-46.34624 314.9824-130.48832C911.09376 742.84032 957.44 630.97856 957.44 511.99488c0-118.97856-46.34624-230.8352-130.47296-314.95168C742.82496 112.91136 630.96832 66.56 511.98464 66.56z m275.58912 721.02912c-73.61024 73.63584-171.47904 114.18624-275.58912 114.18624s-201.97376-40.5504-275.57888-114.18624c-73.63584-73.61024-114.16064-171.47904-114.16064-275.59424 0-104.11008 40.54528-201.97376 114.18112-275.58912 73.60512-73.63072 171.47392-114.176 275.584-114.176s201.97376 40.54528 275.584 114.176c73.63584 73.61536 114.18112 171.47904 114.18112 275.58912 0 104.1152-40.56576 201.984-114.2016 275.59424z"
          fill="#515151" p-id="4027"></path>
    <path d="M519.1168 555.79136V267.91936a27.8528 27.8528 0 0 0-27.84256-27.84768 27.8528 27.8528 0 0 0-27.84256 27.84768v306.23232a27.81184 27.81184 0 0 0 16.88064 25.58976"
          fill="#515151" p-id="4028"></path>
    <path d="M734.70464 574.15168a31.0784 31.0784 0 0 1-31.07328 31.0784H496.44544a31.08864 31.08864 0 0 1-31.07328-31.0784 31.09376 31.09376 0 0 1 31.07328-31.0784h207.18592a31.08864 31.08864 0 0 1 31.07328 31.0784z"
          fill="#515151" p-id="4029"></path>
</svg>`,
        ram: `<svg t="1595233483074" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"
     p-id="13971" width="16" height="16">
    <path d="M128 128c-23.552 0-42.496 18.944-42.496 42.496v512c0 23.552 18.944 42.496 42.496 42.496h768c23.552 0 42.496-18.944 42.496-42.496v-512c0-23.552-18.944-42.496-42.496-42.496H128z m0-42.496h768c47.104 0 85.504 38.4 85.504 85.504v512c0 47.104-38.4 85.504-85.504 85.504H128c-47.104 0-85.504-38.4-85.504-85.504v-512c0-47.616 38.4-85.504 85.504-85.504z"
          p-id="13972" fill="#515151"></path>
    <path d="M846.336 487.424l-150.528-215.04c-2.56-4.096-4.608-6.656-7.168-9.728-4.608-4.608-9.216-6.656-14.336-6.656-5.12 0-10.24 2.048-14.336 6.656-3.584 4.096-3.584 5.12-7.168 9.728l-177.152 252.928-128-163.84c-8.192-10.24-19.968-10.752-28.16-5.632-4.608 3.072-6.656 5.632-9.728 9.728L167.936 573.44c-8.192 11.776-6.144 21.504 5.632 29.696 11.776 8.192 21.504 6.144 29.696-5.632L330.24 409.6l128.512 164.864c8.704 11.264 21.504 11.264 29.696 3.584 3.072-2.56 7.168-8.704 10.752-13.824l174.08-248.832 137.216 196.096c8.192 11.776 17.92 13.312 29.696 5.12 12.288-7.68 14.336-17.408 6.144-29.184zM149.504 896h725.504c14.336 0 21.504 7.168 21.504 21.504 0 14.336-7.168 21.504-21.504 21.504H149.504c-14.336 0-21.504-7.168-21.504-21.504 0-14.336 7.168-21.504 21.504-21.504z"
          p-id="13973" fill="#515151"></path>
    <path d="M362.496 725.504c14.336 0 21.504 7.168 21.504 21.504v170.496c0 14.336-7.168 21.504-21.504 21.504-14.336 0-21.504-7.168-21.504-21.504v-170.496c0.512-14.336 7.68-21.504 21.504-21.504zM661.504 725.504c14.336 0 21.504 7.168 21.504 21.504v170.496c0 14.336-7.168 21.504-21.504 21.504-14.336 0-21.504-7.168-21.504-21.504v-170.496c0-14.336 7.168-21.504 21.504-21.504z"
          p-id="13974" fill="#515151"></path>
</svg>`,
        rend: `<svg t="1595233111127" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="7464"
     width="16" height="16">
    <path d="M827.211075 221.676536m-54.351151 0a54.351151 54.351151 0 1 0 108.702302 0 54.351151 54.351151 0 1 0-108.702302 0Z"
          p-id="7465" fill="#515151"></path>
    <path d="M940.905298 515.399947m-67.086951 0a67.086952 67.086952 0 1 0 134.173903 0 67.086952 67.086952 0 1 0-134.173903 0Z"
          p-id="7466" fill="#515151"></path>
    <path d="M829.755035 810.595334m-78.974766 0a78.974766 78.974766 0 1 0 157.949532 0 78.974766 78.974766 0 1 0-157.949532 0Z"
          p-id="7467" fill="#515151"></path>
    <path d="M534.831643 928.64149m-91.48657 0a91.486571 91.486571 0 1 0 182.973141 0 91.486571 91.486571 0 1 0-182.973141 0Z"
          p-id="7468" fill="#515151"></path>
    <path d="M243.780191 805.955407m-101.902408 0a101.902408 101.902408 0 1 0 203.804816 0 101.902408 101.902408 0 1 0-203.804816 0Z"
          p-id="7469" fill="#515151"></path>
    <path d="M536.623615 107.870315m-107.854315 0a107.854315 107.854315 0 1 0 215.70863 0 107.854315 107.854315 0 1 0-215.70863 0Z"
          p-id="7470" fill="#515151"></path>
    <path d="M243.780191 224.220497m-107.854315 0a107.854315 107.854315 0 1 0 215.70863 0 107.854315 107.854315 0 1 0-215.70863 0Z"
          p-id="7471" fill="#515151"></path>
    <path d="M129.429978 512.008m-102.766395 0a102.766394 102.766394 0 1 0 205.532789 0 102.766394 102.766394 0 1 0-205.532789 0Z"
          p-id="7472" fill="#515151"></path>
</svg>`
    }
}