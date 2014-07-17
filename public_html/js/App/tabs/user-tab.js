/**
 * Created by User on 4/25/14.
 */
var _u = App.tabs.user = new TableTab("user", "User", App.baseUrl + "user/table-view");
_u.beforeTableLoad = function(event, ui) {

}
_u.afterTableLoad = function(event, ui) {
    var _self = this;
    var panel = ui.panel;
    panel.find(".create-user").on("click", function(){
        _self.createEditUser();
    });

}

_u.onMenuOptionClick = function(action, data) {
    var _self = this;
    switch (action) {
        case "edit":
            _self.createEditUser(data.id);
            break;
    }
}

_u.createEditUser = function (id){
    var _self = this;
    var title = id ? "Edit User" : "Create User";
    util.editPopup(title, App.baseUrl+ "user/create", {
        data: {id: id},
        success: function() {
            _self.reload();
        }
    });
}
