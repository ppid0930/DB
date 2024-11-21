define(['exports', 'preact/jsx-runtime', './useAccessibleContext-43a3cb41', './FormFieldContext-0bd82107', './useFormFieldContext-db150c3c', './TabbableModeContext-1e10fda7', './useTabbableMode-dd4cb96b', './useTextFieldInputHandlers-b447ab64', './classNames-902bc74c', './textAlign-27feda7f', './mergeInterpolations-2c5b5a03', './mergeProps-31f70810', './TextFieldUtils-5b4c6240', './useComponentTheme-ee621a15', './useTranslationBundle-a17e0551', './UNSAFE_TextField/themes/redwood/TextFieldInputTheme'], (function(e,a,t,o,n,i,s,l,r,d,u,c,b,p,x,m){"use strict";const f=[...Object.values(d.textInterpolations)],h=u.mergeInterpolations(f);e.TextFieldInput=({as:e="input","aria-autocomplete":o,"aria-controls":i,"aria-describedby":d,"aria-expanded":u,"aria-invalid":f,"aria-label":v,"aria-labelledby":C,"aria-valuemax":F,"aria-valuemin":T,"aria-valuenow":y,"aria-valuetext":I,autoComplete:w,autoFocus:P,currentCommitValue:S,hasEmptyLabel:g,hasEndContent:A=!1,hasInsideLabel:L=!1,hasPrefix:B=!1,hasStartContent:D=!1,hasSuffix:E=!1,id:j,inputRef:U,placeholder:V,isRequired:K,role:M,rows:N,spellcheck:R,type:_,value:k="",variant:q="default",onInput:H,onCommit:O,onKeyDown:z,onKeyUp:G,onBlur:J,onFocus:Q,...W})=>{const{isDisabled:X,isFocused:Y,isLoading:Z,isReadonly:$}=n.useFormFieldContext(),{class:ee}=h(W),ae=""!==k,te="textarea"===e,oe="input"===e,ne="password"===_,ie=!X&&B,se=!X&&E,le=b.isInputPlaceholderShown(L,ae,Y)?V:void 0,{classes:re}=p.useComponentTheme(m.TextFieldInputRedwoodTheme,{type:ne?"isPassword":"notPassword",styleVariant:q,textarea:te?"isTextArea":"notTextArea",input:oe?"isInput":"notInput",div:"notDiv",prefix:ie?"hasPrefix":"noPrefix",suffix:se?"hasSuffix":"noSuffix",startContent:D?"hasStartContent":"noStartContent",endContent:A?"hasEndContent":"noEndContent",insideLabel:L?"hasInsideLabel":"noInsideLabel",value:ae?"hasValue":"noValue",focused:Y?"isFocused":"notFocused",disabled:X?"isDisabled":"notDisabled"}),de=r.classNames([re,ee]),ue=e||"input",ce=l.useTextFieldInputHandlers({currentCommitValue:S,value:k,onInput:H,onCommit:O,onKeyDown:z}),be=c.mergeProps(ce,{onBlur:J,onFocus:Q}),{isTabbable:pe,tabbableModeProps:xe}=s.useTabbableMode(),{UNSAFE_ariaLabelledBy:me}=t.useAccessibleContext(),fe=g?function(...e){return e.filter(Boolean).join(" ")||void 0}(C,me):C,he=x.useTranslationBundle("@oracle/oraclejet-preact").formControl_loading();return a.jsx(ue,{"aria-autocomplete":o,"aria-controls":i,"aria-describedby":d,"aria-expanded":u,"aria-invalid":f,"aria-label":Z?he:v||void 0,"aria-labelledby":fe,"aria-required":!!K||void 0,"aria-valuemax":F,"aria-valuemin":T,"aria-valuenow":y,"aria-valuetext":I,autocomplete:w,autofocus:P,class:de,disabled:X,id:j,onKeyUp:G,placeholder:le,readonly:$,ref:U,role:M,rows:N,spellcheck:R,type:_,value:k,...be,...!pe&&xe})}}));
//# sourceMappingURL=TextFieldInput-7f1f701c.js.map