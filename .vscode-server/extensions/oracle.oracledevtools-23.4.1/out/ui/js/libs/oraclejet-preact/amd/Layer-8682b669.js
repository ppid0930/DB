define(['exports', 'preact/jsx-runtime', 'preact/compat', './TopLayerHost-1134809b', './useThemeInterpolations-20e5a76e'], (function(e,t,o,r,n){"use strict";const a="__oj_logical_parent";e.Layer=e=>{const i=o.useContext(r.LayerContext),l="top"===e.priority||"top"===i.priority?"top":e.priority,s=i.getHost?.(l),c=o.useMemo((()=>s),[s]),[u,p]=o.useState(null),d=n.useThemeInterpolations();o.useLayoutEffect((()=>{if(!c)return;const t=(c.ownerDocument??document).createElement("div");return e.logicalParentRef&&(t[a]=e.logicalParentRef.current),c.appendChild(t),p(t),()=>{c&&t&&c.contains(t)&&(delete t[a],c.removeChild(t)),p(null)}}),[c,e.logicalParentRef]),u&&(u.className=d);let m={};return i.getHost&&(m={priority:l,getHost:i.getHost}),t.jsx(r.LayerContext.Provider,{value:m,children:u&&o.createPortal(e.children,u)})}}));
//# sourceMappingURL=Layer-8682b669.js.map
