"use strict";

// Class Definition
var KTLogin = function() {
    var _login;

	var urlSalvarUsuario = "/Usuario/SalvarUsuario/";
	var urlEntrar = "/Usuario/Entrar/";
	var urlEsqueciMinhaSenha = "/Usuario/EsqueciMinhaSenha/";

    var _showForm = function(form) {
        var cls = 'login-' + form + '-on';
        var form = 'kt_login_' + form + '_form';

        _login.removeClass('login-forgot-on');
        _login.removeClass('login-signin-on');
        _login.removeClass('login-signup-on');

        _login.addClass(cls);

        KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
    }

    var _handleSignInForm = function() {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			KTUtil.getById('kt_login_signin_form'),
			{
				fields: {
					email: {
						validators: {
							notEmpty: {
								message: 'O endereço de email é obrigatório!'
							},
                            regexp: {
								regexp: /^(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/,
								message: 'Esse não é um endereço de email valido!',
							}
						}
					},
					password: {
						validators: {
							notEmpty: {
								message: 'A senha é obrigatória!'
							}
						}
					}
				},
				plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        $('#kt_login_signin_submit').on('click', function (e) {
            e.preventDefault();

            validation.validate().then(function(status) {
		        if (status == 'Valid') {

					KTApp.blockPage({
						overlayColor: '#000000',
						state: 'info', // a bootstrap color
						message: 'Aguarde...'
					});
					
            		var email = $('#kt_login_signin_form input[name="email"]').val();
					var password = $('#kt_login_signin_form input[name="password"]').val();					

					$.ajax({
						url: urlEntrar,
						type: 'POST',
						dataType: "html",
						data: {"email":email, "password":password},
						success: function (json) {

							var data = JSON.parse(json);

							KTApp.unblockPage();

							if(data.Ok){
								var urlRedirect = "";	
								const queryString = window.location.search;
								const urlParams = new URLSearchParams(queryString);
								const url = urlParams.get('url');
								if(url)	urlRedirect = url;					
								window.location.href = "/" + urlRedirect;
							}
							else{

								swal.fire({
									title: data.MessageTitle,
									text: data.Message,
									icon: data.Ok ? "success" : "error",
									confirmButtonText: "Ok",
									customClass: {
										confirmButton: "btn font-weight-bold btn-light-primary"
									}
								}).then(function() {	
									KTUtil.scrollTop();	
								});
								
							}
			
							
		
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

        // Handle forgot button
        $('#kt_login_forgot').on('click', function (e) {
            e.preventDefault();
            _showForm('forgot');
        });

        // Handle signup
        $('#kt_login_signup').on('click', function (e) {
            e.preventDefault();
            _showForm('signup');
        });
    }

    var _handleSignUpForm = function(e) {
        var validation;
        var form = KTUtil.getById('kt_login_signup_form');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			form,
			{
				fields: {
					username: {
						validators: {
							notEmpty: {
								message: 'O nome de usuário é obrigatório!'
							},
                            regexp: {
                                regexp: /^(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/i,
                                message: 'O nome de usuário digitado é inválido!'
                            }
						}
					},
					email: {
                        validators: {
							notEmpty: {
								message: 'O endereço de email é obrigatório!'
							},
                            regexp: {
								regexp: /^(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/,
								message: 'Esse não é um endereço de email valido!',
							}
						}
					},
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
                    },
                    agree: {
                        validators: {
                            notEmpty: {
                                message: 'Você deve aceitar os termos de uso!'
                            }
                        }
                    },
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

        $('#kt_login_signup_submit').on('click', function (e) {
            e.preventDefault();

            validation.validate().then(function(status) {
		        if (status == 'Valid') {

					KTApp.blockPage({
						overlayColor: '#000000',
						state: 'info', // a bootstrap color
						message: 'Aguarde...'
					});

					var username = $('#kt_login_signup_form input[name="username"]').val();
            		var email = $('#kt_login_signup_form input[name="email"]').val();
					var password = $('#kt_login_signup_form input[name="password"]').val();
					var cpassword = $('#kt_login_signup_form input[name="cpassword"]').val();

					$.ajax({
						url: urlSalvarUsuario,
						type: 'POST',
						dataType: "html",
						data: {"username":username, "email":email, "password":password, "cpassword":cpassword},
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
									$('#kt_login_signup_form input[name="username"]').val('');
									$('#kt_login_signup_form input[name="email"]').val('');
									$('#kt_login_signup_form input[name="password"]').val('');
									$('#kt_login_signup_form input[name="cpassword"]').val('');
									$('#kt_login_signup_form input[name="username"]').removeClass('is-valid');
									$('#kt_login_signup_form input[name="email"]').removeClass('is-valid');
									$('#kt_login_signup_form input[name="password"]').removeClass('is-valid');
									$('#kt_login_signup_form input[name="cpassword"]').removeClass('is-valid');
									$('#kt_login_signup_form input[name="agree"]').prop('checked', false);
									_showForm('signin');									
									//window.location.href = "/Home/Index";
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
        $('#kt_login_signup_cancel').on('click', function (e) {
            e.preventDefault();

            _showForm('signin');
        });
    }

    var _handleForgotForm = function(e) {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			KTUtil.getById('kt_login_forgot_form'),
			{
				fields: {
					email: {
						validators: {
							notEmpty: {
								message: 'O endereço de email é obrigatório!'
							},
							regexp: {
								regexp: /^(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/,
								message: 'Esse não é um endereço de email valido!',
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        // Handle submit button
        $('#kt_login_forgot_submit').on('click', function (e) {
            e.preventDefault();

            validation.validate().then(function(status) {
		        if (status == 'Valid') {

					KTApp.blockPage({
						overlayColor: '#000000',
						state: 'info', // a bootstrap color
						message: 'Aguarde...'
					});

					var email = $('#kt_login_forgot_form input[name="email"]').val();

					$.ajax({
						url: urlEsqueciMinhaSenha,
						type: 'POST',
						dataType: "html",
						data: {"email":email},
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
									$('#kt_login_forgot_form input[name="email"]').val('');									
									_showForm('signin');					
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
        $('#kt_login_forgot_cancel').on('click', function (e) {
            e.preventDefault();

            _showForm('signin');
        });
    }

    // Public Functions
    return {
        // public functions
        init: function() {
            _login = $('#kt_login');

            _handleSignInForm();
            _handleSignUpForm();
            _handleForgotForm();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
});
