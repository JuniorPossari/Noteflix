"use strict";

var DiretorAPI = function() {

    var urlSalvar = "/Noteflix/Diretor/Salvar/";
    var urlSalvarAlteracao = "/Noteflix/Diretor/SalvarAlteracao/";
    var urlVisualizar = "/Noteflix/Diretor/Visualizar/";
    var urlAlterar = "/Noteflix/Diretor/Alterar/";
    var urlExcluir = "/Noteflix/Diretor/Excluir/";
    var urlSuccess = "/Noteflix/Diretor/Index/";

    var validation = null;    

    var table = function () {

        $('#kt_datatable').KTDatatable({

            data: {
                saveState: { cookie: false },
                pageSize: 10                
            },

            rows: {
                autoHide: false,                
            },

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            toolbar: {
                layout: ['info', 'pagination']
            },

            layout: {
                class: 'tabela-noteflix'
            },
           
            columns: [
                {
                    field: 'id',
                    textAlign: 'center',
                    sortable: false,
                    width: 50,
                    type: 'number',
                    selector: false,

                }, {
                    field: 'nome',
                    textAlign: 'center',
                    width: 180

                }, {
                    field: 'action',
                    textAlign: 'center',
                    sortable: false,
                    overflow: 'visible',
                    autoHide: false,
                    width: 100                    

                }
            ],

            translate: _datatablesTranslate,

        });    
        
        $('#kt_datatable').removeClass('d-none');

    };

    var OnClickVisualizar = function () {
        $('#kt_datatable').on('click', '.view', function () {
            var idElement = $(this).data('id');
            window.location.href = urlVisualizar + idElement;
        });
    }

    var OnClickAlterar = function () {
        $('#kt_datatable').on('click', '.edit', function () {
            var idElement = $(this).data('id');
            window.location.href = urlAlterar + idElement;
        });
    };

    var OnClickExcluir = function () {
        $('#kt_datatable').on('click', '.delete', function () {

            var idElement = $(this).data('id');

            swal.fire({
                title: "Você tem certeza?",
                text: "Realmente deseja excluir esse diretor?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sim",
                cancelButtonText: "Não",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-danger",
                    cancelButton: "btn font-weight-bold btn-light"
                }
            }).then(function(result) {
                if(result.value){
            
                    KTApp.blockPage({
                        overlayColor: '#000000',
                        state: 'info', // a bootstrap color
                        message: 'Aguarde...'
                    });					
    
                    $.ajax({
                        url: urlExcluir,
                        type: 'POST',
                        dataType: "html",
                        data: {"id":idElement},
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
                            
                       
    
                }
    
            });
            
        });
    };
    
    var Validar = function(){

        validation = FormValidation.formValidation(
			KTUtil.getById('Form'),
			{
				fields: {
					DiretorNome: {
						validators: {
							notEmpty: {
								message: 'O nome do diretor é obrigatório!'
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

    var OnClickSalvar = function(){

        $('#Salvar').on('click', function(){

            swal.fire({
                title: "Você tem certeza?",
                text: "Realmente deseja cadastrar esse diretor?",
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
                            
                            var diretorNome = $('#DiretorNome').val();					
            
                            $.ajax({
                                url: urlSalvar,
                                type: 'POST',
                                dataType: "html",
                                data: {"diretorNome":diretorNome},
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
    
                }
    
            });

        });

    }

    var OnClickSalvarAlteracao = function(){

        $('#Salvar').on('click', function(){

            swal.fire({
                title: "Você tem certeza?",
                text: "Realmente deseja alterar esse diretor?",
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
                            
                            var diretorId = $('#IdElement').val();
                            var diretorNome = $('#DiretorNome').val();					
            
                            $.ajax({
                                url: urlSalvarAlteracao,
                                type: 'POST',
                                dataType: "html",
                                data: {"diretorId":diretorId, "diretorNome":diretorNome},
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
    
                }
    
            });

        });

    }

    
    return {
        
        initIndex: function() {

            table();
            OnClickVisualizar();
            OnClickAlterar();
            OnClickExcluir();
            
        },
        initCadastrar: function() {

            Validar();
            OnClickSalvar();
            
        },
        initAlterar: function() {

            Validar();
            OnClickSalvarAlteracao();
            
        },
        initVisualizar: function() {
            
        }

    };
}();
