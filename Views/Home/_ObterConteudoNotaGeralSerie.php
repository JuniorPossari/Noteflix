<?php

    $filmeService = new SerieService();

    $nota = $filmeService->ObterNota($idSerie, "icon-xl", true, true);

    echo $nota;

?>