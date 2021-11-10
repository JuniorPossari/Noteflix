"use strict";

var SerieAPI = function() {

    var urlListarSeries = "/Noteflix/Home/ListarSeries/";

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
                    field: 'series',
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

        $('#SerieCriador').select2({
            placeholder: "Selecione...",
            language: {
                noResults: function (params) {
                  return "Nenhum resultado encontrado";
                }
            }
        });

        $('#SerieAtor').select2({
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

        $('#SeriePrimeiroEP').datepicker({
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
            
            dados.Nome = $('#SerieNome').val();
            dados.DataInicio = $('#SerieDataInicio').val();
            dados.DataFim = $('#SerieDataFim').val();
            dados.IdCriador = $('#SerieCriador').val();
            dados.IdAtor = $('#SerieAtor').val();
            dados.IdGenero = $('#SerieGenero').val();
            dados.IdPlataforma = $('#SeriePlataforma').val();  
            dados.Ordem = $('.SerieOrdem:checked').val();                        				

            $.ajax({
                url: urlListarSeries,
                type: 'POST',
                dataType: "html",
                data: {"dados":dados},
                success: function (data) {
                    
                    $('#Series').html(data);
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
            
            $('#SerieNome').val('');
            $('#SerieCriador').select2("val", "0");
            $('#SerieAtor').select2("val", "0");
            $('#SerieGenero').select2("val", "0");
            $('#SeriePlataforma').select2("val", "0");
            $('#SerieDataInicio').val('');
            $('#SerieDataFim').val('');
            $('#MaiorNota').prop('checked', true);
            

        });
    }

    var OnClickAbrirModalTrailer = function(){
        $('#Series').on('click', '.btnAbrirModalTrailer', function () {
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
