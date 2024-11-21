(()=>{"use strict";var e,t={5747:(e,t,r)=>{var o,n=Object.defineProperty,i=Object.getOwnPropertyDescriptor,s=Object.getOwnPropertyNames,c=Object.prototype.hasOwnProperty,a={};((e,t)=>{for(var r in t)n(e,r,{get:t[r],enumerable:!0})})(a,{config:()=>p,t:()=>d}),e.exports=(o=a,((e,t,r,o)=>{if(t&&"object"==typeof t||"function"==typeof t)for(let r of s(t))c.call(e,r)||undefined===r||n(e,r,{get:()=>t[r],enumerable:!(o=i(t,r))||o.enumerable});return e})(n({},"__esModule",{value:!0}),o));var u,l=r(9896),f=r(1943);function p(e){if("contents"in e)u="string"==typeof e.contents?JSON.parse(e.contents):e.contents;else if("fsPath"in e){const r=(t=e.fsPath,(0,l.readFileSync)(t,"utf8")),o=JSON.parse(r);u=h(o)?o.contents.bundle:o}else{var t;if(e.uri){let t=e.uri;return"string"==typeof e.uri&&(t=new URL(e.uri)),new Promise(((e,r)=>{(async function(e){if("file:"===e.protocol)return await(0,f.readFile)(e,"utf8");if("http:"===e.protocol||"https:"===e.protocol){const t=await fetch(e.toString(),{headers:{"Accept-Encoding":"gzip, deflate",Accept:"application/json"},redirect:"follow"});if(!t.ok){let r=`Unexpected ${t.status} response while trying to read ${e}`;try{r+=`: ${await t.text()}`}catch{}throw new Error(r)}return await t.text()}throw new Error("Unsupported protocol")})(t).then((t=>{try{const r=JSON.parse(t);u=h(r)?r.contents.bundle:r,e()}catch(e){r(e)}})).catch((e=>{r(e)}))}))}}}function d(...e){const t=e[0];let r,o,n;if("string"==typeof t)r=t,o=t,e.splice(0,1),n=e&&"object"==typeof e[0]?e[0]:e;else{if(t instanceof Array){const r=e.slice(1);if(t.length!==r.length+1)throw new Error("expected a string as the first argument to l10n.t");let o=t[0];for(let e=1;e<t.length;e++)o+=`{${e-1}}`+t[e];return d(o,...r)}o=t.message,r=o,t.comment&&t.comment.length>0&&(r+=`/${Array.isArray(t.comment)?t.comment.join(""):t.comment}`),n=t.args??{}}const i=u?.[r];return i?"string"==typeof i?y(i,n):i.comment?y(i.message,n):y(o,n):y(o,n)}var g=/{([^}]+)}/g;function y(e,t){return 0===Object.keys(t).length?e:e.replace(g,((e,r)=>t[r]??e))}function h(e){return!("object"!=typeof e?.contents?.bundle||"string"!=typeof e?.version)}},901:function(e,t,r){var o,n=this&&this.__createBinding||(Object.create?function(e,t,r,o){void 0===o&&(o=r);var n=Object.getOwnPropertyDescriptor(t,r);n&&!("get"in n?!t.__esModule:n.writable||n.configurable)||(n={enumerable:!0,get:function(){return t[r]}}),Object.defineProperty(e,o,n)}:function(e,t,r,o){void 0===o&&(o=r),e[o]=t[r]}),i=this&&this.__setModuleDefault||(Object.create?function(e,t){Object.defineProperty(e,"default",{enumerable:!0,value:t})}:function(e,t){e.default=t}),s=this&&this.__importStar||(o=function(e){return o=Object.getOwnPropertyNames||function(e){var t=[];for(var r in e)Object.prototype.hasOwnProperty.call(e,r)&&(t[t.length]=r);return t},o(e)},function(e){if(e&&e.__esModule)return e;var t={};if(null!=e)for(var r=o(e),s=0;s<r.length;s++)"default"!==r[s]&&n(t,e,r[s]);return i(t,e),t});Object.defineProperty(t,"__esModule",{value:!0});const c=s(r(5747));!async function(){const e=[],t=process.env.VSCODE_L10N_BUNDLE_LOCATION;if(t)try{await c.config({uri:t}),e.push(`l10n: Configured to ${t.toString()}`)}catch(r){e.push(`l10n: Problems loading ${t.toString()} : ${r}`)}await Promise.all([r.e(769),r.e(421)]).then(r.bind(r,7421)),e.forEach(console.log)}()},9899:e=>{e.exports=require("typescript")},5317:e=>{e.exports=require("child_process")},6982:e=>{e.exports=require("crypto")},9896:e=>{e.exports=require("fs")},1943:e=>{e.exports=require("fs/promises")},9278:e=>{e.exports=require("net")},7975:e=>{e.exports=require("node:util")},857:e=>{e.exports=require("os")},6928:e=>{e.exports=require("path")},7016:e=>{e.exports=require("url")},9023:e=>{e.exports=require("util")}},r={};function o(e){var n=r[e];if(void 0!==n)return n.exports;var i=r[e]={exports:{}};return t[e].call(i.exports,i,i.exports,o),i.exports}o.m=t,o.d=(e,t)=>{for(var r in t)o.o(t,r)&&!o.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},o.f={},o.e=e=>Promise.all(Object.keys(o.f).reduce(((t,r)=>(o.f[r](e,t),t)),[])),o.u=e=>e+".htmlServerMain.js",o.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),o.r=e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},e={606:1},o.f.require=(t,r)=>{e[t]||(t=>{var r=t.modules,n=t.ids,i=t.runtime;for(var s in r)o.o(r,s)&&(o.m[s]=r[s]);i&&i(o);for(var c=0;c<n.length;c++)e[n[c]]=1})(require("./"+o.u(t)))};var n=o(901),i=exports;for(var s in n)i[s]=n[s];n.__esModule&&Object.defineProperty(i,"__esModule",{value:!0})})();
//# sourceMappingURL=https://main.vscode-cdn.net/sourcemaps/f1a4fb101478ce6ec82fe9627c43efbf9e98c813/extensions/html-language-features/server/dist/node/htmlServerMain.js.map