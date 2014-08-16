/**
 * Created by User on 8/4/14.
 */
var _L = App.tabs.loan = new TableTab("loan", "Loan Given", App.baseUrl + "loan/load-table");
_L.afterTableLoad = function(event, ui) {
    var _self = this;
    var panel = ui.panel;
};
_L.onMenuOptionClick = function(action, data) {
    var _self = this;
    switch (action) {
        case "history":
            _self.history(data.id);
            break;
        case "take-payment":
            _self.takePayment(data.id);

    }
};
_L.history = function(id) {
    var form = '<form action="' + App.baseUrl + 'loan/payment-history" target="_blank" method="get">' +
        '<input type="hidden" name="id" value="'+id+'">'+
        '</form>'
    $(form).submit();
};
_L.takePayment = function(id) {
    var _self = this;
    util.editPopup("Take Payment", App.baseUrl + "loan/create-payment", {
        data: {id: id},
        success: function() {
            _self.reload();
        }
    })
}
