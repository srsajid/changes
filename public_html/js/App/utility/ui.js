/**
 * Created by User on 4/25/14.
 */
$(function(){
    App.tabs.tabs = $("#tabs");
    App.global_event.trigger("tab-created");
    App.tabs.tabs.tabs({
        beforeLoad: function( event, ui ) {
            ui.jqXHR.error(function (xhr, status, resp) {
                ui.panel.loader(false);
                var html = "Couldn't load this tab. We'll try to fix this as soon as possible.";
                if(xhr.status == 401) {
                    html = "Couldn't load this tab. You do not have right permission. "
                }
                ui.panel.html(html);
            });
        }
    });
    $("button.ribbon-menu-btn").on("click", function(){
        var button = $(this);
        App.tabs.addToTab(button.attr("tab-id"))
    });

    App.tabs.tabs.delegate(".main-tab-header-container span.ui-icon-close", "click", function() {
        var tabHeader = $( this ).closest( "li" )
        var tabId = tabHeader.attr("tab-id");
        var panelId = tabHeader.remove().attr( "aria-controls" );
        $( "#" + panelId ).remove();
        if(App.tabs[tabId].onClose instanceof Function) {
            App.tabs[tabId].onClose();
        }
        App.tabs.tabs.tabs( "refresh" );
    });

    $(".osms-navigation ul.navbar-nav li").on("click", function() {
        var $this = $(this);
        var type = $this.attr("type");
        $(".osms-navigation ul.navbar-nav li.active").removeClass("active");
        $this.addClass("active");
        $(".ribbon-menu-btn-container").find("button").hide();
        $(".ribbon-menu-btn-container").find("[nav-menu='"+ type +"']").show();
    });
    
    $(".osms-navigation ul.navbar-nav li:eq(0)").trigger("click");
    $("#change-password-btn").on("click", function() {
        util.editPopup("Change Password", App.baseUrl + "account/change-pass", {});
    });

})