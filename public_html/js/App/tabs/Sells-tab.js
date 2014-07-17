/**
 * Created by User on 4/25/14.
 */
var _s = App.tabs.sells = new TableTab("sells", "Sells", "sells/loadTable");

_s.beforeTableLoad = function(event, ui) {

}

_s.afterTableLoad = function(event, ui) {
    var _self = this;
    var panel = ui.panel;
    panel.find(".create-sells").on("click", function(){
        var popup = util.editPopup("Create sells", App.baseUrl + "sells/create", {
            width: 700,
            after_load: function() {
                var dom = this;
                var selectionTableContainer = dom.find(".selection-table-container");
                var sellsTable = dom.find(".sells-item-table-container table");
                var packSelector = dom.find("select[name=packSelector]");
                var searchText = dom.find("input[name=searchText]");
                var searchArea = dom.find(".search-area")
                function loadSelectionTable(offset) {
                    util.ajax({
                        url: App.baseUrl + "sells/selection",
                        data: {package: packSelector.val(), searchText: searchText.val(), offset: offset},
                        success: function(resp) {
                            resp = $(resp)
                            selectionTableContainer.html(resp);
                            bindSelectionEvents(resp)
                        }
                    })
                }
                function updateGrandTotal() {
                    var total = 0.0;
                    sellsTable.find("tr:gt(0):not(.last-row)").each(function() {
                        var row = $(this);
                        total = total + (row.attr("price") * row.attr("quantity"))
                    })
                    sellsTable.find("td.grand-total").text(total);
                }
                function addRow(data) {
                    var row = '<tr><td>#NAME#</td><td class="price">#PRICE#</td>' +
                        '<td class="editable"><span class="value">#QUANTITY#</span></td>' +
                        '<td class="total">#TOTAL#</td><td><span class="glyphicon glyphicon-remove remove"></span></td></tr>';
                    row = row.replace("#NAME#", data.name);
                    row = row.replace("#PRICE#", data.price);
                    row = row.replace("#QUANTITY#", data.quantity);
                    var total = (data.price  * data.quantity).toFixed(2);
                    row = row.replace("#TOTAL#", total);
                    row = $(row);
                    row.attr("product-id", data.id)
                    row.attr("stock", data.stock);
                    row.attr("price", data.price);
                    row.attr("quantity", data.quantity);
                    sellsTable.find("tr.last-row").before(row);
                    updateGrandTotal();
                    row.find("span.remove").on("click", function() {
                        row.remove();
                        updateGrandTotal();
                    })
                    util.makeTableCellEditAble(row.find("td.editable"), function(td, newVal) {
                        var old = row.attr("quantity")
                        if(isNaN(newVal) || newVal.indexOf(".") > -1) {
                            util.notify("Invalid Quantity", "error");
                            td.find(".value").text(old);
                        } else if(parseInt(row.attr("stock")) < parseInt(newVal)) {
                            util.notify("Out of stock quantity", "error");
                            td.find(".value").text(old);
                        } else {
                            row.attr("quantity", newVal);
                            var total = (newVal * row.attr("price")).toFixed(2);
                            row.find(".total").text(total);
                            updateGrandTotal();
                        }
                    });
                }
                function bindSelectionEvents(table) {
                    var pagination = table.find(".pagination");
                    var table = selectionTableContainer.find("table");
                    pagination.addClass("pagination-sm");
                    pagination.paginator();
                    pagination.on("paginator-click", function() {
                        loadSelectionTable(pagination.attr("offset"));
                    })

                    table.find("tr:gt(0)").on("click", function() {
                        var tr = $(this)
                        var data = tr.config("product");
                        if(sellsTable.find("[product-id=" + data.id + "]").size() > 0) {
                            util.notify("Already added in list", "error");
                        } else if(parseInt(data.quantity) > parseInt(data.stock)) {
                            util.notify("Item not in stock", "error");
                        }
                        else {
                            addRow(data);
                        }
                    })

                }
                function bindEvents() {
                    packSelector.on("change", function() {
                        var value = $(this).val();
                        if(value) {
                            searchText.val("");
                            searchArea.hide();
                        } else {
                            searchArea.show();
                        }
                        loadSelectionTable();
                    })
                    dom.find("button.search").on("click", function() {
                        loadSelectionTable();
                    })
                    dom.find(".sells-create-btn").on("click", function(){
                        if(sellsTable.find("tr").size() < 3 ) {
                            util.notify("No item added in list.")
                            return;
                        }
                        var ids = [];
                        var quantities =  [];
                        sellsTable.find("tr:gt(0):not(.last-row)").each(function() {
                            var row = $(this);
                            ids.push(row.attr("product-id"));
                            quantities.push(row.attr("quantity"));
                        });
                        var studentId = dom.find("[name='studentId']").val()
                        var mobileNo = dom.find("[name='mobileNo']").val()
                        util.ajax({
                            url: App.baseUrl + "sells/save",
                            data: {studentId: studentId,mobileNo: mobileNo, ids: JSON.stringify(ids), quantities: JSON.stringify(quantities)},
                            type: "POST",
                            dataType: "json",
                            success: function(resp) {
                                if(resp.status != "success") {
                                    this.error(null, null, resp);
                                    return;
                                }
                                util.notify(resp.message, "success");
                                dom.dialog("close");
                                _self.reload();
                            },
                            error: function(a, b, resp) {
                                util.notify(resp.message ? resp.message : "Unexpected error occurred", "error");
                            }
                        })
                    })
                }
                loadSelectionTable();
                bindEvents();
            }
        });
    });
    panel.find(".generate-report").on("click", function(){
        util.editPopup("Generate Report", App.baseUrl + "sells/reportForm", {
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
        case "pdf":
            _self.pdf(data.id);
            break;
        case "view":
            _self.view(data.id);
            break;

    }
}

_s.pdf = function(id) {
    var form = '<form action="' + App.baseUrl + 'sells/pdf" target="_blank">' +
        '<input type="hidden" name="id" value="'+id+'">'+
        '</form>'
    $(form).submit();
};

_s.view = function(id) {
    util.editPopup("Sells Details", "sells/view", {width: 800, data: {id: id} });
}