define(['exports', 'preact/jsx-runtime', 'preact/hooks', './clientHints-cfef9b8d'], (function(t,e,n,r){"use strict";const i={canvas:{},htmlSvg:{},htmlCanvas:{},svg:{}};let a={fontStyle:"normal",fontVariant:"normal",fontWeight:"normal",fontStretch:"normal",fontSize:"medium",lineHeight:"normal",fontFamily:"",letterSpacing:"normal",wordSpacing:"normal",fontVariantNumeric:"normal"};const o=new Set(["normal","small-caps"]),c=new Set(["normal","ultra-condensed","extra-condensed","condensed","semi-condensed","semi-expanded","expanded","extra-expanded","ultra-expanded"]),s="MW",f=t=>t?{fontStyle:t.fontStyle??a.fontStyle,fontVariant:t.fontVariant??a.fontVariant,fontWeight:t.fontWeight??a.fontWeight,fontStretch:t.fontStretch??a.fontStretch,fontSize:t.fontSize??a.fontSize,lineHeight:t.lineHeight??a.lineHeight,fontFamily:t.fontFamily??a.fontFamily,letterSpacing:t.letterSpacing??a.letterSpacing,wordSpacing:t.wordSpacing??a.wordSpacing,fontVariantNumeric:t.fontVariantNumeric??a.fontVariantNumeric}:{...a},u=t=>{const{fontStyle:e,fontVariant:n,fontWeight:r,fontStretch:i,fontSize:a,lineHeight:o,fontFamily:c}=t;return`${e} ${n} ${r} ${i} ${Number.isNaN(Number(a))?a:`${a}px`}/${o} ${c}`},l=(t,e)=>t+u(e)+e.letterSpacing+e.wordSpacing+e.fontVariantNumeric,h=t=>"normal"===t||"0px"===t,g=(t,e,n)=>{const r=f(n),a=l(e,r),o=i.canvas[a];if(o)return o;const c=u(r);t.font=c,t.letterSpacing="0px",t.letterSpacing=r.letterSpacing,t.wordSpacing="0px",t.wordSpacing=r.wordSpacing;const s=t.measureText(e),h={x:0,y:-s.fontBoundingBoxAscent,width:s.width,height:s.fontBoundingBoxAscent+s.fontBoundingBoxDescent};return i.canvas[a]=h,h},d=(t,e,n)=>{const r=f(n),a=l(e,r),o=i.svg[a];if(o)return o;const c=document.createElementNS("http://www.w3.org/2000/svg","text");c.setAttribute("font-style",r.fontStyle),c.setAttribute("font-variant",r.fontVariant),c.setAttribute("font-weight",r.fontWeight),c.setAttribute("font-stretch",r.fontStretch),c.setAttribute("font-size",r.fontSize),c.setAttribute("font-family",r.fontFamily),c.setAttribute("letter-spacing",r.letterSpacing),c.setAttribute("word-spacing",r.wordSpacing),c.style.fontVariantNumeric=r.fontVariantNumeric,c.textContent=e,t.appendChild(c);const s=c.getBBox(),u={x:s.x,y:s.y,width:s.width,height:s.height};return t.innerHTML="",i.svg[a]=u,u},m=(t,e,n,r)=>{const a=f(r),o=l(n,a),c="svg"===e.backend?i.htmlSvg:i.htmlCanvas,h=c[o];if(h)return h;const{width:m,height:S}=((t,e,n)=>{const r=f(n),i=u(r),a=document.createElement("span");a.style.font=i,a.style.whiteSpace="nowrap",a.style.letterSpacing=r.letterSpacing,a.style.wordSpacing=r.wordSpacing,a.style.fontVariantNumeric=r.fontVariantNumeric,a.textContent=e,t.appendChild(a);const o={width:a.offsetWidth,height:a.offsetHeight};return t.innerHTML="",o})(t,n,r),{x:p,y:x}=((t,e)=>{let n;switch(t.backend){case"svg":n=d(t.container,s,e);break;case"canvas":n=g(t.ctx,s,e)}return{x:n.x,y:n.y,width:n.width/2,height:n.height}})(e,r),w={x:p,y:x,width:m,height:S};return c[o]=w,w},S=r.getClientHints().browser;t.useTextDimensions=({backend:t="auto"}={})=>{const r=n.useRef(null),i=n.useRef(null),s=n.useRef(null),[u,l]=n.useState(),p=n.useMemo((()=>{const n=e.jsx("canvas",{ref:r,style:{display:"none"}}),o=e.jsx("div",{ref:i}),c=e.jsx("svg",{ref:s,style:{display:"block",width:"0px",height:"0px"}}),u={canvas:{refs:[r],measureContent:n,measureFunction:(t,e)=>{const n=r.current,i=n?.getContext("2d");return n&&i?g(i,t,e):{x:-1,y:-1,width:-1,height:-1}}},htmlSvg:{refs:[i,s],measureContent:e.jsxs("div",{children:[o,c]}),measureFunction:(t,e)=>i.current&&s.current?m(i.current,{backend:"svg",container:s.current},t,e):{x:-1,y:-1,width:-1,height:-1}},htmlCanvas:{refs:[i,r],measureContent:e.jsxs("div",{children:[o,n]}),measureFunction:(t,e)=>{const n=r.current,a=n?.getContext("2d");return i.current&&n&&a?m(i.current,{backend:"canvas",ctx:a},t,e):{x:-1,y:-1,width:-1,height:-1}}},svg:{refs:[s],measureContent:c,measureFunction:(t,e)=>s.current?d(s.current,t,e):{x:-1,y:-1,width:-1,height:-1}}};return"auto"===t?{refs:[i,r],measureContent:e.jsxs("div",{children:[n,o,c]}),measureFunction:(t,e)=>{const n=((t,e)=>{if("unknown"===t)return"htmlSvg";const{letterSpacing:n,wordSpacing:r,fontVariantNumeric:i}=f(e),o=h(n),c=h(r),s="normal"===i,u=i===a.fontVariantNumeric;if(o&&c&&s&&u)return"canvas";switch(t){case"firefox":default:return"htmlSvg";case"safari":case"chrome":case"edge":return o&&c&&u?"canvas":"htmlCanvas"}})(S,e);return u[n].measureFunction(t,e)}}:u[t]}),[t]);return n.useLayoutEffect((()=>{p.refs[0].current&&((t=>{const e=getComputedStyle(t);a={fontStyle:e.fontStyle,fontVariant:e.fontVariantCaps,fontWeight:e.fontWeight,fontStretch:e.fontStretch,fontSize:e.fontSize,lineHeight:e.lineHeight,fontFamily:e.fontFamily,letterSpacing:e.letterSpacing,wordSpacing:e.wordSpacing,fontVariantNumeric:e.fontVariantNumeric},a.fontVariant&&o.has(a.fontVariant)||(a.fontVariant="normal"),a.fontStretch&&c.has(a.fontStretch)||(a.fontStretch="normal")})(p.refs[0].current),document.fonts.ready.then((()=>{l((()=>p.measureFunction))})))}),[p]),{textMeasureContent:p.measureContent,getTextDimensions:u}}}));
//# sourceMappingURL=useTextDimensions-cd50e46e.js.map
