/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is not neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory();
	else if(typeof define === 'function' && define.amd)
		define([], factory);
	else if(typeof exports === 'object')
		exports["b8"] = factory();
	else
		root["b8"] = factory();
})(self, function() {
return /******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/bg/b8.js":
/*!*************************!*\
  !*** ./src/js/bg/b8.js ***!
  \*************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

eval("var style = document.createElement(\"style\");\nstyle.type = \"text/css\";\nstyle.appendChild(document.createTextNode(\"\\n@keyframes colorChange{0%,100%{opacity:0}50%{opacity:.9}}\\n#landscape{background-image:url('\".concat(Integration_LocalConst.STATIC_PATH, \"images/bg_StarrySky.png');position:fixed;top:0;width:100%;left:0;z-index:-1;height:100%;background-size:1000px 250px;background-repeat:repeat-x;background-position:center bottom}\\n.filter{width:100%;height:100%;position:fixed;top:0;left:0;z-index:-1;background:#da7474;animation:colorChange 30s ease-in-out infinite;animation-fill-mode:both;mix-blend-mode:overlay}\\n    \")));\ndocument.getElementsByTagName(\"head\")[0].appendChild(style);\ndocument.writeln(\"<div id='landscape'></div>\");\ndocument.writeln(\"<div class='filter'></div>\");\ndocument.writeln(\"<canvas id='bg_canvas' style='background:linear-gradient(to bottom,#000000 0%,#5788fe 100%);position:fixed;top:0;left:0;width:100%;height:100%;z-index:-2;'></canvas>\");\n\nfunction Star(id, x, y) {\n  this.id = id;\n  this.x = x;\n  this.y = y;\n  this.r = Math.floor(Math.random() * 2) + 1;\n  var alpha = (Math.floor(Math.random() * 10) + 1) / 10 / 2;\n  this.color = \"rgba(255,255,255,\".concat(alpha, \")\");\n}\n\nvar canvas = document.getElementById('bg_canvas');\nvar ctx = canvas.getContext('2d');\n\nStar.prototype.draw = function () {\n  ctx.fillStyle = this.color;\n  ctx.shadowBlur = this.r * 2;\n  ctx.beginPath();\n  ctx.arc(this.x, this.y, this.r, 0, 2 * Math.PI, false);\n  ctx.closePath();\n  ctx.fill();\n};\n\nvar HEIGHT;\n\nStar.prototype.move = function () {\n  this.y -= .15;\n  if (this.y <= -10) this.y = HEIGHT + 10;\n  this.draw();\n};\n\nvar stars = [];\n\nStar.prototype.die = function () {\n  stars[this.id] = null;\n  delete stars[this.id];\n};\n\nfunction Dot(id, x, y, r) {\n  this.id = id;\n  this.x = x;\n  this.y = y;\n  this.r = Math.floor(Math.random() * 5) + 1;\n  this.maxLinks = 2;\n  this.speed = .5;\n  this.a = .5;\n  this.aReduction = .005;\n  this.color = \"rgba(255,255,255,\".concat(this.a, \")\");\n  this.linkColor = \"rgba(255,255,255,\".concat(this.a / 4, \")\");\n  this.dir = Math.floor(Math.random() * 140) + 200;\n}\n\nDot.prototype.draw = function () {\n  ctx.fillStyle = this.color;\n  ctx.shadowBlur = this.r * 2;\n  ctx.beginPath();\n  ctx.arc(this.x, this.y, this.r, 0, 2 * Math.PI, false);\n  ctx.closePath();\n  ctx.fill();\n};\n\nDot.prototype.link = function () {\n  if (this.id === 0) return;\n  var previousDot1 = getPreviousDot(this.id, 1);\n  var previousDot2 = getPreviousDot(this.id, 2);\n  var previousDot3 = getPreviousDot(this.id, 3);\n  if (!previousDot1) return;\n  ctx.strokeStyle = this.linkColor;\n  ctx.moveTo(previousDot1.x, previousDot1.y);\n  ctx.beginPath();\n  ctx.lineTo(this.x, this.y);\n  if (previousDot2 != false) ctx.lineTo(previousDot2.x, previousDot2.y);\n  if (previousDot3 != false) ctx.lineTo(previousDot3.x, previousDot3.y);\n  ctx.stroke();\n  ctx.closePath();\n};\n\nvar dots = [];\n\nfunction getPreviousDot(id, stepback) {\n  if (id === 0 || id - stepback < 0) return false;\n  if (typeof dots[id - stepback] != \"undefined\") return dots[id - stepback];else return false; //getPreviousDot(id - stepback);\n}\n\nDot.prototype.move = function () {\n  this.a -= this.aReduction;\n\n  if (this.a <= 0) {\n    this.die();\n    return;\n  }\n\n  this.color = \"rgba(255,255,255,\".concat(this.a, \")\");\n  this.linkColor = \"rgba(255,255,255,\".concat(this.a / 4, \")\");\n  this.x = this.x + Math.cos(degToRad(this.dir)) * this.speed, this.y = this.y + Math.sin(degToRad(this.dir)) * this.speed;\n  this.draw();\n  this.link();\n};\n\nDot.prototype.die = function () {\n  dots[this.id] = null;\n  delete dots[this.id];\n};\n\nvar WIDTH;\nvar mouseMoving = false;\nvar mouseMoveChecker;\nvar mouseX;\nvar mouseY;\nvar initStarsPopulation = 80;\nvar dotsMinDist = 2;\nvar maxDistFromCursor = 50;\nsetCanvasSize();\ninit();\n\nfunction setCanvasSize() {\n  WIDTH = document.documentElement.clientWidth, HEIGHT = document.documentElement.clientHeight;\n  canvas.setAttribute(\"width\", WIDTH);\n  canvas.setAttribute(\"height\", HEIGHT);\n}\n\nfunction init() {\n  ctx.strokeStyle = \"white\";\n  ctx.shadowColor = \"white\";\n\n  for (var i = 0; i < initStarsPopulation; i++) {\n    stars[i] = new Star(i, Math.floor(Math.random() * WIDTH), Math.floor(Math.random() * HEIGHT)); //stars[i].draw();\n  }\n\n  ctx.shadowBlur = 0;\n  animate();\n}\n\nfunction animate() {\n  var i;\n  ctx.clearRect(0, 0, WIDTH, HEIGHT);\n\n  for (i in stars) {\n    stars[i].move();\n  }\n\n  for (i in dots) {\n    dots[i].move();\n  }\n\n  drawIfMouseMoving();\n  requestAnimationFrame(animate);\n}\n\nwindow.onmousemove = function (e) {\n  mouseMoving = true;\n  mouseX = e.clientX;\n  mouseY = e.clientY;\n  clearInterval(mouseMoveChecker);\n  mouseMoveChecker = setTimeout(function () {\n    mouseMoving = false;\n  }, 100);\n};\n\nfunction drawIfMouseMoving() {\n  if (!mouseMoving) return;\n\n  if (dots.length === 0) {\n    dots[0] = new Dot(0, mouseX, mouseY);\n    dots[0].draw();\n    return;\n  }\n\n  var previousDot = getPreviousDot(dots.length, 1);\n  var prevX = previousDot.x;\n  var prevY = previousDot.y;\n  var diffX = Math.abs(prevX - mouseX);\n  var diffY = Math.abs(prevY - mouseY);\n  if (diffX < dotsMinDist || diffY < dotsMinDist) return;\n  var xVariation = Math.random() > .5 ? -1 : 1;\n  xVariation = xVariation * Math.floor(Math.random() * maxDistFromCursor) + 1;\n  var yVariation = Math.random() > .5 ? -1 : 1;\n  yVariation = yVariation * Math.floor(Math.random() * maxDistFromCursor) + 1;\n  dots[dots.length] = new Dot(dots.length, mouseX + xVariation, mouseY + yVariation);\n  dots[dots.length - 1].draw();\n  dots[dots.length - 1].link();\n} //setInterval(drawIfMouseMoving, 17);\n\n\nfunction degToRad(deg) {\n  return deg * (Math.PI / 180);\n}\n\n//# sourceURL=webpack://%5Bname%5D/./src/js/bg/b8.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		if(__webpack_module_cache__[moduleId]) {
/******/ 			return __webpack_module_cache__[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	// module exports must be returned from runtime so entry inlining is disabled
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__("./src/js/bg/b8.js");
/******/ })()
;
});