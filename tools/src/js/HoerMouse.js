window.HoerMouse = () => {
    const mouseType = Integration_LocalConst.MOUSE_TYPE
    const imageDir = `${Integration_LocalConst.STATIC_PATH}images`
    if (mouseType !== 'none') {
        const style = document.createElement(`style`)
        style.type = "text/css"
        style.appendChild(document.createTextNode(`
        body{cursor:url(${imageDir}/${mouseType}/normal.cur),auto;}
        select, input, textarea, a, button,img{cursor:url(${imageDir}/${mouseType}/link.cur),auto;}
        input[disabled], select[disabled], textarea[disabled], input[readonly], select[readonly] {cursor:url(${imageDir}/${mouseType}/link.cur),auto;}
        `))
        document.getElementsByTagName(`head`)[0].appendChild(style)
    }
}
//鼠标点击特效
window.handleBubbleType_text = () => {
    let index = 0
    const old = typeof window.onclick === "function" && window.onclick
    window.onclick = function (event) {
        old && old()
        const string = Integration_LocalConst.BUBBLE.Text
        const span = $("<span/>").text(string[index])
        index = (index + 1) % string.length
        const x = event.pageX,
            y = event.pageY
        let color = Integration_LocalConst.BUBBLE.Color;
        if (color === "随机") {
            color = randomColor()
        }
        span.css({
            left: x,
            top: y - 20,
            position: `absolute`,
            "font-weight": `bold`,
            color: color,
            "z-index": 99999,
        })
        $(`body`).append(span)
        const styles = {
            top: y - 180,
            opacity: 0
        };
        span.animate(styles, Integration_LocalConst.BUBBLE.Speed, function () {
            span.remove()
        })
    }

}
// 鼠标点击爱心特效
window.handleBubbleType_heart = () => {
    const hearts = [];
    window.requestAnimationFrame = window.requestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame ||
        window.oRequestAnimationFrame ||
        window.msRequestAnimationFrame ||
        function (callback) {
            setTimeout(callback, 1e3 / 60);
        }
    const style = document.createElement(`style`);
    style.type = "text/css";
    style.appendChild(document.createTextNode(`.heart{width: 10px;height: 10px;position: fixed;background: #f00;transform: rotate(45deg);-webkit-transform: rotate(45deg);-moz-transform: rotate(45deg);}.heart:after,.heart:before{content: '';width: inherit;height: inherit;background: inherit;border-radius: 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;position: absolute;}.heart:after{top: -5px;}.heart:before{left: -5px;}`));
    document.getElementsByTagName(`head`)[0].appendChild(style)
    const old = typeof window.onclick === "function" && window.onclick
    window.onclick = function (event) {
        old && old()
        const d = $('<div/>')
        d.addClass(`heart`);
        hearts.push({
            el: d,
            x: event.clientX - 5,
            y: event.clientY - 5,
            scale: 1,
            alpha: 1,
            color: randomColor()
        });
        document.body.appendChild(d)
    }
    gameloop();

    function gameloop() {
        for (let i = 0; i < hearts.length; i++) {
            if (hearts[i].alpha <= 0) {
                hearts[i].el.remove();
                hearts.splice(i, 1);
                continue;
            }
            hearts[i].y--;
            hearts[i].scale += 0.004;
            hearts[i].alpha -= 0.013;
            hearts[i].el.cssText = `"left": ${hearts[i].x} "top": ${hearts[i].y} "opacity": ${hearts[i].alpha} "transform": "scale(${hearts[i].scale},${hearts[i].scale}) rotate(45deg)" "background": ${hearts[i].color} "z-index": 99999`
        }
        requestAnimationFrame(gameloop)
    }
}