define(['exports', './useUser-03bad59a'], (function(e,a){"use strict";const r=(e,a,r)=>{r?.({value:e}),a.current=e},t=e=>{e.preventDefault(),e.stopPropagation()};e.handleInput=r,e.useKeyboardEvents=function(e,n,s,o,c,i,u){const{direction:b}=a.useUser(),h="rtl"===b;return{onKeyUp:a=>{switch(a.key){case"Enter":i?.({value:e}),t(a);break;case"Tab":r(e,c,u),t(a);break;case"Home":r(n,c,u),t(a);break;case"End":r(s,c,u),t(a)}},onKeyDown:a=>{switch(a.key){case"Tab":return;case"ArrowDown":r(Math.max(n,e-o),c,u),t(a);break;case"ArrowUp":r(Math.min(s,e+o),c,u),t(a);break;case"ArrowLeft":{const i=h?Math.min(s,e+o):Math.max(n,e-o);r(i,c,u),t(a);break}case"ArrowRight":{const i=h?Math.max(n,e-o):Math.min(s,e+o);r(i,c,u),t(a);break}}}}}}));
//# sourceMappingURL=useKeyboardEvents-7e261e90.js.map