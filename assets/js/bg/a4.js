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
		exports["a4"] = factory();
	else
		root["a4"] = factory();
})(self, function() {
return /******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/bg/a4.js":
/*!*************************!*\
  !*** ./src/js/bg/a4.js ***!
  \*************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

eval("/*\r\n * 需要在 “后台” → “设置外观” → “开发者设置” → “自定义输出body 尾部的HTML代码” 添加以下代码\r\n * <!-- canvas背景 -->\r\n * <script type=\"text/javascript\" src=\"//域名/usr/extend/canvas.js\"></script>\r\n */\n\n\nwindow.bubbly = function (t) {\n  var o = t || {\n    colorStart: \"rgba(255,244,230,1)\",\n    colorStop: \"rgba(255,233,228,1)\",\n    blur: 1,\n    compose: \"source-over\",\n    bubbleFunc: function bubbleFunc() {\n      return \"hsla(\".concat(Math.random() * 50, \", 100%, 50%, .3)\");\n    }\n  },\n      e = function e() {\n    return Math.random();\n  },\n      r = o.canvas || document.createElement(\"canvas\"),\n      n = r.width,\n      a = r.height;\n\n  null === r.parentNode && (r.setAttribute(\"style\", \"position:fixed;z-index:-1;left:0;top:0;min-width:100vw;min-height:100vh;\"), n = r.width = window.innerWidth, a = r.height = window.innerHeight, document.body.appendChild(r));\n  var i = r.getContext(\"2d\");\n  i.shadowColor = o.shadowColor || \"#fff\", i.shadowBlur = o.blur || 4;\n  var l = i.createLinearGradient(0, 0, n, a);\n  l.addColorStop(0, o.colorStart || \"#2AE\"), l.addColorStop(1, o.colorStop || \"#17B\");\n\n  for (var h = o.bubbles || Math.floor(.02 * (n + a)), d = [], c = 0; c < h; c++) {\n    d.push({\n      f: (o.bubbleFunc || function () {\n        return \"hsla(0, 0%, 100%, \" + .1 * e() + \")\";\n      }).call(),\n      x: e() * n,\n      y: e() * a,\n      r: 4 + e() * n / 25,\n      a: e() * Math.PI * 2,\n      v: .1 + .5 * e()\n    });\n  }\n\n  !function t() {\n    if (null === r.parentNode) return cancelAnimationFrame(t);\n    !1 !== o.animate && requestAnimationFrame(t), i.globalCompositeOperation = \"source-over\", i.fillStyle = l, i.fillRect(0, 0, n, a), i.globalCompositeOperation = o.compose || \"lighter\", d.forEach(function (t) {\n      i.beginPath(), i.arc(t.x, t.y, t.r, 0, 2 * Math.PI), i.fillStyle = t.f, i.fill(), t.x += Math.cos(t.a) * t.v, t.y += Math.sin(t.a) * t.v, t.x - t.r > n && (t.x = -t.r), t.x + t.r < 0 && (t.x = n + t.r), t.y - t.r > a && (t.y = -t.r), t.y + t.r < 0 && (t.y = a + t.r);\n    });\n  }();\n};\n\nbubbly();\nvar configs = [{}, {\n  colorStart: \"#111\",\n  colorStop: \"#422\",\n  bubbleFunc: function bubbleFunc() {\n    return \"hsla(0, 100%, 50%, \".concat(Math.random() * 0.25, \")\");\n  }\n}, {\n  colorStart: \"#4c004c\",\n  colorStop: \"#1a001a\",\n  bubbleFunc: function bubbleFunc() {\n    return \"hsla(\".concat(Math.random() * 360, \", 100%, 50%, \").concat(Math.random() * 0.25, \")\");\n  }\n}, {\n  colorStart: \"#fff4e6\",\n  colorStop: \"#ffe9e4\",\n  blur: 1,\n  compose: \"source-over\",\n  bubbleFunc: function bubbleFunc() {\n    return \"hsla(\".concat(Math.random() * 50, \", 100%, 50%, .3)\");\n  }\n}];\ndocument.addEventListener(\"click\", function (e) {\n  if (e.target.hasAttribute(\"data-config-nr\")) {\n    document.body.removeChild(document.querySelector(\"canvas\"));\n    bubbly(configs[e.target.getAttribute(\"data-config-nr\")]);\n  }\n});\n\n//# sourceURL=webpack://%5Bname%5D/./src/js/bg/a4.js?");

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
/******/ 	return __webpack_require__("./src/js/bg/a4.js");
/******/ })()
;
});