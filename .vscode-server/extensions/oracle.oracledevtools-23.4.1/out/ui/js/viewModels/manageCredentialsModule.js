define(["require","exports","knockout","../common/scriptExecutionModels","../common/dataAccessService","../utilities","../common/localizedConstants","../common/messageService","../common/models","ojs/ojcontext","ojs/ojbutton","ojs/ojknockout","ojs/ojinputtext","ojs/ojformlayout","ojs/ojlabel","ojs/ojselectcombobox","ojs/ojmessage","ojs/ojmessages","ojs/ojprogress","ojs/ojprogress-circle","ojs/ojinputnumber","ojs/ojcheckboxset"],(function(require,e,s,t,a,i,n,c,o,r){"use strict";let l;class d{constructor(){this.createCredentialTitle=n.LocalizedConstants.Instance.dbmsCloudAIManageCredentials,this.credentialName=n.LocalizedConstants.Instance.credentialName,this.username=n.LocalizedConstants.Instance.userName,this.userUnavailable=n.LocalizedConstants.Instance.currentUserUnavailable,this.apiKey=n.LocalizedConstants.Instance.apiKey,this.save=n.LocalizedConstants.Instance.saveBtnLabel,this.copy=n.LocalizedConstants.Instance.connUITextCopyConnectionString,this.yesStr=n.LocalizedConstants.Instance.yes,this.showSQL=n.LocalizedConstants.Instance.showSQLLabel,this.sampleCode="BEGIN\n    DBMS_CLOUD.CREATE_CREDENTIAL('<credential_name>', '<username>', '<API Key>');\nEND;\n/"}}return class{constructor(e){this.msgPos={my:{vertical:"top",horizontal:"end"},at:{vertical:"top",horizontal:"end"},of:"window"},this.messageHandlersField=new Map,this.labelTexts=new d,this.connectionId=-1,this.connectionUniqueName="",this.connectionName="",this.credentialName=s.observable(""),this.apiKey=s.observable(""),this.username=s.observable(""),this.bUserUnavailable=!1,this.isSaving=s.observable(!1).extend({notify:"always"}),this.isSavingStatic=!1,this.saveButtonDisabled=s.observable(!0),this.saveAvailable=!1,this.showSQLOption=s.observableArray(),this.doShowSQL=s.computed((()=>-1!=this.showSQLOption.indexOf(this.labelTexts.yesStr))),this.credNameReplaceStr=n.LocalizedConstants.Instance.credentialNameReplaceStr,this.usernameReplaceStr=n.LocalizedConstants.Instance.usernameReplaceStr,this.apiKeyReplaceStr=n.LocalizedConstants.Instance.apiKeyReplaceStr,this.credNameFormatStr=s.observable(this.credNameReplaceStr),this.userFormatStr=s.observable(this.usernameReplaceStr),this.keyFormatStr=s.observable(this.apiKeyReplaceStr),this.sampleCode=s.computed((()=>`BEGIN\n    DBMS_CLOUD.CREATE_CREDENTIAL('${this.credNameFormatStr()}', '${this.userFormatStr()}', '${this.keyFormatStr()}');\nEND;\n/`)),this.onSave=e=>{a.DataAccessService.instance.logInfo("Sending create credential request");const s=new t.MessageBase;s.type=t.MessageName.saveCredentialRequest;const i=new t.SaveCredentialRequest;i.ownerUri=a.DataAccessService.instance.URI,i.executionId=a.DataAccessService.instance.currentExecutionId,i.windowUri=a.DataAccessService.instance.windowUri,i.connectionUniqueId=this.connectionId,i.connectionUniqueName=this.connectionUniqueName,i.connectionName=this.connectionName,i.credentialName=this.credentialName(),i.apiKey=this.apiKey(),i.username=this.username(),s.data=i,this.isSaving(!0),this.isSavingStatic=!0,this.saveButtonDisabled(!0);try{a.DataAccessService.instance.send(s),a.DataAccessService.instance.logInfo("Successfully placed createCredentialRequest - "+t.SaveCredentialRequest.displayString(i))}catch(e){a.DataAccessService.instance.logError(e),this.isSaving(!1),this.isSavingStatic=!1,this.saveButtonDisabled(!1)}},this.onCredentialNameChanged=e=>{e.currentTarget.value=e.detail?.value,this.isValueEmpty(this.credentialName())?this.credNameFormatStr(this.credNameReplaceStr):this.credNameFormatStr(this.credentialName()),this.saveButtonDisabled(this.doDisableSave())},this.onAPIKeyChanged=e=>{e.currentTarget.value=e.detail?.value,this.isValueEmpty(this.apiKey())?this.keyFormatStr(this.apiKeyReplaceStr):this.keyFormatStr(this.apiKey()),this.saveButtonDisabled(this.doDisableSave())},this.onCopySampleCode=e=>{try{i.copyToClipBoard(this.sampleCode())}catch(e){a.DataAccessService.instance.logError(e)}},l=this,this.moduleName=e.moduleName,this.messageHandlers.set(t.MessageName.saveCredentialResponse,(e=>{this.handleSaveCredentialResponse(e)})),this.messageHandlers.set(t.MessageName.llmConfigGetCredentialsResponse,(e=>{if(e&&i.selectAIResponseIsSameConnection(e,this.connectionId)){const s=e.data;s&&s.sourceTab&&s.sourceTab===this.moduleName&&this.handleGetCredentialsResponse(e)}})),a.DataAccessService.instance.subscribe((e=>{if(e&&this.messageHandlers.get(e.type)){const s=this.messageHandlers.get(e.type);s&&s(e)}else a.DataAccessService.instance.logError(`Could not find handler for message ${e.type}`)})),a.DataAccessService.instance.logInfo("Fetching Localized resources "),a.DataAccessService.instance.getLocalizedData().done((e=>{a.DataAccessService.instance.logInfo("Fetched localized resources."),n.LocalizedConstants.Instance.Configure(e)})).fail((e=>{a.DataAccessService.instance.logError("Localized resources "+JSON.stringify(e))})),i.setContrast(),this.initialize(e.connectedUser,e.connectionId,e.connectionUniqueName,e.connectionName)}get messagesDataProvider(){return c.MessagesService.getinstance().messagesDataproviderField}get messageHandlers(){return this.messageHandlersField}set messageHandlers(e){this.messageHandlersField=e}initialize(e,s,t,i){a.DataAccessService.instance.logInfo("Start initializing manageCredentialsModule");const n=s===this.connectionId;this.username(e),this.connectionId=s,this.connectionUniqueName=t,this.connectionName=i,this.isValueEmpty(this.username())?(this.userFormatStr(this.usernameReplaceStr),this.bUserUnavailable=!0):(this.userFormatStr(this.username()),this.bUserUnavailable=!1),n&&this.isSavingStatic||this.initValues(),a.DataAccessService.instance.logInfo("End initializing manageCredentialsModule")}initValues(){this.credentialName(""),this.apiKey(""),r.getPageContext().getBusyContext().whenReady().then((()=>{this.isSaving(!1)})),this.saveButtonDisabled(!0),this.bUserUnavailable||this.getCredentials()}getCredentials(){const e=new t.MessageBase;e.type=t.MessageName.llmConfigGetCredentialsRequest;const s=new t.LLMConfigGetCredentialsRequest;s.ownerUri=a.DataAccessService.instance.URI,s.executionId=a.DataAccessService.instance.currentExecutionId,s.windowUri=a.DataAccessService.instance.windowUri,s.connectionUniqueId=this.connectionId,s.connectionUniqueName=this.connectionUniqueName,s.connectionName=this.connectionName,s.sourceTab=this.moduleName,e.data=s;try{a.DataAccessService.instance.send(e),a.DataAccessService.instance.logInfo("Successfully placed LLMConfigGetCredentialsRequest - "+t.LLMConfigGetCredentialsRequest.displayString(s))}catch(e){a.DataAccessService.instance.logError(e)}}handleGetCredentialsResponse(e){a.DataAccessService.instance.logInfo("Received LLMConfigGetCredentialsResponse");try{const s=e.data;s&&(a.DataAccessService.instance.logInfo("Handling LLMConfigGetCredentialsResponse - "+t.LLMConfigGetCredentialsResponse.displayString(s)),this.populateCredentialName(s.credentials))}catch(e){a.DataAccessService.instance.logError(e)}}handleSaveCredentialResponse(e){a.DataAccessService.instance.logInfo("Received SaveCredential Response");try{const s=e.data;s&&(a.DataAccessService.instance.logInfo("Handling SaveCredentialResponse - "+t.SaveCredentialResponse.displayString(s)),c.MessagesService.getinstance().ClearAll(),s.success?c.MessagesService.getinstance().ShowMessage(s.message):c.MessagesService.getinstance().ShowMessage(s.message,o.Severity.error),i.selectAIResponseIsSameConnection(e,this.connectionId)&&(this.isSavingStatic=!1,this.isModuleVisible()&&(this.isSaving(!1),s.success&&this.initValues(),this.saveButtonDisabled(this.doDisableSave()))))}catch(e){a.DataAccessService.instance.logError(e)}a.DataAccessService.instance.logInfo("End handling save credential")}populateCredentialName(e){if(this.isValueEmpty(this.credentialName())){let s="",t=1,a=!1;if(!this.isValueEmpty(this.username())){let i=this.username().replace(/\s/g,"").toUpperCase();for(;!a;)s=`${i}_CREDENTIAL_${t.toString()}`,e&&0!==e.length&&-1!==e.indexOf(s)?t++:a=!0}this.credentialName(s)}}isValueEmpty(e){return null==e||null==e||""==e}doDisableSave(){return!!(this.isSaving()||this.isValueEmpty(this.credentialName())||this.isValueEmpty(this.apiKey())||this.isValueEmpty(this.username())||this.bUserUnavailable)}isModuleVisible(){return!!document.getElementById("manageCredentialModule")}}}));