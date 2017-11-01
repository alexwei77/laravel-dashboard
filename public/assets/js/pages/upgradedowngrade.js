// bootstrap wizard//
$("#gender, #gender1").select2({
    theme:"bootstrap",
    placeholder:"",
    width: '100%'
});
$('input[type="checkbox"].custom-checkbox, input[type="radio"].custom-radio').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue',
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
$("#submitUpgradeDowngrade").bootstrapValidator({
    fields: {
        acceptTerms:{
            validators:{
                notEmpty:{
                    message: 'You must accept our terms and conditions'
                }
            }
        }
    }
});

$('#rootwizard').bootstrapWizard({
    'tabClass': 'nav nav-pills',
    'onNext': function(tab, navigation, index) {
        var $validator = $('#submitUpgradeDowngrade').data('bootstrapValidator').validate();
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

        if($current == 3){
            //do the calculations and display the results 
            //alert("Do the calculation here");

            formData = {
            'periodChosen'          : jQuery('#period').val(),
            'packageChosen'         : jQuery('#packages').val(),
        };
           
           $("#amount_pay").text("loading...");

            $.ajax({
                type: 'GET',
                url: "upgradedowngrade",
                data: formData,
                dataType: 'json',
                success: function(data){
                // do stuff
               // alert(data)
                 // $("#package_cost").text(data.amountrefund); //data.REFERENCE
                  $("#credit_worth").text("$" + data.amountrefund);
                  $("#amount_pay").text("$" + data.amountdue);
                  $("#additional_amount").text("$" + data.additionalAmount);
                   $("#PROCESS_NOW_AMOUNT").val(data.additionalAmount);
                  $("#amoun_to_pay").val(data.additionalAmount);
                 }
              });
        }
    }});

$('#rootwizard .finish').click(function () {
    var $validator = $('#submitUpgradeDowngrade').data('bootstrapValidator').validate();
    if ($validator.isValid()) {
        document.getElementById("submitUpgradeDowngrade").submit();
    }

});
$('#activate').on('ifChanged', function(event){
    $('#submitUpgradeDowngrade').bootstrapValidator('revalidateField', $('#activate'));
});