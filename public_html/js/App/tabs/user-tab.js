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
        case "manage-permission":
            _self.managePermission(data.id);
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
};
_u.managePermission = function(id) {
    util.editPopup("Manage Permission", App.baseUrl + "user/permission-edit", {
        data: {id: id},
        width: 350,
        after_load: function() {
            var popup = this;
            function reloadForm(controller) {
                popup.loader();
                util.ajax({
                    url: App.baseUrl + "user/permission-edit",
                    data: {id: id, controller: controller},
                    dataType: "html",
                    success: function(resp) {
                        resp = $(resp);
                        popup.find("form").replaceWith(resp)
                        attachEvents(resp)
                        popup.loader(false);
                    }
                })
            }
            function attachEvents(form) {
                var controllerSelector = form.find(".controller-selector");
                controllerSelector.on("change", function() {
                    reloadForm($(this).val());
                });
                form.form({
                    ajax: true,
                    preSubmit: function(ajaxSetting) {
                        form.loader();
                        $.extend(ajaxSetting, {
                           success: function(resp) {
                               util.notify(resp.message, resp.status);
                           },
                            error: function(xhr, status, resp) {
                                util.notify("Unexpected error occurred", "error");
                            },
                            response: function() {
                                form.loader(false);
                            }
                        });
                    }
                })
            }
            attachEvents(popup.find("form"))
        }
    })
}
