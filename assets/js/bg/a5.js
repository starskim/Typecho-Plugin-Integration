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
		exports["a5"] = factory();
	else
		root["a5"] = factory();
})(self, function() {
return /******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/bg/a5.js":
/*!*************************!*\
  !*** ./src/js/bg/a5.js ***!
  \*************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

eval("function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }\n\nfunction _nonIterableRest() { throw new TypeError(\"Invalid attempt to destructure non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.\"); }\n\nfunction _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === \"string\") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === \"Object\" && o.constructor) n = o.constructor.name; if (n === \"Map\" || n === \"Set\") return Array.from(o); if (n === \"Arguments\" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }\n\nfunction _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }\n\nfunction _iterableToArrayLimit(arr, i) { if (typeof Symbol === \"undefined\" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i[\"return\"] != null) _i[\"return\"](); } finally { if (_d) throw _e; } } return _arr; }\n\nfunction _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }\n\ndocument.writeln(\"<canvas id=\\'rainbow\\' style=\\'background-color: #ffffffe0;z-index: -1;position:fixed;top:0;left:0;width:100%;height:100%;\\'></canvas>\");\nvar DPR = window.devicePixelRatio;\nvar colors = [['#EC008C', '#f957b6'], ['#EF4136', '#ff7972'], ['yellow', '#fff'], ['lime', '#7aff7a'], ['#27AAE1', '#5ec8f2'], [\"#662D91\", '#a158d8']];\nvar tau = Math.PI * 2;\nvar start = Math.PI;\nvar finish = .5;\nvar inc = .007;\nvar rainbowHeight = .5;\nvar arcStagger = .05;\nvar sparklesInPerStripe = 3;\nvar sparkles = [];\n\nvar clamp = function clamp(min, max, val) {\n  return Math.min(Math.max(min, val), max);\n};\n\nvar boolRandom = function boolRandom() {\n  return Math.round(Math.random()) ? false : true;\n};\n\nvar sizeCanvas = function sizeCanvas() {\n  radius = clamp(15, 50, window.innerWidth / 60 / DPR);\n  var canvas = document.getElementById('rainbow');\n  canvas.width = window.innerWidth * DPR;\n  canvas.height = window.innerHeight * DPR;\n};\n\nvar addRandom = function addRandom(lineWidth) {\n  return (boolRandom() ? -1 : 1) * Math.random() * lineWidth;\n};\n\nvar makeSparkle = function makeSparkle(_ref) {\n  var cx = _ref.cx,\n      cy = _ref.cy,\n      radiusX = _ref.radiusX,\n      radiusY = _ref.radiusY,\n      endAngle = _ref.endAngle,\n      lineWidth = _ref.lineWidth,\n      color = _ref.color;\n  return {\n    x: cx + radiusX * Math.cos(endAngle) + addRandom(lineWidth),\n    y: cy + radiusY * Math.sin(endAngle) + addRandom(lineWidth),\n    opacity: 1,\n    color: color,\n    rad: Math.max(radius * Math.random() * DPR, 15)\n  };\n};\n\nfunction animate() {\n  var percent = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;\n  var doneAnimatingIn = percent >= finish + arcStagger * colors.length;\n  var width = window.innerWidth * DPR;\n  var height = window.innerHeight * DPR;\n  var lineWidth = height * .5 / colors.length;\n  var cx = width / 2;\n  var startCy = height + lineWidth * rainbowHeight + (height - colors.length * lineWidth) / 3;\n  var startRadiusX = width / 2 + colors.length * lineWidth * 2;\n  var startRadiusY = height;\n  var ctx = document.getElementById('rainbow').getContext('2d');\n  ctx.clearRect(0, 0, width, height);\n  ctx.globalAlpha = 1;\n  ctx.lineWidth = lineWidth;\n\n  for (var i = colors.length - 1; i > -1; i--) {\n    var _colors$i = _slicedToArray(colors[i], 2),\n        colorLine = _colors$i[0],\n        colorSparkle = _colors$i[1];\n\n    var cy = startCy + i * (lineWidth / 2 - 1);\n    var radiusX = startRadiusX - i * lineWidth / 2;\n    var radiusY = startRadiusY - i * lineWidth / 2;\n    var endAngle = tau * (percent - i * arcStagger) + start;\n    var angle = clamp(start, tau * finish + start, endAngle);\n    ctx.beginPath();\n    ctx.shadowColor = colorLine;\n    ctx.strokeStyle = colorLine;\n    ctx.ellipse(cx, cy, radiusX, radiusY, 0, start, angle, false);\n    ctx.lineCap = \"round\";\n    ctx.stroke();\n    ctx.closePath();\n\n    if (!doneAnimatingIn) {\n      for (var j = 0; j < sparklesInPerStripe; j++) {\n        sparkles.push(makeSparkle({\n          cx: cx,\n          cy: cy,\n          radiusX: radiusX,\n          radiusY: radiusY,\n          endAngle: angle,\n          lineWidth: lineWidth,\n          color: colorLine\n        }));\n      }\n    } else {\n      sparkles.push(makeSparkle({\n        cx: cx,\n        cy: cy,\n        radiusX: radiusX,\n        radiusY: radiusY,\n        endAngle: Math.random() * Math.PI + Math.PI,\n        lineWidth: lineWidth,\n        color: boolRandom() ? '#fff' : colorSparkle\n      }));\n    }\n  }\n\n  var nextSparkles = [];\n\n  for (var _i2 = 0, len = sparkles.length; _i2 < len; _i2++) {\n    var _sparkles$_i = sparkles[_i2],\n        x = _sparkles$_i.x,\n        y = _sparkles$_i.y,\n        opacity = _sparkles$_i.opacity,\n        color = _sparkles$_i.color,\n        rad = _sparkles$_i.rad;\n    ctx.beginPath();\n    ctx.globalAlpha = opacity;\n    ctx.fillStyle = color;\n    ctx.arc(x - rad, y - rad, rad, 0, Math.PI / 2);\n    ctx.arc(x - rad, y + rad, rad, 3 * Math.PI / 2, 2 * Math.PI);\n    ctx.arc(x + rad, y + rad, rad, Math.PI, 3 * Math.PI / 2);\n    ctx.arc(x + rad, y - rad, rad, Math.PI / 2, Math.PI);\n    ctx.fill();\n\n    if (opacity > .2 && rad > .2) {\n      nextSparkles.push({\n        x: x,\n        y: y,\n        opacity: opacity - .03,\n        rad: rad - .2,\n        color: color\n      });\n    }\n  }\n\n  sparkles = nextSparkles;\n\n  if (!doneAnimatingIn) {\n    requestAnimationFrame(function () {\n      animate(percent + inc);\n    });\n  } else {\n    requestAnimationFrame(function () {\n      animate(finish + colors.length * arcStagger);\n    });\n  }\n}\n\nsizeCanvas();\nrequestAnimationFrame(function () {\n  animate();\n});\nwindow.addEventListener('resize', sizeCanvas);\n\n//# sourceURL=webpack://%5Bname%5D/./src/js/bg/a5.js?");

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
/******/ 	return __webpack_require__("./src/js/bg/a5.js");
/******/ })()
;
});