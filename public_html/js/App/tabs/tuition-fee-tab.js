/**
 * Created by User on 8/4/14.
 */
var _tf = App.tabs.tuition_fee = new TableTab("tuition_fee", "Tuition fee", App.baseUrl + "tuition/load-table");
_tf.afterTableLoad = function(event, ui) {
    var _self = this;
    var panel = ui.panel;
    panel.find(".take-fee").on("click", function(){
        _self.takeFee();
    });

}

_tf.takeFee = function (id){
    var _self = this;
    var title = "Tuition fee payment";
    util.editPopup(title, App.baseUrl+ "tuition/pay-salary-form", {
        data: {id: id},
        after_load: function() {
            var dom = this;
            var monthSelect = dom.find("[name=month]");
            var yearSelect = dom.find("[name=year]");
            var step1 =  dom.find(".step-1")
            var step2 =  dom.find(".step-2")
            dom.find(".step-2").hide();
            function loadNextStep() {
                dom.loader();
                util.ajax({
                    url: App.baseUrl+ "tuition/take-tuition-fee-next",
                    data: {id: id, month: monthSelect.val(), year: yearSelect.val()},
                    success: function(resp) {
                        resp = $(resp);
                        step2.filter(".form-field").html(resp);
                        if(step2.find("[name=hide]").val() == "true") {
                            dom.find("button[type=submit]").hide();
                        } else {
                            dom.find("button[type=submit]").show();
                        }
                        step1.hide("blind");
                        step2.show("clip");
                        dom.loader(false);
                    },
                    error: function(xhr, status, resp) {
                        util.notify("Unexpected error occurred")
                        dom.loader(false);
                    }
                })
            }

            dom.find("#next button").on("click", function() {
                loadNextStep();
            })

            dom.find("#previous button").on("click", function() {
                step2.hide("blind");
                step1.show("clip");
            })
        },
        success: function() {
            App.global_event.trigger("salary-paid");
        }
    });
}
