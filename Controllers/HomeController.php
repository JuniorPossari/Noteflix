<?php

    Class HomeController extends Controller{

        public function Index(){

            $this->CarregarLayout('Home/Index');

        }

        public function FileCallback(){

            $json = new JsonResult();
            
            $result = $json->Data(true, "Success", "FileCallback success!");

            echo $result;

        }

    }

?>