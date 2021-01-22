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
		exports["a2"] = factory();
	else
		root["a2"] = factory();
})(self, function() {
return /******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/bg/a2.js":
/*!*************************!*\
  !*** ./src/js/bg/a2.js ***!
  \*************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

eval("document.writeln(\"<canvas id='cvs' style='width:100%;height:100%;position:fixed;top:0;left:0;z-index:-1;background-color:#000;'></canvas>\");\nvar cvs = document.getElementById(\"cvs\");\nvar ctx = cvs.getContext(\"2d\");\nvar cw = cvs.width = document.body.clientWidth;\nvar ch = cvs.height = document.body.clientHeight; //动画绘制对象\n\nvar requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;\nvar codeRainArr = []; //代码雨数组\n\nvar cols = parseInt(cw / 14); //代码雨列数\n\nvar step = 16; //步长，每一列内部数字之间的上下间隔\n\nctx.font = \" 14px microsoft yahei\"; //声明字体，个人喜欢微软雅黑\n//创建代码雨\n\nfunction createCodeRain() {\n  for (var n = 0; n < cols; n++) {\n    var col = []; //基础位置，为了列与列之间产生错位\n\n    var basePos = parseInt(Math.random() * 300); //随机速度 3~13之间\n\n    var speed = parseInt(Math.random() * 10) + 3; //每组的x轴位置随机产生\n\n    var colx = parseInt(Math.random() * cw);\n\n    for (var i = 0; i < parseInt(ch / step) / 2; i++) {\n      var code = {\n        x: colx,\n        y: -(step * i) - basePos,\n        speed: speed,\n        text: parseInt(Math.random() * 10) % 2 == 0 ? 0 : 1 //随机生成0或者1\n        //                          text : [\"a\",\"b\",\"c\",\"d\",\"e\",\"f\",\"g\",\"h\",\"o\",\"s\",\"x\"][parseInt(Math.random()*11)] //随机生成字母数组中的一个\n\n      };\n      col.push(code);\n    }\n\n    codeRainArr.push(col);\n  }\n} //代码雨下起来\n\n\nfunction codeRaining() {\n  //把画布擦干净\n  ctx.clearRect(0, 0, cw, ch);\n\n  for (var n = 0; n < codeRainArr.length; n++) {\n    //取出列\n    col = codeRainArr[n]; //遍历列，画出该列的代码\n\n    for (var i = 0; i < col.length; i++) {\n      var code = col[i];\n\n      if (code.y > ch) {\n        //如果超出下边界则重置到顶部\n        code.y = 0;\n      } else {\n        //匀速降落\n        code.y += code.speed;\n      } //颜色也随机变化\n\n\n      ctx.fillStyle = \"hsl(\" + (parseInt(Math.random() * 359) + 1) + \",30%,\" + (50 - i * 2) + \"%)\"; //把代码画出来\n\n      ctx.fillText(code.text, code.x, code.y);\n    }\n  }\n\n  requestAnimationFrame(codeRaining);\n} //创建代码雨\n\n\ncreateCodeRain(); //开始下雨吧 GO>>\n\nrequestAnimationFrame(codeRaining);\n\n//# sourceURL=webpack://%5Bname%5D/./src/js/bg/a2.js?");

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
/******/ 	return __webpack_require__("./src/js/bg/a2.js");
/******/ })()
;
});