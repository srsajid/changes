/**
 * Created by User on 4/25/14.
 */
var _pp = App.tabs.package = new TableTab("package", "Package Product", App.baseUrl + "package/load-table");

_pp.beforeTableLoad = function(event, ui) {
}

_pp.afterTableLoad = function(event, ui) {
    var _self = this;
    var panel = ui.panel;
    panel.find(".create-package").on("click", function() {
        _self.create();
    })
}

_pp.onMenuOptionClick = function(action, data) {
    var _self = this;
    switch (action) {
        case "edit":
            _pp.create(data.id);
        case "inventory-update":
    }
}

_pp.create = function(id) {
    var _self = this;
    util.editPopup("Create Package Product", App.baseUrl + "package/create", {
        width: 800,
        data: {id: id},
        after_load: function () {
            var x = 0;
            var selector = util.twoSideSelection(this, App.baseUrl + "product/selection", "items");
            selector.afterSelect = function(row) {
                var nameTd = row.find(".name");
                var name = nameTd.text();
                nameTd.text("")
                var template = '<div class="pack-row"> <div class="form-row"><label>Name:</label><span>' + name + '</span></div>' +
                    '<div class="form-row"><label>Quantity:</label><input type="text" name="quantity" value="1"></div></div>'
                nameTd.html($(template))

            }
        },
        preSubmit: function(ajaxSetting) {
            var popup = this;
            var items = [];
            var quantities = [];
            var form = this.find("form");
            var rightTable = form.find(".last-column table");
            rightTable.find("tr").not(":eq(0)").each(function(){
                var it = $(this);
                var item = it.find("input[name=items]").val();
                var quantity = it.find("input[name=quantity]").val();
                items.push(item);
                quantities.push(quantity);
            })
            form.loader();
            util.ajax({
                url: App.baseUrl + "package/save",
                type: "POST",
                dataType: "json",
                data: {
                    id: form.find("input[name=id]").val(),
                    name: form.find("input[name=name]").val(),
                    items: JSON.stringify(items),
                    quantities: JSON.stringify(quantities)
                },
                complete: function() {
                    form.loader(false)
                },
                success: function(resp) {
                   util.notify(resp.message, resp.status);
                   popup.dialog("close");
                   _self.reload();
                },
                error: function(a, b, resp) {
                    util.notify(resp.message, "error")
                }
            })
            return false;
        }
    });
}