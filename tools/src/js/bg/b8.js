const style = document.createElement(`style`)
style.type = "text/css"
style.appendChild(document.createTextNode(`
@keyframes colorChange{0%,100%{opacity:0}50%{opacity:.9}}
#landscape{background-image:url('${Integration_LocalConst.STATIC_PATH}images/bg_StarrySky.png');position:fixed;top:0;width:100%;left:0;z-index:-1;height:100%;background-size:1000px 250px;background-repeat:repeat-x;background-position:center bottom}
.filter{width:100%;height:100%;position:fixed;top:0;left:0;z-index:-1;background:#da7474;animation:colorChange 30s ease-in-out infinite;animation-fill-mode:both;mix-blend-mode:overlay}
    `))
document.getElementsByTagName(`head`)[0].appendChild(style)
document.writeln(`<div id='landscape'></div>`);
document.writeln(`<div class='filter'></div>`);
document.writeln(`<canvas id='bg_canvas' style='background:linear-gradient(to bottom,#000000 0%,#5788fe 100%);position:fixed;top:0;left:0;width:100%;height:100%;z-index:-2;'></canvas>`);

function Star(id, x, y){
	this.id = id;
	this.x = x;
	this.y = y;
	this.r = Math.floor(Math.random()*2)+1;
	const alpha = (Math.floor(Math.random() * 10) + 1) / 10 / 2;
	this.color = `rgba(255,255,255,${alpha})`;
}

const canvas = document.getElementById('bg_canvas');
const ctx = canvas.getContext('2d');
Star.prototype.draw = function() {
	ctx.fillStyle = this.color;
	ctx.shadowBlur = this.r * 2;
	ctx.beginPath();
	ctx.arc(this.x, this.y, this.r, 0, 2 * Math.PI, false);
	ctx.closePath();
	ctx.fill();
}

let HEIGHT;
Star.prototype.move = function() {
	this.y -= .15;
	if (this.y <= -10) this.y = HEIGHT + 10;
	this.draw();
}

const stars = [];
Star.prototype.die = function() {
    stars[this.id] = null;
    delete stars[this.id];
}


function Dot(id, x, y, r) {
	this.id = id;
	this.x = x;
	this.y = y;
	this.r = Math.floor(Math.random()*5)+1;
	this.maxLinks = 2;
	this.speed = .5;
	this.a = .5;
	this.aReduction = .005;
	this.color = `rgba(255,255,255,${this.a})`;
	this.linkColor = `rgba(255,255,255,${this.a / 4})`;

	this.dir = Math.floor(Math.random()*140)+200;
}

Dot.prototype.draw = function() {
	ctx.fillStyle = this.color;
	ctx.shadowBlur = this.r * 2;
	ctx.beginPath();
	ctx.arc(this.x, this.y, this.r, 0, 2 * Math.PI, false);
	ctx.closePath();
	ctx.fill();
}

Dot.prototype.link = function() {
	if (this.id === 0) return;
	const previousDot1 = getPreviousDot(this.id, 1);
	const previousDot2 = getPreviousDot(this.id, 2);
	const previousDot3 = getPreviousDot(this.id, 3);
	if (!previousDot1) return;
	ctx.strokeStyle = this.linkColor;
	ctx.moveTo(previousDot1.x, previousDot1.y);
	ctx.beginPath();
	ctx.lineTo(this.x, this.y);
	if (previousDot2 != false) ctx.lineTo(previousDot2.x, previousDot2.y);
	if (previousDot3 != false) ctx.lineTo(previousDot3.x, previousDot3.y);
	ctx.stroke();
	ctx.closePath();
}

const dots = [];

function getPreviousDot(id, stepback) {
	if (id === 0 || id - stepback < 0) return false;
	if (typeof dots[id - stepback] != "undefined") return dots[id - stepback];
	else return false;//getPreviousDot(id - stepback);
}

Dot.prototype.move = function() {
	this.a -= this.aReduction;
	if (this.a <= 0) {
		this.die();
		return
	}
	this.color = `rgba(255,255,255,${this.a})`;
	this.linkColor = `rgba(255,255,255,${this.a / 4})`;
	this.x = this.x + Math.cos(degToRad(this.dir))*this.speed,
	this.y = this.y + Math.sin(degToRad(this.dir))*this.speed;

	this.draw();
	this.link();
}

Dot.prototype.die = function() {
    dots[this.id] = null;
    delete dots[this.id];
}


let WIDTH;
let mouseMoving = false;
let mouseMoveChecker;
let mouseX;
let mouseY;
const initStarsPopulation = 80;
const dotsMinDist = 2;
const maxDistFromCursor = 50;

setCanvasSize();
init();

function setCanvasSize() {
	WIDTH = document.documentElement.clientWidth,
    HEIGHT = document.documentElement.clientHeight;

	canvas.setAttribute("width", WIDTH);
	canvas.setAttribute("height", HEIGHT);
}

function init() {
	ctx.strokeStyle = "white";
	ctx.shadowColor = "white";
	for (let i = 0; i < initStarsPopulation; i++) {
		stars[i] = new Star(i, Math.floor(Math.random()*WIDTH), Math.floor(Math.random()*HEIGHT));
		//stars[i].draw();
	}
	ctx.shadowBlur = 0;
	animate();
}

function animate() {
    let i;
	ctx.clearRect(0, 0, WIDTH, HEIGHT);

    for (i in stars) {
    	stars[i].move();
    }
    for (i in dots) {
    	dots[i].move();
    }
    drawIfMouseMoving();
    requestAnimationFrame(animate);
}

window.onmousemove = function(e){
	mouseMoving = true;
	mouseX = e.clientX;
	mouseY = e.clientY;
	clearInterval(mouseMoveChecker);
	mouseMoveChecker = setTimeout(function() {
		mouseMoving = false;
	}, 100);
}


function drawIfMouseMoving(){
	if (!mouseMoving) return;

	if (dots.length === 0) {
		dots[0] = new Dot(0, mouseX, mouseY);
		dots[0].draw();
		return;
	}

	const previousDot = getPreviousDot(dots.length, 1);
	const prevX = previousDot.x;
	const prevY = previousDot.y;

	const diffX = Math.abs(prevX - mouseX);
	const diffY = Math.abs(prevY - mouseY);

	if (diffX < dotsMinDist || diffY < dotsMinDist) return;

	let xVariation = Math.random() > .5 ? -1 : 1;
	xVariation = xVariation*Math.floor(Math.random()*maxDistFromCursor)+1;
	let yVariation = Math.random() > .5 ? -1 : 1;
	yVariation = yVariation*Math.floor(Math.random()*maxDistFromCursor)+1;
	dots[dots.length] = new Dot(dots.length, mouseX+xVariation, mouseY+yVariation);
	dots[dots.length-1].draw();
	dots[dots.length-1].link();
}
//setInterval(drawIfMouseMoving, 17);

function degToRad(deg) {
	return deg * (Math.PI / 180);
}