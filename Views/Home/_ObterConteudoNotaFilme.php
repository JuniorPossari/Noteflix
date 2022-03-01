<?php

    $filmeService = new FilmeService();

    $idUsuario = $_SESSION['2A66DC91515A4715850091B6F9035AAE'];
    
    $notaUsuario = $filmeService->ObterNotaNumericaUsuario($idFilme, $idUsuario);

    $notaClasse = '';

    if ($notaUsuario < 2) {
        $notaClasse = 'nota-baixa';
    }
    else if ($notaUsuario >= 2 && $notaUsuario <= 3) {
        $notaClasse = 'nota-media';
    }
    else{
        $notaClasse = 'nota-alta';               
    }

    $nota = number_format((float)$notaUsuario, 1, '.', '');

    $observacaoUsuario = $filmeService->ObterObservacaoUsuario($idFilme, $idUsuario);

?>

<div class="d-flex justify-content-center">
    <div class="text-center">
        <span class="myratings <?php echo $notaClasse; ?>"><?php echo $nota; ?></span>
        <fieldset class="rating">
            <input type="radio" <?php if($nota == 5.0) echo 'checked'; ?> class="radio-nota" id="star5" name="rating" value="5.0" /><label class="full" for="star5" title="5.0 Obra-prima"></label>
            <input type="radio" <?php if($nota == 4.5) echo 'checked'; ?> class="radio-nota" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="4.5 Ótimo"></label>
            <input type="radio" <?php if($nota == 4.0) echo 'checked'; ?> class="radio-nota" id="star4" name="rating" value="4.0" /><label class="full" for="star4" title="4.0 Muito bom"></label>
            <input type="radio" <?php if($nota == 3.5) echo 'checked'; ?> class="radio-nota" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="3.5 Bom"></label>
            <input type="radio" <?php if($nota == 3.0) echo 'checked'; ?> class="radio-nota" id="star3" name="rating" value="3.0" /><label class="full" for="star3" title="3.0 Legal"></label>
            <input type="radio" <?php if($nota == 2.5) echo 'checked'; ?> class="radio-nota" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="2.5 Regular"></label>
            <input type="radio" <?php if($nota == 2.0) echo 'checked'; ?> class="radio-nota" id="star2" name="rating" value="2.0" /><label class="full" for="star2" title="2.0 Fraco"></label>
            <input type="radio" <?php if($nota == 1.5) echo 'checked'; ?> class="radio-nota" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="1.5 Ruim"></label>
            <input type="radio" <?php if($nota == 1.0) echo 'checked'; ?> class="radio-nota" id="star1" name="rating" value="1.0" /><label class="full" for="star1" title="1.0 Muito ruim"></label>
            <input type="radio" <?php if($nota == 0.5) echo 'checked'; ?> class="radio-nota" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="0.5 Horrível"></label>
            <input type="radio" <?php if($nota == 0.0) echo 'checked'; ?> class="radio-nota reset-option" name="rating" value="0.0" />
        </fieldset>
    </div>
</div>                   

<textarea rows="5" class="form-control mt-10" id="txtObservacao" maxlength="1000" placeholder="Deixe sua observação sobre o filme..."><?php echo $observacaoUsuario; ?></textarea>