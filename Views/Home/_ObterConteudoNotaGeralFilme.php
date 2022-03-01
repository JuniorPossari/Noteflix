<?php

    $filmeService = new FilmeService();

    $nota = $filmeService->ObterNota($idFilme, "icon-xl", true, true);

    echo $nota;

?>