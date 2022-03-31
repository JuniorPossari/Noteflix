"use strict";

// Class Definition
var KTLogin = function() {
    var _login;

	var urlFinalizarRedefinicaoSenha = "/Usuario/FinalizarRedefinicaoSenha/";

    var _handleResetForm = function(e) {
        var validation;
        var form = KTUtil.getById('kt_login_reset_form');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			form,
			{
				fields: {					
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'A senha é obrigatória!'
                            }
                        }
                    },
                    cpassword: {
                        validators: {
                            notEmpty: {
                                message: 'A confirmação de senha é obrigatória!'
                            },
                            identical: {
                                compare: function() {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'A senha não confere!'
                            }
                        }
                    }
				},
				plugins: {
                    declarative: new FormValidation.plugins.Declarative({
                        html5Input: true,
                    }),
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        $('#kt_login_reset_submit').on('click', function (e) {
            e.preventDefault();

            validation.validate().then(function(status) {
		        if (status == 'Valid') {

					KTApp.blockPage({
						overlayColor: '#000000',
						state: 'info', // a bootstrap color
						message: 'Aguarde...'
					});

					var token = $('#kt_login_reset_form input[name="token"]').val();
            		var email = $('#kt_login_reset_form input[name="email"]').val();
					var password = $('#kt_login_reset_form input[name="password"]').val();
					var cpassword = $('#kt_login_reset_form input[name="cpassword"]').val();

					$.ajax({
						url: urlFinalizarRedefinicaoSenha,
						type: 'POST',
						dataType: "html",
						data: {"token":token, "email":email, "password":password, "cpassword":cpassword},
						success: function (json) {

							var data = JSON.parse(json);

							KTApp.unblockPage();
			
							swal.fire({
								title: data.MessageTitle,
								text: data.Message,
								icon: data.Ok ? "success" : "error",
								confirmButtonText: "Ok",
								customClass: {
									confirmButton: "btn font-weight-bold btn-light-primary"
								}
							}).then(function() {

								if(data.Ok){									
									window.location.href = "/Usuario/Login";
								}
								else{
									KTUtil.scrollTop();
								}

							});
		
						},
						error: function () {

							KTApp.unblockPage();
		
							swal.fire({
								title: "Aviso",
								text: "Desculpe, houve um erro na requisição!",
								icon: "error",
								confirmButtonText: "Ok",
								customClass: {
									confirmButton: "btn font-weight-bold btn-light-primary"
								}
							}).then(function() {
								KTUtil.scrollTop();
							});
			
						}
					});
                    
				} else {
					swal.fire({
						title: "Aviso",
		                text: "Você deve preencher todos os campos obrigatórios!",
		                icon: "error",
		                confirmButtonText: "Ok",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}
		            }).then(function() {
						KTUtil.scrollTop();
					});
				}
		    });
        });

        // Handle cancel button
        $('#kt_login_reset_cancel').on('click', function (e) {
            e.preventDefault();

            _showForm('signin');
        });
    }

    // Public Functions
    return {
        // public functions
        init: function() {
            _login = $('#kt_login');

            _handleResetForm();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
});
