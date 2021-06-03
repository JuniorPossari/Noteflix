<?php

    Class JsonResult{

        public function Data($ok, $title, $message, $result = array()){

            $response = array("Ok" => $ok, "MessageTitle" => $title, "Message" => $message, "Result" => $result);
            
            return json_encode($response);

        }

        public function DataError($e = null){

            $response = array("Ok" => false, "MessageTitle" => "Aviso", "Message" => isset($e) ? $e : "Desculpe, houve um erro na requisição. Tente novamente mais tarde!", "Result" => array());
            
            return json_encode($response);

        }

    }

?>