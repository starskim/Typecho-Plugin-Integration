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
		exports["b7"] = factory();
	else
		root["b7"] = factory();
})(self, function() {
return /******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/bg/b7.js":
/*!*************************!*\
  !*** ./src/js/bg/b7.js ***!
  \*************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

eval("function async_load() {\n  i.scrolling = \"no\";\n  i.frameborder = \"0\";\n  i.border = \"0\";\n  i.setAttribute(\"frameborder\", \"0\", 0);\n  i.width = \"100px\";\n  i.height = \"20px\";\n  document.getElementById(\"hub_iframe\").appendChild(i);\n}\n\nif (window.addEventListener) {\n  window.addEventListener(\"load\", async_load, false);\n} else if (window.attachEvent) {\n  window.attachEvent(\"onload\", async_load);\n} else {\n  window.onload = async_load;\n}\n\n!function () {\n  //封装方法，压缩之后减少文件大小\n  function get_attribute(node, attr, default_value) {\n    return node.getAttribute(attr) || default_value;\n  } //封装方法，压缩之后减少文件大小\n\n\n  function get_by_tagname(name) {\n    return document.getElementsByTagName(name);\n  } //获取配置参数\n\n\n  function get_config_option() {\n    var scripts = get_by_tagname(\"script\"),\n        script_len = scripts.length,\n        script = scripts[script_len - 1]; //当前加载的script\n\n    return {\n      l: script_len,\n      //长度，用于生成id用\n      z: get_attribute(script, \"zIndex\", -1),\n      //z-index\n      o: get_attribute(script, \"opacity\", 1),\n      //opacity\n      c: get_attribute(script, \"color\", \"87,250,255\"),\n      //color\n      n: get_attribute(script, \"count\", 150) //count\n\n    };\n  } //设置canvas的高宽\n\n\n  function set_canvas_size() {\n    canvas_width = the_canvas.width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth, canvas_height = the_canvas.height = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;\n  } //绘制过程\n\n\n  function draw_canvas() {\n    context.clearRect(0, 0, canvas_width, canvas_height); //随机的线条和当前位置联合数组\n\n    var e, i, d, x_dist, y_dist, dist; //临时节点\n    //遍历处理每一个点\n\n    random_lines.forEach(function (r, idx) {\n      r.x += r.xa, r.y += r.ya, //移动\n      r.xa *= r.x > canvas_width || r.x < 0 ? -1 : 1, r.ya *= r.y > canvas_height || r.y < 0 ? -1 : 1, //碰到边界，反向反弹\n      context.fillRect(r.x - 0.5, r.y - 0.5, 1, 1); //绘制一个宽高为1的点\n      //从下一个点开始\n\n      for (i = idx + 1; i < all_array.length; i++) {\n        e = all_array[i]; //不是当前点\n\n        if (null !== e.x && null !== e.y) {\n          x_dist = r.x - e.x, //x轴距离 l\n          y_dist = r.y - e.y, //y轴距离 n\n          dist = x_dist * x_dist + y_dist * y_dist; //总距离, m\n\n          dist < e.max && (e === current_point && dist >= e.max / 2 && (r.x -= 0.03 * x_dist, r.y -= 0.03 * y_dist), //靠近的时候加速\n          d = (e.max - dist) / e.max, context.beginPath(), context.lineWidth = d / 2, context.strokeStyle = \"rgba(\" + config.c + \",\" + (d + 0.2) + \")\", context.moveTo(r.x, r.y), context.lineTo(e.x, e.y), context.stroke());\n        }\n      }\n    }), frame_func(draw_canvas);\n  } //创建画布，并添加到body中\n\n\n  var the_canvas = document.createElement(\"canvas\"),\n      //画布\n  config = get_config_option(),\n      //配置\n  canvas_id = \"c_n\" + config.l,\n      //canvas id\n  context = the_canvas.getContext(\"2d\"),\n      canvas_width,\n      canvas_height,\n      frame_func = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function (func) {\n    window.setTimeout(func, 1000 / 45);\n  },\n      random = Math.random,\n      current_point = {\n    x: null,\n    //当前鼠标x\n    y: null,\n    //当前鼠标y\n    max: 20000\n  },\n      all_array;\n\n  the_canvas.id = canvas_id;\n  the_canvas.style.cssText = \"position:fixed;top:0;left:0;z-index:\" + config.z + \";opacity:\" + config.o;\n  get_by_tagname(\"body\")[0].appendChild(the_canvas); //初始化画布大小\n\n  set_canvas_size(), window.onresize = set_canvas_size; //当时鼠标位置存储，离开的时候，释放当前位置信息\n\n  window.onmousemove = function (e) {\n    e = e || window.event, current_point.x = e.clientX, current_point.y = e.clientY;\n  }, window.onmouseout = function () {\n    current_point.x = null, current_point.y = null;\n  }; //随机生成config.n条线位置信息\n\n  for (var random_lines = [], i = 0; config.n > i; i++) {\n    var x = random() * canvas_width,\n        //随机位置\n    y = random() * canvas_height,\n        xa = 2 * random() - 1,\n        //随机运动方向\n    ya = 2 * random() - 1;\n    random_lines.push({\n      x: x,\n      y: y,\n      xa: xa,\n      ya: ya,\n      max: 6000 //沾附距离\n\n    });\n  }\n\n  all_array = random_lines.concat([current_point]); //0.1秒后绘制\n\n  setTimeout(function () {\n    draw_canvas();\n  }, 100);\n}();\n\n//# sourceURL=webpack://%5Bname%5D/./src/js/bg/b7.js?");

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
/******/ 	return __webpack_require__("./src/js/bg/b7.js");
/******/ })()
;
});