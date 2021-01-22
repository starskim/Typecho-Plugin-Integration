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
		exports["a6"] = factory();
	else
		root["a6"] = factory();
})(self, function() {
return /******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/bg/a6.js":
/*!*************************!*\
  !*** ./src/js/bg/a6.js ***!
  \*************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

eval("document.writeln(\"<canvas id=\\'bg_canvas\\' style=\\'top: 0;left: 0;position: fixed;width: 100%;height: 100%;z-index: -1;display: block; background: rgb(56, 163, 179);\\'></canvas> \");\nvar can = document.getElementById(\"bg_canvas\"); //设置2d绘图环境\n\nvar ctx = can.getContext(\"2d\"); //获取浏览器窗口的宽高\n\nvar w = can.width = window.innerWidth,\n    h = can.height = window.innerHeight; //自适应浏览器窗口\n\nwindow.onresize = function () {\n  w = can.width = window.innerWidth, h = can.height = window.innerHeight;\n}; //         ctx.fillStyle=\"yellow\"\n//       ctx.fillRect(100,100,100,100);\n//       //  绘制圆形\n//    ctx.arc(250,250,50,0,Math.PI*2,false);\n//    ctx.strokeStyle=\"yellow\";\n//    ctx.stroke();\n// //运动\n// var y=0;\n// setInterval(function(){\n// y++;\n// ctx.clearRect(0,0,w,h);\n// ctx.fillRect(100,y,100,100);\n// },30);\n\n\nfunction Drop() {}\n\n; //创建雨滴类\n\nDrop.prototype = {\n  init: function init() {\n    this.x = rand(0, w); //雨滴的初始化坐标\n\n    this.y = 0; //雨滴y轴方向的坐标\n\n    this.vy = rand(8, 9); //雨滴下落的速度\n\n    this.l = rand(h * 0.8, h * 0.9); //雨滴下落的高度\n\n    this.r = 1;\n    this.vr = 1; //半径增加的速度\n\n    this.a = 1;\n    this.va = 0.98; //透明度的变化系数\n  },\n  draw: function draw() //绘制雨滴\n  {\n    if (this.y > this.l) {\n      //绘制圆形\n      ctx.beginPath(); //开始路径\n\n      ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2, false);\n      ctx.strokeStyle = \"rgba(255,255,255,\" + this.a + \")\";\n      ctx.stroke();\n    } else {\n      //绘制下落的雨滴\n      ctx.fillStyle = \"rgb(255,255,255)\";\n      ctx.fillRect(this.x, this.y, 2, 10);\n    }\n\n    this.update();\n  },\n  update: function update() //更新坐标\n  {\n    if (this.y < this.l) {\n      this.y += this.vy;\n    } else {\n      if (this.a > 0.03) {\n        this.r += this.vr;\n\n        if (this.r > 50) {\n          this.a *= this.va;\n        }\n      } else {\n        //重新初始化了\n        this.init();\n      }\n    }\n  }\n}; //实例化一个雨滴对象\n\nvar drops = []; //默认值为undefined\n//console.log(drops)\n\nfor (var i = 0; i < 30; i++) {\n  setTimeout(function () {\n    var drop = new Drop();\n    drop.init();\n    drops.push(drop);\n  }, i * 200);\n} //实例初始化\n\n\nsetInterval(function () {\n  //绘制一个透明层\n  ctx.id = \"rainbow\";\n  ctx.fillStyle = \"rgba(129, 135, 255, 0.44)\";\n  ctx.fillRect(0, 0, w, h);\n\n  for (var i = 0; i < drops.length; i++) {\n    drops[i].draw();\n  }\n}, 30);\n\nfunction rand(min, max) {\n  return Math.random() * (max - min) + min;\n}\n\n//# sourceURL=webpack://%5Bname%5D/./src/js/bg/a6.js?");

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
/******/ 	return __webpack_require__("./src/js/bg/a6.js");
/******/ })()
;
});