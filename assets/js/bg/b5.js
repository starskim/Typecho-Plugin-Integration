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
		exports["b5"] = factory();
	else
		root["b5"] = factory();
})(self, function() {
return /******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/bg/b5.js":
/*!*************************!*\
  !*** ./src/js/bg/b5.js ***!
  \*************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

eval("function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }\n\nfunction _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }\n\nfunction _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }\n\nfunction _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError(\"Cannot call a class as a function\"); } }\n\nfunction _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if (\"value\" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }\n\nfunction _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }\n\ndocument.writeln(\"<div id=\\'bubble\\' style=\\'width:100%;height:100%;position:fixed;top:0;left:0;z-index:-1;background-color:#000;\\'></div>\");\n\nvar BGBubble = /*#__PURE__*/function () {\n  function BGBubble(opts) {\n    _classCallCheck(this, BGBubble);\n\n    this.defaultOpts = {\n      id: '',\n      //容器ID\n      num: 100,\n      // 个数\n      start_probability: 0.1,\n      // 如果数量小于num，有这些几率添加一个新的\n      radius_min: 1,\n      // 初始半径最小值\n      radius_max: 2,\n      // 初始半径最大值\n      radius_add_min: .3,\n      // 半径增加最小值\n      radius_add_max: .5,\n      // 半径增加最大值\n      opacity_min: 0.3,\n      // 初始透明度最小值\n      opacity_max: 0.5,\n      // 初始透明度最大值\n      opacity_prev_min: .003,\n      // 透明度递减值最小值\n      opacity_prev_max: .005,\n      // 透明度递减值最大值\n      light_min: 40,\n      // 颜色亮度最小值\n      light_max: 70,\n      // 颜色亮度最大值\n      is_same_color: false,\n      //泡泡颜色是否相同\n      background: \"#f1f3f4\"\n    };\n\n    if (Object.prototype.toString.call(opts) == \"[object Object]\") {\n      this.userOpts = _objectSpread(_objectSpread({}, this.defaultOpts), opts);\n    } else {\n      this.userOpts = _objectSpread(_objectSpread({}, this.defaultOpts), {}, {\n        id: opts\n      });\n    }\n\n    this.color = this.random(0, 360);\n    this.bubbleNum = [];\n    this.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;\n    this.cancelAnimationFrame = window.cancelAnimationFrame || window.mozCancelAnimationFrame;\n  }\n\n  _createClass(BGBubble, [{\n    key: \"random\",\n    value: function random(a, b) {\n      return Math.random() * (b - a) + a; //取a-b之间的随机值\n    }\n  }, {\n    key: \"initBubble\",\n    value: function initBubble(color, isSameColor) {\n      var width = window.innerWidth;\n      var height = window.innerHeight;\n      var userOpts = this.userOpts;\n      var light = this.random(userOpts.light_min, userOpts.light_max);\n      this.bubble = {\n        x: this.random(0, width),\n        y: this.random(0, height),\n        radius: this.random(userOpts.radius_min, userOpts.radius_max),\n        radiusChange: this.random(userOpts.radius_add_min, userOpts.radius_add_max),\n        opacity: this.random(userOpts.opacity_min, userOpts.opacity_max),\n        opacityChange: this.random(userOpts.opacity_prev_min, userOpts.opacity_prev_max),\n        light: light,\n        color: \"hsl(\".concat(isSameColor ? color : this.random(0, 360), \",100%,\").concat(light, \"%)\")\n      };\n    }\n  }, {\n    key: \"bubbling\",\n    value: function bubbling(ctx, color, isSameColor) {\n      !this.bubble && this.initBubble(color, isSameColor);\n      var bubble = this.bubble;\n      ctx.fillStyle = bubble.color;\n      ctx.globalAlpha = bubble.opacity;\n      ctx.beginPath();\n      ctx.arc(bubble.x, bubble.y, bubble.radius, 0, 2 * Math.PI, true);\n      ctx.closePath();\n      ctx.fill();\n      ctx.globalAlpha = 1;\n      bubble.opacity -= bubble.opacityChange;\n      bubble.radius += bubble.radiusChange;\n\n      if (bubble.opacity <= 0) {\n        this.initBubble(color, isSameColor);\n        return;\n      }\n    }\n  }, {\n    key: \"createCanvas\",\n    value: function createCanvas() {\n      var _this = this;\n\n      this.canvas = document.createElement('canvas');\n      this.ctx = this.canvas.getContext('2d');\n      this.canvas.id = \"bg_canvas\";\n      this.canvas.style.display = 'block'; //防止全屏的canvas出现滚动条\n\n      this.canvas.width = window.innerWidth;\n      this.canvas.height = window.innerHeight;\n      this.canvas.style.position = 'fixed';\n      this.canvas.style.top = '0';\n      this.canvas.style.left = '0';\n      this.canvas.style.zIndex = '-1';\n      document.getElementById(this.userOpts.id).appendChild(this.canvas);\n\n      window.onresize = function () {\n        _this.canvas.width = window.innerWidth;\n        _this.canvas.height = window.innerHeight;\n      };\n    }\n  }, {\n    key: \"start\",\n    value: function start() {\n      var _this2 = this;\n\n      var width = window.innerWidth;\n      var height = window.innerHeight;\n      this.color += 0.1;\n      this.ctx.fillStyle = this.defaultOpts.background; //这里修改颜色hsl(${this.color},100%,97%)//rgba(255, 255, 255, 0)\n\n      this.ctx.fillRect(0, 0, width, height);\n\n      if (this.bubbleNum.length < this.userOpts.num && Math.random() < this.userOpts.start_probability) {\n        this.bubbleNum.push(new BGBubble());\n      }\n\n      this.bubbleNum.forEach(function (bubble) {\n        return bubble.bubbling(_this2.ctx, _this2.color, _this2.userOpts.is_same_color);\n      });\n      var requestAnimationFrame = this.requestAnimationFrame;\n      this.myReq = requestAnimationFrame(function () {\n        return _this2.start();\n      });\n    }\n  }, {\n    key: \"destory\",\n    value: function destory() {\n      var cancelAnimationFrame = this.cancelAnimationFrame;\n      cancelAnimationFrame(this.myReq);\n      window.onresize = null;\n    }\n  }]);\n\n  return BGBubble;\n}();\n\nvar bubbleDemo = new BGBubble('bubble');\nbubbleDemo.createCanvas();\nbubbleDemo.start();\n\n//# sourceURL=webpack://%5Bname%5D/./src/js/bg/b5.js?");

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
/******/ 	return __webpack_require__("./src/js/bg/b5.js");
/******/ })()
;
});