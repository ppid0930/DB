define(["require","exports","./dataAccessService","./localizedConstants","./scriptExecutionModels"],(function(require,e,t,s,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.ApplicationData=e.ODTUtils=void 0;class n{static acknowledgeMessage(e){try{if(e&&e.data&&(e.type===a.OracleEventNames.scriptExecutionMessage||e.type===a.OracleEventNames.scriptExecutionBatchedMessage||e.type===a.OracleEventNames.scriptExecutionStarted||e.type===a.OracleEventNames.scriptExecutionFinished||e.type===a.OracleEventNames.scriptExecutionCancelled)){const s=new a.MessageBase;s.type=a.MessageName.acknowledgeMessageRequest;const n=new a.ScriptExecutionAcknowledgeMessageRequestParams;if(n.messageType=e.type,e.type==a.OracleEventNames.scriptExecutionMessage){const t=e.data;n.executionId=t.executionId,n.messageId=t.messageId,n.ownerUri=t.ownerUri,n.windowUri=t.windowUri,n.queryId=t.queryId,s.data=n}else if(e.type==a.OracleEventNames.scriptExecutionBatchedMessage){const t=e.data;n.executionId=t.executionId,n.messageId=t.messageId,n.ownerUri=t.ownerUri,n.windowUri=t.windowUri,s.data=n}else if(e.type===a.OracleEventNames.scriptExecutionStarted){const t=e.data;n.executionId=t.executionId,n.ownerUri=t.ownerUri,n.windowUri=t.windowUri,s.data=n}else if(e.type===a.OracleEventNames.scriptExecutionFinished){const t=e.data;n.executionId=t.executionId,n.ownerUri=t.ownerUri,n.windowUri=t.windowUri,s.data=n}else if(e.type===a.OracleEventNames.scriptExecutionCancelled){const t=e.data;n.executionId=t.executionId,n.ownerUri=t.ownerUri,n.windowUri=t.windowUri,s.data=n}t.DataAccessService.instance.logInfo(`Message Type=${e.type} MessageId=${n.messageId}`),t.DataAccessService.instance.send(s)}}catch(s){t.DataAccessService.instance.logInfo(`Failed to acknowledge message ${e.type}`),t.DataAccessService.instance.logError(s)}}static toCodePointArray(e){let t;if(e){t=[];for(let s=0;s<e.length;s++){const a=e.codePointAt(s);t.push(a)}}return t}static sendUpdateToolbarEvent(e){t.DataAccessService.instance.displayMode!=a.UIDisplayMode.ExceuteScript&&t.DataAccessService.instance.displayMode!=a.UIDisplayMode.ExceuteSQLStatement||this.sendUpdateToolbarEventInternal(e)}static sendUpdateToolbarEventInternal(e){t.DataAccessService.instance.logInfo("Sending Update Toolbar event - "+t.DataAccessService.instance.URI);const s=new a.MessageBase;s.type=a.MessageName.updateToolbarEvent;const c=new a.UpdateToolbarEvent;c.executionId=t.DataAccessService.instance.currentExecutionId,c.ownerUri=t.DataAccessService.instance.URI,c.windowUri=t.DataAccessService.instance.windowUri,c.toolbarOptions=n.getToolbarOptions(e),s.data=c,t.DataAccessService.instance.send(s)}static getUserPreferences(){const e=new a.MessageBase;e.type=a.MessageName.getUserPreferencesRequest;const s=new a.GetUserPreferencesRequest;s.executionId=t.DataAccessService.instance.currentExecutionId,s.ownerUri=t.DataAccessService.instance.URI,s.windowUri=t.DataAccessService.instance.windowUri,e.data=s;try{t.DataAccessService.instance.send(e),t.DataAccessService.instance.logInfo("Successfully placed GetUserPreferencesRequest")}catch(e){t.DataAccessService.instance.logError(e)}}static handlegetUserPreferencesResponse(e){t.DataAccessService.instance.logInfo("Received GetUserPreferencesResponse");try{const t=e.data;if(t.result){const e=t.userPreferences;c.instance.userPreferences=e}}catch(e){t.DataAccessService.instance.logError(e)}}static getRootAppendedDisplayName(e){let t="";return e&&(t=`${e} (${s.LocalizedConstants.Instance.root})`),t}static getRootAppenedFullCompartmentNameForDisplay(e){let t;if(e){let s=e.indexOf(this.compartmentSeparator);if(s>=0){let a=e.substr(0,s);t=e.replace(a,this.getRootAppendedDisplayName(a))}else t=this.getRootAppendedDisplayName(e)}return t}static preventCutAndPaste(e){$(e).on("cut paste",(function(e){e.preventDefault()}))}}e.ODTUtils=n,n.getToolbarOptions=e=>{let t=new a.ToolbarOptions;switch(e){case a.ExecutionStatus.Started:t.cancelEnabled=!0,t.clearEnabled=!1,t.cancelVisible=!0,t.clearVisible=!0;break;case a.ExecutionStatus.Finished:t.cancelEnabled=!1,t.clearEnabled=!0,t.cancelVisible=!0,t.clearVisible=!0;break;default:t.cancelVisible=!1,t.clearVisible=!1,t.cancelEnabled=!1,t.clearEnabled=!1}return t},n.compartmentSeparator="/";class c{constructor(){this.DefaultMessageTimeout=1e4,this.TransientMessageTimeout=2e3,this.MessageTimeoutInfinite=-1}static get instance(){return c._instance}static set instance(e){c._instance=e}get userPreferences(){return this._userPreferences}set userPreferences(e){this._userPreferences=e}}e.ApplicationData=c,c._instance=new c}));