"use strict";

var SerieAPI = function() {

    var urlSalvar = "/Noteflix/Serie/Salvar/";
    var urlSalvarAlteracao = "/Noteflix/Serie/SalvarAlteracao/";
    var urlVisualizar = "/Noteflix/Serie/Visualizar/";
    var urlAlterar = "/Noteflix/Serie/Alterar/";
    var urlExcluir = "/Noteflix/Serie/Excluir/";
    var urlSuccess = "/Noteflix/Serie/Index/";
    var urlFileCallback = "/Noteflix/Home/FileCallback/";
    var urlBuscarFoto = "/Noteflix/Ator/BuscarFoto/";

    var validation = null;
    var ObjDropzone = null;   

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
                    field: 'primeiroep',
                    textAlign: 'center',
                    width: 100

                }, {
                    field: 'ntemporada',
                    textAlign: 'center',
                    width: 120

                }, {
                    field: 'criador',
                    textAlign: 'center',
                    width: 120

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
                text: "Realmente deseja excluir essa série?",
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
					SerieNome: {
						validators: {
							notEmpty: {
								message: 'O nome da série é obrigatório!'
							},
						},
					},
                    SeriePrimeiroEp: {
						validators: {
							notEmpty: {
								message: 'A data do primeiro episódio é obrigatória!'
							},
						},
					},
                    SerieNumeroTemp: {
						validators: {
							notEmpty: {
								message: 'O numero de temporadas da série é obrigatório!'
							},
						},
					},
                    SerieCriador: {
						validators: {
							notEmpty: {
								message: 'O criador da série é obrigatório!'
							},
						},
					},
                    SerieElenco: {
						validators: {
							notEmpty: {
								message: 'O elenco da série é obrigatório!'
							},
						},
					},
                    SerieGenero: {
						validators: {
							notEmpty: {
								message: 'O gênero da série é obrigatório!'
							},
						},
					},
                    SerieFoto: {
						validators: {
							callback: {
                                callback: function(input) {

                                    var foto = localStorage.getItem('base64Foto');

                                    if(foto == null || foto == "" || typeof(foto) == "undefined"){
                                        return {
                                            valid: false,
                                            message: 'A foto da série é obrigatória!',
                                        };
                                    }
                                    else{
                                        return {
                                            valid: true,
                                        };
                                    }

                                }
                            },
						},
					},
                    SerieSinopse: {
						validators: {
							notEmpty: {
								message: 'A sinopse da série é obrigatória!'
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

    var UploadFoto = (blockClick) => {

        KTApp.blockPage({
            overlayColor: '#000000',
            state: 'info', // a bootstrap color
            message: 'Aguarde...'
        }); 
        
        var idElement = $('#IdElement').val();

        $.ajax({
            url: urlBuscarFoto,
            type: 'POST',
            dataType: "html",
            data: {"idElement":idElement},
            success: function (json) {

                var data = JSON.parse(json);

                KTApp.unblockPage();

                if (data.Result.url != null) {

                    localStorage.removeItem('base64Foto');
                    localStorage.setItem('base64Foto', data.Result.url.replace(/^data:image\/[a-z]+;base64,/, ""))
                    InitDropzone(data.Result, blockClick);

                } else {
                    InitDropzone("", blockClick);
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

    }

    var InitDropzone = (preloadFile, blockClick) => {

        ObjDropzone = $('.drop-zone').dropzone({
            url: urlFileCallback,
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 1,
            maxFilesize: 5, // MB
            thumbnailWidth: 310,
            thumbnailHeight: 420,
            addRemoveLinks: true,
            acceptedFiles: ".jpg,.jpeg",
            init: function () {
                this.on("addedfile", function (file) {                    

                    if (file.size > 1000000) {
                        return;
                    }

                    if (this.files[1] != null) {
                        this.removeFile(this.files[0]);
                    }

                    if (this.files[0] && $.inArray(this.files[0].type, ['image/jpeg', 'image/jpg', 'image/png']) == -1) {
                        return;
                    }

                    if (this.files[1] != null) {
                        this.removeFile(this.files[0]);
                    }
                    else if (this.files[0] instanceof Blob) {
                        var reader = new FileReader();
                        reader.onload = function (event) {
                            var base64String = event.target.result;
                            
                            localStorage.removeItem('base64Foto');
                            localStorage.setItem('base64Foto', base64String.replace(/^data:image\/[a-z]+;base64,/, ""))
                        };
                        reader.readAsDataURL(this.files[0]);

                    }                    

                });
                this.on("complete", function (file) {

                    if (!blockClick) {
                        $(".dz-remove").html("<div><span class='text-danger font-size-h6'>Remover</span></div>");
                    }
                    else {
                        $(".dz-remove").remove();
                    }
                    

                    ObjDropzone = this;


                });

                if (preloadFile) {
                    var mockFile = { name: preloadFile.name, size: preloadFile.size, type: 'image/jpg', dataUrl: " data:image/jpg;charset=utf-8;base64, " + preloadFile.url };
                    this.files.push(mockFile);
                    this.displayExistingFile(mockFile, " data:image/jpg;charset=utf-8;base64, " + preloadFile.url);
                }

                if (blockClick) {
                    this.disable();
                }

                this.on("error", function (file) {
                    this.removeFile(file);
                    localStorage.removeItem('base64Foto');
                });

            },
            addedFile: (file) => {
                console.log(file);
            },
            accept: function (file, done) {
                done();
            },
            error: (file, message, xhr) => {

                var erro = message;

                if (message == "You can't upload files of this type.") {
                    erro = "Esse tipo de arquivo não é permitido!";
                }
                
                if (message.substring(0, 15) == "File is too big") {
                    erro = "O tamanho máximo é de 1 MB!";
                }

                Swal.fire({
                    text: erro,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light"
                    }
                })

            }
        });

    }

    var OnClickSalvar = function(){

        $('#Salvar').on('click', function(){

            swal.fire({
                title: "Você tem certeza?",
                text: "Realmente deseja cadastrar essa série?",
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

                            var dados = {};

                            dados.Nome = $('#SerieNome').val();
                            dados.PrimeiroEpisodio = $('#SeriePrimeiroEpisodio').val();
                            dados.NumeroTemporada = $('#SerieNumeroTemporada').val();
                            dados.DataTermino = $('#SerieDataTermino').val();
                            dados.IdCriador = $('#SerieCriador').val();
                            dados.Elenco = $('#SerieElenco').val();
                            dados.Genero = $('#SerieGenero').val();
                            dados.Plataforma = $('#SeriePlataforma').val();
                            dados.Foto = localStorage.getItem('base64Foto');
                            dados.Sinopse = $('#SerieSinopse').val();                            				
            
                            $.ajax({
                                url: urlSalvar,
                                type: 'POST',
                                dataType: "html",
                                data: {"dados":dados},
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
                text: "Realmente deseja alterar essa série?",
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
                            
                            var dados = {};

                            dados.Id = $('#IdElement').val();
                            dados.Nome = $('#SerieNome').val();
                            dados.PrimeiroEpisodio = $('#SeriePrimeiroEpisodio').val();
                            dados.DataTermino = $('#SerieDataTermino').val();
                            dados.IdCriador = $('#SerieCriador').val();
                            dados.Elenco = $('#SerieElenco').val();
                            dados.Genero = $('#SerieGenero').val();
                            dados.Plataforma = $('#SeriePlataforma').val();
                            dados.Foto = localStorage.getItem('base64Foto');
                            dados.Sinopse = $('#SerieSinopse').val();					
            
                            $.ajax({
                                url: urlSalvarAlteracao,
                                type: 'POST',
                                dataType: "html",
                                data: {"dados":dados},
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

    var Select2 = function(){

        $('#SerieCriador').select2({
            placeholder: "Selecione...",
            language: {
                noResults: function (params) {
                  return "Nenhum resultado encontrado";
                }
            }
        });

        $('#SerieElenco').select2({
            placeholder: "Selecione...",
            language: {
                noResults: function (params) {
                  return "Nenhum resultado encontrado";
                }
            }
        });

        $('#SerieGenero').select2({
            placeholder: "Selecione...",
            language: {
                noResults: function (params) {
                  return "Nenhum resultado encontrado";
                }
            }
        });

        $('#SeriePlataforma').select2({
            placeholder: "Selecione...",
            language: {
                noResults: function (params) {
                  return "Nenhum resultado encontrado";
                }
            }
        });

    }

    var Datepicker = function(){

        $('#SeriePrimeiroEp').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            format: 'dd/mm/yyyy',
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });

        $('#SerieDataTermino').datepicker({
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
    
    return {
        
        initIndex: function() {

            table();
            OnClickVisualizar();
            OnClickAlterar();
            OnClickExcluir();
            
        },
        initCadastrar: function() {

            localStorage.removeItem('base64Foto');
            InitDropzone();
            Validar();
            Datepicker();
            Select2();
            OnClickSalvar();
            
        },
        initAlterar: function() {

            localStorage.removeItem('base64Foto');
            UploadFoto();
            Validar();
            Datepicker();
            Select2();
            OnClickSalvarAlteracao();
            
        },
        initVisualizar: function() {

            localStorage.removeItem('base64Foto');
            UploadFoto(true);
            Datepicker();
            Select2();
            
        }

    };
}();
