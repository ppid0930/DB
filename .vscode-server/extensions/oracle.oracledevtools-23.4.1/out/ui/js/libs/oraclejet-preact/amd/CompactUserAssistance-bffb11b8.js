define(['exports', 'preact/jsx-runtime', './useComponentTheme-ee621a15', 'preact/hooks', './Flex-f2984cda', 'css!./MessageBannerStyles.styles.css', 'module', './UNSAFE_MessageBanner/themes/redwood/MessageBannerVariants.css', 'preact', './Floating-3a873bc7', 'preact/compat', './TopLayerHost-1134809b', 'css!./TooltipContentStyles.styles.css', 'module', './hooks/UNSAFE_useTooltip/themes/redwood/TooltipContentVariants.css', 'css!./IconStyle.styles.css', './IconButton-0d891953', 'css!./MessageStyles.styles.css', './MessageFormattingUtils-83f6ebb6', './logger-2fbed0e0', './TransitionGroup-e46b469a', './MessagesContext-e6605f86', 'css!./HiddenAccessibleStyles.styles.css', 'css!./ComponentMessageStyles.styles.css', 'module', './UNSAFE_ComponentMessage/themes/redwood/ComponentMessageVariants.css', './ComponentMessageContainer-0f850243', './FormFieldContext-0bd82107', './useFormFieldContext-db150c3c', './Popup-6ccb1318', './Separator-87ddeffc', './CompactHelpSource-fa80c302', './UNSAFE_UserAssistance/themes/UserAssistanceStyles.css', './UNSAFE_UserAssistance/themes/redwood/UserAssistanceTheme'], (function(e,s,t,o,n,a,i,c,r,l,p,d,m,h,g,u,y,C,F,S,A,f,x,T,M,U,b,B,w,E,N,_,j,v){"use strict";e.CompactUserAssistance=function({anchorRef:e,assistiveText:o,fieldLabel:n,id:a,messages:i=[]}){const{isInputFocused:c,isReadonly:r}=w.useFormFieldContext(),{isFocused:l,popupProps:p}=_.usePopupFocusWithin(),d=!0===c||!0===l,{baseTheme:m}=t.useComponentTheme(v.UserAssistanceRedwoodTheme);return!0!==r&&(i.length>0||o)?s.jsx(E.Popup,{...p,placement:"end-top-corner",isOpen:d,anchorRef:e,flipOptions:{mainAxis:!0,crossAxis:!1},tail:"simple",children:s.jsxs("div",{id:a,class:m,children:[i.length>0&&s.jsx(b.ComponentMessageContainer,{fieldLabel:n,messages:i}),i.length>0&&o&&s.jsx("span",{class:j.dividerStyle,children:s.jsx(N.Separator,{})}),o&&s.jsx("span",{class:j.assistiveStyles,children:o})]})}):null}}));
//# sourceMappingURL=CompactUserAssistance-bffb11b8.js.map
