"use strict";

const _datatablesTranslate = {
    records: {
        processing: "Por favor aguarde",
        noRecords: "Nenhum resultado encontrado"
    },
    toolbar: {
        pagination: {
            items: {
                default: {
                    first: 'Primeira',
                    prev: 'Anterior',
                    next: 'Próxima',
                    last: 'Última',
                    more: 'Mais Páginas',
                    input: 'Número da Página',
                    select: 'Selecione a quantidade de registros'
                },
                info: 'Exibindo {{start}} - {{end}} de {{total}} registros'
            }
        }
    }
};

const _datatablesTranslateRating = {
    records: {
        processing: "Por favor aguarde",
        noRecords: "Seja o primeiro a avaliar essa obra!"
    },
    toolbar: {
        pagination: {
            items: {
                default: {
                    first: 'Primeira',
                    prev: 'Anterior',
                    next: 'Próxima',
                    last: 'Última',
                    more: 'Mais Páginas',
                    input: 'Número da Página',
                    select: 'Selecione a quantidade de registros'
                },
                info: 'Exibindo {{start}} - {{end}} de {{total}} registros'
            }
        }
    }
};

const _DefaultKTDatatablesOptions = {
    // datasource definition
    data: {
        type: 'remote',
        source: {
            read: {
                url: '',
                //params: {
                //    'idEmpresa': 1101
                //},
                //method: 'GET'
                // sample custom headers
                // headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                //contentType: 'application/json',
                map: function (raw) {
                    // sample data mapping
                    var dataSet = raw;
                    if (typeof raw.data !== 'undefined') {
                        dataSet = raw.data;
                    }
                    return dataSet;
                },
            },
        },
        pageSize: 10,
        serverPaging: true,
        serverFiltering: true,
        serverSorting: true,
        saveState: false
    },

    // layout definition
    layout: {
        scroll: false,
        footer: false,
        spinner: {
            message: "Aguarde..."
        }
    },

    toolbar: {
        layout: ['info', 'pagination']
    },

    translate: _datatablesTranslate,

    // column sorting
    sortable: true,

    pagination: true,

    // columns definition
    columns: [{
        field: 'Id',
        title: '#',
        sortable: false,
        width: 30,
        type: 'number',
        selector: false,
        textAlign: 'center',
    }, {
        field: 'Nome',
        title: 'Nome'
    }, {
        field: 'Descricao',
        title: 'Descrição'
    }, {
        field: 'Acoes',
        title: 'Ações',
        sortable: false,
        width: 165,
        overflow: 'visible',
        autoHide: false,
        template: function (row) {
            var idElemento = row.Id;
            return '\
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2 edit" data-id="'+ idElemento + '" data-toggle="tooltip" title="Editar Registro">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon delete" data-id="'+ idElemento + '" data-toggle="tooltip" title="Deletar">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                         <a href="javascript:;" class="btn btn-sm btn-clean btn-icon detail" data-id="'+ idElemento + '" data-toggle="tooltip" title="Visualizar">\
                               <i class="ki ki-eye icon-md"></i>\
                            </a>\
                    ';
        },
    }],

};

const _TemplateActions = function (row) {
    var idElemento = row.Id;
    return '\
                        <a href="javascript:;"  class="btn btn-sm btn-clean btn-icon mr-2 edit" data-id="'+ idElemento + '" data-toggle="tooltip" title="Alterar">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon delete" data-id="'+ idElemento + '" data-toggle="tooltip" title="Excluir">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                          <a href="javascript:;" class="btn btn-sm btn-clean btn-icon detail" data-id="'+ idElemento + '" data-toggle="tooltip" title="Visualizar">\
                               <i class="ki ki-eye"></i>\
                            </a>\
                    ';
};

var KTLayoutQuickPanel = function () {
    // Private properties
    var _element;
    var _offcanvasObject;
    var _notificationsElement;
    var _logsElement;
    var _settingsElement;

    // Private functions
    var _getContentHeight = function () {
        var height;

        var header = KTUtil.find(_element, '.offcanvas-header');
        var content = KTUtil.find(_element, '.offcanvas-content');

        var height = parseInt(KTUtil.getViewPort().height);

        if (header) {
            height = height - parseInt(KTUtil.actualHeight(header));
            height = height - parseInt(KTUtil.css(header, 'marginTop'));
            height = height - parseInt(KTUtil.css(header, 'marginBottom'));
        }

        if (content) {
            height = height - parseInt(KTUtil.css(content, 'marginTop'));
            height = height - parseInt(KTUtil.css(content, 'marginBottom'));
        }

        height = height - parseInt(KTUtil.css(_element, 'paddingTop'));
        height = height - parseInt(KTUtil.css(_element, 'paddingBottom'));

        height = height - 2;

        return height;
    }

    var _init = function () {
        _offcanvasObject = new KTOffcanvas(_element, {
            overlay: true,
            baseClass: 'offcanvas',
            placement: 'right',
            closeBy: 'kt_quick_panel_close',
            toggleBy: 'kt_quick_panel_toggle'
        });
    }

    var _initNotifications = function () {
        KTUtil.scrollInit(_notificationsElement, {
            mobileNativeScroll: true,
            resetHeightOnDestroy: true,
            handleWindowResize: true,
            height: function () {
                return _getContentHeight();
            }
        });
    }

    var _initLogs = function () {
        KTUtil.scrollInit(_logsElement, {
            mobileNativeScroll: true,
            resetHeightOnDestroy: true,
            handleWindowResize: true,
            height: function () {
                return _getContentHeight();
            }
        });
    }

    var _initSettings = function () {
        KTUtil.scrollInit(_settingsElement, {
            mobileNativeScroll: true,
            resetHeightOnDestroy: true,
            handleWindowResize: true,
            height: function () {
                return _getContentHeight();
            }
        });
    }

    var _updateScrollbars = function () {
        $(_element).find('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            KTUtil.scrollUpdate(_notificationsElement);
            KTUtil.scrollUpdate(_logsElement);
            KTUtil.scrollUpdate(_settingsElement);
        });
    }

    // Public methods
    return {
        init: function (id) {
            _element = KTUtil.getById(id);
            _notificationsElement = KTUtil.getById('kt_quick_panel_notifications');
            _logsElement = KTUtil.getById('kt_quick_panel_logs');
            _settingsElement = KTUtil.getById('kt_quick_panel_settings');

            _init();
            _initNotifications();
            _initLogs();
            _initSettings();

            _updateScrollbars();
        }
    };
}();


