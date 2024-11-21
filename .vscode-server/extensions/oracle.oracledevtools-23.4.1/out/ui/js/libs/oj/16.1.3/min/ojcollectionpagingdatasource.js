/**
 * @license
 * Copyright (c) 2014, 2024, Oracle and/or its affiliates.
 * Licensed under The Universal Permissive License (UPL), Version 1.0
 * as shown at https://oss.oracle.com/licenses/upl/
 * @ignore
 */
define(["ojs/ojcore","jquery","knockout","ojs/ojknockout-model","ojs/ojdatasource-common","ojs/ojmodel"],function(t,e,n,o){"use strict";t.CollectionPagingDataSource=function(t){this.collection=t,this.current=0,this.Init(),this.dataWindow=[],this._noInit=!0;try{this._setPageSize(10)}finally{this._noInit=!1}},t.Object.createSubclass(t.CollectionPagingDataSource,t.DataSource,"oj.CollectionPagingDataSource"),t.CollectionPagingDataSource.prototype.Init=function(){t.CollectionPagingDataSource.superclass.Init.call(this)},t.CollectionPagingDataSource.prototype._getSize=function(){return this._hasMore()?this.currentPageSize:this.totalSize()-this.current},t.CollectionPagingDataSource.prototype._refreshDataWindow=function(){this.dataWindow=new Array(this._getSize());var t=this;return this.collection.IterativeAt(this.current,this.current+this.dataWindow.length).then(function(e){for(var n=0;n<e.length;n++)t.dataWindow[n]=e[n];t._refreshObservableDataWindow(),t._endIndex=t._startIndex+(t.dataWindow.length-1)})},t.CollectionPagingDataSource.prototype._refreshObservableDataWindow=function(){if(void 0!==this.observableDataWindow){this.observableDataWindow.removeAll();for(var t=0;t<this.dataWindow.length;t++)this.observableDataWindow.push(o.map(this.dataWindow[t]))}},t.CollectionPagingDataSource.prototype.getWindow=function(){return this.dataWindow},t.CollectionPagingDataSource.prototype.getWindowObservable=function(){return void 0===this.observableDataWindow&&(this.observableDataWindow=n.observableArray(),this._refreshObservableDataWindow()),this.observableDataWindow},t.CollectionPagingDataSource.prototype.getPage=function(){return this._page},t.CollectionPagingDataSource.prototype.setPage=function(e,n){n=n||{},e=parseInt(e,10);try{t.CollectionPagingDataSource.superclass.handleEvent.call(this,t.PagingModel.EventType.BEFOREPAGE,{page:e,previousPage:this._page})}catch(t){return Promise.reject(t)}this.pageSize=null!=n.pageSize?n.pageSize:this.pageSize,n.startIndex=e*this.pageSize;var o=this._page;this._page=e,this._startIndex=n.startIndex;var a=this;return new Promise(function(e,i){a._fetchInternal(n).then(function(){t.CollectionPagingDataSource.superclass.handleEvent.call(a,t.PagingModel.EventType.PAGE,{page:a._page,previousPage:o}),e(null)},function(t){a._page=o,a._startIndex=a._page*a.pageSize,i(t)})})},t.CollectionPagingDataSource.prototype.getStartItemIndex=function(){return this._startIndex},t.CollectionPagingDataSource.prototype.getEndItemIndex=function(){return this._endIndex},t.CollectionPagingDataSource.prototype.getPageCount=function(){var t=this.totalSize();return-1===t?-1:Math.ceil(t/this.pageSize)},t.CollectionPagingDataSource.prototype.fetch=function(t){var e=t||{};if(void 0!==e.pageSize&&void 0!==e.startIndex){if(!this._hasMore())return this._processSuccess(null),Promise.resolve();this.currentPageSize=e.startIndex+e.pageSize;var n=this;return this._refreshDataWindow().then(function(){n._processSuccess(null)})}return this._fetchInternal(t)},t.CollectionPagingDataSource.prototype._fetchInternal=function(t){var e=t||{};void 0!==e.startIndex&&(this.current=e.startIndex),void 0!==e.pageSize&&(this.pageSize=e.pageSize,this.currentPageSize=e.pageSize);var n=this;return new Promise(function(t){try{n.collection.fetch({success:function(){n._refreshDataWindow().then(function(){n._processSuccess(e),t({data:n.getWindow(),startIndex:n.current})})}})}catch(o){n._refreshDataWindow().then(function(){n._processSuccess(e),t({data:n.getWindow(),startIndex:n.current})})}})},t.CollectionPagingDataSource.prototype._processSuccess=function(t){var e=t||{};e.silent||this.handleEvent("sync",{data:this.getWindow(),startIndex:this.current}),e.success&&e.success()},t.CollectionPagingDataSource.prototype.handleEvent=function(e,n){return t.CollectionPagingDataSource.superclass.handleEvent.call(this,e,n)},t.CollectionPagingDataSource.prototype._hasMore=function(){return this.current+this.currentPageSize<this.totalSize()},t.CollectionPagingDataSource.prototype._setPageSize=function(t){this.pageSize=t,this.currentPageSize=t},t.CollectionPagingDataSource.prototype.setFetchCallback=function(t){this.fetchCallback=t},t.CollectionPagingDataSource.prototype.size=function(){var t=this.getWindow();return t?t.length:0},t.CollectionPagingDataSource.prototype.totalSize=function(){return this.collection.length},t.CollectionPagingDataSource.prototype.totalSizeConfidence=function(){return"actual"},t.CollectionPagingDataSource.prototype.getCapability=function(t){return null}});
//# sourceMappingURL=ojcollectionpagingdatasource.js.map