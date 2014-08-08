/**
 * Created by User on 8/4/14.
 */
var _s = App.tabs.salary = new TableTab("salary", "Salary", App.baseUrl + "salary/load-table");
_s.afterTableLoad = function(event, ui) {
    var _self = this;
    var panel = ui.panel;
}

