define(['exports', 'preact/jsx-runtime', 'preact', 'preact/compat', '../TopLayerHost-1134809b', '../EnvironmentProvider-fea74278', '../Theme-4e5c2b63', '../Common/themes/redwood/theme', '../Common/themes/themeContract.css', 'preact/hooks', '../LayerManager-0b32f35b'], (function(e,S,r,t,o,L,C,a,n,E,m){"use strict";e.withThemeProps=e=>{const o=e.displayName||e.name||"ComponentWithProvider",a=t.forwardRef((({colorScheme:o,scale:a,...n},E)=>{const m=E||r.createRef();return t.useEffect((()=>{if(m.current){const{classList:e}=m.current;if(!e)return;if(o){[C.LIGHT_CLASS,C.DARK_CLASS,C.INVERT_CLASS,C.COLORSCHEME_DEPENDENT_CLASS].map((S=>e.remove(S))),"dark"===o?(e.add(C.DARK_CLASS),e.add(C.INVERT_CLASS)):e.add(C.LIGHT_CLASS),e.add(C.COLORSCHEME_DEPENDENT_CLASS)}if(a){[C.SCALE_SM_CLASS,C.SCALE_MD_CLASS,C.SCALE_LG_CLASS,C.SCALE_DEPENDENT_CLASS].map((S=>e.remove(S))),e.add(`${"sm"===a?C.SCALE_SM_CLASS:"md"===a?C.SCALE_MD_CLASS:C.SCALE_LG_CLASS}`),e.add(C.SCALE_DEPENDENT_CLASS)}}}),[m,o,a]),S.jsx(L.EnvironmentProvider,{environment:{colorScheme:o,scale:a},children:S.jsx(e,{...n,ref:m})})}));return a.displayName=`withThemeProps(${o})`,a},Object.defineProperty(e,"__esModule",{value:!0})}));
//# sourceMappingURL=UNSAFE_withThemeProps.js.map
