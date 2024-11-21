define(['exports', 'preact/jsx-runtime', 'preact', 'preact/compat', 'preact/hooks', './useFocusableTextField-3da26e05', './FormContext-f3d7d458', './useFormContext-bf875ce1', './FormFieldContext-0bd82107', './useTextField-ab6a48a5', './useHover-78209499', './useLengthFilter-4c17cf0f', './Label-68daef9a', './ObfuscatedTextFieldInput-23ddd580', './ReadonlyTextFieldInput-8ed621a5', './StyledTextField-7abcabc0', './TextField-43458873', './TextFieldInput-7f1f701c', './MaxLengthLiveRegion-8af4d9ae', './logger-2fbed0e0', './TabbableModeContext-1e10fda7', './useTranslationBundle-a17e0551', 'css!./UserAssistanceStyles.styles.css', 'module', './UNSAFE_UserAssistance/themes/redwood/UserAssistanceVariants.css', './InlineUserAssistance-6eea8507', './CompactUserAssistance-bffb11b8', './Floating-3a873bc7', './TopLayerHost-1134809b', './useToggle-373978a9', 'css!./TooltipContentStyles.styles.css', 'module', './hooks/UNSAFE_useTooltip/themes/redwood/TooltipContentVariants.css', 'css!./IconStyle.styles.css', './Popup-6ccb1318', 'css!./LabelStyles.styles.css', 'module', './UNSAFE_Label/themes/redwood/LabelVariants.css', './InputGroupContext-4122dbd2', 'css!./HiddenAccessibleStyles.styles.css', 'module', './UNSAFE_Popup/themes/redwood/PopupVariants.css', './useClearIcon-c0e4fc4c', './componentUtils-4c898d4d', './ClearIcon-ade745e6', './useCurrentValueReducer-7c31bcf6', './clientHints-cfef9b8d', './RevealToggleIcon-e6378273', './useFocusWithin-3a309bee', './useMessageSeverity-7ce9c66a', './stringUtils-15d0b4ab', './useFormFieldContextProps-95e39d9d', './useId-93f47e0a', './lengthFilter-09ccdc37', './useFormFieldContext-db150c3c', './classNames-902bc74c', './useComponentTheme-ee621a15', './Flex-f2984cda', './dimensions-f9da1099', './size-0ac0e517', './utils-b1f1bfab', './Common/themes/themeContract.css', './colorUtils-35dd886e', './_curry1-18233096', './mergeInterpolations-2c5b5a03', './_curry3-d231d2ab', './_curry2-6839fe47', './_isObject-3d38b8ba', './boxalignment-8811030d', './arrayUtils-110317ac', 'css!./boxalignment.styles.css', './vanilla-extract-sprinkles-createRuntimeSprinkles.esm-fa409727', './flexbox-0ac22ae4', 'css!./flexbox.styles.css', './flexitem-554e6fbe', 'css!./flexitem.styles.css', 'css!./FlexStyles.styles.css', 'css!./MessageBannerStyles.styles.css', 'module', './UNSAFE_MessageBanner/themes/redwood/MessageBannerVariants.css', 'css!./MessageBannerVariants.styles.css', './vanilla-extract-recipes-createRuntimeFn.esm-cef8720b', './IconButton-0d891953', './BaseButton-9f07f6ef', './usePress-52c24c9a', './useActive-92b57fa5', './useTabbableMode-dd4cb96b', './useColorScheme-504ab80c', './mergeProps-31f70810', './UNSAFE_BaseButton/themes/BaseButtonStyles.css', 'css!./BaseButtonStyles.styles.css', './useTestId-85e3a67d', './ButtonLayout-818f8ae5', './Text-24f845b9', './UNSAFE_Text/themes/TextStyles.css', 'css!./TextStyles.styles.css', './UNSAFE_ButtonLayout/themes/redwood/ButtonLayoutTheme', './UNSAFE_ButtonLayout/themes/ButtonLayoutStyles.css', 'css!./ButtonLayoutStyles.styles.css', './UNSAFE_ButtonLayout/themes/redwood/ButtonLayoutBaseTheme.css', 'module', './UNSAFE_ButtonLayout/themes/redwood/ButtonLayoutVariants.css', 'css!./ButtonLayoutVariants.styles.css', './useTooltip-c5269153', './useTooltipControlled-ca5c213a', './Layer-8682b669', './useThemeInterpolations-20e5a76e', './useScale-cdf8dd7a', './theme-7fdf24b2', './Theme-4e5c2b63', './useFocus-b99be29c', './useTouch-c4d9ff65', './useAnimation-6b82844f', './hooks/UNSAFE_useTooltip/themes/redwood/TooltipContentTheme', './hooks/UNSAFE_useTooltip/themes/TooltipContentStyles.css', './hooks/UNSAFE_useTooltip/themes/redwood/TooltipContentBaseTheme.css', 'css!./TooltipContentVariants.styles.css', './EnvironmentProvider-fea74278', './LayerManager-0b32f35b', 'css!./MessageStyles.styles.css', './MessageFormattingUtils-83f6ebb6', './getLocale-22900015', './Message.types-c32c6e2a', './TransitionGroup-e46b469a', './MessagesContext-e6605f86', 'css!./ComponentMessageStyles.styles.css', 'module', './UNSAFE_ComponentMessage/themes/redwood/ComponentMessageVariants.css', './UNSAFE_Separator/themes/SeparatorStyles.css', 'css!./SeparatorStyles.styles.css', './CompactLabelAssistance-80395dc9', './CompactHelpSource-fa80c302', './Help-10c6fc41', './Icon-8e654a65', './UNSAFE_Icon/themes/IconStyle.css', './UNSAFE_UserAssistance/themes/UserAssistanceStyles.css', './UNSAFE_Label/themes/redwood/LabelTheme', './UNSAFE_Label/themes/LabelStyles.css', './UNSAFE_Label/themes/redwood/LabelBaseTheme.css', './UNSAFE_TextField/themes/redwood/TextFieldTheme', './UNSAFE_TextField/themes/TextFieldStyles.css', 'css!./SkeletonStyles.styles.css', 'css!./TextFieldLoadingStyles.styles.css', 'css!./TextFieldStyles.styles.css', './UNSAFE_TextField/themes/redwood/TextFieldBaseTheme.css', 'module', './UNSAFE_TextField/themes/redwood/TextFieldVariants.css', 'css!./TextFieldVariants.styles.css', './useEffectEvent-04cb4be3', './refUtils-280eda7e', './UNSAFE_TextField/themes/ObfuscatedTextFieldInputStyles.css', 'css!./ObfuscatedTextFieldInputStyles.styles.css', './useAccessibleContext-43a3cb41', './textAlign-27feda7f', 'css!./text.styles.css', './UNSAFE_TextField/themes/redwood/ReadonlyTextFieldInputTheme', './UNSAFE_TextField/themes/ReadonlyTextFieldInputStyles.css', 'css!./ReadonlyTextFieldInputStyles.styles.css', './UNSAFE_TextField/themes/redwood/ReadonlyTextFieldInputVariants.css', './LabelValueLayout-5ba79305', 'css!./LabelValueLayoutStyles.styles.css', './UNSAFE_RadioItem/themes/redwood/RadioTheme', './UNSAFE_RadioItem/themes/RadioStyles.css', 'css!./RadioStyles.styles.css', './UNSAFE_RadioItem/themes/redwood/RadioBaseTheme.css', 'module', './UNSAFE_RadioItem/themes/redwood/RadioVariants.css', './UNSAFE_TextField/themes/redwood/FormLayoutTheme', './UNSAFE_TextField/themes/FormLayoutStyles.css', './UNSAFE_TextField/themes/redwood/FormLayoutBaseTheme.css', 'module', './UNSAFE_Checkbox/themes/redwood/CheckboxTheme', './UNSAFE_Checkbox/themes/CheckboxStyles.css', 'css!./CheckboxStyles.styles.css', './UNSAFE_Checkbox/themes/redwood/CheckboxBaseTheme.css', 'module', './UNSAFE_Checkbox/themes/redwood/CheckboxVariants.css', 'css!./CheckboxVariants.styles.css', './LayoutStyles.css-4b800410', 'css!./LayoutStyles.styles.css', './useInputGroupContext-feffa091', './useUser-03bad59a', './UNSAFE_TextField/themes/ReadonlyTextFieldStyles.css', 'css!./ReadonlyTextFieldStyles.styles.css', './UNSAFE_TextField/themes/redwood/ReadonlyTextFieldTheme', './UNSAFE_TextField/themes/redwood/ReadonlyTextFieldVariants.css', 'css!./ReadonlyTextFieldVariants.styles.css', './UNSAFE_Skeleton/themes/redwood/SkeletonTheme', './UNSAFE_Skeleton/themes/SkeletonStyles.css', './UNSAFE_Skeleton/themes/redwood/SkeletonBaseTheme.css', 'module', './UNSAFE_Skeleton/themes/redwood/SkeletonVariants.css', './useTextFieldInputHandlers-b447ab64', './TextFieldUtils-5b4c6240', './UNSAFE_TextField/themes/redwood/TextFieldInputTheme', './UNSAFE_TextField/themes/TextFieldInputStyles.css', 'css!./TextFieldInputStyles.styles.css', './UNSAFE_TextField/themes/redwood/TextFieldInputVariants.css', 'css!./TextFieldInputVariants.styles.css', './useDebounce-74e7358c', './LiveRegion-a66ead79', 'css!./LiveRegionStyles.styles.css', './ComponentMessageContainer-0f850243', './MessagesManager-e4da0822', './useMessagesContext-1fdfc011', './Transition-b3523f78', './ComponentMessage-b07e7a29', './MessageStartIcon-72112245', './SuccessS-33dbcb73', './ErrorS-a242a50c', './InformationS-7bfca79c', './WarningS-fd898f89', './PRIVATE_Message/themes/MessageStyles.css', './MessageSummary-fcc76654', './MessageUtils-8fb9ce97', './soundUtils-229b8343', './HiddenAccessible-8ed7ffcd', './UNSAFE_ComponentMessage/themes/redwood/ComponentMessageTheme', './UNSAFE_ComponentMessage/themes/ComponentMessageStyles.css', './UNSAFE_ComponentMessage/themes/redwood/ComponentMessageBaseTheme.css', './InlineHelp-9a90ca8b', './InlineHelpSource-4b65b8c3', './UNSAFE_UserAssistance/themes/redwood/UserAssistanceTheme', './UNSAFE_UserAssistance/themes/redwood/UserAssistanceBaseTheme.css', './Separator-87ddeffc', './useFloating-64bd8b22', './positionUtils-35b6e6b7', './useOutsideClick-3ced4958', './UNSAFE_Floating/themes/redwood/FloatingTheme', './UNSAFE_Floating/themes/FloatingStyles.css', 'css!./FloatingStyles.styles.css', './UNSAFE_Floating/themes/redwood/FloatingBaseTheme.css', 'module', './UNSAFE_Floating/themes/redwood/FloatingVariants.css', './vanilla-extract-dynamic.esm-f66d9a78', './UNSAFE_Floating/themes/FloatingContract.css', './Common/themes/redwood/theme', './tabbableUtils-63e9f37e', './head-585360fd', './_arity-cc05f75a', './_isArray-a4219cba', './_isString-5e4bea9c', './FocusTrap-61139e4d', './FocusTracker-0be417ef', './PRIVATE_FocusTracker/themes/FocusTrackerStyles.css', 'css!./FocusTrackerStyles.styles.css', './Modal-a327901f', './UNSAFE_Modal/themes/ModalStyles.css', 'css!./ModalStyles.styles.css', './useAnimationStatus-f0588438', './UNSAFE_Popup/themes/PopupContract.css', './UNSAFE_Popup/themes/redwood/PopupTheme', './UNSAFE_Popup/themes/redwood/PopupBaseTheme.css', 'css!./PopupStyles.styles.css', 'css!./ClearIconStyles.styles.css', './ViewHide-0dc6cf3d', './View-66e0aabc', 'css!./RevealToggleIconStyles.styles.css'], (function(e,s,t,o,a,l,n,i,d,c,r,u,m,h,F,y,S,b,T,p,x,A,f,U,g,E,_,C,N,L,w,v,I,B,R,k,M,V,P,j,H,D,O,W,q,G,z,K,J,Q,X,Y,Z,$,ee,se,te,oe,ae,le,ne,ie,de,ce,re,ue,me,he,Fe,ye,Se,be,Te,pe,xe,Ae,fe,Ue,ge,Ee,_e,Ce,Ne,Le,we,ve,Ie,Be,Re,ke,Me,Ve,Pe,je,He,De,Oe,We,qe,Ge,ze,Ke,Je,Qe,Xe,Ye,Ze,$e,es,ss,ts,os,as,ls,ns,is,ds,cs,rs,us,ms,hs,Fs,ys,Ss,bs,Ts,ps,xs,As,fs,Us,gs,Es,_s,Cs,Ns,Ls,ws,vs,Is,Bs,Rs,ks,Ms,Vs,Ps,js,Hs,Ds,Os,Ws,qs,Gs,zs,Ks,Js,Qs,Xs,Ys,Zs,$s,et,st,tt,ot,at,lt,nt,it,dt,ct,rt,ut,mt,ht,Ft,yt,St,bt,Tt,pt,xt,At,ft,Ut,gt,Et,_t,Ct,Nt,Lt,wt,vt,It,Bt,Rt,kt,Mt,Vt,Pt,jt,Ht,Dt,Ot,Wt,qt,Gt,zt,Kt,Jt,Qt,Xt,Yt,Zt,$t,eo,so,to,oo,ao,lo,no,io,co,ro,uo,mo,ho,Fo,yo,So,bo,To,po,xo,Ao,fo,Uo,go,Eo,_o,Co,No,Lo,wo,vo,Io,Bo,Ro,ko,Mo,Vo,Po,jo,Ho,Do,Oo){"use strict";const Wo=o.forwardRef((({"aria-describedby":e,assistiveText:o,autoFocus:n=!1,columnSpan:b,hasClearIcon:p="never",hasRevealToggle:x="always",helpSourceLink:f,helpSourceText:U,isDisabled:g,isReadonly:C,isRequired:N=!1,isRequiredShown:w,label:v,labelEdge:I,labelStartWidth:B,maxLength:R,maxLengthUnit:k,messages:M,placeholder:V,revealToggleLabel:P,textAlign:j,userAssistanceDensity:H,value:D,variant:z="default",virtualKeyboard:J,onInput:Q,onCommit:X,testId:Y},Z)=>{const{currentCommitValue:$,dispatch:ee}=G.useCurrentValueReducer({value:D}),se=a.useCallback((e=>{ee({type:"input",payload:e.value}),Q?.(e)}),[Q,ee]),te=a.useCallback((e=>{ee({type:"commit",payload:e.value}),X?.(e)}),[X,ee]),{isDisabled:oe,isReadonly:ae,labelEdge:le,labelStartWidth:ne,textAlign:ie,userAssistanceDensity:de}=i.useFormContext(),ce=g??oe,re=C??ae,ue=I??le,me=B??ne,he=j??ie,Fe=H??de,{bool:ye,setFalse:Se,setTrue:be}=L.useToggle(!1),{enabledElementRef:Te,focusProps:pe,isFocused:xe,readonlyElementRef:Ae}=l.useFocusableTextField({isDisabled:ce,isReadonly:re,ref:Z,onBlurWithin:Se}),{hoverProps:fe,isHover:Ue}=r.useHover({isDisabled:re||ce||!1}),{formFieldContext:ge,inputProps:Ee,labelProps:_e,textFieldProps:Ce,userAssistanceProps:Ne}=c.useTextField({ariaDescribedBy:e,helpSourceLink:f,helpSourceText:U,isDisabled:ce,isFocused:xe,isReadonly:re,isRequiredShown:w,labelEdge:ue,messages:M,styleVariant:z,userAssistanceDensity:Fe,value:D}),Le=a.useCallback((()=>{ye?Se():be()}),[ye,Se,be]),we=A.useTranslationBundle("@oracle/oraclejet-preact"),ve=P||we.inputSensitiveText_hidden(),Ie=ce||re&&!D||"always"!==x?null:s.jsx(K.RevealToggleIcon,{onPress:Le,isRevealed:ye,"aria-label":ve}),Be=a.useCallback((()=>{Te.current?.focus(),se?.({previousValue:D,value:""})}),[se,D,Te]),Re=O.useClearIcon({clearIcon:s.jsx(q.ClearIcon,{onClick:Be}),display:p,hasValue:ge.hasValue,isFocused:xe,isEnabled:!re&&!ce,isHover:Ue}),ke=W.beforeVNode(Ie,Re),{isMaxLengthExceeded:Me,valueLength:Ve,onFilteredInput:Pe}=u.useLengthFilter({maxLength:R,maxLengthUnit:k,value:D,onInput:se,onCommit:te}),je="none"!==ue?s.jsx(m.Label,{..._e,children:v}):void 0,He={label:"none"!==ue?je:void 0,labelEdge:"none"!==ue?ue:void 0,labelStartWidth:"none"!==ue?me:void 0},De="none"===ue?v:void 0,Oe="efficient"===Fe||"reflow"===Fe?ce||re?"efficient"!==Fe?void 0:s.jsx(E.InlineUserAssistance,{userAssistanceDensity:Fe,...Ne}):s.jsx(E.InlineUserAssistance,{assistiveText:o,helpSourceLink:f,helpSourceText:U,messages:M,isRequiredShown:w,userAssistanceDensity:Fe,...Ne}):void 0,We=a.useRef(null),qe="compact"===Fe?s.jsx(_.CompactUserAssistance,{anchorRef:We,messages:M,assistiveText:o,...Ne}):void 0;if(re){const e=s.jsx(F.ReadonlyTextFieldInput,{"aria-describedby":Ee["aria-describedby"],"aria-label":De,"aria-labelledby":_e.id,as:"input",autoFocus:n,elementRef:Ae,textAlign:he,type:"text",value:ye?D:"•".repeat(D?D.length:0),hasEmptyLabel:""===v&&"none"===ue,hasInsideLabel:void 0!==v&&"inside"===ue});return s.jsx(d.FormFieldContext.Provider,{value:ge,children:s.jsx(y.ReadonlyTextField,{role:"presentation",columnSpan:b,compactUserAssistance:qe,inlineUserAssistance:Oe,endContent:Ie,mainContent:e,onBlur:pe.onfocusout,onFocus:pe.onfocusin,ref:We,testId:Y,...He})})}const Ge=s.jsxs(t.Fragment,{children:[s.jsx(h.ObfuscatedTextFieldInput,{"aria-label":De,autoFocus:n,character:"•",currentCommitValue:$,hasEmptyLabel:""===v&&"none"===ue,hasInsideLabel:void 0!==je&&"inside"===ue,inputRef:Te,isRequired:N,onInput:Pe,onCommit:te,placeholder:V,textAlign:he,type:qo()?J:void 0,value:D,isRevealed:ye,...Ee}),void 0!==R&&s.jsx(T.MaxLengthLiveRegion,{isMaxLengthExceeded:Me,maxLength:R,valueLength:Ve})]});return s.jsx(d.FormFieldContext.Provider,{value:ge,children:s.jsx(S.TextField,{columnSpan:b,endContent:ke,inlineUserAssistance:Oe,compactUserAssistance:qe,mainContent:Ge,onBlur:pe.onfocusout,onFocus:pe.onfocusin,mainFieldRef:We,testId:Y,...Ce,...He,...fe})})}));function qo(){const e=z.getClientHints().deviceType;return"phone"===e||"tablet"===e}e.InputSensitiveText=Wo,Object.defineProperty(e,"__esModule",{value:!0})}));
//# sourceMappingURL=UNSAFE_InputSensitiveText.js.map
