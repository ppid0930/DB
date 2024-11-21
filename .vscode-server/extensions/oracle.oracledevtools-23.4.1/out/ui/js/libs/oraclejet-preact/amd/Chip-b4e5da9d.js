define(['exports', 'preact/jsx-runtime', './useActionable-e8622fa1', 'preact/hooks', './TabbableModeContext-1e10fda7', './useTabbableMode-dd4cb96b', './UNSAFE_Chip/themes/ChipStyles.css', './useInteractionStyle-272137c8', './mergeProps-31f70810', './useTestId-85e3a67d'], (function(e,s,t,a,i,o,l,r,c,d){"use strict";e.Chip=function({isSelected:e,isDisabled:i,"aria-label":n,children:b,testId:u,onToggle:p}){const v=a.useCallback((()=>{p?.({previousValue:e,value:!e})}),[e,p]),{actionableProps:h}=t.useActionable(v),{interactionProps:y,applyActiveStyle:S,applyHoverStyle:f,applyPseudoHoverStyle:H}=r.useInteractionStyle(),P=c.mergeProps(h,y),T=l.multiVariantStyles({disabled:i?"isDisabled":"notDisabled",hover:!f||i||e?"notHover":"isHover",pseudoHover:!H||i||e?"notPseudoHover":"isPseudoHover",active:e||S?"isActive":"notActive"}),{isTabbable:x}=o.useTabbableMode(),A=d.useTestId(u);return i?s.jsx("div",{class:T,...A,children:b}):s.jsx("div",{...P,class:T,...A,tabIndex:x?0:-1,"aria-label":n,role:"switch","aria-checked":e?"true":"false",children:b})}}));
//# sourceMappingURL=Chip-b4e5da9d.js.map
