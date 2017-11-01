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
$("#subscriptionEdit").bootstrapValidator({
    fields: {
        account_name: {
            validators: {
                notEmpty: {
                    message: 'The Account Holder is required'
                }
            },
            required: true
        },
        account_type: {
            validators: {
                notEmpty: {
                    message: 'The Account Type is required'
                }
            },
            required: true
        },
        account_email: {
            validators: {
                notEmpty: {
                    message: 'The Account Email is required'
                }
            },
            required: true
        },
        subscribed_category: {
            validators: {
                notEmpty: {
                    message: 'The Subscribed Category is required'
                }
            },
            required: true
        },
        account_users: {
            validators: {
                notEmpty: {
                    message: 'The Account user is required'
                }
            },
            required: true
        },
        contracts_quantity: {
            validators: {
                notEmpty: {
                    message: 'The Contracts Quantity is required'
                }
            },
            required: true
        },
        subscription_country: {
            validators: {
                notEmpty: {
                    message: 'The Subscription Country is required'
                }
            },
            required: true
        },
        account_balance: {
            validators: {
                notEmpty: {
                    message: 'The Account Balance is required'
                }
            },
            required: true
        },
        contracts_quantity: {
            validators: {
                notEmpty: {
                    message: 'The Contracts Quantity is required'
                }
            },
            required: true
        },
        REFERENCE: {
            validators: {
                notEmpty: {
                    message: 'The Reference is required'
                }
            },
            required: true
        },
        account_status: {
            validators: {
                notEmpty: {
                    message: 'The Account Status is required'
                }
            },
            required: true
        },
        account_payment_status: {
            validators: {
                notEmpty: {
                    message: 'The Payment Status is required'
                }
            },
            required: true
        }
    }
});

$('#rootwizard').bootstrapWizard({
    'tabClass': 'nav nav-pills',
    'onNext': function(tab, navigation, index) {
        var $validator = $('#subscriptionEdit').data('bootstrapValidator').validate();
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
    var $validator = $('#subscriptionEdit').data('bootstrapValidator').validate();
    if ($validator.isValid()) {
        document.getElementById("subscriptionEdit").submit();
    }

});
$('#activate').on('ifChanged', function(event){
    $('#subscriptionEdit').bootstrapValidator('revalidateField', $('#activate'));
});