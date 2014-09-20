/**
 * Created by User on 4/25/14.
 */
var _r = App.tabs.registration = new TableTab("registration", "Registration", App.baseUrl + "registration/table-view");

_r.beforeTableLoad = function(event, ui) {
}
_r.afterTableLoad = function(event, ui) {
    var _self = this;
    var panel = ui.panel;
    panel.find(".create-registration").on("click", function(){
        util.editPopup("Create Registration", "registration/create", {
            width:925,
            after_load: function() {
                var popup = this;
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('.' + $(input).attr("name")).attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                popup.find("[type=file]").srFileInput();
                popup.find("[type=file]").on("change", function() {
                    readURL(this);
                })
            },
            success: function() {
                _self.reload();
            }
        });
    });
}

_r.onMenuOptionClick = function(action, data) {
    var _self = this;
    switch (action) {
        case "edit":
            _self.editStudent(data.id);
            break;
        case "print":
            _self.printStudent(data.id);
            break;
    }
}

_r.editStudent = function (id){
    var _self = this;
    util.editPopup("Edit Student", "admission/edit", {
        width:925,
        success: function() {
            _self.reload();
        },
        data: {id: id}
    });
}

_r.printStudent = function (id){
    var form = '<form action="' + App.baseUrl + 'sells/pdf" target="_blank">' +
        '<input type="hidden" name="id" value="'+id+'">'+
        '</form>'
    $(form).submit();
}