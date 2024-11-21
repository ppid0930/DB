/**
 * @license
 * Copyright (c) 2014, 2024, Oracle and/or its affiliates.
 * Licensed under The Universal Permissive License (UPL), Version 1.0
 * as shown at https://oss.oracle.com/licenses/upl/
 * @ignore
 */
define(["exports","ojs/ojexpparser"],function(n,e){"use strict";
/**
   * @license
   * Copyright (c) 2019 2024, Oracle and/or its affiliates.
   * Licensed under The Universal Permissive License (UPL), Version 1.0
   * as shown at https://oss.oracle.com/licenses/upl/
   *
   * @license
   * Based on the Expression Evaluator 2.0.0
   * https://github.com/donmccurdy/expression-eval
   * under MIT License
   * @ignore
   */n.CspExpressionEvaluatorInternal=function(n){var r=new e.ExpParser,t=Object.assign({},n);t.globalScope&&t.globalScope.Object||(t.globalScope=Object.assign({Object:Object},t.globalScope)),this.createEvaluator=function(n){var e;try{e=r.parse(n)}catch(e){l(e,n)}var u=t.globalScope;return{evaluate:function(r){var t,o=r;u&&(o=r.concat([u]));try{t=a(e,o)}catch(e){l(e,n)}return t}}},this.evaluate=function(n,e){return a(n,[e])};var u={"||":function(n,e){return n||e()},"??":function(n,e){return n??e()},"&&":function(n,e){return n&&e()},"|":function(n,e){return n|e},"^":function(n,e){return n^e},"&":function(n,e){return n&e},"==":function(n,e){return n==e},"!=":function(n,e){return n!=e},"===":function(n,e){return n===e},"!==":function(n,e){return n!==e},"<":function(n,e){return n<e},">":function(n,e){return n>e},"<=":function(n,e){return n<=e},">=":function(n,e){return n>=e},"<<":function(n,e){return n<<e},">>":function(n,e){return n>>e},">>>":function(n,e){return n>>>e},"+":function(n,e){return n+e},"-":function(n,e){return n-e},"*":function(n,e){return n*e},"/":function(n,e){return n/e},"%":function(n,e){return n%e},"**":function(n,e){return n**e},instanceof:function(n,e){return n instanceof e}},o={"-":function(n){return-n},"+":function(n){return n},"~":function(n){return~n},"!":function(n){return!n},"...":function(n){return new c(n)},typeof:function(n){return typeof n}};function c(n){this.items=function(){return n}}function a(n,r){switch(n.type){case e.IDENTIFIER:return function(n,e){var r=s(n,e);if(r)return r[e];throw new Error("Variable "+e+" is undefined")}(r,n.name);case e.MEMBER_EXP:return f(n,r)[1];case e.LITERAL:return n.value;case e.CALL_EXP:var t,c,E;switch(n.callee.type){case e.IDENTIFIER:E=function(n,e){var r=s(n,e);if(r)return[r,r[e]];throw new Error("Variable "+e+" is undefined")}(r,n.callee.name);break;case e.MEMBER_EXP:E=f(n.callee,r);break;default:c=a(n.callee,r)}return!c&&Array.isArray(E)&&(t=E[0],c=E[1]),"function"!=typeof c&&p("Expression is not a function"),c.apply(t,i(n.arguments,r));case e.UNARY_EXP:var y;try{y=a(n.argument,r)}catch(r){if(n.argument.type!==e.IDENTIFIER)throw r}return o[n.operator](y);case e.BINARY_EXP:return"="===n.operator?function(n,r,t){switch(n.type){case e.IDENTIFIER:var u=n.name,o=s(r,u);o||p("Cannot assign value to undefined variable "+u),o[u]=t;break;case e.MEMBER_EXP:var c=n.computed?a(n.property,r):n.property.name;f(n,r)[0][c]=t;break;default:p("Expression of type: "+n.type+" not supported for assignment")}return t}(n.left,r,a(n.right,r)):u[n.operator](a(n.left,r),a(n.right,r));case e.LOGICAL_EXP:return u[n.operator](a(n.left,r),function(){return a(n.right,r)});case e.CONDITIONAL_EXP:return a(n.test,r)?a(n.consequent,r):a(n.alternate,r);case e.ARRAY_EXP:return i(n.elements,r);case e.OBJECT_EXP:return function(n,r){return n.properties.reduce(function(n,t){return n[e.getKeyValue(t.key)]=a(t.value,r),n},{})}(n,r);case e.FUNCTION_EXP:return function(n,e){return function(){var r=arguments,t=n.arguments.reduce(function(n,e,t){return n[e.name]=r[t],n},{});t.this=this;try{var u=a(n.body,[t].concat(e));if(n.return)return u}catch(e){l(e,n.expr)}}}(n,r);case e.NEW_EXP:return function(n,e){var r=a(n.callee,e);r instanceof Function||p("Node of type "+n.callee.type+" is not evaluated into a constructor");return new(Function.prototype.bind.apply(r,[null].concat(i(n.arguments,e))))}(n,r);default:throw new Error("Unsupported expression type: "+n.type)}}function i(n,e){return n.reduce((n,r)=>{const t=a(r,e);return t instanceof c?n.push(...t.items()):n.push(t),n},[])}function f(n,e){var r=a(n.object,e);return!r&&n.optional?[]:n.computed?[r,r[a(n.property,e)]]:[r,r[n.property.name]]}function s(n,e){for(var r=0;r<n.length;r++){var t=n[r];if(t instanceof Object&&e in t)return t}return null}function p(n){throw new Error(n)}function l(n,e){throw new Error(n.message+' in expression "'+e+'"')}},Object.defineProperty(n,"__esModule",{value:!0})});
//# sourceMappingURL=ojcspexpressionevaluator-internal.js.map