"use strict";

var FilmeAPI = function() {

    var urlListarFilmes = "/Noteflix/Home/ListarFilmes/";

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
                    field: 'filmes',
                    textAlign: 'center',
                    sortable: false,
                    selector: false,

                }
            ],

            translate: _datatablesTranslate,

        });
        
        datatable.on('datatable-on-layout-updated', function(){
            $(this).removeClass('d-none');
            KTApp.unblockPage();
        });

    };

    var Select2 = function(){

        $('#FilmeDiretor').select2({
            placeholder: "Selecione...",
            language: {
                noResults: function (params) {
                  return "Nenhum resultado encontrado";
                }
            }
        });

        $('#FilmeAtor').select2({
            placeholder: "Selecione...",
            language: {
                noResults: function (params) {
                  return "Nenhum resultado encontrado";
                }
            }
        });

        $('#FilmeGenero').select2({
            placeholder: "Selecione...",
            language: {
                noResults: function (params) {
                  return "Nenhum resultado encontrado";
                }
            }
        });

        $('#FilmePlataforma').select2({
            placeholder: "Selecione...",
            language: {
                noResults: function (params) {
                  return "Nenhum resultado encontrado";
                }
            },
            templateResult: function (option) {

                if(option.text == "Selecione..."){
                    var $span = $("<span>" + option.text + "</span>");
                    return $span;
                }
                
                var $span = $("<span><img class='mr-2' src='/Noteflix/Content/img/plataformas/" + option.id + ".png' style='height: 25px; width: auto;' /> " + option.text + "</span>");
                return $span;
                
            }
        });

    }

    var Datepicker = function(){

        $('#FilmeDataLancamento').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            format: 'dd/mm/yyyy',
            language: 'pt-BR',
            endDate: '+1d',
            datesDisabled: '+1d',
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });

    }

    var OnClickPesquisar = function(){

        $('#Pesquisar').on('click', function(){
            
            KTApp.blockPage({
                overlayColor: '#000000',
                state: 'info', // a bootstrap color
                message: 'Aguarde...'
            });

            var dados = {};
            
            dados.Nome = $('#FilmeNome').val();
            dados.DataInicio = $('#FilmeDataInicio').val();
            dados.DataFim = $('#FilmeDataFim').val();
            dados.IdDiretor = $('#FilmeDiretor').val();
            dados.IdAtor = $('#FilmeAtor').val();
            dados.IdGenero = $('#FilmeGenero').val();
            dados.IdPlataforma = $('#FilmePlataforma').val();  
            dados.Ordem = $('.FilmeOrdem:checked').val();                        				

            $.ajax({
                url: urlListarFilmes,
                type: 'POST',
                dataType: "html",
                data: {"dados":dados},
                success: function (data) {
                    
                    $('#Filmes').html(data);
                    table();

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

    var OnClickLimpar = function(){
        $('#Limpar').on('click', function () {
            
            $('#FilmeNome').val('');
            $('#FilmeDiretor').select2("val", "0");
            $('#FilmeAtor').select2("val", "0");
            $('#FilmeGenero').select2("val", "0");
            $('#FilmePlataforma').select2("val", "0");
            $('#FilmeDataInicio').val('');
            $('#FilmeDataFim').val('');
            $('#MaiorNota').prop('checked', true);

            $('#Pesquisar').trigger('click');            

        });
    }

    var OnClickAbrirModalTrailer = function(){
        $('#Filmes').on('click', '.btnAbrirModalTrailer', function () {
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

            table();
            Select2();
            Datepicker();
            OnClickPesquisar();
            OnClickLimpar();
            OnClickAbrirModalTrailer();
            OnCloseModalTrailer();
            
        }

    };
}();
