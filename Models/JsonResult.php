<?php

    Class JsonResult{

        public function Data($ok, $title, $message, $result = array()){

            $response = array("Ok" => $ok, "MessageTitle" => $title, "Message" => $message, "Result" => $result);
            
            return json_encode($response);

        }

    }

?>