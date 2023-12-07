<?php

################################################################################
# ime   : Class Mail
# opis  : Klasa za slanje mailova
# autor : Ivan Bozajic
# datum : 02/2023
################################################################################

/** Include PHPMailer */
require_once('admin/inc/PHPMailer/class.phpmailer.php');
require_once('admin/inc/PHPMailer/class.smtp.php'); 

class Mail
{    
    protected $mail;

    function __construct()
    {
        $this->mail = new PHPMailer;
        #$mail->SMTPDebug = 3;                               // Enable verbose debug output
        $this->mail->isSMTP();                                      // Set mailer to use SMTP
        $this->mail->Host       = 'mail.swapps.eu';  // Specify main and backup SMTP servers
        $this->mail->SMTPAuth   = true;                               // Enable SMTP authentication
        $this->mail->Username   = 'web@swapps.eu';                 // SMTP username
        $this->mail->Password   = 'g4qTm7Nt01V';                           // SMTP password
        $this->mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port       = 465;                                    // TCP port to connect to      
        $this->mail->From       = 'web@swapps.eu';        
    }

    /**************************************************************************/
    /**
     * SendReservation
     *
     * @return void
     */
    public function SendReservation($id_reservation)
    {
        $db = MysqlDB::getInstance();        

        $user_email = "podrska@mooveon.hr";

        list($subject, $message, $email) = $this->PrepareMail($id_reservation);

        $user_email .= ";" . $email; 

        $mail = $this->mail;
        $mail->FromName = 'Mooveon Rezervacija';
        #$mail->addReplyTo('info@poslovnaspajalica.hr', 'Info PoslovnaSpajalica');
        #$mail->addCC('ivan.bozajic@gmail.com');
        #$mail->addBCC('ivan.bozajic@gmail.com');
        
        #$mail->addAttachment('/var/www/1played.com/public_html/cron/' . $filename);         // Add attachments
        #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML
        
        $mail->Subject = $subject;
        $mail->Body    = $message;
        #$mail->AltBody = $message;
        
        // ==== SLANJE ====
        
            // medjukorak provjera da slucajno nema upisano vise email adresa odvojenih ;
            $pos = strpos($user_email, ";");
            
            if ($pos !== false)
            {
                $user_email_array = array();
                $user_email_array = explode(";", $user_email);
                
                if(is_array($user_email_array))
                {
                    foreach($user_email_array as $e)
                    {
                        $mail->addAddress(trim($e)); // Add a recipients	
                    }
                }	
            }
            else
            {
                $mail->addAddress($user_email);     // Add a recipient
            }
        
        if(!$mail->send()) 
        {
            echo 'Message could not be sent.'."\n";
            echo 'Mailer Error: ' . $mail->ErrorInfo."\n";
        } 
        else 
        {
            // echo 'Message has been sent to: '.$user_email.''."\n";
        }        
    }
    
    /**************************************************************************/
    /**
     * PrepareMail
     *
     * @return void
     */
    private function PrepareMail($id_reservation)
    {        
        $repairshops = new Repairshops();
        $vehicles = new Vehicles();

        $reservation_list = $repairshops->GetReservations(array("id" => $id_reservation));
        $reservation = $reservation_list[$id_reservation];    

        $id_vehicle = $reservation["id_vehicle"];

        $vehicles_list = $vehicles->List("HR", "0,1", array("id" => $id_vehicle));
        $vehicle = $vehicles_list[$id_vehicle];

        $registraions = $vehicles->getRegistration($id_vehicle);
        $registraion = end($registraions[$id_vehicle]);
        
        $fields = array();
        $fields["__DATE__"]        = date("d.m.Y.", strtotime($reservation["date_time"]));
        $fields["__TIME__"]        = date("H:i", strtotime($reservation["date_time"]));
        $fields["__REPAIRSHOP__"]  = $reservation["name"];
        $fields["__ADDRESS__"]     = $reservation["address"];
        $fields["__CITY__"]        = $reservation["city"];
        $fields["__DESCRIPTION__"] = $reservation["description"];
        $fields["__PHONE__"]       = $reservation["phone"];
        $fields["__MAIL__"]        = $reservation["mail"];

        $fields["__CUSTOMER__"]       = $reservation["firstname"] . " " . $reservation["lastname"];
        $fields["__CUSTOMER_PHONE__"] = $reservation["user_phone"];
        $fields["__CUSTOMER_MAIL__"]  = $reservation["user_mail"];
        
        $fields["__VEHICLE__"]        = $vehicle["marka"] . ' ' .$vehicle["model"] . ' ' . $vehicle["podmodel"];
        $fields["__VEHICLE_PLATES__"] = $registraion["plates"];
        $fields["__VEHICLE_VIN__"]    = $vehicle["vin"];


        $path = 'img/logo.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);      
        
        $fields["__IMG_LOGO__"] = $base64;

        $path = 'img/logo_footer.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);      
        
        $fields["__IMG_FOOTER__"] = $base64;        

        $content = file_get_contents("template_mail.html");

        $content = strtr($content, $fields);
        $subject = "Rezervacija servisnog termina - " . $registraion["plates"];

        return array($subject, $content, $reservation["user_mail"]);
    }
    
    /**************************************************************************/
    /**
     * SendVerificationCode
     *
     * @return void
     */
    public function SendVerificationCode($id_user)
    {
        list($subject, $message, $user_email) = $this->PrepareMailVerificationCode($id_user);

        $mail = $this->mail;
        $mail->FromName = 'Mooveon Login';
        #$mail->addReplyTo('info@poslovnaspajalica.hr', 'Info PoslovnaSpajalica');
        #$mail->addCC('ivan.bozajic@gmail.com');
        #$mail->addBCC('ivan.bozajic@gmail.com');
        
        #$mail->addAttachment('/var/www/1played.com/public_html/cron/' . $filename);         // Add attachments
        #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML
        
        $mail->Subject = $subject;
        $mail->Body    = $message;
        #$mail->AltBody = $message;
        
        // ==== SLANJE ====
        
            // medjukorak provjera da slucajno nema upisano vise email adresa odvojenih ;
            $pos = strpos($user_email, ";");
            
            if ($pos !== false)
            {
                $user_email_array = array();
                $user_email_array = explode(";", $user_email);
                
                if(is_array($user_email_array))
                {
                    foreach($user_email_array as $e)
                    {
                        $mail->addAddress(trim($e)); // Add a recipients	
                    }
                }	
            }
            else
            {
                $mail->addAddress($user_email);     // Add a recipient
            }
        
        if(!$mail->send()) 
        {
            echo 'Message could not be sent.'."\n";
            echo 'Mailer Error: ' . $mail->ErrorInfo."\n";
        } 
        else 
        {
            // echo 'Message has been sent to: '.$user_email.''."\n";
        }   
    }
    
    /**************************************************************************/
    /**
     * PrepareMailVerificationCode
     *
     * @return void
     */
    public function PrepareMailVerificationCode($id_user)
    {
        $users = new Users();

        $list = $users->List("HR", "0,1", $id_user);
        $user = $list[$id_user];

        $code = $users->GenerateVerificationCode($id_user);
        
        $fields = array();
        $fields["__VERIFICATION_CODE__"] = $code;


        $path = 'img/logo.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);      
        
        $fields["__IMG_LOGO__"] = $base64;

        $path = 'img/logo_footer.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);      
        
        $fields["__IMG_FOOTER__"] = $base64;        

        $content = file_get_contents("template_mail_verification_code.html");

        $content = strtr($content, $fields);
        $subject = "Verifikacijski kod";

        return array($subject, $content, $user["email"]);        
    }
}

?>