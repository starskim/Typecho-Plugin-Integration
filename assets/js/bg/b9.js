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
		exports["b9"] = factory();
	else
		root["b9"] = factory();
})(self, function() {
return /******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/bg/b9.js":
/*!*************************!*\
  !*** ./src/js/bg/b9.js ***!
  \*************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

eval("document.writeln(\"<canvas id=\\'canvas\\' style=\\'width:100%;height:100%;position:fixed;top:0;left:0;z-index:-1;pointer-events: none;\\'></canvas>\");\n\n(function (window, document, undefined) {\n  window.requestAnimFrame = function () {\n    return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || function (callback) {\n      window.setTimeout(callback, 1000 / 60);\n    };\n  }();\n\n  var canvas = document.getElementById(\"canvas\"),\n      ctx = canvas.getContext(\"2d\"),\n      w = canvas.width = window.innerWidth,\n      h = canvas.height = window.innerHeight,\n      hue = 217,\n      stars = [],\n      count = 0,\n      maxStars = 600;\n  var canvas2 = document.createElement(\"canvas\"),\n      ctx2 = canvas2.getContext(\"2d\");\n  canvas2.width = 100;\n  canvas2.height = 100;\n  var half = canvas2.width / 2,\n      gradient2 = ctx2.createRadialGradient(half, half, 0, half, half, half);\n  gradient2.addColorStop(0.025, \"#fff\");\n  gradient2.addColorStop(0.1, \"hsl(\" + hue + \",61%,33%)\");\n  gradient2.addColorStop(0.25, \"hsl(\" + hue + \",64%,6%)\");\n  gradient2.addColorStop(1, \"transparent\");\n  ctx2.fillStyle = gradient2;\n  ctx2.beginPath();\n  ctx2.arc(half, half, half, 0, Math.PI * 2);\n  ctx2.fill();\n\n  function random(min, max) {\n    if (arguments.length < 2) {\n      max = min;\n      min = 0;\n    }\n\n    if (min > max) {\n      var hold = max;\n      max = min;\n      min = hold;\n    }\n\n    return Math.floor(Math.random() * (max - min + 1)) + min;\n  }\n\n  function maxOrbit(x, y) {\n    var max = Math.max(x, y),\n        diameter = Math.round(Math.sqrt(max * max + max * max));\n    return diameter / 2;\n  }\n\n  var Star = function Star() {\n    this.orbitRadius = random(maxOrbit(w, h));\n    this.radius = random(90, this.orbitRadius) / 12;\n    this.orbitX = w / 2;\n    this.orbitY = h / 2;\n    this.timePassed = random(0, maxStars);\n    this.speed = random(this.orbitRadius) / 180000;\n    this.alpha = random(2, 10) / 10;\n    count++;\n    stars[count] = this;\n  };\n\n  Star.prototype.draw = function () {\n    var x = Math.sin(this.timePassed) * this.orbitRadius + this.orbitX,\n        y = Math.cos(this.timePassed) * this.orbitRadius + this.orbitY,\n        twinkle = random(10);\n\n    if (twinkle === 1 && this.alpha > 0) {\n      this.alpha -= 0.05;\n    } else {\n      if (twinkle === 2 && this.alpha < 1) {\n        this.alpha += 0.05;\n      }\n    }\n\n    ctx.globalAlpha = this.alpha;\n    ctx.drawImage(canvas2, x - this.radius / 2, y - this.radius / 2, this.radius, this.radius);\n    this.timePassed += this.speed;\n  };\n\n  for (var i = 0; i < maxStars; i++) {\n    new Star();\n  }\n\n  function animation() {\n    ctx.globalCompositeOperation = \"source-over\";\n    ctx.globalAlpha = 0.8;\n    ctx.fillStyle = \"hsla(\" + hue + \",64%,6%,1)\";\n    ctx.fillRect(0, 0, w, h);\n    ctx.globalCompositeOperation = \"lighter\";\n\n    for (var i = 1, l = stars.length; i < l; i++) {\n      stars[i].draw();\n    }\n\n    window.requestAnimationFrame(animation);\n  }\n\n  animation();\n})(window, document);\n\n//# sourceURL=webpack://%5Bname%5D/./src/js/bg/b9.js?");

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
/******/ 	return __webpack_require__("./src/js/bg/b9.js");
/******/ })()
;
});