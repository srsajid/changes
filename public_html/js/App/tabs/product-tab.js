/**
 * Created by User on 4/25/14.
 */
var _p = App.tabs.product = new TableTab("product", "Product", "product/loadTable");

_p.beforeTableLoad = function(event, ui) {
    ui.ajaxSettings.data = "?sajid=sssssssss";
}

_p.afterTableLoad = function(event, ui) {
    var _self = this;
    var panel = ui.panel;
    panel.find(".create-product").on("click", function() {
        _self.editProduct();
    })
}

_p.onMenuOptionClick = function(action, data) {
    var _self = this;
    switch (action) {
        case "edit":
            _self.editProduct(data.id);
            break;
        case "inventory-update":
            _self.loadInventoryForm(data.id);
            break;
        case "view":
            _self.view(data.id);
            break;
        case "inventory-history":
            _self.inventoryHistory(data.id);
            break;
    }
}

_p.editProduct = function(id){
    var _self = this;
    util.editPopup("Edit Product", "product/create", {
        success: function() {
            _self.reload();
        },
        data: {id: id}
    });
}

_p.view = function(id){
    var _self = this;
    util.editPopup("Product Details", "product/view", {
        success: function() {
            _self.reload();
        },
        data: {id: id}
    });
}

_p.loadInventoryForm = function(id) {
    var _self = this;
    util.editPopup("Update Inventory", "product/inventory", {
        data: {id: id},
        success: function() {
            _self.reload();
        }
    });
}

_p.inventoryHistory = function(id) {
    var form = '<form action="' + App.baseUrl + 'product/history" target="_blank" method="get">' +
        '<input type="hidden" name="id" value="'+id+'">'+
        '</form>'
    $(form).submit();
};