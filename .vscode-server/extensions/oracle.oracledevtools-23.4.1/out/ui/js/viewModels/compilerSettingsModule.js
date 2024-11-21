define(["require","exports","knockout","../common/scriptExecutionModels","../common/dataAccessService","../utilities","../common/localizedConstants","../common/messageService","ojs/ojmodule-element-utils","signals","../common/models","../common/models","ojs/ojbutton","ojs/ojcheckboxset","ojs/ojknockout","ojs/ojinputtext","ojs/ojformlayout","ojs/ojlabel","ojs/ojselectcombobox","ojs/ojmessage","ojs/ojmessages","ojs/ojcollapsible","ojs/ojlistview","ojs/ojprogress","ojs/ojprogress-circle"],(function(require,e,t,i,n,s,o,a,l,r,c,g){"use strict";class p{}return p.NONE="NONE",p.ALL="ALL",p.PUBLIC="PUBLIC",p.SQL="SQL",p.PLSQL="PLSQL",p.DISABLE="DISABLE",p.ENABLE="ENABLE",p.ERROR="ERROR",p.AllConfigBlank=" ",p.NoValue="",p.plscopeIdentifiers="plscopeIdentifiers",p.plscopeStatements="plscopeStatements",p.allConfigParams=["plscopeIdentifiers","plscopeStatements","allWarnings","informationalWarnings","performanceWarnings","severeWarnings"],class{constructor(e){this.configType=t.observable(i.CompileConfig.Compile),this.enableFlags=t.observableArray([]),this.optimizeLevel=t.observable(2),this.plscopeIdentifier=t.observable(p.NONE),this.plscopeStatement=t.observable(""),this.allWarnings=t.observable(p.DISABLE),this.severeWarnings=t.observable(""),this.informationalWarnings=t.observable(""),this.performanceWarnings=t.observable(""),this.saveButtonDisable=t.observable(!0),this.resetButtonDisable=t.observable(!0),this.isActiveAllConfig=t.observable(!1),this.isSaving=t.observable(!1),this.enableConfigLabel=t.observable(o.LocalizedConstants.Instance.useCompileSettings),this.configTypes=t.observableArray([{value:i.CompileConfig.Compile,label:o.LocalizedConstants.Instance.compile},{value:i.CompileConfig.CompileDebug,label:o.LocalizedConstants.Instance.compileDebug},{value:i.CompileConfig.AllConfigurations,label:o.LocalizedConstants.Instance.allConfigurations}]),this.compileOptLevels=[{value:2,label:"2"},{value:3,label:"3"}],this.debugOptLevels=[{value:0,label:"0"},{value:1,label:"1"}],this.optLevels=t.observableArray(this.compileOptLevels),this.identifiers=t.observable([{value:p.NONE,label:o.LocalizedConstants.Instance.none},{value:p.ALL,label:o.LocalizedConstants.Instance.all},{value:p.PLSQL,label:o.LocalizedConstants.Instance.plsql},{value:p.PUBLIC,label:o.LocalizedConstants.Instance.public},{value:p.SQL,label:o.LocalizedConstants.Instance.sql},{value:p.NoValue,label:o.LocalizedConstants.Instance.noValue}]),this.statements=t.observable([{value:p.NONE,label:o.LocalizedConstants.Instance.none},{value:p.ALL,label:o.LocalizedConstants.Instance.all},{value:p.NoValue,label:o.LocalizedConstants.Instance.noValue}]),this.warningOptions=t.observable([{value:p.ENABLE,label:o.LocalizedConstants.Instance.enable},{value:p.DISABLE,label:o.LocalizedConstants.Instance.disable},{value:p.ERROR,label:o.LocalizedConstants.Instance.error},{value:p.NoValue,label:o.LocalizedConstants.Instance.noValue}]),this.messageHandlersField=new Map,this.onCompileConfigChanged=e=>{null==this.configType()||this.configType()!==i.CompileConfig.Compile&&this.configType()!==i.CompileConfig.CompileDebug&&this.configType()!==i.CompileConfig.AllConfigurations?(a.MessagesService.getinstance().ClearAll(),a.MessagesService.getinstance().ShowMessage(o.LocalizedConstants.Instance.compilerSettingConfigTypeError,g.Severity.error),this.configType(e.detail.previousValue),n.DataAccessService.instance.logError(o.LocalizedConstants.Instance.compilerSettingConfigTypeError)):this.updateUIConfig(!1)},this.onParameterChanged=(e,t)=>{if(e&&e.detail){if(e.detail.previousValue==e.detail.value)return;let n=e.detail.value;void 0!==n&&(this.configType()==i.CompileConfig.AllConfigurations?this.updateAllConfig(t,n):this.updateSingleConfig(t,n))}this.updateSaveButton(),this.updateResetButton(this.currentActiveSettings.compileConfig,this.currentActiveSettings.compileDebugConfig,this.currentActiveSettings.allConfig)},this.onOptLevelChanged=()=>{this.currentActiveSettings&&(this.configType()==i.CompileConfig.Compile?this.currentActiveSettings.compileConfig.optimizeLevel=this.optimizeLevel():this.currentActiveSettings.compileDebugConfig.optimizeLevel=this.optimizeLevel(),this.updateSaveButton(),this.updateResetButton(this.currentActiveSettings.compileConfig,this.currentActiveSettings.compileDebugConfig,this.currentActiveSettings.allConfig))},this.onEnableFlagsChanged=()=>{this.currentActiveSettings&&(this.configType()==i.CompileConfig.AllConfigurations?this.currentActiveSettings.compileConfig.enableFlags=this.currentActiveSettings.compileDebugConfig.enableFlags=this.currentActiveSettings.allConfig.enableFlags=this.getEnableFlagValue():(this.configType()==i.CompileConfig.Compile?this.currentActiveSettings.compileConfig.enableFlags=this.getEnableFlagValue():this.currentActiveSettings.compileDebugConfig.enableFlags=this.getEnableFlagValue(),this.currentActiveSettings.allConfig.enableFlags=this.currentActiveSettings.compileConfig.enableFlags&&this.currentActiveSettings.compileDebugConfig.enableFlags),this.updateSaveButton(),this.updateResetButton(this.currentActiveSettings.compileConfig,this.currentActiveSettings.compileDebugConfig,this.currentActiveSettings.allConfig))},this.onReset=()=>{if(this.plscopeIdentifier(p.NONE),this.currentActiveSettings.compileConfig.plscopeIdentifiers=this.currentActiveSettings.compileDebugConfig.plscopeIdentifiers=this.currentActiveSettings.allConfig.plscopeIdentifiers=p.NONE,this.plscopeStatement(p.NoValue),this.currentActiveSettings.compileConfig.plscopeStatements=this.currentActiveSettings.compileDebugConfig.plscopeStatements=this.currentActiveSettings.allConfig.plscopeStatements=p.NoValue,this.allWarnings(p.DISABLE),this.currentActiveSettings.compileConfig.allWarnings=this.currentActiveSettings.compileDebugConfig.allWarnings=this.currentActiveSettings.allConfig.allWarnings=p.DISABLE,this.informationalWarnings(p.NoValue),this.currentActiveSettings.compileConfig.informationalWarnings=this.currentActiveSettings.compileDebugConfig.informationalWarnings=this.currentActiveSettings.allConfig.informationalWarnings=p.NoValue,this.performanceWarnings(p.NoValue),this.currentActiveSettings.compileConfig.performanceWarnings=this.currentActiveSettings.compileDebugConfig.performanceWarnings=this.currentActiveSettings.allConfig.performanceWarnings=p.NoValue,this.severeWarnings(p.NoValue),this.currentActiveSettings.compileConfig.severeWarnings=this.currentActiveSettings.compileDebugConfig.severeWarnings=this.currentActiveSettings.allConfig.severeWarnings=p.NoValue,this.setEnableFlagValue(!1),this.currentActiveSettings.compileConfig.enableFlags=this.currentActiveSettings.compileDebugConfig.enableFlags=this.currentActiveSettings.allConfig.enableFlags=!1,this.currentActiveSettings.compileConfig.optimizeLevel=2,this.currentActiveSettings.compileDebugConfig.optimizeLevel=1,this.configType()!=i.CompileConfig.AllConfigurations){let e=this.configType()==i.CompileConfig.Compile?2:1;this.optimizeLevel(e)}this.updateSaveButton(),this.resetButtonDisable(!0)},this.onSaveSettings=()=>{n.DataAccessService.instance.logInfo("Saving compiler settings ..."),this.isSaving(!0),this.saveButtonDisable(!0);const e=new i.SaveCompilerSettingsRequest,t=new i.MessageBase;t.type=i.MessageName.saveCompilerSettingsRequest,e.executionId=n.DataAccessService.instance.currentExecutionId,e.ownerUri=n.DataAccessService.instance.URI,e.windowUri=n.DataAccessService.instance.windowUri,e.compileConfig=this.currentActiveSettings.compileConfig,e.compileDebugConfig=this.currentActiveSettings.compileDebugConfig,e.configType=this.configType(),e.configurationTarget=this.profileConfigurationTarget(),e.workspaceFolder=this.profileWorkspaceFolder(),t.data=e;try{n.DataAccessService.instance.send(t),n.DataAccessService.instance.logInfo("Successfully placed save compiler settings request ")}catch(e){n.DataAccessService.instance.logError(e)}this.updateResetButton(this.currentActiveSettings.compileConfig,this.currentActiveSettings.compileDebugConfig,this.currentActiveSettings.allConfig)},this.preventListAnimation=e=>{let t=e.detail;e.preventDefault(),t.endCallback()},this.onThemeChanged=()=>{n.DataAccessService.instance.logInfo("Theme Changed"),s.setContrast()},this.profileConfigurationTarget=t.observable(i.ConfigurationTarget.Global),this.profileWorkspaceFolder=t.observable(void 0),this.profileEditable=t.observable(!0),this.infoSignalToConfig=new r.Signal,this.infoSignalFromConfig=new r.Signal,this.settingsConfig=l.createConfig({name:"configSettings",params:{infoSignalToConfig:this.infoSignalToConfig,infoSignalFromConfig:this.infoSignalFromConfig,editable:this.profileEditable,profileConfigTarget:this.profileConfigurationTarget,profileWorkspaceFolder:this.profileWorkspaceFolder,fieldIdPrefix:"compiler"}}),this.moduleName=e.moduleName,this.messageHandlers.set(i.MessageName.themeChanged,this.onThemeChanged),this.messageHandlers.set(i.MessageName.odtConfigChanged,this.onConfigChanged),this.messageHandlers.set(i.MessageName.getCompilerSettingsResponse,(e=>{this.handleGetCompilerSettingsResponse(e)})),this.messageHandlers.set(i.MessageName.saveCompilerSettingsResponse,(e=>{this.handleSaveCompilerSettingsResponse(e)})),n.DataAccessService.instance.subscribe((e=>{if(e&&this.messageHandlers.get(e.type)){const t=this.messageHandlers.get(e.type);t&&t(e)}else n.DataAccessService.instance.logError(`Could not find handler for message ${e.type}`)})),n.DataAccessService.instance.logInfo("Fetching Localized resources "),n.DataAccessService.instance.getLocalizedData().done((e=>{n.DataAccessService.instance.logInfo("Fetched localized resources."),o.LocalizedConstants.Instance.Configure(e)})).fail((e=>{n.DataAccessService.instance.logError("Localized resources "+JSON.stringify(e))})),this.initialize(),s.setContrast(),this.initializeConfigSettings(),this.infoSignalFromConfig.add(((e,t)=>{this.handleInfoSignalFromConfig(e,t)}),this)}get compilerSettingsTitle(){return o.LocalizedConstants.Instance.compilerSettingsTitle}get compilerSettingsSubTitle(){return o.LocalizedConstants.Instance.compilerDebuggerSettingsSubTitle}get configurationLabel(){return o.LocalizedConstants.Instance.configurationLabel}get optLevelLabel(){return o.LocalizedConstants.Instance.optLevelLabel}get plscopeIdsLabel(){return o.LocalizedConstants.Instance.plscopeIdentifiers}get plscopeStmtsLabel(){return o.LocalizedConstants.Instance.plscopeStatements}get allLabel(){return o.LocalizedConstants.Instance.all}get informationalLabel(){return o.LocalizedConstants.Instance.informational}get performanceLabel(){return o.LocalizedConstants.Instance.performance}get severeLabel(){return o.LocalizedConstants.Instance.severe}get saveLabel(){return o.LocalizedConstants.Instance.saveBtnLabel}get resetToDefaults(){return o.LocalizedConstants.Instance.resetToDefaults}get messageHandlers(){return this.messageHandlersField}set messageHandlers(e){this.messageHandlersField=e}initialize(){n.DataAccessService.instance.logInfo("Start initializing compilerSettingsModule"),a.MessagesService.getinstance().ClearAll();const e=new i.MessageBase;e.type=i.MessageName.getCompilerSettingsRequest;const t=new i.GetCompilerSettingsRequest;t.executionId=n.DataAccessService.instance.currentExecutionId,t.ownerUri=n.DataAccessService.instance.URI,t.windowUri=n.DataAccessService.instance.windowUri,t.configurationTarget=n.DataAccessService.instance.configurationTarget,t.workspaceFolder={uri:void 0,name:n.DataAccessService.instance.workspaceFolderName,index:n.DataAccessService.instance.workspaceFolderIndex},e.data=t;try{n.DataAccessService.instance.send(e),n.DataAccessService.instance.logInfo("Successfully placed get compiler settings request ")}catch(e){n.DataAccessService.instance.logError(e)}n.DataAccessService.instance.logInfo("End initializing")}updateUIConfig(e){if(this.compilerSettings){let t,n=this.profileConfigurationTarget(),s=this.profileWorkspaceFolder(),a=this.compilerSettings.find((e=>e.configurationTarget===n&&(!e.workspaceFolder&&!s||e.workspaceFolder&&s&&e.workspaceFolder.name===s.name&&e.workspaceFolder.index===s.index)));if(a){switch(e&&(this.currentActiveSettings=new i.CompilerSettings,this.currentActiveSettings.compileConfig=new i.CompileFlags(a.compileConfig),this.currentActiveSettings.compileDebugConfig=new i.CompileFlags(a.compileDebugConfig),this.currentActiveSettings.allConfig=new i.CompileFlags(a.allConfig),this.currentActiveSettings.configType=a.configType,this.currentActiveSettings.configurationTarget=a.configurationTarget,this.currentActiveSettings.workspaceFolder=a.workspaceFolder,this.configType(a.configType)),this.currentActiveSettings&&(a=this.currentActiveSettings),this.configType()){case i.CompileConfig.Compile:t=a.compileConfig,this.isActiveAllConfig(!1),this.enableConfigLabel(o.LocalizedConstants.Instance.useCompileSettings),this.optLevels(this.compileOptLevels);break;case i.CompileConfig.CompileDebug:t=a.compileDebugConfig,this.isActiveAllConfig(!1),this.enableConfigLabel(o.LocalizedConstants.Instance.useCompileDebugSettings),this.optLevels(this.debugOptLevels);break;case i.CompileConfig.AllConfigurations:t=a.allConfig,this.isActiveAllConfig(!0),this.enableConfigLabel(o.LocalizedConstants.Instance.useAllConfigSettings)}this.setEnableFlagValue(t.enableFlags),this.plscopeIdentifier(t.plscopeIdentifiers),this.plscopeStatement(t.plscopeStatements),this.optimizeLevel(t.optimizeLevel),this.allWarnings(t.allWarnings),this.informationalWarnings(t.informationalWarnings),this.performanceWarnings(t.performanceWarnings),this.severeWarnings(t.severeWarnings)}}}setEnableFlagValue(e){e?this.enableFlags(["Yes"]):this.enableFlags([])}getEnableFlagValue(){return 1==this.enableFlags().length}initConfigValues(){this.compilerSettings.forEach((e=>{e.allConfig=new i.CompileFlags,e.allConfig.enableFlags=e.compileConfig.enableFlags&&e.compileDebugConfig.enableFlags;let t=e.compileConfig,n=e.compileDebugConfig;p.allConfigParams.forEach((i=>{void 0===t[i]&&(t[i]=p.NoValue),void 0===n[i]&&(n[i]=p.NoValue),t[i]===n[i]?e.allConfig[i]=t[i]:e.allConfig[i]=p.AllConfigBlank})),this.updateResetButton(t,n,null)}))}updateSingleConfig(e,t){let n,s;this.configType()==i.CompileConfig.Compile?(n=this.currentActiveSettings.compileConfig,s=this.currentActiveSettings.compileDebugConfig):(n=this.currentActiveSettings.compileDebugConfig,s=this.currentActiveSettings.compileConfig),n[e]=t,this.currentActiveSettings.allConfig[e]=t==s[e]?t:p.AllConfigBlank,e==p.plscopeIdentifiers&&t!==p.NoValue&&t!==p.NONE&&this.plscopeStatement()==p.NoValue&&(this.plscopeStatement(p.ALL),n[p.plscopeStatements]=p.ALL,s[p.plscopeStatements]==p.ALL&&(this.currentActiveSettings.allConfig.plscopeStatements=p.ALL))}updateAllConfig(e,t){this.currentActiveSettings.compileConfig[e]=this.currentActiveSettings.compileDebugConfig[e]=this.currentActiveSettings.allConfig[e]=t,e==p.plscopeIdentifiers&&t!==p.NONE&&this.plscopeStatement()==p.NoValue&&(this.plscopeStatement(p.ALL),this.currentActiveSettings.compileDebugConfig.plscopeStatements=this.currentActiveSettings.compileConfig.plscopeStatements=this.currentActiveSettings.allConfig.plscopeStatements=p.ALL)}handleSaveCompilerSettingsResponse(e){n.DataAccessService.instance.logInfo("Received SaveCompilerSettingsResponse");try{const t=e.data;if(t)if(a.MessagesService.getinstance().ClearAll(),a.MessagesService.getinstance().ShowMessage(t.message),t.success){let e=this.profileConfigurationTarget(),t=this.profileWorkspaceFolder(),n=this.compilerSettings.find((i=>i.configurationTarget===e&&(!i.workspaceFolder&&!t||i.workspaceFolder&&t&&i.workspaceFolder.name===t.name&&i.workspaceFolder.index===t.index)));n&&(n.compileConfig=new i.CompileFlags(this.currentActiveSettings.compileConfig),n.compileDebugConfig=new i.CompileFlags(this.currentActiveSettings.compileDebugConfig))}else this.saveButtonDisable(!1)}catch(e){n.DataAccessService.instance.logError(e),this.saveButtonDisable(!1)}finally{this.isSaving(!1)}}handleGetCompilerSettingsResponse(e){n.DataAccessService.instance.logInfo("Received GetCompilerSettingsResponse");try{const t=e.data;this.profileConfigurationTarget(t.configurationTarget),this.profileWorkspaceFolder(t.workspaceFolder),this.compilerSettings=t.compilerSettings,this.initConfigValues(),this.updateUIConfig(!0)}catch(e){n.DataAccessService.instance.logError(e)}}onConfigChanged(e){const t=e.data;n.DataAccessService.instance.updatedConfig(t)}hasConfigChanged(e,t){try{return e.enableFlags!=t.enableFlags||e.plscopeIdentifiers!=t.plscopeIdentifiers||e.plscopeStatements!=t.plscopeStatements||e.optimizeLevel!=t.optimizeLevel||e.allWarnings!=t.allWarnings||e.informationalWarnings!=t.informationalWarnings||e.performanceWarnings!=t.performanceWarnings||e.severeWarnings!=t.severeWarnings}catch(e){n.DataAccessService.instance.logError(e)}return!0}updateSaveButton(){try{let e=this.profileConfigurationTarget(),t=this.profileWorkspaceFolder(),i=this.compilerSettings.find((i=>i.configurationTarget===e&&(!i.workspaceFolder&&!t||i.workspaceFolder&&t&&i.workspaceFolder.name===t.name&&i.workspaceFolder.index===t.index))),n=this.hasConfigChanged(i.compileDebugConfig,this.currentActiveSettings.compileDebugConfig)||this.hasConfigChanged(i.compileConfig,this.currentActiveSettings.compileConfig);this.saveButtonDisable(!n)}catch(e){n.DataAccessService.instance.logInfo("Error in saveButtonDisabled processing"),n.DataAccessService.instance.logError(e)}}updateResetButton(e,t,i){try{let n=!0,s=0==e.enableFlags&&2==e.optimizeLevel&&e.plscopeIdentifiers==p.NONE&&e.plscopeStatements==p.NoValue&&e.allWarnings==p.DISABLE&&e.informationalWarnings==p.NoValue&&e.performanceWarnings==p.NoValue&&e.severeWarnings==p.NoValue,o=0==t.enableFlags&&1==t.optimizeLevel&&t.plscopeIdentifiers==p.NONE&&t.plscopeStatements==p.NoValue&&t.allWarnings==p.DISABLE&&t.informationalWarnings==p.NoValue&&t.performanceWarnings==p.NoValue&&t.severeWarnings==p.NoValue;i&&(n=0==i.enableFlags&&i.plscopeIdentifiers==p.NONE&&i.plscopeStatements==p.NoValue&&i.allWarnings==p.DISABLE&&i.informationalWarnings==p.NoValue&&i.performanceWarnings==p.NoValue&&i.severeWarnings==p.NoValue),this.resetButtonDisable(s&&o&&n)}catch(e){n.DataAccessService.instance.logInfo("Error in resetButtonDisabled processing"),n.DataAccessService.instance.logError(e)}}initializeConfigSettings(){t.computed((()=>{let e=this.profileConfigurationTarget(),t=this.profileWorkspaceFolder();this.currentActiveSettings&&(e!==this.currentActiveSettings.configurationTarget||t&&!this.currentActiveSettings.workspaceFolder||!t&&this.currentActiveSettings.workspaceFolder||t&&this.currentActiveSettings.workspaceFolder&&(t.name!==this.currentActiveSettings.workspaceFolder.name||t.index!==this.currentActiveSettings.workspaceFolder.index))&&this.updateUIConfig(!0),this.updateSaveButton()}),this)}handleInfoSignalFromConfig(e,t){if(e===c.configSignalType.SaveConfirm){let e=t;e.promptToSave=!this.saveButtonDisable(),this.infoSignalToConfig.dispatch(c.configSignalType.SaveConfirm,e)}}}}));