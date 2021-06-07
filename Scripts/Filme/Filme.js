"use strict";

var FilmeAPI = function() {

    var urlSalvar = "/Noteflix/Filme/Salvar/";
    var urlSalvarAlteracao = "/Noteflix/Filme/SalvarAlteracao/";
    var urlVisualizar = "/Noteflix/Filme/Visualizar/";
    var urlAlterar = "/Noteflix/Filme/Alterar/";
    var urlExcluir = "/Noteflix/Filme/Excluir/";
    var urlSuccess = "/Noteflix/Filme/Index/";

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
                text: "Realmente deseja excluir esse filme?",
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
					FilmeNome: {
						validators: {
							notEmpty: {
								message: 'O nome do filme é obrigatório!'
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
                text: "Realmente deseja cadastrar esse filme?",
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
                            
                            var filmeNome = $('#FilmeNome').val();					
            
                            $.ajax({
                                url: urlSalvar,
                                type: 'POST',
                                dataType: "html",
                                data: {"filmeNome":filmeNome},
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

    var OnClickSalvarAlteracao = function(){

        $('#Salvar').on('click', function(){

            swal.fire({
                title: "Você tem certeza?",
                text: "Realmente deseja alterar esse filme?",
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
                            
                            var filmeId = $('#FilmeId').val();
                            var filmeNome = $('#FilmeNome').val();					
            
                            $.ajax({
                                url: urlSalvarAlteracao,
                                type: 'POST',
                                dataType: "html",
                                data: {"filmeId":filmeId, "filmeNome":filmeNome},
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

    var Select2 = function(){

        $('#FilmeDiretor').select2({
            placeholder: "Selecione...",
        });

        $('#FilmeElenco').select2({
            placeholder: "Selecione..."
        });

        $('#FilmeGenero').select2({
            placeholder: "Selecione..."
        });

        $('#FilmePlataforma').select2({
            placeholder: "Selecione..."
        });

    }

    var Datepicker = function(){

        $('#FilmeDataLancamento').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            format: 'dd/mm/yyyy',
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });

    }

    var Timepicker = function(){

        $('#FilmeDuracao').timepicker({
            minuteStep: 1,
            defaultTime: '',
            showMeridian: false,
            snapToStep: true
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

            Timepicker();
            Datepicker();
            Select2();
            
        },
        initAlterar: function() {

            Timepicker();
            Datepicker();
            Select2();
            
        },
        initVisualizar: function() {

            Timepicker();
            Datepicker();
            Select2();
            
        }

    };
}();
