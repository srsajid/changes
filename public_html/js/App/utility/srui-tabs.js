/**
 * Created by User on 4/25/14.
 */
App.tabs.addToTab = function(tabId) {
    var tabs = this.tabs;
    if(!tabs.find("li[tab-id="+ tabId +"]").length) {
        var tab = App.tabs[tabId];
        var url = tab.url;
        var panel = url ? url : "#sr-ui-tab-" + tabId;
        var headerTemplate = '<li tab-id="' + tabId + '"><a href="' + panel + '">' + tab.title +'</a> <span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>';
        tabs.find(".main-tab-header-container ul").append(headerTemplate);
        if(!url) {
            tabs.find(".main-tab-body-container").append('<div id="'+ panel +'"></div>');
        }
        tabs.tabs("refresh");
    }
    this.active(tabId)
}

App.tabs.active = function(tabId) {
    var tabs = this.tabs;
    var index = tabs.find(".main-tab-header-container ul li").index(tabs.find(".main-tab-header-container li[tab-id="+ tabId +"]"));
    this.tabs.tabs("option", "active", index);
}

App.tabs.reload = function(tabId) {
    var tabs = this.tabs;
    var index = tabs.find(".main-tab-header-container ul li").index(tabs.find(".main-tab-header-container li[tab-id="+ tabId +"]"));
    this.tabs.tabs("load", index);
};

App.global_event.on("tab-created", function() {

    App.tabs.tabs.on("tabsbeforeload", function(event, ui) {
        var panel = ui.panel;
        var tabId = ui.tab.attr("tab-id");
        var tab = App.tabs[tabId];
        if(typeof tab["beforeTabLoad"] == "function") {
            tab["beforeTabLoad"](event, ui);
        }
        panel.loader();
    });

    App.tabs.tabs.on("tabsload", function(event, ui) {
        var panel = ui.panel;
        var tabId = ui.tab.attr("tab-id");
        var tab = App.tabs[tabId];
        if(typeof tab["afterTabLoad"] == "function") {
            tab.afterTabLoad(event, ui);
        }
        panel.load(false);
    });
})