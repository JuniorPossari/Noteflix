<table class="d-none datatable-altura table-hover" id="kt_datatable">
    <thead>
        <tr>                        
            <th data-title="Avaliações">
                avaliacoes
            </th>                                              
        </tr>
    </thead>
    <tbody>

        <?php

            $serieService = new SerieService();
            $usuarioService = new UsuarioService();

            $avaliacoes = $serieService->ObterSerieNotas($idSerie);

            foreach($avaliacoes as $avaliacao){

                $idUsuario = $avaliacao['IdUsuario'];
                $usuario = $usuarioService->ObterPorId($idUsuario);
                $nome = $usuario['Nome'];
                $foto = $usuario['Foto'];
                $observacao = $avaliacao['Observacao'];
                $data = $avaliacao['Data'];
                $datetime = new DateTime($data);

                ?>

                    <tr>
                        <td>

                            <div class="d-flex">
                                <div class="image-input image-input-outline usuario-imagem-background" style="background-image: url(<?php if(isset($foto) && $foto != ""){ echo 'data:image;base64,'.base64_encode($foto); }else{ echo '/Noteflix/Content/img/sem-foto.png'; } ?>)">
                                    <div class="image-input-wrapper border border-dark usuario-imagem"></div>
                                </div>
                                <div class="ml-2 w-100">
                                    <div class="mb-1 d-flex justify-content-between nome">
                                        <a href="javascript:;" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?php echo $nome; ?></a>
                                        <label><?php echo $datetime->format("d/m/Y H:m:s"); ?></label>
                                    </div>                        
                                    <div class="mb-1 nota">
                                        <?php echo $serieService->ObterNotaUsuario($idSerie, $idUsuario, "icon-md", true); ?>
                                    </div>
                                    <div class="observacao">
                                        <?php echo nl2br(str_replace(">", "&gt;", str_replace("<","&lt;", $observacao))); ?>
                                    </div>
                                </div>
                            </div>   
                            
                        </td>

                    </tr>

                <?php

            }
            
        ?>

    </tbody>
</table>

              
            
                    
               