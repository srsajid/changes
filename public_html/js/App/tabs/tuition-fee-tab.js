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
    util.editPopup(title, App.baseUrl+ "tuition/tuition-fee-form", {
        data: {id: id},
        after_load: function() {
            var dom = this;
            var yearSelect = dom.find("[name=year]");
            var studentId = dom.find("[name=studentId]");
            var step1 =  dom.find(".step-1")
            var step2 =  dom.find(".step-2")
            dom.find(".step-2").hide();
            function loadNextStep() {
                dom.loader();
                util.ajax({
                    url: App.baseUrl+ "tuition/tuition-fee-next",
                    dataType: 'json',
                    data: {id: id, year: yearSelect.val(), studentId: studentId.val()},
                    success: function(resp, status, xhr) {
                        if(resp.status == "error") {
                            util.notify(resp.message);
                            dom.loader(false);
                            return;
                        }
                        resp = $(resp.html);
                        step2.filter(".form-field").html(resp);
                        if(step2.find("[name=hide]").val() == "true") {
                            dom.find("button[type=submit]").hide();
                        } else {
                            dom.find("button[type=submit]").show();
                        }
                        step1.hide("blind");
                        step2.show("clip");
                       resp.find("[name=monthCount], [name=fine], [name=discount]").on("change", function() {
                          var noOfMonth = resp.find("[name=monthCount]").val();
                          var perMonthFee = dom.find(".per-month-tuition").text().trim();
                          var fine = resp.find("[name=fine]").val();
                          var discount = resp.find("[name=discount]").val();
                          var total = noOfMonth * perMonthFee - (discount ? discount : 0) + parseFloat(fine ? fine : 0);
                           resp.find(".total-tuition").text(total);
                       });
                        resp.find("[name=monthCount]").trigger("change");
                        dom.loader(false);
                    },
                    error: function(xhr, status, resp) {
                        util.notify(resp.message);
                        dom.loader(false);
                    }
                })
            }

            dom.find("#next button").on("click", function() {
                if(dom.find("form").validationEngine("validate")) {
                    loadNextStep();
                }
            })
            dom.find("#previous button").on("click", function() {
                step2.hide("blind");
                step1.show("clip");
            })
            studentId.off(".key_return");
            studentId.bind("keydown.key_return", function(evt) {
                if(evt.which == 13 && dom.find("form").validationEngine("validate")) {
                    evt.preventDefault();
                    loadNextStep();
                }
            })
        },
        success: function() {
           _self.reload();
        }
    });
}
