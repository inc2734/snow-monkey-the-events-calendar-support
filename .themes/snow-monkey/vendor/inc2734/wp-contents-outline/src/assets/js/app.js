!function(e){var t={};function r(n){if(t[n])return t[n].exports;var o=t[n]={i:n,l:!1,exports:{}};return e[n].call(o.exports,o,o.exports,r),o.l=!0,o.exports}r.m=e,r.c=t,r.d=function(e,t,n){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(r.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)r.d(n,o,function(t){return e[t]}.bind(null,o));return n},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="",r(r.s=0)}([function(e,t,r){"use strict";r.r(t);window.addEventListener("DOMContentLoaded",(function(){var e=document.querySelectorAll(".wpco-wrapper");[].slice.call(e).forEach((function(e){return function(e){var t=e.getAttribute("data-wpco-post-class"),r=document.querySelector(t);if(r){var n=e.getAttribute("data-wpco-selector"),o=r.querySelectorAll(n);if(!(1>o.length)){var u=[],i=e.getAttribute("data-wpco-headings").split(",").map((function(e){return e.trim()}));[].slice.call(o).forEach((function(e){[].slice.call(e.children).forEach((function(e){-1!==i.indexOf(e.tagName.toLowerCase())&&u.push(e)}))})),new ContentsOutline(e,{headings:u,moveToBefore1stHeading:"true"===e.getAttribute("data-wpco-move")})}}}(e)}))}),!1)}]);