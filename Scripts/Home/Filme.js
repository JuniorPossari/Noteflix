"use strict";

var FilmeAPI = function() {

    var urlFilme = "/Noteflix/Home/Filme/";

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
                    field: 'filmes',
                    textAlign: 'center',
                    sortable: false,
                    selector: false,

                }
            ],

            translate: _datatablesTranslate,

        });     
        
        $('#kt_datatable').removeClass('d-none');

    };

    var Select2 = function(){

        $('.select2').select2({
            placeholder: "Selecione...",
            language: {
                noResults: function (params) {
                  return "Nenhum resultado encontrado";
                }
            },
            templateResult: function (option) {

                if(option.text == "Disney Plus"){
                    var $span = $("<span><img class='mr-2' src='/Noteflix/Content/img/plataformas/disney-plus.png' style='height: 25px; width: auto;' /> " + option.text + "</span>");
                    return $span;
                }
                else if(option.text == "Netflix"){
                    var $span = $("<span><img class='mr-2' src='/Noteflix/Content/img/plataformas/netflix.png' style='height: 25px; width: auto;' /> " + option.text + "</span>");
                    return $span;
                }
                else if(option.text == "Prime Video"){
                    var $span = $("<span><img class='mr-2' src='/Noteflix/Content/img/plataformas/prime-video.png' style='height: 25px; width: auto;' /> " + option.text + "</span>");
                    return $span;
                }

                var $span = $("<span>" + option.text + "</span>");
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
            endDate: '+1d',
            datesDisabled: '+1d',
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
            Select2();
            Datepicker();
            
        }

    };
}();
