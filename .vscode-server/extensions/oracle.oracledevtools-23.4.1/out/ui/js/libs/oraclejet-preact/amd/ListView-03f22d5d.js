define(['exports', 'preact/jsx-runtime', './List-96f5c957'], (function(t,e,a){"use strict";t.ListView=function(t){const i=t.data?t.data.map((e=>({data:e,metadata:{key:t.getRowKey(e)}}))):null,n=t.onLoadMore?t.onLoadMore:()=>{},o=i?{offset:0,data:i,sizePrecision:t.hasMore?"atLeast":"exact",totalSize:i.length}:null;return e.jsx(a.List,{isVirtualized:!1,...t,onLoadRange:n,data:o,children:t.children})}}));
//# sourceMappingURL=ListView-03f22d5d.js.map