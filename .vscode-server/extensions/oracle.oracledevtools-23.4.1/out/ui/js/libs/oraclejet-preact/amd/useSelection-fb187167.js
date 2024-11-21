define(['exports', 'preact/hooks'], (function(e,t){"use strict";const n=["ArrowUp","ArrowDown","ArrowLeft","ArrowRight"],o=(e,t,n,o,r)=>{let l=new Set([]);if(null!=e){l=new Set(t);const r=t.has(e);"toggle"===o?r?l.delete(e):"single"===n?l=new Set([e]):l.add(e):r||(l=new Set([e]))}var c,i;i=t,(c=l).size===i.size&&[...c].every((e=>i.has(e)))||r?.({ids:[...l]})};e.useSelection=function({selection:e=[],selectionMode:r="none",idExtracter:l,onChange:c,isDrillEnabled:i,isKeyboardSelection:s}){const u=t.useRef(),a=t.useCallback((t=>{if(u.current&&i)return clearTimeout(u.current),void(u.current=void 0);const n=l(t),s=t.metaKey,a=t.ctrlKey;t.defaultPrevented||null==n&&(s||a)||(i?u.current=setTimeout((()=>{o(n,new Set(e),r,s||a||"touch"===t.pointerType?"toggle":"replace",c),u.current=void 0}),250):o(n,new Set(e),r,s||a||"touch"===t.pointerType?"toggle":"replace",c))}),[e,r,c,l,i]),d=t.useCallback((t=>{const n=l(t),i=t.ctrlKey;o(n,new Set(e),r,i?"toggle":"replace",c)}),[e,r,c,l]),g=t.useCallback((t=>{const i=t.shiftKey,u=t.ctrlKey&&" "===t.key,a=-1!==n.indexOf(t.key),d=l(t);if(a||u||s&&s(t)){const t=i||u?"toggle":"replace";o(d,new Set(e),r,t,c)}}),[e,r,c,l,s]);return"none"===r||null==c?{}:{onKeyUp:g,onContextMenu:d,onPointerUp:a}}}));
//# sourceMappingURL=useSelection-fb187167.js.map
