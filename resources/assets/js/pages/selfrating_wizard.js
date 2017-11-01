// bootstrap wizard//
$("#gender, #gender1").select2({
    theme:"bootstrap",
    placeholder:"",
    width: '100%'
});


$("#selfRatingForm").bootstrapValidator({
    fields: {
        yourID: {
            validators: {
                notEmpty: {
                    message: 'Your ID Number is required'
                }
            },
            required: true,
            minlength: 3
        },
        taskTitle: {
            validators: {
                notEmpty: {
                    message: 'Task Name is required'
                }
            },
            required: true,
            minlength: 3
        },
        taskDescribe: {
            validators: {
                notEmpty: {
                    message: 'Task Description is required'
                }
            },
            required: true,
            minlength: 3
        },
        datetime3: {
            validators: {
                notEmpty: {
                    message: 'Incident time is required'
                }
            },
            required: true,
            minlength: 3
        },
        acceptTerms:{
            validators:{
                notEmpty:{
                    message: 'The checkbox must be checked'
                }
            }
        }
    }
});
$('#acceptTerms').on('ifChanged', function(event){
    $('#selfRatingForm').bootstrapValidator('revalidateField', $('#acceptTerms'));
});
$('#rootwizard').bootstrapWizard({
    'tabClass': 'nav nav-pills',
    'onNext': function(tab, navigation, index) {
        var $validator = $('#selfRatingForm').data('bootstrapValidator').validate();
        return $validator.isValid();
    },
    onTabClick: function(tab, navigation, index) {
        return false;
    },
    onTabShow: function(tab, navigation, index) {
        var $total = navigation.find('li').length;
        var $current = index+1;
        var $percent = ($current/$total) * 100;

        // If it's the last tab then hide the last button and show the finish instead
        if($current >= $total) {
            $('#rootwizard').find('.pager .next').hide();
            $('#rootwizard').find('.pager .finish').show();
            $('#rootwizard').find('.pager .finish').removeClass('disabled');
        } else {
            $('#rootwizard').find('.pager .next').show();
            $('#rootwizard').find('.pager .finish').hide();
        }
        $('#rootwizard .finish').click(function() {
            var $validator = $('#commentForm').data('bootstrapValidator').validate();
            if ($validator.isValid()) {
                $('#myModal').modal('show');
                return $validator.isValid();
                $('#rootwizard').find("a[href='#tab1']").tab('show');
            }
        });

    }});

$('input[type="checkbox"].custom-checkbox, input[type="radio"].custom-radio').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue',
    increaseArea: '20%'
});