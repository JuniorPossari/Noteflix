<?php

    Class KTDataTablesModel
    {

        public $pagination;
        public $query;
        public $sort;

    }

    Class KTDataTablesPagination
    {

        public $field;
        public $page;
        public $pages; 
        public $perpage;
        public $sort;
        public $Total;

    }

    Class KTDataTablesQuery
    {

        public $generalSearch; 
        public $Processos; 
        public $Subprocessos; 
        public $Cargos; 
        public $SegmentosMercado;

    }

    Class KTDataTablesSort
    {

        public $sort  = "asc";
        public $field  = "nome";
        
    }

?>