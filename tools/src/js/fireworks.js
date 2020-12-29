'use strict';
import anime from 'animejs/lib/anime.es.js';

const canvas = document.createElement(`canvas`)
canvas.id = "fireworks"
canvas.width = window.innerWidth
canvas.height = window.innerHeight
canvas.style.cssText = "position:fixed;top:0;left:0;pointer-events:none;z-index:999999"
window.addEventListener(`resize`, function () {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
})
document.body.appendChild(canvas)
const context = canvas.getContext(`2d`)
const numberOfParticules = 30
let pointerX = 0
let pointerY = 0
let tap
if ("ontouchstart" in window || navigator.msMaxTouchPoints) {
    tap = "touchstart";
} else {
    tap = "mousedown";
}
const colors = [`#FF1461`, `#18FF92`, `#5A87FF`, `#FBF38C`]

function setCanvasSize() {
    canvas.width = 2 * window.innerWidth
    canvas.height = 2 * window.innerHeight
    canvas.style.width = `${window.innerWidth}px`
    canvas.style.height = `${window.innerHeight}px`
    context.scale(2, 2)
}

function updateCoords(e) {
    pointerX = (e.clientX || e.touches[0].clientX) - canvas.getBoundingClientRect().left
    pointerY = e.clientY || e.touches[0].clientY - canvas.getBoundingClientRect().top
}

function setParticuleDirection(p) {
    const angle = anime.random(0, 360) * Math.PI / 180,
        value = anime.random(50, 180),
        radius = [-1, 1][anime.random(0, 1)] * value;
    return {
        x: p.x + radius * Math.cos(angle),
        y: p.y + radius * Math.sin(angle)
    }
}

function createParticule(x, y) {
    const p = {}
    p.x = x
    p.y = y
    p.color = colors[anime.random(0, colors.length - 1)]
    p.radius = anime.random(16, 32)
    p.endPos = setParticuleDirection(p)
    p.draw = function () {
        context.beginPath()
        context.arc(p.x, p.y, p.radius, 0, 2 * Math.PI, !0)
        context.fillStyle = p.color
        context.fill()
    }
    return p
}

function createCircle(x, y) {
    const p = {}
    p.x = x
    p.y = y
    p.color = "red"
    p.radius = .1
    p.alpha = .5
    p.lineWidth = 6
    p.draw = function () {
        context.globalAlpha = p.alpha
        context.beginPath()
        context.arc(p.x, p.y, p.radius, 0, 2 * Math.PI, !0)
        context.lineWidth = p.lineWidth
        context.strokeStyle = p.color
        context.stroke()
        context.globalAlpha = 1
    }
    return p
}

function renderParticule(anim) {
    for (let i = 0; i < anim.animatables.length; i++) {
        anim.animatables[i].target.draw()
    }
}

function animateParticules(x, y) {
    const circle = createCircle(x, y),
        particules = []
    for (let i = 0; i < numberOfParticules; i++) {
        particules.push(createParticule(x, y))
    }
    anime.timeline().add({
        targets: particules,
        x: function (p) {
            return p.endPos.x
        },
        y: function (p) {
            return p.endPos.y
        },
        radius: .1,
        duration: anime.random(1200, 1800),
        easing: `easeOutExpo`,
        update: renderParticule
    })
    anime.timeline().add({
        targets: circle,
        radius: anime.random(80, 160),
        lineWidth: 0,
        alpha: {
            value: 0,
            easing: `linear`,
            duration: anime.random(600, 800),
        },
        duration: anime.random(1200, 1800),
        easing: "easeOutExpo",
        update: renderParticule
    })
}

const render = anime({
    duration: Infinity,
    update: function () {
        context.clearRect(0, 0, canvas.width, canvas.height)
    }
})
document.addEventListener(tap, function (e) {
    "sidebar" !== e.target.id && "toggle-sidebar" !== e.target.id && "A" !== e.target.nodeName && "IMG" !== e.target.nodeName && (render.play(),
            updateCoords(e),
            animateParticules(pointerX, pointerY)
    )
}, !1)
setCanvasSize()
window.addEventListener(`resize`, setCanvasSize, !1)