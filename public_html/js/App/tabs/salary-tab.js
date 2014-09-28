/**
 * Created by User on 8/4/14.
 */
var _s = App.tabs.salary = new TableTab("salary", "Salary", App.baseUrl + "salary/load-table");
_s.afterTableLoad = function(event, ui) {
    var _self = this;
    var panel = ui.panel;
    panel.find(".generate-report").on("click", function(){
        util.editPopup("Generate Report", App.baseUrl + "salary/report-form", {
            after_load: function() {
                var $this = this;
                this.updateUi();
                this.find("form").on("submit", function(){
                    $this.dialog("close");
                })
            }
        });
    });
}

_s.onMenuOptionClick = function(action, data) {
    var _self = this;
    switch (action) {
        case "view":
            _self.viewSalary(data.id);
            break;
    }
}

_s.viewSalary = function(id) {
    util.editPopup("Salary Details View", App.baseUrl + "salary/view", {data: {id: id}});
}

