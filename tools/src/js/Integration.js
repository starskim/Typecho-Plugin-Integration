'use strict';
// import $ from "jquery"
// import 'jquery-pjax'

const General = Integration_LocalConst.INIT.General
const handsome = Integration_LocalConst.INIT.handsome
//随机颜色
window.randomColor = () => `hsl(${Math.floor(Math.random() * 360)},100%,50%,0.6)`
//判断上午或者下午
window.getTimeState = () => {
    let text = ``;
    const hours = new Date().getHours();
    if (hours >= 0 && hours <= 10) {
        text = "早上好，永远年轻，永远热泪盈眶！"
    } else if (hours > 10 && hours <= 14) {
        text = "中午好，睡会儿午觉吧！"
    } else if (hours > 14 && hours <= 18) {
        text = "下午好，是时候打个盹了！"
    } else if (hours > 18 && hours <= 24) {
        text = "晚上好，注意早点休息！"
    }
    return text
}
$(() => {
    new Function(General)()
    ReturnTop()
    ActivatePowerModes()
    HoerMouse()
    if (Integration_LocalConst.GET_THEME) {
        setCopyright(Integration_LocalConst.COPYRIGHT_TYPE)
        new Function(handsome)()
    }
})
// 你能留下我的信息, 我会很高兴的 ^_^
console.log(`\n %c Integration v${Integration_Version} ${Git_Hash} %c by Stars_Kim | blog.starskim.cn \n`,
    `color: #fadfa3; background: #030307; padding:5px 0;`, `background: #fadfa3; padding:5px 0;`
)
console.log(`\n %c 炫彩鼠标插件 https://gitee.com/HoeXhe/HoerMouse %c www.hoehub.com 😊 HoerMouse By Hoe\n`,
    `font-family:'Microsoft YaHei','SF Pro Display',Roboto,Noto,Arial,'PingFang SC',sans-serif;color:white;background:#ffa099;padding:5px 0;`,
    `font-family:'Microsoft YaHei','SF Pro Display',Roboto,Noto,Arial,'PingFang SC',sans-serif;color:#ffa099;background:#404040;padding:5px 0;`
)