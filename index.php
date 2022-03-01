<?php
	
	session_start();

	require 'autoload.php';
	$c = new Core();

// 	function include_versioned($file) {

// 		$absoluto = 'https://' . $_SERVER['SERVER_NAME'];

// 		if (is_file($absoluto . $file)) {

// 			$time = filemtime($$absoluto . $file);
   
// 			$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
   
// 			switch ($ext) {
// 				case 'js':
// 					echo '<script src="', $file,'?v=', $time,'"></script>';
// 					break;
// 				case 'css':
// 					echo '<link href="', $file,'?v=', $time,'" rel="stylesheet">';
// 				  	break;
// 				default:
// 					echo '<!-- Tipo inválido de resource -->';
// 			}
// 		}
// 		else {
// 			echo '<!-- Resource não encontrado -->';
// 		}
		
//    }
				
?>