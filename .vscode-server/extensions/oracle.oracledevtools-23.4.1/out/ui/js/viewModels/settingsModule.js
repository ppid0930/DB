define(["require","exports","knockout","ojs/ojarraydataprovider","../common/dataAccessService","../common/localizedConstants","../common/scriptExecutionModels","../utilities","ojs/ojmodule-element-utils","../common/messageService","ojs/ojknockout","ojs/ojnavigationlist","ojs/ojmodule-element","ojs/ojmessage","ojs/ojmessages"],(function(require,e,s,t,i,a,n,o,c,r){"use strict";let d;class l{constructor(){this.compilerSettings=a.LocalizedConstants.Instance.compilerSettings,this.debuggerSettings=a.LocalizedConstants.Instance.debuggerSettings}}return class{constructor(){this.uiLocalizedStrings=new l,this.msgPos={my:{vertical:"top",horizontal:"end"},at:{vertical:"top",horizontal:"end"},of:"window"},this.compilerTab="compilerSettingsModule",this.debuggerTab="debuggerSettingsModule",this.handlersField=new Map,this.onThemeChanged=e=>{i.DataAccessService.instance.logInfo("Theme Changed"),o.setContrast()},this.viewDisconnectedListener=e=>{if(e.detail&&e.detail.view&&e.detail.viewModel&&e.detail.viewModel.moduleName){const s=e.detail.viewModel.moduleName;this.settingsCache[s]={view:e.detail.view,viewModel:e.detail.viewModel,cleanupMode:"none"}}},d=this,d.handlers=new Map,d.handlers.set(n.MessageName.themeChanged,d.onThemeChanged),d.handlers.set(n.MessageName.odtConfigChanged,d.onConfigChanged),i.DataAccessService.instance.subscribe((e=>{if(e&&this.handlers.get(e.type)){const s=this.handlers.get(e.type);s&&s(e)}else i.DataAccessService.instance.logError(`Could not find handler for message ${e.type}`)})),i.DataAccessService.instance.logInfo("Fetching Localized resources "),i.DataAccessService.instance.getLocalizedData().done((e=>{i.DataAccessService.instance.logInfo("Fetched localized resources."),a.LocalizedConstants.Instance.Configure(e)})).fail((e=>{i.DataAccessService.instance.logError("Localized resources "+JSON.stringify(e))}));const e=[{name:this.uiLocalizedStrings.debuggerSettings,id:this.debuggerTab},{name:this.uiLocalizedStrings.compilerSettings,id:this.compilerTab}];this.tabDataProvider=new t(e,{keyAttributes:"id"}),this.settingsCache=new Map,this.moduleConfig=s.pureComputed((()=>{const e=this.selectedTab();return this.settingsCache[e]||(this.settingsCache[e]=c.createConfig({name:e,params:{moduleName:e}}).then((e=>({view:e.view,viewModel:e.viewModel,cleanupMode:"none"})))),this.settingsCache[e]})),this.selectedTab=s.observable(this.debuggerTab)}get messagesDataprovider(){return r.MessagesService.getinstance().messagesDataproviderField}get handlers(){return this.handlersField}set handlers(e){this.handlersField=e}onConfigChanged(e){const s=e.data;i.DataAccessService.instance.updatedConfig(s)}}}));