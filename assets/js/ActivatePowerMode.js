!function(e,t){"object"==typeof exports&&"object"==typeof module?module.exports=t():"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?exports.ActivatePowerMode=t():e.ActivatePowerMode=t()}(window,(function(){return function(e){var t={};function o(n){if(t[n])return t[n].exports;var r=t[n]={i:n,l:!1,exports:{}};return e[n].call(r.exports,r,r.exports,o),r.l=!0,r.exports}return o.m=e,o.c=t,o.d=function(e,t,n){o.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},o.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},o.t=function(e,t){if(1&t&&(e=o(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(o.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)o.d(n,r,function(t){return e[t]}.bind(null,r));return n},o.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return o.d(t,"a",t),t},o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},o.p="",o(o.s=134)}({134:function(e,t,o){"use strict";var n=document.createElement("canvas");n.id="ActivatePowerMode",n.width=window.innerWidth,n.height=window.innerHeight,n.style.cssText="position:fixed;top:0;left:0;pointer-events:none;z-index:999999",window.addEventListener("resize",(function(){n.width=window.innerWidth,n.height=window.innerHeight})),document.body.appendChild(n);var r=n.getContext("2d"),i=[],a=0,d=!1;function l(e,t){return Math.random()*(t-e)+e}function u(e){if(f.colorful){var t=l(0,360);return"hsla("+l(t-10,t+10)+", 100%, "+l(50,80)+"%, 1)"}return window.getComputedStyle(e).color}function c(e,t,o){return{x:e,y:t,alpha:1,color:o,velocity:{x:2*Math.random()-1,y:2*Math.random()-3.5}}}function f(){for(var e=function(){var e,t=document.activeElement;if("TEXTAREA"===t.tagName||"INPUT"===t.tagName&&"text"===t.getAttribute("type")){var n=o(135)(t,t.selectionEnd);return e=t.getBoundingClientRect(),{x:n.left+e.left,y:n.top+e.top,color:u(t)}}var r=window.getSelection();if(r.rangeCount){var i=r.getRangeAt(0),a=i.startContainer;return a.nodeType===document.TEXT_NODE&&(a=a.parentNode),{x:(e=i.getBoundingClientRect()).left,y:e.top,color:u(a)}}return{x:0,y:0,color:"transparent"}}(),t=5+Math.round(10*Math.random());t--;)i[a]=c(e.x,e.y,e.color),a=(a+1)%500;if(f.shake){var n=1+2*Math.random(),r=n*(Math.random()>.5?-1:1),l=n*(Math.random()>.5?-1:1);document.body.style.marginLeft=r+"px",document.body.style.marginTop=l+"px",setTimeout((function(){document.body.style.marginLeft="",document.body.style.marginTop=""}),75)}d||requestAnimationFrame(p)}function p(){d=!0,r.clearRect(0,0,n.width,n.height);for(var e=!1,t=n.getBoundingClientRect(),o=0;o<i.length;++o){var a=i[o];a.alpha<=.1||(a.velocity.y+=.075,a.x+=a.velocity.x,a.y+=a.velocity.y,a.alpha*=.96,r.globalAlpha=a.alpha,r.fillStyle=a.color,r.fillRect(Math.round(a.x-1.5)-t.left,Math.round(a.y-1.5)-t.top,3,3),e=!0)}e?requestAnimationFrame(p):d=!1}f.shake=!0,f.colorful=!1,e.exports=f},135:function(e,t,o){!function(){var t=["direction","boxSizing","width","height","overflowX","overflowY","borderTopWidth","borderRightWidth","borderBottomWidth","borderLeftWidth","borderStyle","paddingTop","paddingRight","paddingBottom","paddingLeft","fontStyle","fontVariant","fontWeight","fontStretch","fontSize","fontSizeAdjust","lineHeight","fontFamily","textAlign","textTransform","textIndent","textDecoration","letterSpacing","wordSpacing","tabSize","MozTabSize"],o=null!=window.mozInnerScreenX;function n(e,n,r){var i=r&&r.debug||!1;if(i){var a=document.querySelector("#input-textarea-caret-position-mirror-div");a&&a.parentNode.removeChild(a)}var d=document.createElement("div");d.id="input-textarea-caret-position-mirror-div",document.body.appendChild(d);var l=d.style,u=window.getComputedStyle?getComputedStyle(e):e.currentStyle;l.whiteSpace="pre-wrap","INPUT"!==e.nodeName&&(l.wordWrap="break-word"),l.position="absolute",i||(l.visibility="hidden"),t.forEach((function(e){l[e]=u[e]})),o?e.scrollHeight>parseInt(u.height)&&(l.overflowY="scroll"):l.overflow="hidden",d.textContent=e.value.substring(0,n),"INPUT"===e.nodeName&&(d.textContent=d.textContent.replace(/\s/g," "));var c=document.createElement("span");c.textContent=e.value.substring(n)||".",d.appendChild(c);var f={top:c.offsetTop+parseInt(u.borderTopWidth),left:c.offsetLeft+parseInt(u.borderLeftWidth)};return i?c.style.backgroundColor="#aaa":document.body.removeChild(d),f}void 0!==e.exports?e.exports=n:window.getCaretCoordinates=n}()}})}));