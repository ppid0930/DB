"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.Icon = exports.TreeNodeBase = void 0;
const vscode = require("vscode");
const iExplorerNode_1 = require("./iExplorerNode");
const constants_1 = require("../constants/constants");
class TreeNodeBase {
    constructor(connectionURI, parentPath, nodeID, nodeType, contextValue, iconPath, schemaName, nodeLabel = "") {
        this.connectionURI = connectionURI;
        this.parentPath = parentPath;
        this.nodeID = nodeID;
        this.nodeType = nodeType;
        this.contextValue = contextValue;
        this.iconPath = iconPath;
        this.schemaName = schemaName;
        this.nodeLabel = nodeLabel;
        this.canRefresh = true;
        this.toolTipMsg = "";
        this.populateCommandSupportedMap();
        this.populateCommandSupportedAcrossConnection();
    }
    removeChild(treeNode) {
        let index = this.childrenField.indexOf(treeNode);
        if (index > -1) {
            this.childrenField.splice(index, 1);
        }
    }
    get getNodeType() {
        return this.nodeType;
    }
    reset() {
        this.childrenField = undefined;
    }
    get getIconPath() {
        if (this.iconPath)
            if ((this.iconPath instanceof Icon && this.iconPath.light && this.iconPath.dark) ||
                (this.iconPath instanceof vscode.ThemeIcon))
                return this.iconPath;
        return undefined;
    }
    get getContextValue() {
        return this.contextValue;
    }
    get getNodeIdentifier() {
        return this.nodeID;
    }
    set setNodeIdentifier(nodeId) {
        this.nodeID = nodeId;
    }
    get getNodeLabel() {
        return this.nodeLabel;
    }
    set setNodeLabel(nodeLabel) {
        this.nodeLabel = nodeLabel;
    }
    get getParentPath() {
        return this.parentPath;
    }
    get getConnectionURI() {
        return this.connectionURI;
    }
    get children() {
        return this.childrenField;
    }
    set children(value) {
        this.childrenField = value;
    }
    IsCommandSupported(commandID, nodeID) {
        let commandSupported = false;
        if (TreeNodeBase.commandSupportedbyNodesMap.has(commandID)) {
            let supportedNodes = TreeNodeBase.commandSupportedbyNodesMap.get(commandID);
            if (supportedNodes && supportedNodes.indexOf(nodeID) >= 0) {
                commandSupported = true;
            }
        }
        return commandSupported;
    }
    IsMultiCommandSupportedAcrossConnection(commandID, nodeID) {
        let commandSupported = false;
        if (TreeNodeBase.multiCommandSupportedbyNodesAcrossConnectionMap.has(commandID)) {
            let supportedNodes = TreeNodeBase.multiCommandSupportedbyNodesAcrossConnectionMap.get(commandID);
            if (supportedNodes && supportedNodes.indexOf(nodeID) >= 0) {
                commandSupported = true;
            }
        }
        return commandSupported;
    }
    populateCommandSupportedAcrossConnection() {
        if (!TreeNodeBase.multiCommandSupportedbyNodesAcrossConnectionMap) {
            TreeNodeBase.multiCommandSupportedbyNodesAcrossConnectionMap = new Map();
            TreeNodeBase.multiCommandSupportedbyNodesAcrossConnectionMap.set(constants_1.Constants.cmdExplorerConnectionDelete, [constants_1.TreeViewConstants.connectedConnectionStr, constants_1.TreeViewConstants.disconnectedConnectionStr, constants_1.TreeViewConstants.defaultConnectedConnectionStr, constants_1.TreeViewConstants.defaultDisconnectedConnectionStr,
                constants_1.TreeViewConstants.erroredConnectionStr, constants_1.TreeViewConstants.defaultErroredConnectionStr]);
            TreeNodeBase.multiCommandSupportedbyNodesAcrossConnectionMap.set(constants_1.Constants.cmdExplorerDisconnect, [constants_1.TreeViewConstants.connectedConnectionStr, constants_1.TreeViewConstants.disconnectedConnectionStr, constants_1.TreeViewConstants.defaultConnectedConnectionStr, constants_1.TreeViewConstants.defaultDisconnectedConnectionStr,
                constants_1.TreeViewConstants.erroredConnectionStr, constants_1.TreeViewConstants.defaultErroredConnectionStr]);
        }
    }
    populateCommandSupportedMap() {
        if (!TreeNodeBase.commandSupportedbyNodesMap) {
            TreeNodeBase.commandSupportedbyNodesMap = new Map();
            TreeNodeBase.commandSupportedbyNodesMap.set(constants_1.Constants.cmdExplorerConnectionDelete, [constants_1.TreeViewConstants.connectedConnectionStr, constants_1.TreeViewConstants.disconnectedConnectionStr, constants_1.TreeViewConstants.defaultConnectedConnectionStr, constants_1.TreeViewConstants.defaultDisconnectedConnectionStr,
                constants_1.TreeViewConstants.erroredConnectionStr, constants_1.TreeViewConstants.defaultErroredConnectionStr]);
            TreeNodeBase.commandSupportedbyNodesMap.set(constants_1.Constants.cmdExplorerDisconnect, [constants_1.TreeViewConstants.connectedConnectionStr, constants_1.TreeViewConstants.disconnectedConnectionStr, constants_1.TreeViewConstants.defaultConnectedConnectionStr, constants_1.TreeViewConstants.defaultDisconnectedConnectionStr,
                constants_1.TreeViewConstants.erroredConnectionStr, constants_1.TreeViewConstants.defaultErroredConnectionStr]);
        }
    }
    getTreeItem() {
        const treeItemObject = {};
        treeItemObject.label = this.nodeLabel == "" ? this.getNodeIdentifier : this.nodeLabel;
        ;
        treeItemObject.collapsibleState = this.getExpansionState();
        treeItemObject.contextValue = this.getContextValue;
        treeItemObject.iconPath = this.getIconPath;
        treeItemObject.command = this.getCommandObject();
        treeItemObject.tooltip = this.toolTipMsg == "" ? this.getNodeIdentifier : this.toolTipMsg;
        return treeItemObject;
    }
    getChildren() {
        return null;
    }
    getResourceURI() {
        return this.resourceURI;
    }
    getCommandObject() {
        return undefined;
    }
    getExpansionState() {
        return this.getNodeType == iExplorerNode_1.ExplorerNodeType.Category ? vscode.TreeItemCollapsibleState.Collapsed : vscode.TreeItemCollapsibleState.None;
    }
}
exports.TreeNodeBase = TreeNodeBase;
class Icon {
    constructor(dark = "", light = "") {
        this.dark = dark;
        this.light = light;
    }
}
exports.Icon = Icon;
