define(['exports', 'preact/jsx-runtime', 'preact/hooks', './useResizeObserver-b337deec', './BaseCardView-21ea2f6d'], (function(e,t,i,r,a){"use strict";e.CardFlexView=function(e){const c=i.useRef(null),[d,s]=i.useState({}),n=i.useCallback((e=>{const t=e.contentRect.width;d.containerWidth!==t&&s((e=>({...e,containerWidth:t})))}),[d]);r.useResizeObserver({ref:c,callback:n});const o=a.gutterSizeToPX[e.gutterSize||"sm"],u=a.getColCount(o,d.cardWidth,d.containerWidth),h={width:d.cardWidth,height:d.cardHeight};return t.jsx(a.BaseCardView,{...e,ref:c,layout:"flex",columns:u,cardSize:h,updateCardSize:(e,t)=>{s((i=>({...i,cardWidth:e,cardHeight:t})))}})}}));
//# sourceMappingURL=CardFlexView-36ea6209.js.map