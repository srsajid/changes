/**
 * Created by User on 5/9/14.
 */
var TableTab = function(id, title, url) {
    this.tabId = id;
    this.title = title;
    this.url = url;
}

var tableTabPrototype = TableTab.prototype;

tableTabPrototype.beforeTabLoad = function(event, ui) {
    var _self = this;
    var panel = ui.panel;
    var params = {};
    var pagination = panel.find(".pagination");
    if(pagination) {
        $.extend(params, {
            max: panel.find(".item-per-page").val(),
            offset: pagination.attr("offset")
        })
    }
    if(panel.find("input[name=searchText]").val()) {
        $.extend(params, {
            searchText: panel.find("input[name=searchText]").val()
        });
    }
    panel.find(".advance-search-field").each(function() {
        var field = $(this);
        params[field.attr("name")] = field.val();
    });
    if(typeof _self["beforeTableLoad"] == "function") {
        _self["beforeTableLoad"](event, ui, params);
    }
    ui.ajaxSettings.url += "?" + $.param(params);
}

tableTabPrototype.afterTabLoad = function(event, ui) {
    var _self = this;
    var panel = ui.panel;
    var pagination = panel.find(".pagination");
    pagination.paginator();
    pagination.on("paginator-click", function() {
        _self.reload();
    })
    panel.find(".item-per-page").on("change", function() {
        pagination.attr("offset", "0");
        _self.reload();
    });
    panel.find("button.search").on("click", function() {
        pagination.attr("offset", "0");
        _self.reload();
    })
    panel.find(".action-menu").on("click", function() {
        var $this = $(this);
        if(typeof _self['onMenuOptionClick'] == "function") {
            _self['onMenuOptionClick']($this.attr("action"), $this.data());
        }
    });
    if(typeof _self["afterTableLoad"] == "function") {
        _self.afterTableLoad(event, ui);
    }
}

tableTabPrototype.reload = function() {
    App.tabs.reload(this.tabId);
}