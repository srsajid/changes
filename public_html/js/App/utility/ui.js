/**
 * Created by User on 4/25/14.
 */
$(function(){
    App.tabs.tabs = $("#tabs");
    App.global_event.trigger("tab-created");
    App.tabs.tabs.tabs();
    $("button.ribbon-menu-btn").on("click", function(){
        var button = $(this);
        App.tabs.addToTab(button.attr("tab-id"))
    });

    App.tabs.tabs.delegate(".main-tab-header-container span.ui-icon-close", "click", function() {
        var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
        $( "#" + panelId ).remove();
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

})