define(['exports', 'preact/hooks', './useToggle-373978a9'], (function(e,r,n){"use strict";e.useSpinning=({isStepDownDisabled:e,isStepUpDisabled:t,onSpin:o,onSpinComplete:u,onStep:c})=>{const{bool:a,setTrue:s,setFalse:l}=n.useToggle(!1),{bool:i,setTrue:p,setFalse:P}=n.useToggle(!1),f=r.useRef(null),w=r.useRef(null),d=r.useRef("increase"),k=r.useRef(!1),D=r.useCallback((r=>{"ArrowDown"!==r.key&&"ArrowUp"!==r.key||(r.preventDefault(),r.stopPropagation(),a||"ArrowDown"===r.key&&e||"ArrowUp"===r.key&&t||(d.current="ArrowDown"===r.key?"decrease":"increase",s(),c?.({direction:d.current})))}),[a,c,e,t,s]),g=r.useCallback((e=>{"ArrowDown"!==e.key&&"ArrowUp"!==e.key||(i&&(k.current=!0),l(),P(),e.stopPropagation())}),[i,l,P]),b=r.useCallback((e=>{e.stopPropagation(),e.preventDefault(),t||(d.current="increase",s(),c?.({direction:d.current}))}),[c,t,s]),y=r.useCallback((r=>{r.stopPropagation(),r.preventDefault(),e||(d.current="decrease",s(),c?.({direction:d.current}))}),[c,e,s]),C=r.useCallback((e=>{i&&(k.current=!0),l(),P(),e.stopPropagation()}),[i,l,P]);r.useEffect((()=>(a&&!f.current&&(f.current=setTimeout((()=>{p()}),500)),()=>{f.current&&(clearTimeout(f.current),f.current=null)})),[a,p]),r.useEffect((()=>(i?w.current||(w.current=setInterval((()=>{"increase"===d.current&&t||"decrease"===d.current&&e?(P(),k.current=!0):o?.({direction:d.current})}),40)):w.current&&(clearInterval(w.current),w.current=null),()=>{w.current&&(clearInterval(w.current),w.current=null)})),[i,e,t,o,P]),r.useEffect((()=>{!i&&k.current&&(k.current=!1,u?.())}),[i,u]);return{keyboardHandlerProps:{onKeyDown:D,onKeyUp:g},pointerIncreaseHandlerProps:{onPointerDown:b,onPointerUp:C,onPointerOut:C,onPointerCancel:C},pointerDecreaseHandlerProps:{onPointerDown:y,onPointerUp:C,onPointerOut:C,onPointerCancel:C}}}}));
//# sourceMappingURL=useSpinning-be4a9498.js.map
