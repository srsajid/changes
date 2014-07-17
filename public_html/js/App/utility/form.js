(function() {
    var DATA_KEY = "form-inst";
    var DEFAULT_OPTIONS = {
        preSubmit: undefined,
        disable_on_submit: true,
        disable_on_invalid: true,
        text_change_on_submit: true
    }


    var careFunctions = {
        events: function()  {
            var form = this;
            this.bind("submit", function() {
                var obj = form.data(DATA_KEY);
                return instanceFuncs.submit.call(obj)
            });
            if(!form.is("form")) {
                form.find("input, textarea").bind("keydown.key_return", function() {
                    form.triggerHandler("submit");
                });
                form.find(".submit-button").click(function() {
                    form.triggerHandler("submit")
                });
                form.find(".reset-button").click(function() {
                    form.triggerHandler("reset");
                });
            }
        },
        updateUi: function() {
            var form = this;
            form.updateUi();
        }
    }

    var instanceFuncs = {
        lock: function(lockId) {
            if(!this.lock) {
                this.lock = {};
            }
            this.lock[lockId] = true;
            this.submitButton.attr("disabled", "disabled");
            this.elm.trigger("lock")
        },
        unlock: function(lockId) {
            if(this.lock && this.lock[lockId]) {
                delete this.lock[lockId];
            }
            if($.isEmptyObject(this.lock)) {
                this.submitButton.removeAttr("disabled");
                this.elm.trigger("unlock")
            }
        },
        prop: function(name, value) {
            utility.prop(this, name, value)
        },
        force_submit: function(settings) {
            var _form = this;
            if (this.disable_on_submit) {
                if(this.text_change_on_submit) {
                    var text = this.submitButton.orgText = this.submitButton.text();
                    if (this.disable_button_text) {
                        this.submitButton.text(this.disable_button_text);
                    } else {
                        if (text == "Create") {
                            text = "Creating"
                        } else if (text == "Update") {
                            text = "Updating"
                        } else {
                            text = "Submitting"
                        }
                        this.submitButton.text(text + " ...");
                    }
                }
                this.submitButton.attr("disabled", "disabled")
            }
            var _def_settings = $.extend({}, this.ajax === true ? {} : this.ajax)
            var _response;
            settings = settings || {}
            if(_def_settings.success && settings.success) {
                var _s = settings.success;
                settings.success = function() {
                    _s.apply(this, arguments);
                    _def_settings.success.apply(this, arguments);
                }
            }
            if(_def_settings.error && settings.error) {
                var _s = settings.error;
                settings.error = function() {
                    _s.apply(this, arguments);
                    _def_settings.error.apply(this, arguments);
                }
            }
            if(_def_settings.response || settings.response) {
                _response = function() {
                    if(settings.response) {
                        settings.response.apply(this, arguments);
                    }
                    if(_def_settings.response) {
                        _def_settings.response.apply(this, arguments);
                    }
                }
            }
            if(_def_settings.complete && settings.complete) {
                var _s = settings.complete;
                settings.complete = function() {
                    _s.apply(this, arguments);
                    _def_settings.complete.apply(this, arguments);
                }
            }
            var modified_settings = $.extend({}, _def_settings, settings);
            if(!this.elm.is("form")) {
                modified_settings.data = $.extend(this.elm.serializeObject(), modified_settings.data)
            }
            this.elm.ajaxSubmit($.extend(modified_settings, {
                complete: function () {
                    if (_form.disable_on_submit) {
                        if (_form.text_change_on_submit) {
                            _form.submitButton.text(_form.submitButton.orgText);
                        }
                        _form.submitButton.removeAttr("disabled", "disabled")
                    }
                    if (_response) {
                        _response.apply(_form.elm, arguments);
                    }
                }
            }));
        },
        submit: function(settings) {
            if (!$.isEmptyObject(this.lock)) {
                return false;
            }
            try {
                if(!this.elm.validationEngine("validate")) {
                    return false;
                }
                var beforeSubmitRet = true;
                if (typeof this.preSubmit === 'function') {
                    settings = settings || (this.ajax ? {} : null)
                    beforeSubmitRet = this.preSubmit.call(this.elm, settings);
                }
                if (beforeSubmitRet !== false && this.ajax) {
                    instanceFuncs.force_submit.call(this, settings)
                    return false;
                }
                return beforeSubmitRet;
            } catch (ex) {
                return false;
            }

        }
    }

    function init(instance) {
        var _self = this;
        var obj = this.data(DATA_KEY);
        if(!obj.submitButton) {
            obj.submitButton = this.find("[type='submit'], .submit-button");
            if(obj.submitButton.length > 1) {
                this.attr("class").split(" ").each(function() {
                    var button = obj.submitButton.filter("." + this + "-submit");
                    if(button.length) {
                        obj.submitButton = button;
                        return false;
                    }
                })
            }
        }
        $.each(careFunctions, function() {
            this.call(_self, instance);
        })
        _self.validationEngine('attach');
    }

    $.fn.form = function(funcs) {
        var forms = this;
        if(typeof funcs == "string") {
            var rtrn
            var _arguments = Array.prototype.slice.call(arguments, 1)
            forms.each(function() {
                var obj = $(this).data(DATA_KEY)
                if(typeof instanceFuncs[funcs] == "function") {
                    rtrn = instanceFuncs[funcs].apply(obj, _arguments);
                } else {
                    rtrn = obj[funcs]
                }
                if(typeof rtrn != "undefined") {
                    return false
                }
            })
            if(typeof rtrn != "undefined") {
                return rtrn
            }
        }
        forms.each(function() {
            var form = $(this);
            if(!form.data(DATA_KEY)) {
                var inst = $.extend({}, DEFAULT_OPTIONS, funcs, {elm: form})
                form.data(DATA_KEY, inst);
                init.call(form, inst);
            }
        });
        return this;
    }
})();
