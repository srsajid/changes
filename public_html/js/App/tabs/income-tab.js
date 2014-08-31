/**
 * Created by USER on 8/18/14.
 */

var _income = App.tabs.income = new TableTab("income", "Income Types", App.baseUrl + "income/loadTable");
_income.beforeTableLoad = function(event, ui) {

}
_income.afterTableLoad = function(event, ui) {
    var _self = this;
    var panel = ui.panel;
    panel.find(".create-income").on("click", function(){
        _self.createEditIncome();
    });
    panel.find(".add-income").on("click", function(){
        _self.addIncome();
    });

}

_income.onMenuOptionClick = function(action, data) {
    var _self = this;
    switch (action) {
        case "edit":
            _self.createEditIncome(data.id);
            break;
    }
}

_income.createEditIncome = function (id){
    var _self = this;
    var title = id ? "Edit Income Type" : "Create Income Type";
    if(id){
        util.editPopup(title, App.baseUrl+ "income/edit", {
            data: {id: id},
            success: function() {
                _self.reload();
            }
        });
    }
    else{
        util.editPopup(title, App.baseUrl+ "income/create", {
            data: {id: id},
            success: function() {
                _self.reload();
            }
        });
    }
}

_income.addIncome = function (){
    var _self = this;
    var title = "Add Income";
    util.editPopup(title, App.baseUrl+ "income/add", {
        success: function() {
            _self.reload();
        }
    });
}
