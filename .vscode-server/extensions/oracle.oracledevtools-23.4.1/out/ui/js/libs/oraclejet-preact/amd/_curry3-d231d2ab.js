define(['exports', './_curry1-18233096', './_curry2-6839fe47'], (function(r,e,c){"use strict";r._curry3=function(r){return function n(u,l,t){switch(arguments.length){case 0:return n;case 1:return e._isPlaceholder(u)?n:c._curry2((function(e,c){return r(u,e,c)}));case 2:return e._isPlaceholder(u)&&e._isPlaceholder(l)?n:e._isPlaceholder(u)?c._curry2((function(e,c){return r(e,l,c)})):e._isPlaceholder(l)?c._curry2((function(e,c){return r(u,e,c)})):e._curry1((function(e){return r(u,l,e)}));default:return e._isPlaceholder(u)&&e._isPlaceholder(l)&&e._isPlaceholder(t)?n:e._isPlaceholder(u)&&e._isPlaceholder(l)?c._curry2((function(e,c){return r(e,c,t)})):e._isPlaceholder(u)&&e._isPlaceholder(t)?c._curry2((function(e,c){return r(e,l,c)})):e._isPlaceholder(l)&&e._isPlaceholder(t)?c._curry2((function(e,c){return r(u,e,c)})):e._isPlaceholder(u)?e._curry1((function(e){return r(e,l,t)})):e._isPlaceholder(l)?e._curry1((function(e){return r(u,e,t)})):e._isPlaceholder(t)?e._curry1((function(e){return r(u,l,e)})):r(u,l,t)}}}}));
//# sourceMappingURL=_curry3-d231d2ab.js.map
