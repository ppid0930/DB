define(['exports', 'preact/jsx-runtime', './Flex-f2984cda', './WindowOverlay-31e3416a', './useUser-03bad59a', './Layer-8682b669', 'preact/compat', './TopLayerHost-1134809b'], (function(t,o,e,s,r,i,a,n){"use strict";t.MessageLayer=({children:t,offset:a,testId:n,position:c="bottom"})=>{const p=c.split("-")[0];let l;l="number"==typeof a?{mainAxis:a,crossAxis:a}:"top"==p||"bottom"==p?{mainAxis:a?.vertical,crossAxis:a?.horizontal}:{mainAxis:a?.horizontal,crossAxis:a?.vertical};const{direction:d}=r.useUser(),b="ltr"===d;let m;switch(c){case"top-left":m=b?"top-start":"top-end";break;case"top-right":m=b?"top-end":"top-start";break;case"bottom-left":m=b?"bottom-start":"bottom-end";break;case"bottom-right":m=b?"bottom-end":"bottom-start";break;default:m=c}return o.jsx(i.Layer,{priority:"top",children:o.jsx(s.WindowOverlay,{placement:m,offset:l,children:o.jsx("div",{"data-testid":n,children:o.jsx(e.Flex,{direction:"column",gap:"2x",children:t})})})})},t.positions=["top","top-left","top-right","top-start","top-end","bottom","bottom-left","bottom-right","bottom-start","bottom-end"]}));
//# sourceMappingURL=MessageLayer-b7d1f259.js.map
