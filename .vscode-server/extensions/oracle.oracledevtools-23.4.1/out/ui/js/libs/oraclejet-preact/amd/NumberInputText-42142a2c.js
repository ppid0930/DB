define(['exports', 'preact/jsx-runtime', 'preact/compat', 'preact/hooks', './useFocusableTextField-3da26e05', './FormContext-f3d7d458', './useFormContext-bf875ce1', './FormFieldContext-0bd82107', './useTextField-ab6a48a5', './Label-68daef9a', './PrefixSuffix-cc47ca7b', './usePrefixSuffix-85d59bba', './clientHints-cfef9b8d', './TextFieldInput-7f1f701c', 'css!./ObfuscatedTextFieldInputStyles.styles.css', './ReadonlyTextFieldInput-8ed621a5', './StyledTextField-7abcabc0', './TextField-43458873', 'preact', './TopLayerHost-1134809b', 'css!./LiveRegionStyles.styles.css', './logger-2fbed0e0', './TabbableModeContext-1e10fda7', 'css!./UserAssistanceStyles.styles.css', 'module', './UNSAFE_UserAssistance/themes/redwood/UserAssistanceVariants.css', './InlineUserAssistance-6eea8507', './CompactUserAssistance-bffb11b8', './Floating-3a873bc7', 'css!./TooltipContentStyles.styles.css', 'module', './hooks/UNSAFE_useTooltip/themes/redwood/TooltipContentVariants.css', 'css!./IconStyle.styles.css', './Popup-6ccb1318', 'css!./LabelStyles.styles.css', 'module', './UNSAFE_Label/themes/redwood/LabelVariants.css', './InputGroupContext-4122dbd2', 'css!./HiddenAccessibleStyles.styles.css', 'module', './UNSAFE_Popup/themes/redwood/PopupVariants.css', './useCurrentValueReducer-7c31bcf6', './ChevronDown-86f3138b', './ChevronUp-4e7a21aa', './Minus-7f0d6e42', './Plus-3153f6cc', './IconButton-0d891953', './useTranslationBundle-a17e0551', './Grid-a7f59ed9', './useSpinning-be4a9498'], (function(e,s,i,t,n,a,o,l,r,d,u,c,p,b,x,f,v,h,m,S,y,F,C,T,P,A,g,U,j,D,I,R,w,L,E,V,B,N,k,_,q,H,M,G,O,W,K,Z,z,J){"use strict";function Q({direction:e,isDisabled:i,children:t,onPointerDown:n,onPointerUp:a,onPointerOut:o,onPointerCancel:l}){const r=Z.useTranslationBundle("@oracle/oraclejet-preact"),d=r.inputNumber_increase(),u=r.inputNumber_decrease(),c="increase"===e?d:u;return s.jsx(C.TabbableModeContext.Provider,{value:{isTabbable:!1},children:s.jsx("div",{"aria-hidden":"true",onPointerDown:n,onPointerUp:a,onPointerOut:o,onPointerCancel:l,children:s.jsx(K.IconButton,{isDisabled:i,tooltip:c,variant:"borderless",children:t})})})}function X({children:e}){return s.jsx(z.Grid,{align:"center",gap:"1x",gridTemplateColumns:"1fr 1fr",children:e})}const Y=i.forwardRef((({"aria-describedby":e,"aria-valuemax":i,"aria-valuemin":a,"aria-valuenow":p,"aria-valuetext":x,assistiveText:m,autoComplete:S="off",autoFocus:y=!1,columnSpan:F,helpSourceLink:C,helpSourceText:T,isDisabled:P,isReadonly:A,isRequired:j=!1,isRequiredShown:D,isStepDownDisabled:I,isStepUpDisabled:R,hasSteppers:w=!1,stepperVariant:L="directional",label:E,labelEdge:V,labelStartWidth:B,messages:N,placeholder:k,prefix:_,suffix:q,textAlign:K,userAssistanceDensity:Z,value:z,variant:Y="default",virtualKeyboard:ee,onInput:se,onCommit:ie,onSpin:te,onSpinComplete:ne,onStep:ae,testId:oe},le)=>{const{currentCommitValue:re,dispatch:de}=H.useCurrentValueReducer({value:z}),ue=t.useCallback((e=>{de({type:"input",payload:e.value}),se?.(e)}),[se,de]),ce=t.useCallback((e=>{de({type:"commit",payload:e.value}),ie?.(e)}),[ie,de]),{isDisabled:pe,isReadonly:be,labelEdge:xe,labelStartWidth:fe,textAlign:ve,userAssistanceDensity:he}=o.useFormContext(),me=P??pe,Se=A??be,ye=V??xe,Fe=B??fe,Ce=K??ve,Te=Z??he,{enabledElementRef:Pe,focusProps:Ae,isFocused:ge,readonlyElementRef:Ue}=n.useFocusableTextField({isDisabled:me,isReadonly:Se,ref:le}),{baseId:je,formFieldContext:De,inputProps:Ie,labelProps:Re,textFieldProps:we,userAssistanceProps:Le}=r.useTextField({ariaDescribedBy:e,helpSourceLink:C,helpSourceText:T,isDisabled:me,isFocused:ge,isReadonly:Se,isRequiredShown:D,labelEdge:ye,messages:N,styleVariant:Y,userAssistanceDensity:Te,value:z}),Ee=me||I,Ve=me||R,Be=t.useCallback((e=>{ge||Pe.current?.focus(),ae?.(e)}),[ae,ge,Pe]),{keyboardHandlerProps:Ne,pointerIncreaseHandlerProps:ke,pointerDecreaseHandlerProps:_e}=J.useSpinning({isStepDownDisabled:Ee,isStepUpDisabled:Ve,onSpin:te,onSpinComplete:ne,onStep:Be}),qe=w?s.jsx(Q,{direction:"decrease",isDisabled:Ee,..._e,children:"directional"===L?s.jsx(M.SvgChevronDown,{}):s.jsx(O.SvgMinus,{})}):void 0,He=w?s.jsx(Q,{direction:"increase",isDisabled:Ve,...ke,children:"directional"===L?s.jsx(G.SvgChevronUp,{}):s.jsx(W.SvgPlus,{})}):void 0,Me=w&&"quantitative"===L?qe:void 0,Ge=w?"directional"===L?s.jsxs(X,{children:[qe,He]}):He:void 0,Oe=void 0!==E&&"inside"===ye,{shouldRenderPrefix:We,shouldRenderSuffix:Ke,prefixProps:Ze,suffixProps:ze,valuePrefixSuffix:Je,ariaLabelledBy:Qe}=c.usePrefixSuffix({baseId:je,hasEndContent:void 0!==Ge,hasInsideLabel:Oe,hasStartContent:void 0!==Me,hasValue:De.hasValue,isDisabled:me,isFocused:ge,labelId:Re.id,prefix:_,suffix:q,value:z}),Xe=We?s.jsx(u.PrefixSuffix,{...Ze}):void 0,Ye=Ke?s.jsx(u.PrefixSuffix,{...ze}):void 0,$e="none"!==ye?s.jsx(d.Label,{...Re,children:E}):void 0,es={label:"none"!==ye?$e:void 0,labelEdge:"none"!==ye?ye:void 0,labelStartWidth:"none"!==ye?Fe:void 0},ss="none"===ye?E:void 0,is="efficient"===Te||"reflow"===Te?me||Se?"efficient"!==Te?void 0:s.jsx(g.InlineUserAssistance,{userAssistanceDensity:Te,...Le}):s.jsx(g.InlineUserAssistance,{assistiveText:m,fieldLabel:E,helpSourceLink:C,helpSourceText:T,messages:N,isRequiredShown:D,userAssistanceDensity:Te,...Le}):void 0,ts=t.useRef(null),ns="compact"===Te?s.jsx(U.CompactUserAssistance,{anchorRef:ts,messages:N,assistiveText:m,...Le}):void 0;if(Se){const e=s.jsx(f.ReadonlyTextFieldInput,{"aria-describedby":Ie["aria-describedby"],"aria-label":ss,"aria-labelledby":Re.id,as:"div",autoFocus:y,elementRef:Ue,textAlign:Ce,value:Je,hasEmptyLabel:""===E&&"none"===ye,hasInsideLabel:Oe});return s.jsx(l.FormFieldContext.Provider,{value:De,children:s.jsx(v.ReadonlyTextField,{role:"presentation",columnSpan:F,compactUserAssistance:ns,inlineUserAssistance:is,onBlur:Ae.onfocusout,onFocus:Ae.onfocusin,ref:ts,mainContent:e,testId:oe,...es})})}const as=void 0===p||p.toString()!==x?x:void 0,os=s.jsxs(s.Fragment,{children:[Xe,s.jsx(b.TextFieldInput,{"aria-labelledby":Qe,"aria-label":ss,"aria-valuemax":w?i:void 0,"aria-valuemin":w?a:void 0,"aria-valuenow":w?p:void 0,"aria-valuetext":w?as:void 0,autoComplete:S,autoFocus:y,currentCommitValue:re,hasEmptyLabel:""===E&&"none"===ye,hasEndContent:void 0!==Ge,hasInsideLabel:Oe,hasPrefix:void 0!==Xe,hasStartContent:void 0!==Me,hasSuffix:void 0!==Ye,inputRef:Pe,isRequired:j,placeholder:k,role:w?"spinbutton":void 0,textAlign:Ce,type:$()?ee:void 0,value:me?Je:z,onCommit:ce,onInput:ue,...Ie,...w?Ne:{}}),Ye]});return s.jsx(l.FormFieldContext.Provider,{value:De,children:s.jsx(h.TextField,{startContent:Me,endContent:Ge,columnSpan:F,compactUserAssistance:ns,inlineUserAssistance:is,mainContent:os,onBlur:Ae.onfocusout,onFocus:Ae.onfocusin,mainFieldRef:ts,hasZeroStartMargin:w&&"quantitative"===L,testId:oe,...we,...es})})}));function $(){const e=p.getClientHints().deviceType;return"phone"===e||"tablet"===e}e.NumberInputText=Y,e.stepperVariants=["directional","quantitative"]}));
//# sourceMappingURL=NumberInputText-42142a2c.js.map