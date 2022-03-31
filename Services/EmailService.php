<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    Class EmailService{

        public function GetEmailBody($templateName){

            try{
                return file_get_contents($_SERVER['DOCUMENT_ROOT']."/EmailTemplate/{$templateName}.html");
            }
            catch(Exception $e){
                return '';
            }            

        }

        public function SendEmail($usuario, $assunto, $mensagem){

            $mail = new PHPMailer(true);          

            try {

                $appsettings = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/appsettings.json'), true);
                $smtpconfig = $appsettings['SMTPConfig'];

                //Server settings
                // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = $smtpconfig['Host'];                       // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = $smtpconfig['Username'];                 // SMTP username
                $mail->Password = $smtpconfig['Password'];                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to
            
                //Recipients
                $mail->setFrom($smtpconfig['Username'], 'Noteflix');
                $mail->addAddress($usuario['Email'], $usuario['Nome']);     // Add a recipient
                // $mail->addAddress('ellen@example.com');               // Name is optional
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');
            
                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->CharSet = 'utf-8';
                $mail->Subject = $assunto;
                $mail->Body    = $mensagem;
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                $mail->send();

                return true;

            } catch (Exception $e) {
                //echo $e->getMessage();
                return false;

            }

        }

    }

?>