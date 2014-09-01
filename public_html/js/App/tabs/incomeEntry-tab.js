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
