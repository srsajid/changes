/**
 * Created by User on 8/4/14.
 */
var _b = App.tabs.beneficiary = new TableTab("beneficiary", "Beneficiary", App.baseUrl + "beneficiary/load-table");
_b.afterTableLoad = function(event, ui) {
    var _self = this;
    var panel = ui.panel;
    panel.find(".create-beneficiary").on("click", function(){
        _self.createEditBeneficiary();
    });

}

_b.onMenuOptionClick = function(action, data) {
    var _self = this;
    switch (action) {
        case "edit":
            _self.createEditBeneficiary(data.id);
            break;
        case "pay-salary":
            _self.paySalary(data.id);
            break
        case "give-loan":
            _self.giveLoan(data.id);
            break;
    }
}

_b.createEditBeneficiary = function (id){
    var _self = this;
    var title = id ? "Edit Beneficiary" : "Create Beneficiary";
    util.editPopup(title, App.baseUrl+ "beneficiary/create", {
        data: {id: id},
        success: function() {
            _self.reload();
        }
    });
}

_b.paySalary = function (id){
    var _self = this;
    var title = "Pay Salary";
    util.editPopup(title, App.baseUrl+ "beneficiary/pay-salary-form", {
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
                    url: App.baseUrl+ "beneficiary/pay-salary-next-step",
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

_b.giveLoan = function(id) {
    util.editPopup("Give Loan", App.baseUrl + "loan/create", {
        data: {beneficiaryId: id}
    })
}
