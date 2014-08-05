/**
 * Created by User on 4/25/14.
 */
var _c = App.tabs.category =new TableTab("category", "Category", "category");
_c.beforeTableLoad = function(event, ui) {
    ui.ajaxSettings.data = {name: "aAJID"}
    console.log("befor")
}
_c.afterTableLoad = function(event, ui) {
    var _self = this;
    var panel = ui.panel;
    panel.find(".create-category").on("click", function(){
        util.editPopup("Create Category", App.baseUrl + "category/create", {
            success: function() {
                _self.reload();
            }
        });
    });
}

_c.onMenuOptionClick = function(action, data) {
    var _self = this;
    switch (action) {
        case "edit":
            _self.createEditCategory(data.id);
            break;
    }
}

_c.createEditCategory = function (id){
    var _self = this;
    util.editPopup("Edit Category", App.baseUrl + "category/edit", {
        success: function() {
            _self.reload();
        },
        data: {id: id}
    });
}