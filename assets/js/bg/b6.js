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
		exports["b6"] = factory();
	else
		root["b6"] = factory();
})(self, function() {
return /******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/bg/b6.js":
/*!*************************!*\
  !*** ./src/js/bg/b6.js ***!
  \*************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

eval("document.writeln(\"<canvas id=\\'bg_canvas\\' style=\\'position: fixed;top: 0;left: 0; width: 100%; height: 100% ;z-index: -1;background: #fff;\\'></canvas>\");\ndocument.writeln(\"<canvas id=\\'c\\' style=\\'position: fixed;top: 0;left: 0; width: 100%; height: 100% ;z-index: -1;\\'></canvas>\");\nvar canvas = document.getElementById(\"c\");\nvar ctx = canvas.getContext(\"2d\");\nvar w = canvas.width = window.innerWidth;\nvar h = canvas.height = window.innerHeight;\nvar sin = Math.sin,\n    cos = Math.cos,\n    PI = Math.PI,\n    sqrt = Math.sqrt;\nvar PI2 = PI * 2;\nvar SCALE = 1;\n\nvar radius = function radius(x) {\n  return Math.pow(x, 3);\n};\n\nvar NUM = 15;\nvar t = 1;\nvar t2 = 0;\nvar amount = 1;\n\nfunction loop() {\n  ctx.clearRect(0, 0, w, h);\n  ctx.translate(w / 2, h / 2);\n\n  for (var r = 0; SCALE * radius(r) < (w + h) / 2; r++) {\n    var rad = SCALE * radius(r + t + t2);\n\n    for (var i = 0; i < NUM; i++) {\n      var a = PI2 * (i + t) / NUM;\n      var x = rad * cos(a);\n      var y = rad * sin(a);\n      ctx.beginPath();\n      ctx.arc(x, y, 0.2 * (r + t + t2) * (r + t + t2), 0, PI2);\n      ctx.fill();\n    }\n\n    rad = SCALE * radius(r + t + t2 + 0.5);\n\n    for (var _i = 0.5; _i < NUM; _i++) {\n      var _a = PI2 * (_i - t) / NUM;\n\n      var _x = rad * cos(_a);\n\n      var _y = rad * sin(_a);\n\n      ctx.beginPath();\n      ctx.arc(_x, _y, 0.2 * (r + t + t2 + 0.5) * (r + t + t2 + 0.5), 0, PI2);\n      ctx.fill();\n    }\n  }\n\n  t -= 0.01 * amount;\n  if (t <= 0) t += 1;\n  ctx.translate(-w / 2, -h / 2);\n  requestAnimationFrame(loop);\n}\n\nctx.fillStyle = \"#595\";\nloop();\n\nfunction background() {\n  var canvas = document.getElementById(\"bg_canvas\");\n  var ctx = canvas.getContext(\"2d\");\n  var w = canvas.width = window.innerWidth;\n  var h = canvas.height = window.innerHeight;\n  ctx.fillStyle = \"#eee\";\n  ctx.fillRect(0, 0, w, h);\n  ctx.strokeStyle = \"#8c8\";\n\n  function loop() {\n    ctx.clearRect(0, 0, w, h);\n    ctx.translate(w / 2, h / 2);\n\n    for (var i = 0; i < NUM * 2; i++) {\n      ctx.beginPath();\n      ctx.moveTo(0, 0);\n\n      for (var r = 0; SCALE * radius(r) < (w + h) / 2; r += 0.1) {\n        var rad = SCALE * radius(r + t2);\n        var a = PI2 * (i + (i < NUM ? r : -r)) / NUM;\n        var x = rad * cos(a);\n        var y = rad * sin(a);\n        ctx.lineTo(x, y);\n      }\n\n      ctx.stroke();\n    }\n\n    t2 = (t2 + 0.004 * amount) % 1;\n    ctx.translate(-w / 2, -h / 2);\n    requestAnimationFrame(loop);\n  }\n\n  loop();\n}\n\nbackground();\n\nwindow.onclick = function (e) {\n  amount = amount == 0 ? 1 : 0;\n};\n\n//# sourceURL=webpack://%5Bname%5D/./src/js/bg/b6.js?");

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
/******/ 	return __webpack_require__("./src/js/bg/b6.js");
/******/ })()
;
});