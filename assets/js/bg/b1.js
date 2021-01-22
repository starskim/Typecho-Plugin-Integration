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
		exports["b1"] = factory();
	else
		root["b1"] = factory();
})(self, function() {
return /******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/bg/b1.js":
/*!*************************!*\
  !*** ./src/js/bg/b1.js ***!
  \*************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

eval("document.writeln(\"<canvas id=\\'bg_canvas\\' style=\\'top: 0;left: 0;position: fixed;width: 100%;height: 100%;z-index: -1;background: linear-gradient(to top, #c8e8f8, #2595f2);\\'></canvas> \"); // Canvas Init\n\nvar c = document.getElementById('bg_canvas'),\n    ctx = c.getContext('2d'),\n    width = window.innerWidth,\n    height = window.innerHeight,\n    particles = 60,\n    minRadius = 5,\n    maxRadius = 20,\n    speed = 0.01,\n    x = width / particles; // Bubbles\n\nvar Bubbles = [];\n\nfor (var i = 0; i < particles; i++) {\n  Bubbles.push({\n    x: i * x,\n    y: height * Math.random(),\n    r: minRadius + Math.random() * (maxRadius - minRadius),\n    speed: 10 * Math.random()\n  });\n}\n\nfunction bubble() {\n  c.width = width;\n  c.height = height;\n\n  for (i = 0; i < Bubbles.length; i++) {\n    var b = Bubbles[i];\n    console.log(i, b);\n    ctx.beginPath();\n    ctx.arc(b.x, b.y, b.r, 0, 2 * Math.PI);\n    b.alpha = .5 * (b.y / height);\n    b.speed += speed;\n    ctx.strokeStyle = \"rgba(255, 255, 255, .5)\";\n    ctx.stroke();\n    ctx.fillStyle = \"hsla(203, 75%, 69%,\" + b.alpha + \")\";\n    ctx.fill();\n    b.y -= b.speed;\n\n    if (b.y < 0) {\n      b.y = height;\n      b.speed = Math.random() * 5;\n    }\n  }\n} // Draw\n\n\nfunction draw() {\n  bubble();\n  window.requestAnimationFrame(draw);\n} // Resize Canvas\n\n\nfunction resizeCanvas() {\n  width = window.innerWidth, height = window.innerHeight;\n  c.width = width;\n  c.height = height;\n  draw();\n}\n\nresizeCanvas();\nwindow.addEventListener('resize', resizeCanvas, false);\n\n//# sourceURL=webpack://%5Bname%5D/./src/js/bg/b1.js?");

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
/******/ 	return __webpack_require__("./src/js/bg/b1.js");
/******/ })()
;
});