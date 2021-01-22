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
		exports["ActivatePowerMode"] = factory();
	else
		root["ActivatePowerMode"] = factory();
})(self, function() {
return /******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/ActivatePowerMode.js":
/*!*************************************!*\
  !*** ./src/js/ActivatePowerMode.js ***!
  \*************************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements: module, __webpack_require__ */
/*! CommonJS bailout: module.exports is used directly at 144:0-14 */
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";
eval("\n\nvar canvas = document.createElement(\"canvas\");\ncanvas.id = \"ActivatePowerMode\";\ncanvas.width = window.innerWidth;\ncanvas.height = window.innerHeight;\ncanvas.style.cssText = 'position:fixed;top:0;left:0;pointer-events:none;z-index:999999';\nwindow.addEventListener(\"resize\", function () {\n  canvas.width = window.innerWidth;\n  canvas.height = window.innerHeight;\n});\ndocument.body.appendChild(canvas);\nvar context = canvas.getContext(\"2d\");\nvar particles = [];\nvar particlePointer = 0;\nvar rendering = false;\nActivatePowerMode.shake = true;\n\nfunction getRandom(min, max) {\n  return Math.random() * (max - min) + min;\n}\n\nfunction getColor(el) {\n  if (ActivatePowerMode.colorful) {\n    var u = getRandom(0, 360);\n    return \"hsla(\".concat(getRandom(u - 10, u + 10), \", 100%, \").concat(getRandom(50, 80), \"%, 1)\");\n  } else {\n    return window.getComputedStyle(el).color;\n  }\n}\n\nfunction getCaret() {\n  var el = document.activeElement;\n  var bcr;\n\n  if (el.tagName === 'TEXTAREA' || el.tagName === 'INPUT' && el.getAttribute(\"type\") === 'text') {\n    var offset = __webpack_require__(/*! textarea-caret-position */ \"./src/js/textarea-caret-position.js\")(el, el.selectionEnd);\n\n    bcr = el.getBoundingClientRect();\n    return {\n      x: offset.left + bcr.left,\n      y: offset.top + bcr.top,\n      color: getColor(el)\n    };\n  }\n\n  var selection = window.getSelection();\n\n  if (selection.rangeCount) {\n    var range = selection.getRangeAt(0);\n    var startNode = range.startContainer;\n\n    if (startNode.nodeType === document.TEXT_NODE) {\n      startNode = startNode.parentNode;\n    }\n\n    bcr = range.getBoundingClientRect();\n    return {\n      x: bcr.left,\n      y: bcr.top,\n      color: getColor(startNode)\n    };\n  }\n\n  return {\n    x: 0,\n    y: 0,\n    color: \"transparent\"\n  };\n}\n\nfunction createParticle(x, y, color) {\n  return {\n    x: x,\n    y: y,\n    alpha: 1,\n    color: color,\n    velocity: {\n      x: -1 + Math.random() * 2,\n      y: -3.5 + Math.random() * 2\n    }\n  };\n}\n\nfunction ActivatePowerMode() {\n  {\n    // spawn particles\n    var caret = getCaret();\n    var numParticles = 5 + Math.round(Math.random() * 10);\n\n    while (numParticles--) {\n      particles[particlePointer] = createParticle(caret.x, caret.y, caret.color);\n      particlePointer = (particlePointer + 1) % 500;\n    }\n  }\n  {\n    // shake screen\n    if (ActivatePowerMode.shake) {\n      var intensity = 1 + 2 * Math.random();\n      var x = intensity * (Math.random() > 0.5 ? -1 : 1);\n      var y = intensity * (Math.random() > 0.5 ? -1 : 1);\n      document.body.style.marginLeft = \"\".concat(x, \"px\");\n      document.body.style.marginTop = \"\".concat(y, \"px\");\n      setTimeout(function () {\n        document.body.style.marginLeft = '';\n        document.body.style.marginTop = '';\n      }, 75);\n    }\n  }\n\n  if (!rendering) {\n    requestAnimationFrame(loop);\n  }\n}\n\nActivatePowerMode.colorful = false;\n\nfunction loop() {\n  rendering = true;\n  context.clearRect(0, 0, canvas.width, canvas.height);\n  var rendered = false;\n  var rect = canvas.getBoundingClientRect();\n\n  for (var i = 0; i < particles.length; ++i) {\n    var particle = particles[i];\n    if (particle.alpha <= 0.1) continue;\n    particle.velocity.y += 0.075;\n    particle.x += particle.velocity.x;\n    particle.y += particle.velocity.y;\n    particle.alpha *= 0.96;\n    context.globalAlpha = particle.alpha;\n    context.fillStyle = particle.color;\n    context.fillRect(Math.round(particle.x - 1.5) - rect.left, Math.round(particle.y - 1.5) - rect.top, 3, 3);\n    rendered = true;\n  }\n\n  if (rendered) {\n    requestAnimationFrame(loop);\n  } else {\n    rendering = false;\n  }\n}\n\nmodule.exports = ActivatePowerMode;\n\n//# sourceURL=webpack://%5Bname%5D/./src/js/ActivatePowerMode.js?");

/***/ }),

/***/ "./src/js/textarea-caret-position.js":
/*!*******************************************!*\
  !*** ./src/js/textarea-caret-position.js ***!
  \*******************************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements: module */
/*! CommonJS bailout: module.exports is used directly at 80:45-59 */
/*! CommonJS bailout: module.exports is used directly at 81:4-18 */
/***/ ((module) => {

eval("/* jshint browser: true */\n(function () {\n  // The properties that we copy into a mirrored div.\n  // Note that some browsers, such as Firefox,\n  // do not concatenate properties, i.e. padding-top, bottom etc. -> padding,\n  // so we have to do every single property specifically.\n  var properties = ['direction', // RTL support\n  'boxSizing', 'width', // on Chrome and IE, exclude the scrollbar, so the mirror div wraps exactly as the textarea does\n  'height', 'overflowX', 'overflowY', // copy the scrollbar for IE\n  'borderTopWidth', 'borderRightWidth', 'borderBottomWidth', 'borderLeftWidth', 'borderStyle', 'paddingTop', 'paddingRight', 'paddingBottom', 'paddingLeft', // https://developer.mozilla.org/en-US/docs/Web/CSS/font\n  'fontStyle', 'fontVariant', 'fontWeight', 'fontStretch', 'fontSize', 'fontSizeAdjust', 'lineHeight', 'fontFamily', 'textAlign', 'textTransform', 'textIndent', 'textDecoration', // might not make a difference, but better be safe\n  'letterSpacing', 'wordSpacing', 'tabSize', 'MozTabSize'];\n  var isFirefox = window.mozInnerScreenX != null;\n\n  function getCaretCoordinates(element, position, options) {\n    var debug = options && options.debug || false;\n\n    if (debug) {\n      var el = document.querySelector('#input-textarea-caret-position-mirror-div');\n\n      if (el) {\n        el.parentNode.removeChild(el);\n      }\n    } // mirrored div\n\n\n    var div = document.createElement('div');\n    div.id = 'input-textarea-caret-position-mirror-div';\n    document.body.appendChild(div);\n    var style = div.style;\n    var computed = window.getComputedStyle ? getComputedStyle(element) : element.currentStyle; // currentStyle for IE < 9\n    // default textarea styles\n\n    style.whiteSpace = 'pre-wrap';\n    if (element.nodeName !== 'INPUT') style.wordWrap = 'break-word'; // only for textarea-s\n    // position off-screen\n\n    style.position = 'absolute'; // required to return coordinates properly\n\n    if (!debug) style.visibility = 'hidden'; // not 'display: none' because we want rendering\n    // transfer the element's properties to the div\n\n    properties.forEach(function (prop) {\n      style[prop] = computed[prop];\n    });\n\n    if (isFirefox) {\n      // Firefox lies about the overflow property for textareas: https://bugzilla.mozilla.org/show_bug.cgi?id=984275\n      if (element.scrollHeight > parseInt(computed.height)) style.overflowY = 'scroll';\n    } else {\n      style.overflow = 'hidden'; // for Chrome to not render a scrollbar; IE keeps overflowY = 'scroll'\n    }\n\n    div.textContent = element.value.substring(0, position); // the second special handling for input type=\"text\" vs textarea: spaces need to be replaced with non-breaking spaces - http://stackoverflow.com/a/13402035/1269037\n\n    if (element.nodeName === 'INPUT') div.textContent = div.textContent.replace(/\\s/g, \"\\xA0\");\n    var span = document.createElement('span'); // Wrapping must be replicated *exactly*, including when a long word gets\n    // onto the next line, with whitespace at the end of the line before (#7).\n    // The  *only* reliable way to do that is to copy the *entire* rest of the\n    // textarea's content into the <span> created at the caret position.\n    // for inputs, just '.' would be enough, but why bother?\n\n    span.textContent = element.value.substring(position) || '.'; // || because a completely empty faux span doesn't render at all\n\n    div.appendChild(span);\n    var coordinates = {\n      top: span.offsetTop + parseInt(computed['borderTopWidth']),\n      left: span.offsetLeft + parseInt(computed['borderLeftWidth'])\n    };\n\n    if (debug) {\n      span.style.backgroundColor = '#aaa';\n    } else {\n      document.body.removeChild(div);\n    }\n\n    return coordinates;\n  }\n\n  if ( true && typeof module.exports != \"undefined\") {\n    module.exports = getCaretCoordinates;\n  } else {\n    window.getCaretCoordinates = getCaretCoordinates;\n  }\n})();\n\n//# sourceURL=webpack://%5Bname%5D/./src/js/textarea-caret-position.js?");

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
/******/ 	return __webpack_require__("./src/js/ActivatePowerMode.js");
/******/ })()
;
});