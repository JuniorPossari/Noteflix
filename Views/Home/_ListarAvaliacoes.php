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
            $eu = $usuarioService->ObterPorId(1);
            $observacao = $filmeService->ObterObservacaoUsuario($idFilme, 1);
            $Nome = $eu['Nome'];
            $Foto = $eu['Foto'];
            $Id = $eu['Id'];
            $Email = $eu['Email'];
        ?>

        <tr>
            <td>

                <div class="d-flex">
                    <div class="image-input image-input-outline usuario-imagem-background" style="background-image: url(<?php if(isset($Foto) && $Foto != ""){ echo 'data:image;base64,'.base64_encode($Foto); }else{ echo '/Noteflix/Content/img/sem-foto.png'; } ?>)">
                        <div class="image-input-wrapper border border-dark usuario-imagem"></div>
                    </div>
                    <div class="ml-2">
                        <div class="mb-1"><a href="javascript:;" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?php echo $Nome; ?></a></div>                        
                        <div class="mb-1"><?php echo $filmeService->ObterNota($idFilme, "icon-lg", true); ?></div>
                        <div class="mb-1">
                        <?php echo $observacao; ?>
                        </div>
                    </div>
                </div>   
                  
            </td>

        </tr>
        <tr>
            <td>

                <div class="d-flex">
                    <div class="image-input image-input-outline usuario-imagem-background" style="background-image: url(<?php if(isset($Fotoas) && $Fotoas != ""){ echo 'data:image;base64,'.base64_encode($Foto); }else{ echo '/Noteflix/Content/img/sem-foto.png'; } ?>)">
                        <div class="image-input-wrapper border border-dark usuario-imagem"></div>
                    </div>
                    <div class="ml-2">
                        <div class="mb-1"><a href="javascript:;" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?php echo $Nome; ?></a></div>                        
                        <div class="mb-1"><?php echo $filmeService->ObterNota($idFilme, "icon-lg", true); ?></div>
                        <div class="mb-1">
                            Lorem ipsum aptent luctus curae tempor sollicitudin eget porta ullamcorper aptent rhoncus aliquet lorem aliquam, quisque urna sodales mauris congue dolor eleifend vulputate vestibulum cras malesuada adipiscing. donec aenean consectetur hac duis pharetra malesuada praesent suspendisse interdum, sed ligula ullamcorper nisl dui purus egestas nisi taciti, maecenas porttitor nunc morbi fames aenean rhoncus tristique. euismod suspendisse eu vehicula ultrices porttitor malesuada velit neque, non arcu quisque posuere pulvinar consequat accumsan diam aliquet, arcu eleifend accumsan taciti ultrices ut molestie. ad cras convallis primis torquent nibh bibendum pulvinar, nec elit donec tincidunt fermentum ipsum molestie ac, rhoncus gravida sollicitudin convallis ut suspendisse. Cubilia primis venenatis ullamcorper commodo ac enim interdum, donec gravida accumsan platea ullamcorper donec, dapibus fermentum mattis enim cubilia hendrerit. arcu laoreet fringilla habitasse adipiscing vitae tortor nullam at, viverra suscipit non euismod eget donec metus tortor senectus, amet lacinia ut imperdiet etiam sociosqu tellus. consequat nec feugiat curae sed vulputate tempus dictumst nullam morbi, tincidunt integer elementum etiam arcu posuere massa etiam libero, eros sem donec litora maecenas pharetra sit dui. sed commodo curabitur dapibus cursus eleifend magna risus eget nostra, commodo gravida pellentesque torquent habitasse accumsan ut odio curae, dui inceptos etiam curabitur tempor fermentum odio amet. Nec aliquam nisi eu aptent tortor a id potenti purus, dui quisque sodales laoreet bibendum dictumst ante suspendisse neque, mollis interdum aliquet mauris ut aliquam hac tempor. tristique laoreet suspendisse nisl maecenas euismod augue arcu, ligula varius per amet justo mattis egestas porttitor, ac fames ultrices cursus fermentum vel. cursus sem varius primis nulla gravida aliquet pretium, vitae sodales vehicula tristique aptent curabitur, turpis hac vivamus arcu neque vivamus. himenaeos platea ultrices laoreet pharetra ultricies fringilla, nulla eleifend urna fusce mollis interdum etiam, semper habitasse bibendum purus suscipit. tortor sodales risus etiam himenaeos hac pellentesque lacinia dictumst, aliquam in urna proin interdum consequat donec aliquam, vulputate aliquet arcu aliquet blandit lectus consectetur. Cras nunc non viverra eu donec augue nibh habitant non, id inceptos rutrum aliquam tortor ac lorem curae nisl duis, libero pellentesque urna nam donec maecenas torquent feugiat. lacus felis dui curae ultricies volutpat, rutrum viverra non sem, netus duis neque vehicula. justo commodo massa suspendisse arcu taciti quisque eget odio, pretium aenean inceptos imperdiet blandit lectus ad, vestibulum mollis hendrerit pharetra luctus laoreet interdum. quisque inceptos risus quisque praesent eleifend rhoncus, enim faucibus vestibulum rhoncus venenatis, cursus elit accumsan phasellus interdum. in urna primis placerat curabitur et justo amet mattis bibendum, sapien pellentesque nulla rutrum pellentesque class sit semper, platea fames nostra at tortor phasellus luctus cubilia. Laoreet suscipit placerat hac nisi nam dapibus metus quis, laoreet adipiscing ut iaculis congue faucibus litora fermentum mollis, dictum justo molestie orci praesent consequat mattis. tincidunt porttitor justo integer massa pharetra est sociosqu aenean litora, vehicula nunc pharetra quam diam hendrerit nulla cursus, dolor fusce accumsan himenaeos erat arcu aenean augue. lacus diam elit nisl iaculis dictum, curabitur lorem nibh suscipit torquent, euismod vel arcu aenean. orci vivamus metus magna gravida urna dui ante, vitae amet tristique placerat sodales nec. 
                        </div>
                    </div>
                </div>   
            
            </td>
        </tr>

    </tbody>
</table>

              
            
                    
               