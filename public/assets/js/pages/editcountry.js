// bootstrap wizard//
$("#gender, #gender1").select2({
    theme:"bootstrap",
    placeholder:"",
    width: '100%'
});
$('input[type="checkbox"].custom-checkbox').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    increaseArea: '20%'
});
$("#dob").datetimepicker({
    format: 'YYYY-MM-DD',
    widgetPositioning:{
        vertical:'bottom'
    },
    keepOpen:false,
    useCurrent: false,
    maxDate: moment().add(1,'h').toDate()
});
$("#countryEditForm").bootstrapValidator({
    fields: {
        country_name: {
            validators: {
                notEmpty: {
                    message: 'The country name is required'
                }
            },
            required: true
        },
        country_code: {
            validators: {
                notEmpty: {
                    message: 'The country code is required'
                }
            },
            required: true
        },
        currency: {
            validators: {
                notEmpty: {
                    message: 'The currency is required'
                }
            },
            required: true
        },
        currency_code: {
            validators: {
                notEmpty: {
                    message: 'The currency code is required'
                }
            },
            required: true
        },
        basic_price: {
            validators: {
                notEmpty: {
                    message: 'The basic price is required'
                }
            },
            required: true
        },
        standard_price: {
            validators: {
                notEmpty: {
                    message: 'The standard price is required'
                }
            },
            required: true
        },
        premium_price: {
            validators: {
                notEmpty: {
                    message: 'The premium price is required'
                }
            },
            required: true
        },
        status: {
            validators: {
                notEmpty: {
                    message: 'The status is required'
                }
            },
            required: true
        }
    }
});

$('#rootwizard').bootstrapWizard({
    'tabClass': 'nav nav-pills',
    'onNext': function(tab, navigation, index) {
        var $validator = $('#countryEditForm').data('bootstrapValidator').validate();
        return $validator.isValid();
    },
    onTabClick: function(tab, navigation, index) {
        return false;
    },
    onTabShow: function(tab, navigation, index) {
        var $total = navigation.find('li').length;
        var $current = index + 1;

        // If it's the last tab then hide the last button and show the finish instead
        if ($current >= $total) {
            $('#rootwizard').find('.pager .next').hide();
            $('#rootwizard').find('.pager .finish').show();
            $('#rootwizard').find('.pager .finish').removeClass('disabled');
        } else {
            $('#rootwizard').find('.pager .next').show();
            $('#rootwizard').find('.pager .finish').hide();
        }
    }});

$('#rootwizard .finish').click(function () {
    var $validator = $('#countryEditForm').data('bootstrapValidator').validate();
    if ($validator.isValid()) {
        document.getElementById("countryEditForm").submit();
    }

});
$('#activate').on('ifChanged', function(event){
    $('#countryEditForm').bootstrapValidator('revalidateField', $('#activate'));
});