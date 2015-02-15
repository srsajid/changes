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
        case "increment":
            _self.increment(data.id);
            break;
        case 'salary-history':
            _self.salaryHistory(data.id)
    }
}

_b.createEditBeneficiary = function (id){
    var _self = this;
    var title = id ? "Edit Beneficiary" : "Create Beneficiary";
    var rowTemplate = '<tr class="education"><td class="degree">#DEGREE#</td>' +
        '<td class="institution">#INSTITUTION#</td><td class="board">#BOARD#</td><td class="passed">#PASSED#</td><td class="grade">#GRADE#</td>' +
        '<td><span class="glyphicon glyphicon-pencil edit"><span class="glyphicon glyphicon-remove remove"></span></td>' +
        '</tr>';
    util.editPopup(title, App.baseUrl+ "beneficiary/create", {
        width: 1000,
        data: {id: id},
        success: function() {
            _self.reload();
        },
        after_load: function() {
            var popup = this, educationTable = popup.find("table"), lastRow = educationTable.find(".last-row"), editionRow;
            var degree = lastRow.find('[name=degree]'), institution = lastRow.find('[name=institution]'),
                board = lastRow.find('[name=board]'),passed = lastRow.find('[name=passed]'), grade = lastRow.find('[name=grade]');
            lastRow.on("keydown", function(e) {
                if(e.keyCode == 13) {
                    lastRow.find(".add").trigger("click")
                    return false
                }
            })
            function attachRowEvent(row) {
                row.find(".remove").on("click", function() {
                    row.remove();
                });
                row.find(".edit").on("click", function() {
                    degree.val(row.find(".degree").text());
                    institution.val(row.find(".institution").text());
                    grade.val(row.find(".grade").text());
                    passed.val(row.find(".passed").text());
                    board.val(row.find(".board").text());
                    editionRow = row;
                })
            }
            educationTable.find("tr:gt(0):not(.last-row)").each(function() {
                attachRowEvent($(this));
            });
            lastRow.find('.add').on("click", function() {
                if(degree.val() && institution.val()) {
                    var row = $(rowTemplate.replace("#DEGREE#", degree.val()).replace("#INSTITUTION#", institution.val()).replace("#BOARD#", board.val()).replace("#PASSED#", passed.val()).replace("#GRADE#", grade.val()));
                    attachRowEvent(row)
                    if(editionRow) {
                        editionRow.replaceWith(row);
                        editionRow = null
                    } else {
                        lastRow.before(row)
                    }
                    degree.val("");
                    institution.val("")
                    board.val("")
                    grade.val("");
                    passed.val("");
                }
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.' + $(input).attr("name")).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            popup.find("[type=file]").srFileInput();
            popup.find("[type=file]").on("change", function() {
                readURL(this);
            })
        },
        preSubmit: function(ajaxSetting) {
            var popup = this, educationTable = popup.find("table"), degrees = [], institutions = [], boards = [], passed_years = [], grades = [];
            educationTable.find("tr:gt(0):not(.last-row)").each(function() {
                var $this = $(this);
                degrees.push($this.find(".degree").text());
                institutions.push($this.find(".institution").text());
                boards.push($this.find(".board").text());
                passed_years.push($this.find(".passed").text());
                grades.push($this.find(".grade").text());
            });
            ajaxSetting.data = {
                degrees: JSON.stringify(degrees),
                institutions: JSON.stringify(institutions),
                boards: JSON.stringify(boards),
                passed_years: JSON.stringify(passed_years),
                grades: JSON.stringify(grades)
            };
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
};
_b.increment = function(id) {
    var _self = this;
    util.editPopup("Adjust Salary", App.baseUrl + "beneficiary/create-increment", {
        data: {id: id},
        success: function() {
            _self.reload();
        }
    })
};

_b.salaryHistory = function(id) {
    var form = '<form action="' + App.baseUrl + 'beneficiary/salary-history" target="_blank" method="get">' +
        '<input type="hidden" name="id" value="'+id+'">'+
        '</form>'
    $(form).submit();
};
var _no = App.tabs.notification = new TableTab("notification", "Promotion Notification", App.baseUrl + "notification/load-table");
_no.afterTableLoad = function(event, ui) {
    var _self = this;
    var panel = ui.panel;
    panel.find("[name=searchText]").on("change", function(){
        _self.reload();
    });

}