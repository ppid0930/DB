define(['exports', 'preact/hooks', './useFocusWithin-3a309bee'], (function(e,u,s){"use strict";e.useFocusableTextField=function({isReadonly:e,ref:r=(()=>{}),...t}){const{focusProps:c,isFocused:n}=s.useFocusWithin(t),o=u.useRef(n),f=u.useRef(null),i=u.useRef(null);return u.useEffect((()=>{o.current&&(e?setTimeout((()=>i.current?.focus())):setTimeout((()=>f.current?.focus())))}),[e]),u.useEffect((()=>{o.current=n}),[n]),u.useImperativeHandle(r,(()=>({focus:()=>{e?i.current?.focus():f.current?.focus()},blur:()=>{e?i.current?.blur():f.current?.blur()}})),[e]),{enabledElementRef:f,readonlyElementRef:i,isFocused:n,focusProps:c}}}));
//# sourceMappingURL=useFocusableTextField-3da26e05.js.map