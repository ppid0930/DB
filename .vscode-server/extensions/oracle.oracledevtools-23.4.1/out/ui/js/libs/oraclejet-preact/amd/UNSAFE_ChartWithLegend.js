define(['exports', 'preact/jsx-runtime', './Flex-f2984cda', './dimensions-f9da1099', './size-0ac0e517', './utils-b1f1bfab', './Common/themes/themeContract.css', './colorUtils-35dd886e', './_curry1-18233096', './mergeInterpolations-2c5b5a03', './classNames-902bc74c', './_curry3-d231d2ab', './_curry2-6839fe47', './_isObject-3d38b8ba', './boxalignment-8811030d', './arrayUtils-110317ac', 'css!./boxalignment.styles.css', './vanilla-extract-sprinkles-createRuntimeSprinkles.esm-fa409727', './flexbox-0ac22ae4', 'css!./flexbox.styles.css', './flexitem-554e6fbe', 'css!./flexitem.styles.css', 'css!./FlexStyles.styles.css'], (function(e,t,r,s,n,i,c,o,l,a,d,m,u,x,f,h,b,y,g,j,p,v,w){"use strict";e.ChartWithLegend=function({chart:e,legend:s,position:n,maxSize:i,size:c}){const o="start"===n||"end"===n?"row":"column",{chartOrder:l,legendOrder:a}=function(e){const t="start"===e||"top"===e;return{chartOrder:t?2:1,legendOrder:t?1:2}}(n),{justifyContent:d,alignItem:m}=function(e){let t,r;return"top"===e?(t="center",r="end"):"bottom"===e?(t="center",r="start"):"start"===e?(t="end",r="center"):(t="start",r="center"),{justifyContent:t,alignItem:r}}(n);return t.jsxs(r.Flex,{width:"100%",height:"100%",direction:o,children:[t.jsx("div",{style:{order:l,flexGrow:1},children:e}),s&&t.jsx(r.Flex,{order:a,justify:d,align:m,maxHeight:"column"===o?i:void 0,maxWidth:"row"===o?i:void 0,height:"column"===o?c:void 0,width:"row"===o?c:void 0,children:s})]})},Object.defineProperty(e,"__esModule",{value:!0})}));
//# sourceMappingURL=UNSAFE_ChartWithLegend.js.map