define(['exports', 'preact/jsx-runtime', 'preact/hooks', './useId-93f47e0a', 'preact', './classNames-902bc74c', './useComponentTheme-ee621a15', './Flex-f2984cda', './Separator-87ddeffc', './ChevronDown-86f3138b', './CollapseIcon-869e54ab', './ChevronUp-4e7a21aa', './usePress-52c24c9a', './UNSAFE_Collapsible/themes/redwood/CollapsibleTheme', './useAnimation-6b82844f', './useTestId-85e3a67d'], (function(e,n,s,a,i,o,t,l,d,r,c,u,b,h,p,x){"use strict";const m=({isExpanded:e,isDisabled:s,iconPosition:a})=>{const i=s?"disabled":"primary",o="start"===a&&e?r.SvgChevronDown:c.CollapseIcon,t="end"===a&&e?u.SvgChevronUp:r.SvgChevronDown,l="start"===a?o:t;return n.jsx(l,{size:"6x",color:i})},g=({children:e,id:a,contentId:r,isDisabled:c,isExpanded:u,iconPosition:p,variant:x="basic",toggleHandler:g,accessibleLabel:v,accessibleLabelId:f})=>{const[C,j]=s.useState(!1),E=s.useRef(!1),{classes:S,styles:y}=t.useComponentTheme(h.CollapsibleRedwoodTheme,{disabled:c?"isDisabled":"notDisabled",divider:"horizontal-rule"===x?"hasDivider":"noDivider",focused:C?"isFocused":"notFocused"}),D=o.classNames([y.headerChildrenStyle,"end"===p&&y.iconEndStyle,"start"===p&&y.iconStartStyle]),w=s.useCallback((e=>{if(g(e.target),C){(window&&"PointerEvent"in window&&e instanceof PointerEvent||e instanceof MouseEvent)&&j(!1)}}),[g,C]),{pressProps:I}=b.usePress(w,{isDisabled:c,isRepeat:!1}),T=s.useCallback((e=>{"focusin"!==e.type||E.current?j(!1):j(!0)}),[]),H=()=>{E.current=!0},P=()=>{E.current=!1},F=v?{"aria-label":v}:f?{"aria-labelledby":f}:{"aria-labelledby":a};return n.jsxs(n.Fragment,{children:[n.jsx("div",{id:a,className:S,...I,children:n.jsx(l.Flex,{align:"center",justify:"start"===p?"start":"between",children:n.jsxs(i.Fragment,{children:["end"===p&&n.jsx("div",{className:D,children:e}),n.jsx("div",{tabIndex:0,role:"button","aria-controls":r,"aria-expanded":u,onFocus:T,onBlur:T,onMouseDown:H,onMouseUp:P,className:y.chevronStyle,...F,children:n.jsx(m,{iconPosition:p,isExpanded:u,isDisabled:c})}),"start"===p&&n.jsx("div",{className:D,children:e})]})})}),"horizontal-rule"===x&&n.jsx(d.Separator,{})]})},v=({children:e,id:a,isExpanded:i,onTransitionEnd:o})=>{const[l,d]=s.useState(i?"expanding":"unmounted"),{styles:r}=t.useComponentTheme(h.CollapsibleRedwoodTheme),c=s.useRef({overflowY:"hidden",maxHeight:i?"none":"0"});s.useEffect((()=>{("unmounted"!==l||i)&&d(i?"expanding":"collapsing")}),[i,l]);const{nodeRef:u}=p.useAnimation(l,{animationStates:f,onAnimationEnd:({animationState:e})=>{"collapsing"===e&&d("unmounted"),o?.()}});return n.jsx("div",{className:r.contentChildrenStyle,ref:u,id:a,tabIndex:-1,style:c.current,"aria-hidden":!i||void 0,children:"unmounted"!==l&&e})},f={expanding:e=>({to:{maxHeight:`${e.scrollHeight}px`},options:{duration:400},end:{maxHeight:"none"}}),collapsing:e=>({..."none"===e.style.maxHeight&&{from:{maxHeight:`${e.scrollHeight}px`}},to:{maxHeight:"0"},options:{duration:400}})};e.Collapsible=({header:e,children:i,isDisabled:o=!1,isExpanded:t=!1,iconPosition:l="start",variant:d="basic",onToggle:r,onTransitionEnd:c,"aria-label":u,"aria-labelledby":b,testId:h})=>{const p=a.useId(),m=`oj-collapsible-header-${p}`,f=`oj-collapsible-content-${p}`,C=x.useTestId(h),j=s.useCallback((e=>{o||r?.({value:!t,target:e})}),[o,r,t]),E=s.useCallback((()=>{c?.({value:t})}),[c,t]);return n.jsxs("div",{...C,children:[n.jsx(g,{id:m,contentId:f,toggleHandler:j,isDisabled:o,isExpanded:t,iconPosition:l,variant:d,accessibleLabel:u,accessibleLabelId:b,children:e}),n.jsx(v,{id:f,isExpanded:t,onTransitionEnd:E,children:i})]})}}));
//# sourceMappingURL=Collapsible-dcffbd57.js.map
