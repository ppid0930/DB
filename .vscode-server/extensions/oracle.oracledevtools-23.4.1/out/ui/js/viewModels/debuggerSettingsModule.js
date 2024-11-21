define(["require","exports","knockout","../common/scriptExecutionModels","../common/dataAccessService","../utilities","../common/localizedConstants","../common/messageService","ojs/ojmodule-element-utils","signals","../common/models","ojs/ojbutton","ojs/ojknockout","ojs/ojinputtext","ojs/ojformlayout","ojs/ojlabel","ojs/ojselectcombobox","ojs/ojmessage","ojs/ojmessages","ojs/ojprogress","ojs/ojprogress-circle","ojs/ojinputnumber"],(function(require,e,s,t,i,n,a,o,r,c,g){"use strict";class d{constructor(){this.debuggerSettingsTitle=a.LocalizedConstants.Instance.debuggerSettingsTitle,this.debuggerSettingsSubTitle=a.LocalizedConstants.Instance.compilerDebuggerSettingsSubTitle,this.hostIPAddress=a.LocalizedConstants.Instance.hostnameIPAddress,this.startPortNumber=a.LocalizedConstants.Instance.startPortNumber,this.endPortNumber=a.LocalizedConstants.Instance.endPortNumber,this.save=a.LocalizedConstants.Instance.saveBtnLabel,this.copy=a.LocalizedConstants.Instance.connUITextCopyConnectionString,this.sampleCodeDescription=a.LocalizedConstants.Instance.grantDebugPrivsSampleDescription,this.sampleCode="-- Connect as SYSDBA\nconnect sys/<password>@<datasource> as sysdba\n\n-- Grant debug privileges to user\nGRANT DEBUG CONNECT SESSION TO <username>;\nGRANT DEBUG ANY PROCEDURE TO <username>;\n\n-- Set up ACL to allow the database to connect back to Visual Studio Code\n-- Hostname/IP address and ports are those used for debugging on local VS Code machine\n-- This needs to be done once for the machine.\nBEGIN\n  DBMS_NETWORK_ACL_ADMIN.APPEND_HOST_ACE(\n  HOST => '<hostname/ip address>',\n  LOWER_PORT => <starting port number>,\n  UPPER_PORT => <ending port number>,\n  ACE => XS$ACE_TYPE(PRIVILEGE_LIST => XS$NAME_LIST('jdwp'),\n    PRINCIPAL_NAME =>'<username>',\n    PRINCIPAL_TYPE => XS_ACL.PTYPE_DB));\nEND;\n/"}}return class{constructor(e){this.labelTexts=new d,this.ipAddresses=s.observableArray(),this.ipAddress=s.observable(),this.startPort=s.observable(),this.endPort=s.observable(),this.isSaving=s.observable(!1),this.messageHandlersField=new Map,this.saveButtonDisabled=s.observable(!0),this.onRawValueChanged=e=>{e.currentTarget.value=e.detail.value},this.onThemeChanged=()=>{i.DataAccessService.instance.logInfo("Theme Changed"),n.setContrast()},this.onSaveSettings=()=>{i.DataAccessService.instance.logInfo("Saving debugger settings ...");try{if(!this.validateSettings())return void i.DataAccessService.instance.logInfo("Validationg of settings failed");this.isSaving(!0);const e=new t.SaveDebuggerSettingsRequest,s=new t.MessageBase;s.type=t.MessageName.saveDebuggerSettingsRequest,e.executionId=i.DataAccessService.instance.currentExecutionId,e.ownerUri=i.DataAccessService.instance.URI,e.windowUri=i.DataAccessService.instance.windowUri;let n=new t.DebugSettings;n.ipAddress=this.ipAddress(),n.startPort=+this.startPort(),n.endPort=+this.endPort(),n.configurationTarget=this.profileConfigurationTarget(),n.workspaceFolder=this.profileWorkspaceFolder(),e.debugSettings=n,s.data=e,i.DataAccessService.instance.send(s),i.DataAccessService.instance.logInfo("Successfully placed save debugger settings request ")}catch(e){i.DataAccessService.instance.logInfo("Error in saving settings"),i.DataAccessService.instance.logError(e)}},this.validatePortNumInput=e=>{/^[0-9]$/i.test(e.key)||e.preventDefault()},this.onCopySampleCode=(e,s,t)=>{try{n.copyToClipBoard(this.labelTexts.sampleCode)}catch(e){i.DataAccessService.instance.logError(e)}},this.profileConfigurationTarget=s.observable(t.ConfigurationTarget.Global),this.profileWorkspaceFolder=s.observable(void 0),this.profileEditable=s.observable(!0),this.infoSignalToConfig=new c.Signal,this.infoSignalFromConfig=new c.Signal,this.settingsConfig=r.createConfig({name:"configSettings",params:{infoSignalToConfig:this.infoSignalToConfig,infoSignalFromConfig:this.infoSignalFromConfig,editable:this.profileEditable,profileConfigTarget:this.profileConfigurationTarget,profileWorkspaceFolder:this.profileWorkspaceFolder,fieldIdPrefix:"debugger"}}),this.moduleName=e.moduleName,this.messageHandlers.set(t.MessageName.themeChanged,this.onThemeChanged),this.messageHandlers.set(t.MessageName.odtConfigChanged,this.onConfigChanged),this.messageHandlers.set(t.MessageName.getDebuggerSettingsResponse,(e=>{this.handleGetDebuggerSettingsResponse(e)})),this.messageHandlers.set(t.MessageName.saveDebuggerSettingsResponse,(e=>{this.handleSaveDebuggerSettingsResponse(e)})),i.DataAccessService.instance.subscribe((e=>{if(e&&this.messageHandlers.get(e.type)){const s=this.messageHandlers.get(e.type);s&&s(e)}else i.DataAccessService.instance.logError(`Could not find handler for message ${e.type}`)})),i.DataAccessService.instance.logInfo("Fetching Localized resources "),i.DataAccessService.instance.getLocalizedData().done((e=>{i.DataAccessService.instance.logInfo("Fetched localized resources."),a.LocalizedConstants.Instance.Configure(e)})).fail((e=>{i.DataAccessService.instance.logError("Localized resources "+JSON.stringify(e))})),this.initialize(),n.setContrast(),this.initializeConfigSettings(),this.infoSignalFromConfig.add(((e,s)=>{this.handleInfoSignalFromConfig(e,s)}),this)}get messageHandlers(){return this.messageHandlersField}set messageHandlers(e){this.messageHandlersField=e}initialize(){i.DataAccessService.instance.logInfo("Start initializing debuggerSettingsModule"),o.MessagesService.getinstance().ClearAll();const e=new t.MessageBase;e.type=t.MessageName.getDebuggerSettingsRequest;const s=new t.GetDebuggerSettingsRequest;s.executionId=i.DataAccessService.instance.currentExecutionId,s.ownerUri=i.DataAccessService.instance.URI,s.windowUri=i.DataAccessService.instance.windowUri,s.configurationTarget=i.DataAccessService.instance.configurationTarget,s.workspaceFolder={uri:void 0,name:i.DataAccessService.instance.workspaceFolderName,index:i.DataAccessService.instance.workspaceFolderIndex},e.data=s;try{i.DataAccessService.instance.send(e),i.DataAccessService.instance.logInfo("Successfully placed get debugger settings request ")}catch(e){i.DataAccessService.instance.logError(e)}i.DataAccessService.instance.logInfo("End initializing debuggerSettingsModule")}onConfigChanged(e){const s=e.data;i.DataAccessService.instance.updatedConfig(s)}handleGetDebuggerSettingsResponse(e){i.DataAccessService.instance.logInfo("Received GetDebuggerSettingsResponse");try{const s=e.data;if(this.ipAddresses.removeAll(),s.ipAddresses&&s.ipAddresses.length>0)for(let e=0;e<s.ipAddresses.length;e++)this.ipAddresses.push({value:s.ipAddresses[e],label:s.ipAddresses[e]});else o.MessagesService.getinstance().ClearAll(),o.MessagesService.getinstance().ShowMessage(a.LocalizedConstants.Instance.noIPAddressesAvailable);this.debugSettings=s.debugSettings,this.profileConfigurationTarget(s.configurationTarget),this.profileWorkspaceFolder(s.workspaceFolder),this.updateUiFromSettings()}catch(e){i.DataAccessService.instance.logInfo("Error on processing GetDebuggerSettingsResponse"),i.DataAccessService.instance.logError(e)}i.DataAccessService.instance.logInfo("Processed GetDebuggerSettingsResponse")}updateUiFromSettings(){try{if(this.debugSettings){let e=this.profileConfigurationTarget(),s=this.profileWorkspaceFolder(),t=this.debugSettings.find((t=>t.configurationTarget===e&&(!t.workspaceFolder&&!s||t.workspaceFolder&&s&&t.workspaceFolder.name===s.name&&t.workspaceFolder.index===s.index)));t&&(this.currentActiveSettings=t,this.ipAddress(t.ipAddress),this.startPort(t.startPort),this.endPort(t.endPort))}}catch(e){i.DataAccessService.instance.logInfo("Error in debuggerSettingsModule.updateUiFromSettings"),i.DataAccessService.instance.logError(e)}}updateSaveButton(){let e=!1;try{let s=this.isSaving(),t=this.ipAddress(),i=+this.startPort(),n=+this.endPort(),a=this.profileConfigurationTarget(),o=this.profileWorkspaceFolder(),r=this.debugSettings.find((e=>e.configurationTarget===a&&(!e.workspaceFolder&&!o||e.workspaceFolder&&o&&e.workspaceFolder.name===o.name&&e.workspaceFolder.index===o.index)));if(!s&&r){let s=r.workspaceFolder;r&&t&&i&&n&&(r.ipAddress!==t||r.startPort!==i||r.endPort!==n||this.profileConfigurationTarget()!==r.configurationTarget||o&&!s||!o&&s||o&&s&&(o.name!==s.name||o.index!==s.index))&&(e=!0)}}catch(e){i.DataAccessService.instance.logInfo("Error in saveButtonDisabled processing"),i.DataAccessService.instance.logError(e)}this.saveButtonDisabled(!e)}validateSettings(){i.DataAccessService.instance.logInfo("validateSettings- Start");let e=!1;try{let s=this.ipAddress(),t=+this.startPort(),i=+this.endPort();s&&t&&i&&(t>i?(o.MessagesService.getinstance().ClearAll(),o.MessagesService.getinstance().ShowMessage(a.LocalizedConstants.Instance.portValidationError)):t<1||i<1||t>65535||i>65535?(o.MessagesService.getinstance().ClearAll(),o.MessagesService.getinstance().ShowMessage(a.LocalizedConstants.Instance.portNumberRangeError)):e=!0)}catch(e){i.DataAccessService.instance.logInfo("Error in validating settings"),i.DataAccessService.instance.logError(e)}return i.DataAccessService.instance.logInfo("validateSettings- End"),e}handleSaveDebuggerSettingsResponse(e){i.DataAccessService.instance.logInfo("Received SaveDebuggerSettingsResponse");try{const s=e.data;if(o.MessagesService.getinstance().ClearAll(),o.MessagesService.getinstance().ShowMessage(s.message),s.saved){let e=this.debugSettings.findIndex((e=>e.configurationTarget===s.debugSettings.configurationTarget&&(!e.workspaceFolder&&!s.debugSettings.workspaceFolder||e.workspaceFolder&&s.debugSettings.workspaceFolder&&e.workspaceFolder.name===s.debugSettings.workspaceFolder.name&&e.workspaceFolder.index===s.debugSettings.workspaceFolder.index)));e>-1&&(this.debugSettings[e]=s.debugSettings,this.currentActiveSettings=s.debugSettings)}}catch(e){i.DataAccessService.instance.logInfo("Error in processing SaveDebuggerSettingsResponse"),i.DataAccessService.instance.logError(e)}finally{this.isSaving(!1)}}initializeConfigSettings(){s.computed((()=>{this.isSaving(),this.ipAddress(),this.startPort(),this.endPort();let e=this.profileConfigurationTarget(),s=this.profileWorkspaceFolder();this.currentActiveSettings&&(e!==this.currentActiveSettings.configurationTarget||s&&!this.currentActiveSettings.workspaceFolder||!s&&this.currentActiveSettings.workspaceFolder||s&&this.currentActiveSettings.workspaceFolder&&(s.name!==this.currentActiveSettings.workspaceFolder.name||s.index!==this.currentActiveSettings.workspaceFolder.index))&&this.updateUiFromSettings(),this.updateSaveButton()}),this)}handleInfoSignalFromConfig(e,s){if(e===g.configSignalType.SaveConfirm){let e=s;e.promptToSave=!this.saveButtonDisabled(),this.infoSignalToConfig.dispatch(g.configSignalType.SaveConfirm,e)}}}}));