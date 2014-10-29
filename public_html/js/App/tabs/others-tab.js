/**
 * Created by User on 4/25/14.
 */
var _other = App.tabs.others = new TableTab("others", "Others", App.baseUrl + "others/load-table");

_other.beforeTableLoad = function(event, ui) {
}
_other.afterTableLoad = function(event, ui) {
    var _self = this;
    var panel = ui.panel;
    panel.find(".create-others").on("click", function(){
        util.editPopup("Create Income", "others/create", {
            width:500,
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

_other.onMenuOptionClick = function(action, data) {
    var _self = this;
    switch (action) {
        case "edit":
            _self.editIncome(data.id);
            break;
    }
}

_other.editIncome = function (id){
    var _self = this;
    util.editPopup("Edit Income", "others/edit", {
        width:925,
        success: function() {
            _self.reload();
        },
        data: {id: id}
    });
}
