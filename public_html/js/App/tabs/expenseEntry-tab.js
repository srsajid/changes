/**
 * Created by User on 4/25/14.
 */
var _expenseEnt = App.tabs.expense_entry = new TableTab("expense_entry", "Expense Entry", App.baseUrl + "expenseEntry/load-table");
_ex.beforeTableLoad = function(event, ui) {

}
_expenseEnt.afterTableLoad = function(event, ui) {
    var _self = this;
    var panel = ui.panel;
    panel.find(".create-expenseE").on("click", function(){
        _self.createExpenseEntry();
    });
    panel.find(".generate-report").on("click", function(){
        util.editPopup("Generate Report", App.baseUrl + "expenseEntry/dateselect", {
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

_expenseEnt.onMenuOptionClick = function(action, data) {
    var _self = this;
//    switch (action) {
//        case "add-expense":
//            _self.addExpense(data.id);
//            break;
//    }
}

_expenseEnt.createExpenseEntry = function (){
    var _self = this;
    var title = "Create Expense Entry";
    util.editPopup(title, App.baseUrl+ "expenseEntry/create", {
        success: function() {
            _self.reload();
        }
    });
}
