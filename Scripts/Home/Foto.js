"use strict";

var FotoAPI = function () {

    var urlAlterarFoto = '/Noteflix/Usuario/AlterarFoto/';

    var fv = null;//formValidate
    var datatable = null;//instancia do datatables

    //Events
    //change
    var onChange = function () {
        var avatar5 = new KTImageInput('kt_profile_avatar');

        avatar5.on('change', function (imageInput) {

            KTApp.block('#kt_quick_user', {
                overlayColor: '#000000',
                state: 'success', // a bootstrap color
                size: 'lg' //available custom sizes: sm|lg
            });

            var file = imageInput.input.files[0];
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function () {
                var inputNovaFoto = document.getElementById('HdnNovaFoto');
                inputNovaFoto.value = reader.result.split(',')[1];
                var foto64 = inputNovaFoto.value;
                var idUsuario = $('#HdnIdUsuario').val();
                debugger

                if (reader.result == null || reader.result == "") {
                    KTApp.unblock('#kt_quick_user');

                    swal.fire({
                        text: 'Escolha um formato válido!',
                        icon: 'error',
                        buttonsStyling: false,
                        confirmButtonText: 'Ok!',
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    });
                }
                else {
                    $.ajax({
                        url: urlAlterarFoto,
                        type: 'POST',
                        dataType: "html",
                        data: { 'idUsuario': idUsuario, 'foto64': foto64 },
                        success: function (json) {


                            debugger;


                            var data = JSON.parse(json);

                            debugger;
                            KTApp.unblock('#kt_quick_user');

                            if (data.Ok) {
                                swal.fire({
                                    text: data.Message,
                                    icon: data.Ok ? "success" : "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok",
                                    customClass: {
                                        confirmButton: "btn font-weight-bold btn-light-primary"
                                    }
                                }).then(function() {
                                    
                                });
                            }
                            else {
                                debugger
                                var inputVelhaFoto = $('#HdnVelhaFoto').val();

                                if (inputVelhaFoto == "" || inputVelhaFoto == null)
                                    document.getElementById('kt_profile_avatar').style.backgroundImage = "url('/Noteflix/Content/img/sem-foto.png')";
                                else {
                                    var stringFoto = "url('" + inputVelhaFoto + "')";
                                    document.getElementById('kt_profile_avatar').style.backgroundImage = stringFoto;
                                }
                                
                                swal.fire({
                                    text: data.Message,
                                    icon: data.Ok ? "success" : "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok",
                                    customClass: {
                                        confirmButton: "btn font-weight-bold btn-light-primary"
                                    }
                                }).then(function() {
                                    
                                });
                                
                            }

                            
                        },
                        error: function () {
                            var inputVelhaFoto = $('#HdnVelhaFoto').val();

                            if (inputVelhaFoto == "" || inputVelhaFoto == null)
                                document.getElementById('kt_profile_avatar').style.backgroundImage = "url('/Noteflix/Content/img/sem-foto.png')";
                            else {
                                var stringFoto = "url('" + inputVelhaFoto + "')";
                                document.getElementById('kt_profile_avatar').style.backgroundImage = stringFoto;
                            }

                            KTApp.unblock('#kt_quick_user');

                            swal.fire({
                                text: "Desculpe, houve um erro na requisição!",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-primary"
                                }
                            }).then(function() {
                                
                            });
                        }
                    })
                    //end teste
                }
            };
        });

    }

    //cancel
    var onClickCancel = function () {

        KTApp.block('#kt_quick_user', {
            overlayColor: '#000000',
            state: 'success', // a bootstrap color
            size: 'lg' //available custom sizes: sm|lg
        });

        var avatar5 = new KTImageInput('kt_profile_avatar');
        avatar5.on('cancel', function (imageInput) {
            debugger;
            var foto64 = $('#HdnVelhaFoto').val();
            var idUsuario = $('#HdnIdUsuario').val();

            if (foto64 != ""){
                foto64 = foto64.split(',')[1];
            }                

            $.ajax({
                url: urlAlterarFoto,
                type: 'POST',
                dataType: "html",
                data: { 'idUsuario': idUsuario, 'foto64': foto64 },
                success: function (json) {

                    var data = JSON.parse(json);

                    debugger;
                    if (!data.Ok) {
                        var foto64atual = $('#HdnNovaFoto').val();
                        var stringFoto = "url('data:image;base64," + foto64atual + "')";
                        document.getElementById('kt_profile_avatar').style.backgroundImage = stringFoto;
                    }
                    else{
                        var stringFoto = "";
                        if (foto64 != ""){
                            stringFoto = "url('data:image;base64," + foto64 + "')";
                        }
                        else{
                            stringFoto = "url(/Noteflix/Content/img/sem-foto.png)";
                        } 
                        
                        document.getElementById('kt_profile_avatar').style.backgroundImage = stringFoto;
                    }
                    KTApp.unblock('#kt_quick_user');
                    swal.fire({
                        text: data.Message,
                        icon: data.Ok ? "success" : "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function() {
                        
                    });
                },

                error: function () {
                    var foto64atual = $('#HdnNovaFoto').val();
                    var stringFoto = "url('data:image;base64," + foto64atual + "')";
                    document.getElementById('kt_profile_avatar').style.backgroundImage = stringFoto;
                    swal.fire({
                        text: "Desculpe, houve um erro na requisição!",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function() {
                        
                    });
                }
            })
            //end teste

        });
    }

    //remove
    var onClickRemove = function () {

        KTApp.block('#kt_quick_user', {
            overlayColor: '#000000',
            state: 'success', // a bootstrap color
            size: 'lg' //available custom sizes: sm|lg
        });

        var avatar5 = new KTImageInput('kt_profile_avatar');
        avatar5.on('remove', function (imageInput) {
            debugger;
            var idUsuario = $('#HdnIdUsuario').val();

            $.ajax({
                url: urlAlterarFoto,
                type: 'POST',
                dataType: "html",
                data: { 'idUsuario': idUsuario, 'foto64': "" },
                success: function (json) {

                    var data = JSON.parse(json);

                    debugger;
                    if (data.Ok) {
                        document.getElementById('kt_profile_avatar').style.backgroundImage = "url('/Noteflix/Content/img/sem-foto.png')";                        
                    }
                    else {
                        var foto64atual = $('#HdnNovaFoto').val();
                        var stringFoto = "url('data:image;base64," + foto64atual + "')";
                        document.getElementById('kt_profile_avatar').style.backgroundImage = stringFoto;
                    }
                    KTApp.unblock('#kt_quick_user');
                    swal.fire({
                        text: data.Message,
                        icon: data.Ok ? "success" : "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function() {
                        
                    });

                },

                error: function () {
                    var foto64atual = $('#HdnNovaFoto').val();
                    var stringFoto = "url('data:image;base64," + foto64atual + "')";
                    document.getElementById('kt_profile_avatar').style.backgroundImage = stringFoto;
                    KTApp.unblock('#kt_quick_user');
                    swal.fire({
                        text: "Desculpe, houve um erro na requisição!",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function() {

                    });

                }
            })
            //end teste

        });
    }

    return {
        // public functions
        init: function () {
            onChange();
            onClickCancel();
            onClickRemove();
            KTApp.unblock('#kt_quick_user');
        },
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    FotoAPI.init();
});