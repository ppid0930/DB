define(['exports', './scale-01d6aff1', './labelUtils-4b490596', './getLocale-22900015'], (function(t,e,i,n){"use strict";class a{constructor({scale:t="linear",baselineScaling:e="zero",dataMax:i,dataMin:n,min:a,max:o,viewportMin:r,viewportMax:s,...l}){this.isLog="log"===t,this.isZeroBaseline=!this.isLog&&"zero"===e,this.setDataRange(n,i),this.setViewportRange(r,s,a,o),this.majorIncrement=this.actualToLinear(l.step),this.minorIncrement=this.actualToLinear(l.minorStep),this.minMajorIncrement=this.actualToLinear(l.minStep),this.calcAxisExtents()}setDataRange(t,e){this.dataMin=this.actualToLinear(t),this.dataMax=this.actualToLinear(e),this.isZeroBaseline&&(this.dataMin=Math.min(0,this.dataMin),this.dataMax=Math.max(0,this.dataMax))}setViewportRange(t,e,i,n){this.min=this.actualToLinear(i),this.max=this.actualToLinear(n),this.viewportMin=null==t?this.min:this.actualToLinear(t),this.viewportMax=null==e?this.max:this.actualToLinear(e)}setDefaultMin(t){null==this.min&&(this.isZeroBaseline&&this.dataMin>=0?this.min=0:this.isZeroBaseline||null==this.max?this.min=(Math.ceil(this.dataMin/t)-1)*t:this.min=this.max-t*(Math.floor((this.max-this.dataMin)/t)+1),this.dataMin>=0&&!this.isLog&&(this.min=Math.max(this.min,0)))}setDefaultMax(t){null==this.max&&(this.isZeroBaseline&&this.dataMax<=0?this.max=0:this.isZeroBaseline||null==this.min?this.max=(Math.floor(this.dataMax/t)+1)*t:this.max=this.min+t*(Math.floor((this.dataMax-this.min)/t)+1),this.dataMax<=0&&(this.max=Math.min(this.max,0)))}calcAxisExtents(){const t=null!=this.max?this.max:this.dataMax,e=null!=this.min?this.min:this.dataMin,i=this.calcAxisStep(e,t);let n=this.minMajorIncrement?Math.max(i,this.minMajorIncrement):i;this.dataMin===this.dataMax&&(0===this.dataMin?this.dataMax+=5*n:(this.dataMin-=2*n,this.dataMax+=2*n)),this.setDefaultMin(n),this.setDefaultMax(n),this.max===this.min&&(this.max=100,this.min=0,n=(this.max-this.min)/10),this.viewportMin===this.min&&this.viewportMax===this.max||null==this.viewportMax||null==this.viewportMin||(n=this.calcAxisStep(this.viewportMin,this.viewportMax)),null==this.viewportMin&&(this.viewportMin=this.min),null==this.viewportMax&&(this.viewportMax=this.max),this.calcMajorMinorSteps(n)}calcMajorMinorSteps(t){null!=this.max&&null!=this.min&&(this.majorIncrement||(this.majorTickCount?this.majorIncrement=(this.viewportMax-this.viewportMin)/this.majorTickCount:this.majorIncrement=this.minMajorIncrement?Math.max(t,this.minMajorIncrement):t),this.majorTickCount||(this.majorTickCount=(this.viewportMax-this.viewportMin)/this.majorIncrement,Math.ceil(this.majorTickCount)-this.majorTickCount<1e-10&&(this.majorTickCount=Math.ceil(this.majorTickCount))),this.minorTickCount||(this.minorIncrement?this.minorTickCount=this.majorIncrement/this.minorIncrement:this.isLog?this.minorTickCount=this.majorIncrement:this.minorTickCount=2),this.minorIncrement||(this.minorIncrement=this.majorIncrement/this.minorTickCount))}calcAxisStep(t,e){if(this.majorIncrement)return this.majorIncrement;const i=e-t;if(0===i)return 0===t?10:Math.pow(10,Math.floor(Math.log10(t))-1);if(this.isLog)return Math.floor(i/8)+1;if(this.majorTickCount){const t=i/this.majorTickCount,e=Math.pow(10,Math.ceil(Math.log10(t)-1));let n=t/e;return n=n>1&&n<=1.5?1.5:n>5?10:Math.ceil(n),n*e}return this.getDefaultAxisStep(i)}getDefaultAxisStep(t){const e=Math.log10(t),i=Math.pow(10,Math.ceil(e)-2),n=Math.round(t/i);let a=1;return a=n>=10&&n<=14?2:n>=15&&n<=19?3:n>=20&&n<=24?4:n>=25&&n<=45?5:n>=46&&n<=80?10:20,a*i}linearToActual(t){return this.isLog?Math.pow(10,t):t}actualToLinear(t){if(null!=t)return this.isLog?Math.log10(t):t}getScale(t){const{viewportMin:i,viewportMax:n}=this.getAxisViewport(),a=[this.linearToActual(i),this.linearToActual(n)];return this.isLog?new e.ScaleLog(a,t):new e.ScaleLinear(a,t)}getFirstTick(){return this.isZeroBaseline?Math.ceil(this.viewportMin/this.majorIncrement)*this.majorIncrement:this.min+Math.ceil((this.viewportMin-this.min)/this.majorIncrement)*this.majorIncrement}getAxisViewport(){return{viewportMin:this.viewportMin,viewportMax:this.viewportMax}}getAxisExtent(){return{min:this.min,max:this.max}}getTicks(){let t=this.getFirstTick();const e=[];for(;t<=this.viewportMax;)e.push(this.linearToActual(t)),t+=this.majorIncrement;return e}getMinorTicks(){const t=[];for(let e=-1;e<=this.majorTickCount;e++){const i=e*this.majorIncrement+this.getFirstTick();if(this.isLog&&1==this.majorIncrement&&1==this.minorIncrement)for(let e=2;e<=9;e++){const n=i+Math.log10(e);if(n>this.max)break;n<this.min||t.push(this.linearToActual(n))}else for(let e=1;e<this.minorTickCount;e++){const n=i+e*this.minorIncrement;if(n>this.max)break;n<this.min||t.push(n)}}return t}getStep(){return this.majorIncrement}}const o=.5;function r(t,e,i){let n,a;if(e)a="top"===t?.position?"top":"bottom",n=i?"right":"left";else{n="bottom";a="end"===t?.position?i?"left":"right":i?"right":"left"}return{xAxisPosition:n,yAxisPosition:a}}function s(t,e){return e?"left"===t?"start":"right"===t?"end":"middle":"left"===t?"end":"right"===t?"start":"middle"}function l(t,e,i){const{x:n,y:a,width:o,height:r}=t,s=n+o;let l,h;return"left"===e||"right"===e?(l=a+r,h=a):(l=i?s:n,h=i?n:s),[l,h]}function h(t,e,i){const n=Math.max(0,Math.min(1,null!=i?i:o));return(e?t.height:t.width)*n}function c(t,e,n){if(!n)return 0;const a=n("MW",e),o=i.AXIS_DEFAULTS.labelGap;return Math.floor((.5*a.width+o)/(2*t))}const u=(t,e,i,n)=>{let a,o;return"left"===t?(a=e.x+n.height/2-(i?n.height/2:0),o=e.y+e.height/2):"right"===t?(a=e.x+e.width-(i?n.height/2:0),o=e.y+e.height/2):"top"===t?(a=e.x+e.width/2,o=e.y+n.height/2):(a=e.x+e.width/2,o=e.y+e.height-n.height/2),{x:a,y:o}};function m(t,e,n,a,o,r,s){if(!t||!s)return{width:0,height:0};const l="top"===o||"bottom"===o,{width:h,height:c}=s(t,e),m=l?h:c+i.AXIS_DEFAULTS.titleGap,d=l?c+i.AXIS_DEFAULTS.titleGap:h;if(!l&&m>n||l&&d>n||0===h||0===c)return{width:0,height:0};const{x:f,y:g}=u(o,a,r,{width:h,height:c}),x="left"===o||"right"===o,M=x?`matrix(0, ${r?1:-1}, ${r?-1:1}, 0, ${f}, ${g})`:void 0,p=i.AXIS_DEFAULTS.titleGap+c;return x?(a.width-=p,a.x+="left"===o?p:0):(a.height-=p,a.y+="top"===o?p:0),{width:h,height:p,x:x?void 0:f,y:x?void 0:g,transform:x?M:void 0,style:{fill:e.color,...e}}}const d=["none","thousand","million","billion","trillion","quadrillion"].map(((t,e)=>({scaleFactor:3*e})));function f(t,e,i,n){const a=function(t,e){const i=Math.max(Math.abs(t),Math.abs(e));return function(t){let e=0;if(t<=d[0].scaleFactor)e=d[0].scaleFactor;else if(t>=d[d.length-1].scaleFactor)e=d[d.length-1].scaleFactor;else{for(let i=d.length-1;i>=0;i--)if(d[i].scaleFactor<=t){e=d[i].scaleFactor;break}}return e}(g(i))}(t,e),o=function(t,e,i,n){let a;if(0===i&&t===e){const t=n-g(e);a=t<=0?Math.max(t+3,0):Math.max(t,4)}else{const t=g(i);a=Math.max(n-t,0)}return a}(t,e,i,a),r=Math.pow(10,a);let s=new Intl.NumberFormat(n,{style:"decimal",notation:"compact",numberingSystem:"latn",useGrouping:!1});const l=s.format(r),h=/(\d+)(.*$)/.exec(l),c={style:"decimal",minimumFractionDigits:o,maximumFractionDigits:o};return s=new Intl.NumberFormat(n,c),t=>{if(!h)return"";const e=h[2],i=Number(h[1])/r*t;let n=i.toString();return n=s.format(i),"string"==typeof e&&0!==t&&(n+=e),n}}function g(t){let e=t>=0?t:-t,i=0;if(e<1e-15)return 0;if(e===1/0)return Number.MAX_VALUE;if(e>=10)for(;e>=10;)i+=1,e/=10;else if(e<1)for(;e<1;)i-=1,e*=10;return i}function x(t,e,n,o,r,c,u,d){const[g,x]=l(e,t,n),M=c||new a({...r}),p=M.getScale([g,x]),w="top"===t||"bottom"===t,v=h(e,w,r?.size),b={fontSize:u,...r?.titleStyle},{width:T,height:L,...y}=m(r?.title,b,v,e,t,n,d),A=i.AXIS_DEFAULTS.labelGap,I=T>0&&T>0,S={fontSize:u,fill:r?.tickLabel?.style?.color,...r?.tickLabel?.style,textAnchor:s(t,n),dominantBaseline:"middle"},k=M.getTicks(),D=f(k[0],k[k.length-1],M.getStep(),o);let j=0!=r?.tickLabel?.isRendered;const F=j?k.map((t=>{if(r?.tickLabel?.format)return r.tickLabel.format(t);if("log"===r?.scale){return f(t,t,t,o)(t)}return D(t)})):[],{maxWidth:E,maxHeight:G,tickLabels:C}=i.getMaxTextDimensions(F,((t,n)=>{const a=p.transform(k[n]);return i.getLabelDimensions(a,t,S,w,e,d)}),w);j=j&&w?G+A<v-L:E+A<v-L;const U=t=>p.transform(k[t]);let V=0;return j&&(i.updateLabelsDims(E,G,C,U,e,t),V=w?G+A:E+A),{title:I?r?.title:void 0,titleProps:I?y:void 0,axisDim:I?V+L:V,tickLabels:C,tickLabelStyle:S,scale:p}}const M=1e3,p=60*M,w=60*p,v=24*w,b=28*v,T=31*v,L=365*v,y=366*v;function A(t,e,a,o,r,s,u,d,f,g){const x="top"===e||"bottom"===e,M=h(a,x,d?.size),p={fontSize:f,...d?.titleStyle},w=d?.timeAxisType||"regular",{width:v,height:b,...T}=m(d?.title,p,M,a,e,u,g),L=v>0&&b>0,[y,A]=l(a,e,u),k={fontSize:f,fill:d?.tickLabel?.style?.color,...d?.tickLabel?.style,textAnchor:"left"===e?"end":"bottom"===e?"middle":"start",dominantBaseline:"middle"},j=e=>function(t,e,i,n,a,o,r,s){let l;if("skipGaps"===s){if(r.length<1)return n;const a=U(e,o,r),s=U(i,o,r);l=(U(t,o,r)-a)/(s-a)}else l=(t-e)/(i-e);return n+l*(a-n)}(e,o,r,y,A,s,t,d?.timeAxisType),F=n.getLocale();let G=d?.step;const C=i.AXIS_DEFAULTS.labelGap;let X=[];if(null!=G)X=E(o,r,G);else if("mixedFrequency"===w)G=S(r-o),X=E(o,r,G);else{for(let e=0;e<t.length;e++){const i=new Date(t[e].id).getTime();i>=o&&i<=r&&X.push(i)}G=s}const _=Array.isArray(d?.tickLabel?.format)?d?.tickLabel?.format[0]:d?.tickLabel?.format,N=Array.isArray(d?.tickLabel?.format)?d?.tickLabel?.format[1]:void 0;if("skipGaps"!=w){const t=I(G,r-o);X=function(t,e){let i;const n=new Set;let a=!1,o=t;const r=[],s=t.length;let l=new Date(t[0]);for(let o=1;o<s;o++){const s=new Date(t[o]),h=z(l,s,e);l=s,r.push(h),h<=0||(n.add(h),i?h!==i&&(a=!0):i=h)}if(a){const e=function(t){let e=t[0];for(let i=1;i<t.length;i++)if(e=P(e,t[i]),1===e)return 1;return e}([...n]);o=[],o.push(t[0]);for(let i=1;i<s;i++){const n=t[i];let a=t[i-1];const s=r[i-1];if(s<=e){o.push(n);continue}const l=s/e,h=l-1,c=Math.round((n-a)/l);for(let t=1;t<=h;t++)a+=c,o.push(a);o.push(n),a=n}}return o}(X,t),X.length>1&&(G=(X[X.length-1]-X[0])/(X.length-1));const e=D(new Date(X[0]||o),void 0,!x,!1,F,t,_,N)[0],i=g?.(e,k);if(i){const t=((x?i.width:i.height)+function(t,e){return e?.79*t:.28*t}(i.height,x))*(X.length-1);t>Math.abs(A-y)&&(G=S(r-o),X=E(o,r,G))}}0===X.length&&(X=[o]);const B=I(G,r-o),Y=0!=d?.tickLabel?.isRendered;let W=Y,R=Y,H=b,Z=[];const q=Math.abs(A-y)/X.length;if(Y){const{labelInfos1:t,labelInfos2:o}=function(t,e,i,a,o){const r=n.getLocale(),s=[],l=[],h=[],c=[];let u,m=!0;for(let n=0;n<t.length;n++){const d=t[n],f=i(d),g=new Date(d),[x,M]=D(g,u,!1,!1,r,e,a,o);null!=x&&(s.push({text:x,coord:f}),l.push(f)),null!=M&&(h.push({label2:M,coord:f}),c.push(f),m=!1),u=g}return{labelInfos1:s,labelInfos2:h,coords1:l,coords2:c,isOneLevel:m}}(X,B,j,_,N),r=c(q,k,g),s=(e,n)=>{const o=t[n].coord;return o&&e?i.getLabelDimensions(o,e,k,x,a,g):{width:0,height:0,x:0,y:0}},l=(t,e)=>{const n=o[e]?.coord;return n&&t?i.getLabelDimensions(n,t,k,x,a,g):{width:0,height:0,x:0,y:0}},{maxWidth:h,maxHeight:u,tickLabels:m}=i.getMaxTextDimensions(t.map((t=>t.text)),s,x,r);H=x?u+C:h+C,W=H<M-b;const{maxWidth:d,maxHeight:f,tickLabels:p}=i.skipLabelsGreedy(o.map((t=>t.label2)),l,x),w=x?H+f+C:H+d+C;if(R=w<M-b,W){const n=e=>t[e].coord;i.updateLabelsDims(h,u,m,n,a,e),Z=Z.concat(m),H+=b}if(R){const t=t=>o[t].coord;i.updateLabelsDims(d,f,p,t,a,e),Z.forEach((t=>{t.labelProps.y-=C+t.labelProps.height})),Z=Z.concat(p),H=w+b}}const O={transform:j,range:()=>[y,A],domain:()=>[o,r],invert:e=>function(t,e,i,n,a,o,r,s){const l=(t-e)/(i-e);if("skipGaps"===s){const t=U(n,o,r);return function(t,e,i){const n=Math.min(Math.max(Math.ceil(t),0),i.length),a=n-1,o=void 0!==i[a]?V(i[a].id):V(i[0].id)-e,r=void 0!==i[n]?V(i[n].id):V(i[i.length-1].id)+e;return o+(t-a)*(r-o)}(t+l*(U(a,o,r)-t),o,r)}return n+l*(a-n)}(e,y,A,o,r,s,t,d?.timeAxisType||"enabled")};return{title:L?d?.title:void 0,titleProps:L?T:void 0,axisDim:H,scale:O,tickLabels:Z,groupWidth:q,tickLabelStyle:k}}function I(t,e){return t>=L||e>=6*L?L:t>=b||e>=6*b?b:t>=v||e>=6*v?v:t>=w||e>=6*w?w:t>=p||e>=6*p?p:M}function S(t){return t>=6*L?L:t>=6*b?b:t>=6*v?v:t>=v?3*w:t>=6*w?w:t>=w?15*p:t>=30*p?5*p:t>=6*p?p:t>=p?15*M:t>=30*M?5*M:M}function k(t,e,i){if(!i)return"";const n=i(t.getTime());return(e?i?.(e.getTime()):void 0)!==n||null==n?n:""}function D(t,e,i,n,a,o,r,s){let l=null,h=null;return r||s?(r&&(l=k(t,e,r)),s&&(h=k(t,e,s)),[l,h]):(o===L?l=j(t,a,!1,!1,!0):o===b?(null!=e&&e.getMonth()==t.getMonth()||(l=j(t,a,!1,!0,!1)),null!=e&&e.getFullYear()==t.getFullYear()||(h=j(t,a,!1,!1,!0))):o===v?i?l=j(t,a,!0,!0,!0):(null!=e&&e.getDate()==t.getDate()||(l=j(t,a,!0,!1,!1)),null==e||e.getFullYear()!=t.getFullYear()?h=j(t,a,!1,!0,!0):e.getMonth()!=t.getMonth()&&(h=j(t,a,!1,!0,!1))):(o===w?null!=e&&e.getHours()==t.getHours()||(l=F(t,a,!1,!1)):o===p?null!=e&&e.getMinutes()==t.getMinutes()||(l=F(t,a,!0,!1)):null!=e&&e.getSeconds()==t.getSeconds()||(l=F(t,a,!0,!0)),n?null!=e&&e.getDate()==t.getDate()||(h=j(t,a,!0,!0,!1)):null==e||e.getFullYear()!=t.getFullYear()?h=j(t,a,!0,!0,!0):e.getMonth()!=t.getMonth()?h=j(t,a,!0,!0,!1):e.getDate()!=t.getDate()&&(h=j(t,a,!0,!1,!1))),[l,h])}function j(t,e,i,n,a){const o={year:a?"numeric":void 0,month:n?"short":void 0,day:i?"numeric":void 0};return t.toLocaleDateString(e,o)}function F(t,e,i,n){const a={hour:"2-digit",minute:i?"2-digit":void 0,second:n?"2-digit":void 0};return t.toLocaleTimeString(e,a)}function E(t,e,i){const n=new Date(t),a=n.getTimezoneOffset();n.setMonth(0,1),n.setHours(0,0,0,0);let o=n.getTime();const r=[];if(i>=L&&i<=y){for(;o<t;)o=G(o);for(;o<=e;)r.push(o),o=G(o)}else if(i>=b&&i<=T){for(;o<t;)o=C(o);for(;o<=e;)r.push(o),o=C(o)}else{const s=60*(a-n.getTimezoneOffset())*1e3,l=i<b?s:0;for(o+=Math.ceil((t-o-l)/i)*i+l;o<=e;)r.push(o),o+=i}return r}function G(t){const e=new Date(t);return e.setFullYear(e.getFullYear()+1),e.getTime()}function C(t){const e=new Date(t);return e.setMonth(e.getMonth()+1),e.getTime()}function U(t,e,i){let n=i.length;for(let e=0;e<i.length;e++)if(t<=new Date(i[e].id).getTime()){n=e;break}const a=n-1,o=void 0!==i[a]?new Date(i[a].id).getTime():new Date(i[0].id).getTime()-e;return a+(t-o)/((void 0!==i[n]?new Date(i[n].id).getTime():new Date(i[i.length-1].id).getTime()+e)-o)}function V(t){return new Date(t).getTime()}function X(t){if(t)return new Date(t).getTime()}function _(t,e={},i,n){let{start:a,end:o}=n;const{viewportMin:r,viewportMax:s,viewportEndGroup:l,viewportStartGroup:h}=e;let c=X(r||h),u=X(s||l);null==a&&(a=c),null==o&&(o=u);const m=function(t,e,i){return i!=e&&t.length>1?(i-e)/(t.length-1):i-e>0?i-e:6*p}(t,a,o),d=i*m,f=a-d,g=o+d;c=c||f,u=u||g;let x=0,M=Math.max(0,t.length-1);return t.forEach(((t,e)=>{const i=new Date(t.id).getTime();i<c&&(x=e),i<u&&(M=e)})),{viewportMin:c,viewportMax:u,viewportStartGroup:h,viewportEndGroup:l,startIndex:x,endIndex:M,min:f,max:g,averageInterval:m}}function z(t,e,i){const n=t.getTimezoneOffset(),a=e.getTimezoneOffset(),o=e.getTime(),r=1e3*(n-a)*60;let s;return r>0&&e.setTime(o+r),s=i===L?e.getFullYear()-t.getFullYear():i===b?12*(e.getFullYear()-t.getFullYear())+(e.getMonth()-t.getMonth()):Math.round((e.getTime()-t.getTime())/i),r>0&&e.setTime(o),s}function P(t,e){return 0===t?e:P(e%t,t)}function N(t,e,i,n,a,o,r,s){let l=s?.dataMin,h=s?.dataMax;if(null!=l&&null!=h)return{dataMin:l,dataMax:h};const c=function(t,e,i,n,a,o,r,s){let l=Number.MAX_VALUE,h=-Number.MAX_VALUE;for(let c=e;c<=i;c++){let e=0,i=0;t.forEach(((t,u)=>{const m=n(u,c),d=null!=m?.id&&r.has(m.id)&&"withRescale"===s;!m||null==m.value||d||m.value<=0&&o||(a?(e+=m.value>0?m.value:0,i+=m.value<0?m.value:0,l=Math.min(o?e:i,l),h=Math.max(e,h)):(l=Math.min(l,m.value),h=Math.max(h,m.value)))}))}return{dataMin:l,dataMax:h}}(t,i,n,e,a,"log"===s?.scale,o,r);return null==l&&(l=c.dataMin),null==h&&(h=c.dataMax),{dataMax:h,dataMin:l}}function B(t,e,i,n){let a=t;for(;a<i.length;){if(!!n(e,a))return a;a+=1}return-1}function Y(t,e,i){let n=t;for(;n>=0;){if(!!i(e,n))return n;n-=1}return-1}function W(t,e,i,n){const a=t=>V(e[t].id);if(e.length<2)return 0;if(a(0)>t)return Math.min(...i.map(((t,i)=>B(0,i,e,n))));if(a(e.length-1)<t)return Math.max(...i.map(((t,i)=>Y(e.length-1,i,n))));const o=function(t,e,i,n){let a=t,o=e;const r=(t,e)=>e-t==1&&n(t)<=i&&i<=n(e);let s=0,l=Math.floor((o-a)/2);for(;!r(a,o);){const t=s?Math.floor(a+l):Math.ceil(o-l);0<=i-n(t)?(a=t,s=s?0:1):o=t,l=Math.floor((o-a)/2)}return i-n(a)<n(o)-i?a:o}(0,e.length-1,t,a),r=Math.max(...i.map(((t,e)=>Y(o,e,n))));if(r===o)return r;const s=Math.min(...i.map(((t,i)=>B(o,i,e,n))));return a(s)-t<t-a(r)?s:r}const R=10,H=8;function Z(t,e,i,n,a){const o="left"===i;let r,s,l;return"bottom"===e||"top"===e?(r=O(t,e,o?a:0,o?0:a,n),s=q(t,i,"bottom"===e?n:0,"top"===e?n:0,a),l={x:r.x,y:s.y,width:r.width,height:s.height}):(r=q(t,e,"bottom"===i?a:0,"bottom"===i?0:a,n),s=O(t,i,"left"===e?n:0,"left"===e?0:n,a),l={x:s.x,y:r.y,width:s.width,height:r.height}),{xSpace:r,ySpace:s,plotAreaSpace:l}}function q(t,e,i,n,a){return{x:"left"===e?t.x:t.x+t.width-a,width:a,y:t.y+n,height:t.height-i-n}}function O(t,e,i,n,a){return{x:t.x+i,width:t.width-i-n,y:"top"===e?t.y:t.y+t.height-a,height:a}}function $(t){return{x:t.x,y:t.y,height:t.height,width:t.width}}t.findNearestDataPoint=function(t,e,i,n,a,o,r,s,l,h,c,u){return(m,d)=>{let f=[],g=Math.round(m),x=i.transform(g);const M="mixedFrequency"===u;"enabled"!==u&&"skipGaps"!==u||(g=W(m,e,t,a),x=i.transform(V(e[g].id))),f=t.map(((t,e)=>({groupIndex:g,seriesIndex:e}))),M&&(f=function(t,e,i,n){return e.map(((e,a)=>{let o=Number.MAX_VALUE,r=0;for(let e=0;e<i.length;e++){const i=n(a,e)?.x;if(!i)continue;const s=V(i),l=Math.abs(t-s);l<o&&(o=l,r=e)}return{seriesIndex:a,groupIndex:r}}))}(m,t,e,a));let p,w=0,v=0,b=Number.MAX_VALUE,T=Number.MAX_VALUE,L=0,y=x;return f.forEach((({seriesIndex:t,groupIndex:e})=>{const u=a(t,e);if(!u||c?.has(u.id)||null==u.value||l&&u.value<=0)return;let f=0,A=0;if(M)f=Math.abs(i.transform(V(u?.x))-i.transform(m)),A=Math.abs(n.transform(u.value)-n.transform(d));else if(o){const t=(u.value<0?v:w)+u.value/2;f=Math.abs(d-t)}else{const{offset:e,dataWidth:a}=r(t),o=e+x+a/2;0===a?f=Math.abs(n.transform(u.value)-n.transform(d)):(f=Math.abs(i.transform(m)-o),f<b&&(y=o))}f<b?(b=f,L=t,g=e,p=s(u.value,n,o,l,h,v,w),M&&(T=A)):f===b&&M&&A<T&&(b=f,L=t,g=e,T=A,p=s(u.value,n,o,l,h,v,w)),o&&(w+=u.value>0?u.value:0,v+=u.value<0?u.value:0)})),{seriesIndex:L,groupIndex:g,y:p,x:M?i.transform(V(a(L,g)?.x)):o?x:y}}},t.getAvailSpace=function(t,e){const i=function(t,e){const i=Math.min(t/400,1),n=Math.min(e/300,1);return{width:i*R,height:n*H}}(t,e);return{width:t-2*i.width,height:e-2*i.height,x:i.width,y:i.height}},t.getAxesPosition=r,t.getGroupCenterCoord=function(t,e,i,n,a){return a?"mixedFrequency"===a?i.transform(new Date(n.x).getTime()):i.transform(new Date(t.id).getTime()):i.transform(e)},t.getLayoutInfo=function(t,n,o,u,d,f,g,M,p,w,v,b,T,L,y){const I=null!=u?.timeAxisType,{xAxisPosition:S,yAxisPosition:k}=r(d,p,w);let D;if(I){const e=function(t,e,i,n){const a={start:Number.MAX_VALUE,end:-Number.MAX_VALUE},o=t.length;return"mixedFrequency"!=n.timeAxisType&&o>0?(a.start=X(t[0].id),a.end=X(t[o-1].id)):e.forEach(((e,n)=>{t.forEach(((t,e)=>{const o=X(i(n,e)?.x);o&&(a.start=Math.min(a.start,o),a.end=Math.max(a.end,o))}))})),a.start===Number.MAX_VALUE&&a.end===-Number.MAX_VALUE&&(a.start=void 0,a.end=void 0),a}(n,t,o,u);D=_(n,u,T,e)}else D=function(t,e={},i){let{viewportMin:n,viewportMax:a,viewportEndGroup:o,viewportStartGroup:r}=e;return null!=n&&(r=t[Math.max(0,Math.ceil(n))].id),null!=r&&null==n&&(n=t.findIndex((t=>t.id===r))),null==n&&(n=-1*i,r=t[0]?.id),null!=a&&(o=t[Math.min(t.length-1,Math.floor(a))].id),null!=o&&null==a&&(a=t.findIndex((t=>t.id===o))),null==a&&(a=t.length-1+i,o=t[Math.floor(a)]?.id),{min:-1*i,max:t.length-i,viewportMin:n,viewportMax:a,viewportStartGroup:r,viewportEndGroup:o,startIndex:Math.max(0,Math.ceil(n)),endIndex:Math.min(Math.floor(a),a)}}(n,u,T);const{dataMax:j,dataMin:F}=N(t,o,D.startIndex,D.endIndex,v,g,M,d),E=new a({...d,dataMax:j,dataMin:F}),{axisDim:G}=x(k,$(f),w,L,d,E,b,y),C="bottom"===S,{xSpace:U}=Z(f,S,k,C?f.height:f.width,G),{axisDim:V,scale:z,groupWidth:P,...B}=I?A(n,S,U,D.viewportMin,D.viewportMax,D.averageInterval,w,u,b,y):function(t,n,a,o,r,u,d,f,g,x,M,p){const w="top"===n||"bottom"===n,v=h(a,w,x?.size),b={fontSize:M,...x?.titleStyle},{width:T,height:L,...y}=m(x?.title,b,v,a,n,o,p),A=i.AXIS_DEFAULTS.labelGap,I=T>0&&T>0,[S,k]=l(a,n,o),D=g?[u,r]:[r,u],j=new e.ScaleLinear(D,[S,k]),F=Math.abs(k-S)/(u-r),E={fontSize:M,fill:x?.tickLabel?.style?.color,...x?.tickLabel?.style,textAnchor:s(n,o),dominantBaseline:"middle"};let G=0!=x?.tickLabel?.isRendered;const C=function(t,e,i){const n=[];for(let a=e;a<=i;a++)n.push(t[a].name||t[a].id);return n}(t,d,f),U=c(F,E,p),{maxWidth:V,maxHeight:X,tickLabels:_}=i.getMaxTextDimensions(C,((t,e)=>{const n=j.transform(e+d);return i.getLabelDimensions(n,t,E,w,a,p)}),w,U);G=G&&w?X+A<v-L:V+A<v-L;const z=t=>j.transform(d+t);G&&i.updateLabelsDims(V,X,_,z,a,n);let P=G?w?X+A:V+A:0;return I&&(P+=L),{title:I?x?.title:void 0,titleProps:I?y:void 0,tickLabels:_,tickLabelStyle:E,axisDim:P,scale:j,groupWidth:F}}(n,S,U,w,D.viewportMin,D.viewportMax,D.startIndex,D.endIndex,p,u,b,y),{ySpace:Y}=Z(f,S,k,V,C?f.width:f.height),W=x(k,Y,w,L,d,E,b,y),{axisDim:R,scale:H,...q}=W,{plotAreaSpace:O}=Z(f,S,k,V,R);return{xViewportExtent:{viewportMin:D.viewportMin,viewportMax:D.viewportMax},xIndexExtent:{startIndex:D.startIndex,endIndex:D.endIndex},yViewportExtent:E.getAxisViewport(),yAxisExtent:E.getAxisExtent(),xAxisExtent:{min:D.min,max:D.max},xProps:B,xScale:z,xAxisPosition:S,groupWidth:P,yProps:q,yScale:H,yMaxDim:R,yAxisPosition:k,yMajorTicks:E.getTicks(),yMinorTicks:E.getMinorTicks(),plotAreaSpace:O}},t.getScrollBarSpace=function(t,e,i){const n={x:0,y:0,height:0,width:0},a=$(t);return"off"===e||("left"===i?(n.x=t.x,n.y=t.y,n.width=12,n.height=t.height,a.x+=n.width+6,a.width-=n.width+6):"right"===i?(n.x=t.x+t.width-12,n.width=12,n.height=t.height,n.y=t.y,a.width-=n.width+6):(n.x=t.x,n.y=t.y+t.height-12,n.height=12,n.width=t.width,a.height-=n.height+6)),{scrollDims:n,availSpace:a}},t.updateScrollBarSpace=function(t,e,i){const n=$(t);return e?(n.width-=i,n.x+=i):n.height-=i,n}}));
//# sourceMappingURL=layoutUtils-fa012ea3.js.map
