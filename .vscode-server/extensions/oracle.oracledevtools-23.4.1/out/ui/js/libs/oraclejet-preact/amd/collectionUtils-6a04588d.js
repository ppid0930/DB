define(['exports', './keys-459a726d', './clientHints-cfef9b8d'], (function(e,t,n){"use strict";const l=e=>"number"===e.dataset.ojKeyType?Number(e.dataset.ojKey):e.dataset.ojKey,r=(e,n,r,i)=>()=>{let o,u;if(t.isKeyDefined(n)&&e){const t=e.querySelectorAll(i);for(let e=0;e<t.length;e++)if(l(t[e])===n){o=t[e],u=e;break}if(o){u=u||0;const e=r?t[u-1]:t[u+1];if(e){const t=l(e);if(null!=t)return t}return null}const c=t[0];return l(c)}return null};e.compareListItemContext=(e,t)=>e.data===t.data&&e.index===t.index&&e.isSelected===t.isSelected&&e.metadata.key===t.metadata.key,e.findElementByKey=(e,t,n)=>{if(e){const r=e.querySelectorAll(n);for(let e=0;e<r.length;e++){if(t==l(r[e]))return r[e]}}return null},e.getElementContainsFunc=(e,t)=>n=>null!=e&&(t?e!==n&&e.contains(n):e.contains(n)),e.getFirstVisibleKey=(e,t)=>{if(e){const n=e.querySelector(t);if(n){return l(n)}}return null},e.getKey=l,e.getPrevNextKey=r,e.getPrevNextKeyByCount=(e,t,n,l=0)=>{if(e&&null!=n){const r=e.findIndex((e=>t(e)===n))+l;return 0<=r&&r<e.length?t(e[r]):null}return null},e.getPrevNextKeyUsingRef=(e,t,n,l)=>()=>r(e.current,t,n,l)(),e.getViewportConfig=(e,t)=>t??{scroller:()=>e.current},e.handleEnterActionableMode=function(e,t,n){if(!e){t.length>0?t[0].focus():n(void 0)}},e.handleSelectionRange=(e,t,n)=>{const l=t.map((e=>n(e))),r=l.indexOf(e.value.start),i=l.indexOf(e.value.end),o=Math.min(r,i),u=Math.max(r,i);return-1===o?{offset:0,count:-1}:l.slice(o,u+1)},e.handleWrapActionableFocus=function(e,t,n){const l=t.length;l>0?e?t[l-1].focus():t[0].focus():n(void 0)},e.isMobile=function(){const e=n.getClientHints().deviceType;return"phone"===e||"tablet"===e},e.keyExtractor=(e,t)=>{const n=e.closest(t);if(n){const e=l(n);return void 0===e?null:e}return null}}));
//# sourceMappingURL=collectionUtils-6a04588d.js.map
