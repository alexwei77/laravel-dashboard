jQuery(document).ready(function() {

jQuery("#basicForm").submit(function(e) {
	  e.preventDefault();
      //alert( "Handler for .submit() called." );
  //Form processing
  var $validator = $('#basicForm').data('bootstrapValidator').validate();
  if ($validator.isValid()) {
        document.getElementById("basicForm").submit();
    }

	});

   $("#standardForm").bootstrapValidator({
        fields: {
            first_name: {
                validators: {
                    notEmpty: {
                        message: 'First name is required'
                    }
                },
                required: true,
                minlength: 3
            },
            acceptTerms:{
            validators:{
                notEmpty:{
                    message: 'You must accept our terms and conditions'
                }
            }
         },
            last_name: {
                validators: {
                    notEmpty: {
                        message: 'Last name is required'
                    }
                },
                required: true,
                minlength: 3
            },
            companyname: {
                validators: {
                    notEmpty: {
                        message: 'The company name is required'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            tell_area_code: {
                validators: {
                    notEmpty: {
                        message: 'The Tell Area Code is required'
                    }
                }
            }
            ,
            company_phone: {
                validators: {
                    notEmpty: {
                        message: 'The company phone number is required'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Password is required'
                    },
                    different: {
                        field: 'first_name,last_name',
                        message: 'Password should not match first or last name'
                    }
                }
            },
            password_confirm: {
                validators: {
                    notEmpty: {
                        message: 'Confirm Password is required'
                    },
                    identical: {
                        field: 'password',
                        message: 'The two passwords entered must match'
                    },
                    different: {
                        field: 'first_name,last_name',
                        message: 'Confirm Password should match with password'
                    }
                }
            }
        }
    });

//Business
$("#businessForm").bootstrapValidator({
    fields: {
        companyname: {
            validators: {
                notEmpty: {
                    message: 'Company Name field is required'
                }
            },
            required: true
        },
	  registrationnumber: {
            validators: {
                notEmpty: {
                    message: 'Company Registration Number field is required'
                }
            },
            required: true
        },
	  first_name: {
            validators: {
                notEmpty: {
                    message: 'Account Admin First Name field is required'
                }
            },
            required: true
        },
        last_name: {
            validators: {
                notEmpty: {
                    message: 'Account Admin Last Name field is required'
                }
            },
            required: true
        },
        email: {
            validators: {
                notEmpty: {
                    message: 'Email field is required'
                }
            },
            required: true
        },
        password: {
            validators: {
                notEmpty: {
                    message: 'Password field is required'
                }
            },
            required: true
        },
        password_confirm: {
            validators: {
                notEmpty: {
                    message: 'Confirm Password is required'
                }
            },
            required: true
        },
        acceptTerms:{
            validators:{
                notEmpty:{
                    message: 'You must accept our terms and conditions'
                }
            }
         }
    }
});

//Professional
$("#professionalForm").bootstrapValidator({
    fields: {
        companyname: {
            validators: {
                notEmpty: {
                    message: 'Company Name field is required'
                }
            },
            required: true
        },
	  registrationnumber: {
            validators: {
                notEmpty: {
                    message: 'Company Registration Number field is required'
                }
            },
            required: true
        },
	  first_name: {
            validators: {
                notEmpty: {
                    message: 'Account Admin First Name field is required'
                }
            },
            required: true
        },
        last_name: {
            validators: {
                notEmpty: {
                    message: 'Account Admin Last Name field is required'
                }
            },
            required: true
        },
        email: {
            validators: {
                notEmpty: {
                    message: 'Email field is required'
                }
            },
            required: true
        },
        password: {
            validators: {
                notEmpty: {
                    message: 'Password field is required'
                }
            },
            required: true
        },
        password_confirm: {
            validators: {
                notEmpty: {
                    message: 'Confirm Password is required'
                }
            },
            required: true
        },
        acceptTerms:{
            validators:{
                notEmpty:{
                    message: 'You must accept our terms and conditions'
                }
            }
         }
    }
});

//Enterprise
$("#enterpriseForm").bootstrapValidator({
    fields: {
        companyname: {
            validators: {
                notEmpty: {
                    message: 'Company Name field is required'
                }
            },
            required: true
        },
	  registrationnumber: {
            validators: {
                notEmpty: {
                    message: 'Company Registration Number field is required'
                }
            },
            required: true
        },
	  first_name: {
            validators: {
                notEmpty: {
                    message: 'Account Admin First Name field is required'
                }
            },
            required: true
        },
        last_name: {
            validators: {
                notEmpty: {
                    message: 'Account Admin Last Name field is required'
                }
            },
            required: true
        },
        email: {
            validators: {
                notEmpty: {
                    message: 'Email field is required'
                }
            },
            required: true
        },
        password: {
            validators: {
                notEmpty: {
                    message: 'Password field is required'
                }
            },
            required: true
        },
        password_confirm: {
            validators: {
                notEmpty: {
                    message: 'Confirm Password is required'
                }
            },
            required: true
        },
        acceptTerms:{
            validators:{
                notEmpty:{
                    message: 'You must accept our terms and conditions'
                }
            }
         }
    }
});

//Elite
$("#eliteForm").bootstrapValidator({
    fields: {
        companyname: {
            validators: {
                notEmpty: {
                    message: 'Company Name field is required'
                }
            },
            required: true
        },
	  registrationnumber: {
            validators: {
                notEmpty: {
                    message: 'Company Registration Number field is required'
                }
            },
            required: true
        },
	  first_name: {
            validators: {
                notEmpty: {
                    message: 'Account Admin First Name field is required'
                }
            },
            required: true
        },
        last_name: {
            validators: {
                notEmpty: {
                    message: 'Account Admin Last Name field is required'
                }
            },
            required: true
        },
        email: {
            validators: {
                notEmpty: {
                    message: 'Email field is required'
                }
            },
            required: true
        },
        password: {
            validators: {
                notEmpty: {
                    message: 'Password field is required'
                }
            },
            required: true
        },
        password_confirm: {
            validators: {
                notEmpty: {
                    message: 'Confirm Password is required'
                }
            },
            required: true
        },
        acceptTerms:{
            validators:{
                notEmpty:{
                    message: 'You must accept our terms and conditions'
                }
            }
         }
    }
});

//Standard processing 
jQuery("#standardForm").submit(function(e) {
	 // e.preventDefault();
      //alert( "Handler for .submit() called." );
  //Form processing

	});

 $("#standardForm").bootstrapValidator({
    fields: {
        countryName: {
            validators: {
                notEmpty: {
                    message: 'The country field is required'
                }
            },
            required: true
        },
	  accountType: {
            validators: {
                notEmpty: {
                    message: 'The Account Type field is required'
                }
            },
            required: true
        },
	  accountCategory: {
            validators: {
                notEmpty: {
                    message: 'The Account Category field is required'
                }
            },
            required: true
        },
        acceptTerms:{
            validators:{
                notEmpty:{
                    message: 'You must accept our terms and conditions'
                }
            }
        },
        acceptTerms:{
            validators:{
                notEmpty:{
                    message: 'You must accept our terms and conditions'
                }
            }
         }
    }
});


//Premium processing 
jQuery("#premiumForm").submit(function(e) {
	  //e.preventDefault();
      //alert( "Handler for .submit() called." );
  //Form processing

	});

 $("#premiumForm").bootstrapValidator({
    fields: {
        countryName: {
            validators: {
                notEmpty: {
                    message: 'The country field is required'
                }
            },
            required: true
        },
	  accountType: {
            validators: {
                notEmpty: {
                    message: 'The Account Type field is required'
                }
            },
            required: true
        },
	  accountCategory: {
            validators: {
                notEmpty: {
                    message: 'The Account Category field is required'
                }
            },
            required: true
        },
        acceptTerms:{
            validators:{
                notEmpty:{
                    message: 'You must accept our terms and conditions'
                },
            required: true
            }
        },
        acceptTerms:{
            validators:{
                notEmpty:{
                    message: 'You must accept our terms and conditions'
                }
            }
         }
    }
});

$('#activate').on('ifChanged', function(event){
    $('#submitUpgradeDowngrade').bootstrapValidator('revalidateField', $('#activate'));
});

//When Basic is tabbed on the subscribe page 
//basicTab
jQuery("#basicTab").click(function() {
	//alert("basic clicked");
	jQuery("#collapseOne").removeClass( "panel-collapse collapse" ).addClass( "panel-collapse collapse in" );
	jQuery("#collapseTwo").removeClass( "panel-collapse collapse in" ).addClass( "panel-collapse collapse");
	jQuery("#collapseThree").removeClass( "panel-collapse collapse in" ).addClass( "panel-collapse collapse" );
});


});