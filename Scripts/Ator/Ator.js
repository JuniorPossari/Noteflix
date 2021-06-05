"use strict";

var AtorAPI = function() {

    var urlSalvar = "/Noteflix/Ator/Salvar/";
    var urlSuccess = "/Noteflix/Ator/Index/";

    var validation = null;
    
    var Validar = function(){

        validation = FormValidation.formValidation(
			KTUtil.getById('Form'),
			{
				fields: {
					AtorNome: {
						validators: {
							notEmpty: {
								message: 'O nome do ator é obrigatório!'
							},
						},
					},
				},
				plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

    }

    var Salvar = function(){

        $('#Salvar').on('click', function(){

            swal.fire({
                title: "Você tem certeza?",
                text: "Realmente deseja salvar esse ator?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sim",
                cancelButtonText: "Não",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-primary",
                    cancelButton: "btn font-weight-bold btn-light"
                }
            }).then(function(result) {
                if(result.value){
    
                    validation.validate().then(function(status) {
                        if (status == 'Valid') {
            
                            KTApp.blockPage({
                                overlayColor: '#000000',
                                state: 'info', // a bootstrap color
                                message: 'Aguarde...'
                            });
                            
                            var elencoNome = $('#AtorNome').val();					
            
                            $.ajax({
                                url: urlSalvar,
                                type: 'POST',
                                dataType: "html",
                                data: {"elencoNome":elencoNome},
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
                                            window.location.href = urlSuccess;
                                        }
                                        else{        
                                            
                                            
                                        }
    
                                    });  
                
                                },
                                error: function () {
                
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
                                text: "Você deve preencher todos os campos!",
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
    
                }
    
            });

        });

    }

    
    return {
        
        initIndex: function() {
            
        },
        initCadastrar: function() {

            Validar();
            Salvar();
            
        },
        initAlterar: function() {

            Validar();
            
        },
        initVisualizar: function() {
            
        }

    };
}();
