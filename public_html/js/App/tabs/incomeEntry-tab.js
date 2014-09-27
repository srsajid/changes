/**
 * Created by User on 4/25/14.
 */
var _incomeEnt = App.tabs.income_entry = new TableTab("income_entry", "Income Entry", App.baseUrl + "incomeEntry/load-table");
_ex.beforeTableLoad = function(event, ui) {

}
_incomeEnt.afterTableLoad = function(event, ui) {
    var _self = this;
    var panel = ui.panel;
    panel.find(".create-incomeE").on("click", function(){
        _self.createIncomeEntry();
    });

    panel.find(".generate-report").on("click", function(){
        util.editPopup("Generate Report", App.baseUrl + "incomeEntry/dateselect", {
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

_incomeEnt.onMenuOptionClick = function(action, data) {
    var _self = this;
//    switch (action) {
//        case "add-expense":
//            _self.addExpense(data.id);
//            break;
//    }
}

_incomeEnt.createIncomeEntry = function (){
    var _self = this;
    var title = "Create Income Entry";
    util.editPopup(title, App.baseUrl+ "incomeEntry/create", {
        success: function() {
            _self.reload();
        }
    });
}
