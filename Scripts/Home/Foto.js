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

            KTApp.blockPage({
                overlayColor: '#000000',
                state: 'info', // a bootstrap color
                message: 'Aguarde...'
            });

            var file = imageInput.input.files[0];
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function () {
                var inputNovaFoto = document.getElementById('HdnNovaFoto');
                inputNovaFoto.value = reader.result.split(',')[1];
                var foto64 = inputNovaFoto.value;
                var idUsuario = $('#HdnIdUsuario').val();
                

                if (reader.result == null || reader.result == "") {
                    KTApp.unblockPage();

                    swal.fire({
                        text: 'Escolha um formato válido!',
                        icon: 'error',
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

                            var data = JSON.parse(json);
                            
                            KTApp.unblockPage();

                            if (data.Ok) {
                                swal.fire({
                                    text: data.Message,
                                    icon: data.Ok ? "success" : "error",
                                    confirmButtonText: "Ok",
                                    customClass: {
                                        confirmButton: "btn font-weight-bold btn-light-primary"
                                    }
                                }).then(function() {
                                    
                                });
                            }
                            else {
                                
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

                            KTApp.unblockPage();

                            swal.fire({
                                text: "Desculpe, houve um erro na requisição!",
                                icon: "error",
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

        var avatar5 = new KTImageInput('kt_profile_avatar');
        avatar5.on('cancel', function (imageInput) {

            swal.fire({
                title: "Você tem certeza?",
                text: "Realmente deseja voltar a foto anterior?",
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
                            KTApp.unblockPage();
                            swal.fire({
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
                            var foto64atual = $('#HdnNovaFoto').val();
                            var stringFoto = "url('data:image;base64," + foto64atual + "')";
                            document.getElementById('kt_profile_avatar').style.backgroundImage = stringFoto;
                            KTApp.unblockPage();
                            swal.fire({
                                text: "Desculpe, houve um erro na requisição!",
                                icon: "error",
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-primary"
                                }
                            }).then(function() {
                                
                            });
                        }
                    }); 

                }
                else{
                    var foto64atual = $('#HdnNovaFoto').val();
                    var stringFoto = "url('data:image;base64," + foto64atual + "')";
                    document.getElementById('kt_profile_avatar').style.backgroundImage = stringFoto;
                }

            });

        });
        
    }

    //remove
    var onClickRemove = function () {
        
        var avatar5 = new KTImageInput('kt_profile_avatar');
        avatar5.on('remove', function (imageInput) {

            swal.fire({
                title: "Você tem certeza?",
                text: "Realmente deseja remover sua foto de usuário?",
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
            
                    
                    
                    var idUsuario = $('#HdnIdUsuario').val();
        
                    $.ajax({
                        url: urlAlterarFoto,
                        type: 'POST',
                        dataType: "html",
                        data: { 'idUsuario': idUsuario, 'foto64': "" },
                        success: function (json) {
        
                            var data = JSON.parse(json);
        
                            
                            if (data.Ok) {
                                document.getElementById('kt_profile_avatar').style.backgroundImage = "url('/Noteflix/Content/img/sem-foto.png')";                        
                            }
                            else {
                                var foto64atual = $('#HdnNovaFoto').val();
                                var stringFoto = "url('data:image;base64," + foto64atual + "')";
                                document.getElementById('kt_profile_avatar').style.backgroundImage = stringFoto;
                            }
                            KTApp.unblockPage();
                            swal.fire({
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
                            var foto64atual = $('#HdnNovaFoto').val();
                            var stringFoto = "url('data:image;base64," + foto64atual + "')";
                            document.getElementById('kt_profile_avatar').style.backgroundImage = stringFoto;
                            KTApp.unblockPage();
                            swal.fire({
                                text: "Desculpe, houve um erro na requisição!",
                                icon: "error",
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-primary"
                                }
                            }).then(function() {
        
                            });
        
                        }
                    });

                }
            });

        });
       
    }

    return {
        // public functions
        init: function () {
            onChange();
            onClickCancel();
            onClickRemove();
        },
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    FotoAPI.init();
});