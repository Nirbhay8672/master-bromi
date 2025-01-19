(function ($) {
    "use strict";
    var property_form_validation = $("#modal_form");
    /* Form validation */
    property_form_validation.validate({
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            // $(element).parent().removeClass('has-success').addClass('has-error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        },
        rules: {
            property_category: {
                required: true,
            },
            flat_type: {
                required: true,
            },
            office_type: {
                required: true,
            },
            retail_type: {
                required: true,
            },
            storage_type: {
                required: true,
            },
            plot_type: {
                required: true,
            },
            building_id: {
                required: true,
            }
        },
        messages: {
            property_category: {
                required: " Property category is required.",
            },
            flat_type: {
                required: "Flat type is required.",
            },
            office_type: {
                required: "Office type is required.",
            },
            retail_type: {
                required: "Retail type is required.",
            },
            storage_type: {
                required: "Storage type is required.",
            },
            plot_type: {
                required: "Plot type is required.",
            }
        }
    });

    var add_property_form = {
        init: function () {
            var navListItems = $("div.setup-panel div button"),
                allWells = $(".setup-content"),
                allNextBtn = $(".nextBtn");
                allWells.hide();
                navListItems.click(function (e) {
                    e.preventDefault();
                    property_form_validation.validate().settings.ignore = ":disabled,:hidden";
                    if(property_form_validation.valid()){
                        var $target = $($(this).data("action")),
                            $item = $(this);
                        if (!$item.hasClass("disabled")) {
                            navListItems.removeClass("btn btn-primary").addClass("btn btn-light");
                            $item.addClass("btn btn-primary");
                            allWells.hide();
                            $target.show();
                            $target.find("input:eq(0)").focus();
                        }
                    }
                }),
                allNextBtn.click(function () {
                    property_form_validation.validate().settings.ignore = ":disabled,:hidden";
                    if(property_form_validation.valid()){
                        var curStep = $(this).closest(".setup-content"),
                            curStepBtn = curStep.attr("id"),
                            nextStepWizard = $('div.setup-panel div button[data-action="#' + curStepBtn + '"]')
                                .parent()
                                .next()
                                .children("button"),
                            curInputs = curStep.find("input[type='text'],input[type='url']"),
                            isValid = true;
                        $(".form-group").removeClass("has-error");
                        for (var i = 0; i < curInputs.length; i++) {
                            if (!curInputs[i].validity.valid) {
                                isValid = false;
                                $(curInputs[i]).closest(".form-group").addClass("has-error");
                            }
                        }
                        if (isValid) nextStepWizard.removeAttr("disabled").trigger("click");
                    }
                });
                $("div.setup-content:first").show();
        },
    };

    (function ($) {
        "use strict";
        add_property_form.init();
    })(jQuery);
})(jQuery);