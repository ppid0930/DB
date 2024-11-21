"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.MaterializedViewCategoryNode = void 0;
const dataExplorerRequests_1 = require("../dataExplorerRequests");
const utilities_1 = require("../utilities");
const databaseObjectBasic_1 = require("./databaseObjectBasic");
const vscode_1 = require("vscode");
class MaterializedViewCategoryNode extends databaseObjectBasic_1.CategoryNodeBase {
    constructor(connURI, parentPath, schemaName) {
        super(connURI, parentPath, utilities_1.TreeViewConstants.materializedViewsStr, utilities_1.TreeViewConstants.materializedViewsStr, schemaName);
    }
    async getChildren() {
        return new Promise(async (resolve, reject) => {
            try {
                if (!this.children) {
                    let restrictions = [];
                    restrictions.push(new dataExplorerRequests_1.OracleDDEXRestriction(dataExplorerRequests_1.OracleDDEXRestrictionType.OraDDEXRestriction_IncludeSchemas, [this.schemaName]));
                    restrictions.push(new dataExplorerRequests_1.OracleDDEXRestriction(dataExplorerRequests_1.OracleDDEXRestrictionType.OraDDEXRestriction_ExcludeSchemas, []));
                    this.children = await utilities_1.ExplorerUtilities.getChildNodes(this, dataExplorerRequests_1.OracleDDEXObjectTypes.OraDDEX_MaterializedView, restrictions);
                }
                this.expandNodeField = vscode_1.TreeItemCollapsibleState.Expanded;
                return resolve(this.children);
            }
            catch (error) {
                reject(error);
            }
        });
    }
}
exports.MaterializedViewCategoryNode = MaterializedViewCategoryNode;
