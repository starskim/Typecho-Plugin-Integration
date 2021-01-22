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
		exports["a1"] = factory();
	else
		root["a1"] = factory();
})(self, function() {
return /******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/bg/a1.js":
/*!*************************!*\
  !*** ./src/js/bg/a1.js ***!
  \*************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

eval("document.writeln(\"<canvas id=\\'mom\\' style=\\'width:100%;height:100%;position:fixed;top:0;left:0;z-index:-1;background-color:#000;\\'></canvas>\"); //获取屏幕可视区域大小\n\nvar d = document.documentElement;\nvar clinetW = d.clientWidth;\nvar clinetH = d.clientHeight; //设置画布大小\n\nvar canvas = document.querySelector('#mom');\ncanvas.width = clinetW;\ncanvas.height = clinetH;\nvar cxt = canvas.getContext('2d');\nvar rainStr = 'The matrix of hackers';\nvar arr = rainStr.split('');\nvar fontSize = 14; // 计算行数\n\nvar cols = Math.floor(clinetW / fontSize); // 初始化Y轴坐标\n\nvar down = [];\n\nfor (var i = 0; i < cols; i++) {\n  down.push(Math.floor(Math.random() * -100));\n}\n\nfunction drawRain() {\n  // 填充背景(ps:背景采用rgba,可尝试不同透明度的效果)\n  cxt.fillStyle = 'rgba(0,0,0,.1)';\n  cxt.fillRect(0, 0, clinetW, clinetH); // 设置字体颜色\n\n  cxt.fillStyle = '#00ff00';\n\n  for (var i = 0; i < down.length; i++) {\n    var randomNum = Math.random(); // 绘制文字\n\n    cxt.fillText(arr[Math.floor(randomNum * arr.length)], i * fontSize, down[i] * fontSize);\n\n    if (down[i] * fontSize > clinetH && randomNum > 0.9) {\n      down[i] = 0;\n    } //绘制文字的下一个位置\n\n\n    down[i]++;\n  }\n}\n\nsetInterval(drawRain, 30);\n/**\n * [rain description]\n * @param  {[Element]} canvas canvas元素对象\n * @param  {[String]} text    掉落的字符串\n * @param  {[String]} symbol  分隔符\n * @param  {[Number]} speed   掉落速度\n * @return {[type]}        [description]\n */\n\nfunction rain(canvas, text, symbol, speed) {\n  //获取屏幕可视区域大小\n  var d = document.documentElement;\n  var clinetW = d.clientWidth;\n  var clinetH = d.clientHeight; //设置画布大小\n\n  var canvas = canvas || document.querySelector('#mom');\n  canvas.width = clinetW;\n  canvas.height = clinetH;\n  var cxt = canvas.getContext('2d');\n  var rainStr = text || 'The matrix of hackers';\n  var symbol = symbol || '';\n  var arr = rainStr.split(symbol);\n  var fontSize = 14; // 计算行数\n\n  var cols = Math.floor(clinetW / fontSize); // 初始化Y轴坐标\n\n  var down = [];\n\n  for (var i = 0; i < cols; i++) {\n    down.push(Math.floor(Math.random() * -100));\n  }\n\n  function drawRain() {\n    // 填充背景(ps:背景采用rgba,可尝试不同透明度的效果)\n    cxt.fillStyle = 'rgba(0,0,0,.1)';\n    cxt.fillRect(0, 0, clinetW, clinetH); // 设置字体颜色\n\n    cxt.fillStyle = '#00ff00';\n\n    for (var i = 0; i < down.length; i++) {\n      var randomNum = Math.random(); // 绘制文字\n\n      cxt.fillText(arr[Math.floor(randomNum * arr.length)], i * fontSize, down[i] * fontSize);\n\n      if (down[i] * fontSize > clinetH && randomNum > 0.9) {\n        down[i] = 0;\n      }\n\n      down[i]++;\n    }\n  }\n\n  var speed = speed || 30;\n  setInterval(drawRain, speed);\n}\n\nvar canvas = document.querySelector('#mom');\nvar text = '富强 民主 文明 和谐 自由 平等 公正 法治 爱国 敬业 诚信 友善';\nrain(canvas, text, '', 30);\n\n//# sourceURL=webpack://%5Bname%5D/./src/js/bg/a1.js?");

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
/******/ 	return __webpack_require__("./src/js/bg/a1.js");
/******/ })()
;
});