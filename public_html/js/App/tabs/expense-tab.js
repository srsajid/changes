/**
 * Created by User on 4/25/14.
 */
var _ex = App.tabs.expense = new TableTab("expense", "Expense Types", App.baseUrl + "expense/loadTable");
_ex.beforeTableLoad = function(event, ui) {

}
_ex.afterTableLoad = function(event, ui) {
    var _self = this;
    var panel = ui.panel;
    panel.find(".create-expense").on("click", function(){
        _self.createEditExpense();
    });

}

_ex.onMenuOptionClick = function(action, data) {
    var _self = this;
    switch (action) {
        case "edit":
            _self.createEditExpense(data.id);
            break;
    }
}

_ex.createEditExpense = function (id){
    var _self = this;
    var title = id ? "Edit Expense Type" : "Create Expense Type";
    util.editPopup(title, App.baseUrl+ "expense/create", {
        data: {id: id},
        success: function() {
            _self.reload();
        }
    });
}
