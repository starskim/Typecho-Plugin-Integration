'use strict';
import Vue from 'vue'
import Swal from 'sweetalert2'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
//炫彩鼠标
import './HoerMouse'

Vue.use(ElementUI)
// 标题卖萌
window.MoeTitle = () => {
    const OriginTitle = document.title
    let titleTime
    document.addEventListener(`visibilitychange`, () => {
        if (document.hidden) {
            document.title = "你别走吖 Σ(っ °Д °;)っ";
            clearTimeout(titleTime)
        } else {
            document.title = `你可算回来了 (｡•ˇ‸ˇ•｡)${OriginTitle}`;
            titleTime = setTimeout(() => {
                document.title = OriginTitle
            }, 2000)
        }
    });
}
//文字禁止选中
window.TextBan = () => {
    const style = document.createElement(`style`)
    style.type = "text/css"
    style.appendChild(document.createTextNode(`
    body{user-select: none; }
    `))
    document.getElementsByTagName(`head`)[0].appendChild(style)
}
//图片禁止拖动
window.PicturesBan = () => {
    const style = document.createElement(`style`)
    style.type = "text/css"
    style.appendChild(document.createTextNode(`
    body img { -webkit-user-drag: none; }
    `))
    document.getElementsByTagName(`head`)[0].appendChild(style)
}
//图片呼吸灯
window.PicturesLight = () => {
    const style = document.createElement(`style`)
    style.type = "text/css"
    style.appendChild(document.createTextNode(`
    img {-webkit-animation: ani 2s linear infinite;}
    @keyframes ani {0% {box-shadow: 0 0 0px #00BCD4;}25% {box-shadow: 0 0 10px #00BCD4;}50% {box-shadow: 0 0 20px #00BCD4;}75% {box-shadow: 0 0 10px #00BCD4;}100% {box-shadow: 0 0 0px #00BCD4;}}
    `))
    document.getElementsByTagName(`head`)[0].appendChild(style)
}
//复制提醒
window.Copy = () => {
    document.body.oncopy = () => {
        layer.msg(`复制成功`)
    };
}
//复制提醒2
window.Copy2 = () => {
    document.body.oncopy = () => {
        new Vue({
            data: () => {
                this.$notify({
                    title: `复制成功`,
                    message: `若要转载请务必保留原文链接！`,
                    type: `success`
                })
                return {visible: false}
            }
        })
    }
}
//复制提醒3
window.Copy3 = () => {
    document.body.oncopy = () => {
        Swal.fire({
            icon: `success`,
            allowOutsideClick: false,
            title: `复制成功,如转载请注明出处！`,
            showConfirmButton: false,
            timer: 1500
        })
    };
}
//判断是否pc端，pc端为true
window.IsPC = () => {
    const {indexOf} = navigator.userAgent;
    const Agents = [`Android`, `iPhone`, `SymbianOS`, `Windows Phone`, `iPad`, `iPod`];
    let flag = true;
    for (let v = 0; v < Agents.length; v++) {
        if (indexOf(Agents[v]) > 0) {
            flag = false
            break
        }
    }
    return flag
}
//播放提醒
window.PlayRemind = () => {
    if (IsPC() && sessionStorage.getItem(`isReload`) == null) {
        new Vue({
            data: () => {
                this.$confirm(`是否开启音乐一边浏览一边听呢？`, `提示`, {
                    confirmButtonText: `关闭`,
                    cancelButtonText: `开启`,
                    type: `warning`
                }).then(() => {
                    player.pause()
                }).catch(() => {
                    player.play()
                });
                return {visible: false}
            }
        });
        sessionStorage.setItem(`isReload`, true)
    }
}
//入站欢迎
window.InboundWelcome = () => {
    if (sessionStorage.getItem(`isReload`) == null) {
        setTimeout(() => {
            return new Vue({
                data: () => {
                    this.$notify({
                        title: getTimeState(),
                        message: `欢迎访问本站！！！`,
                        type: `success`
                    });
                    return {visible: false}
                }
            });
        }, 1000);
        sessionStorage.setItem(`isReload`, true)
    }
}
//入站欢迎（定位）
window.InboundWelcome2 = () => {
    if (sessionStorage.getItem(`isReload`) == null) {
        setTimeout(() => {
            new Vue({
                data: () => {
                    this.$notify({
                        title: `欢迎来自${returnCitySN["cname"]}的小伙伴！`,
                        message: `您的IP：${returnCitySN["cip"]}`,
                        type: `success`
                    });
                    return {visible: false}
                }
            })
        }, 1000);
        sessionStorage.setItem(`isReload`, true)
    }
}
//MySSL安全认证签章
window.MySSL = () => {
    const MySSL = `<div id="cc-myssl-id" style="position: fixed;right: 0;bottom: 0;width: 65px;height: 65px;z-index: 99;">
    <a href="https://myssl.com/${Integration_LocalConst.BLOG_URL}?from=mysslid">
        <img alt="" src="https://static.myssl.com/res/images/myssl-id.png" style="width:100%;height:100%">
    </a>
</div>
`
    $('body').append(MySSL)
}
//禁用F12
window.BanF12 = () => {
    document.onkeydown = () => {
        if (window.event && window.event.keyCode === 123) {
            layer.msg('F12被禁用')
            event.returnValue = false
            return false
        }
    }
}

//禁用debug
const checkDebugger = () => {
    const d = new Date();
    debugger
    const dur = Date.now() - d
    if (dur < 5) {
        return false
    } else {
        alert(`Hello World`)
        return true
    }
};

const breakDebugger = () => {
    if (checkDebugger()) {
        breakDebugger()
    }
};

window.BanDeBug = () => {
    breakDebugger();
}
//返回顶部
window.ReturnTop = () => {
    const type = Integration_LocalConst.RETURN_TOP;
    if (type === 1) {
        $(`#updown > #lamu img`).eq(0).click(() => {
            $("html,body").animate({scrollTop: 0}, 800)
            return false
        });
        $(`#updown > #leimu img`).eq(0).click(() => {
            $(`html, body`).animate({scrollTop: $(document).height()}, 800)
            return false
        })
    } else if (type === 2) {
        //scroll 事件适用于所有可滚动的元素和 window 对象（浏览器窗口）。
        $(window).scroll(() => {
            const ScroHei = $(window).scrollTop();//滚动的高度
            if (ScroHei > 500) {
                $(`.back-to-top`).css(`top`, `-200px`)
                // $('.back-to-top').fadeIn();
            } else {
                $(`.back-to-top`).css(`top`, `-999px`)
                // $('.back-to-top').fadeOut();
            }
        })
        /*点击返回顶部*/
        $(`.back-to-top`).click(() => {
            $(`body, html`).animate({
                scrollTop: 0
            }, 600)
        })
    }
}
//打字特效
window.ActivatePowerModes = () => {
    const colorful = Integration_LocalConst.COLORFUL
    const shake = Integration_LocalConst.SHAKE
    if (colorful || shake) {
        try {
            // 你能留下我的信息, 我会很高兴的 ^_^
            console.log(`\n %c 疯狂打字机 https://gitee.com/HoeXhe/ActivatePowerMode %c www.hoehub.com 😊 ActivatePowerMode By Hoe \n`,
                `font-family:'Microsoft YaHei','SF Pro Display',Roboto,Noto,Arial,'PingFang SC',sans-serif;color:white;background:#ffa099;padding:5px 0;`,
                `font-family:'Microsoft YaHei','SF Pro Display',Roboto,Noto,Arial,'PingFang SC',sans-serif;color:#ffa099;background:#404040;padding:5px 0;`)
            // input
            ActivatePowerMode.colorful = colorful // make power mode colorful
            ActivatePowerMode.shake = shake // turn off shake
            document.body.addEventListener(`input`, ActivatePowerMode)
        } catch (e) {
            console.log(`打字特效插件出现错误`)
        }
    }
}