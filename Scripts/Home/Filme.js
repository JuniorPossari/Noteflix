"use strict";

var FilmeAPI = function() {   

    var urlObterConteudoNota = "/Home/ObterConteudoNotaFilme/";
    var urlObterConteudoNotaGeral = "/Home/ObterConteudoNotaGeralFilme/";
    var urlListarAvaliacoesFilme = "/Home/ListarAvaliacoesFilme/";
    var urlSalvarNota = "/Home/SalvarNotaFilme/";
    var urlExcluirNota = "/Home/ExcluirNotaFilme/";

    var datatable = null;    

    var table = function () {

        datatable = null;

        datatable = $('#kt_datatable').KTDatatable({

            data: {
                saveState: { cookie: false },
                pageSize: 10                
            },

            rows: {
                autoHide: false,                
            },

            toolbar: {
                layout: ['info', 'pagination']
            },

            layout: {
                class: 'tabela-noteflix'
            },
           
            columns: [
                {
                    field: 'avaliacoes',
                    sortable: false,
                    selector: false,

                }
            ],

            translate: _datatablesTranslateRating,

        });
        
        datatable.on('datatable-on-layout-updated', function(){
            $(this).removeClass('d-none');
            $('.observacao').shorten({
                showChars: 1000,
                moreText: 'Ver mais',
                lessText: 'Ver menos'
            });
            KTApp.unblockPage();
        });

    };

    var OnClickAbrirModalNota = function(){

        $('#btnAbrirModalNota').on('click', function(){
            
            KTApp.blockPage({
                overlayColor: '#000000',
                state: 'info', // a bootstrap color
                message: 'Aguarde...'
            });

            var idFilme = $('#hdnIdFilme').val();                       				

            $.ajax({
                url: urlObterConteudoNota + idFilme,
                type: 'GET',
                success: function (data) {
                    
                    $('#ConteudoNota').html(data);

                    OnClickNota();
                    
                    var nota = $('.radio-nota:checked').val();
                    if(nota != '0.0'){
                        $('#btnRemoverNota').removeClass('d-none');
                        $('#btnSalvarNota').html('Alterar');
                    }

                    $('#modalNota').modal('show');

                    KTApp.unblockPage();

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

        });

    }

    var OnCloseModalNota = function(){
        $('#modalNota').on('hidden.bs.modal', function () {
            $('#btnRemoverNota').addClass('d-none');
        });
    }
    
    var OnClickNota = function(){
        $('.radio-nota').off().on('click', function(){

            var nota = $('.radio-nota:checked').val();

            $('.myratings').removeClass('nota-baixa');
            $('.myratings').removeClass('nota-media');
            $('.myratings').removeClass('nota-alta');
            
            if (nota < 2) {
                $('.myratings').addClass('nota-baixa');
            }
            else if (nota >= 2 && nota <= 3) {
                $('.myratings').addClass('nota-media');
            }
            else{
                $('.myratings').addClass('nota-alta');                
            }

            $(".myratings").text(nota);

        });
    };

    var OnClickRemoverNota = function(){
        $('#btnRemoverNota').on('click', function(){

            swal.fire({
                title: "Você tem certeza?",
                html: "Sua avaliação desse filme sera removida! Realmente deseja continuar?",
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
                    
                    var idFilme = $('#hdnIdFilme').val();
    
                    $.ajax({
                        url: urlExcluirNota,
                        type: 'POST',
                        dataType: "html",
                        data: {"id":idFilme},
                        success: function (json) {
    
                            var data = JSON.parse(json);

                            if(data.Ok){
                                $('#btnAbrirModalNota i').removeClass('text-warning');	
                                $('#ConteudoNotaGeral').load(urlObterConteudoNotaGeral + idFilme);	
                                $('#Avaliacoes').load(urlListarAvaliacoesFilme + idFilme, function() {
                                    table();
                                });					
                                $('#modalNota').modal('toggle');
                            }
    
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

    var OnClickSalvarNota = function(){

        $('#btnSalvarNota').on('click', function(){

            var idFilme = $('#hdnIdFilme').val();
            var nota = $('.radio-nota:checked').val();
            var observacao = $('#txtObservacao').val();

            if(!idFilme || !nota){
                return swal.fire({
                    title: "Aviso",
                    text: "Desculpe, houve um erro!",
                    icon: "error",
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                });
            }

            if(nota == "0.0"){
                return swal.fire({
                    title: "Aviso",
                    text: "É necessário selecionar uma nota!",
                    icon: "error",
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                });
            }

            if(nota != "0.5" && nota != "1.0" && nota != "1.5" && nota != "2.0" && nota != "2.5" && nota != "3.0" && nota != "3.5" && nota != "4.0" && nota != "4.5" && nota != "5.0"){
                return swal.fire({
                    title: "Aviso",
                    text: "Desculpe, não é possível salvar essa nota!",
                    icon: "error",
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                });
            }

            if(!observacao){
                return swal.fire({
                    title: "Aviso",
                    text: "É necessário deixar uma observação sobre o filme!",
                    icon: "error",
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                });
            }

            var newlines = observacao.split("\n").length; 
            if(newlines > 10){
                return swal.fire({
                    title: "Aviso",
                    text: "Desculpe, só é permitido no máximo 20 quebras de linha na observação!",
                    icon: "error",
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                });
            }

            swal.fire({
                title: "Você tem certeza?",
                text: "Realmente deseja salvar essa nota?",
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

                    var dados = {};

                    dados.IdFilme = idFilme;
                    dados.Nota = nota;
                    dados.Observacao = observacao;                                                                            				
    
                    $.ajax({
                        url: urlSalvarNota,
                        type: 'POST',
                        dataType: "html",
                        data: {"dados":dados},
                        success: function (json) {
                            
                            var data = JSON.parse(json);

                            if(data.Ok){
                                $('#btnAbrirModalNota i').addClass('text-warning');	
                                $('#ConteudoNotaGeral').load(urlObterConteudoNotaGeral + idFilme);		
                                $('#Avaliacoes').load(urlListarAvaliacoesFilme + idFilme, function() {
                                    table();
                                });				
                                $('#modalNota').modal('toggle');
                            }
    
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

    }

    var OnClickAbrirModalTrailer = function(){
        $('.btnAbrirModalTrailer').on('click', function () {
            var embed = $(this).data('embed');
            $('#modalTrailer iframe').attr('src', embed);
        });
    }

    var OnCloseModalTrailer = function(){
        $('#modalTrailer').on('hidden.bs.modal', function () {
            $('#modalTrailer iframe').attr('src', '');
        });
    }
    
    return {
        
        initIndex: function() {
            
            OnClickAbrirModalTrailer();
            OnCloseModalTrailer();
            OnClickAbrirModalNota();  
            OnCloseModalNota();          
            OnClickRemoverNota();
            OnClickSalvarNota();
            table();
            
        }

    };
}();
