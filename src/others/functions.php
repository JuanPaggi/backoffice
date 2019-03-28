<?php

function sendEmail($subject, $body, $to = null,$copy= true)
{
    // parametr�a
    $setting = new settings(4);
    $emailWM = $setting->value;
    $setting = new settings(5);
    $passWM = $setting->value;
    $setting = new settings(6);
    $smtp_host = $setting->value;
    $setting = new settings(7);
    $smtp_port = $setting->value;
    $setting = new settings(8);
    $smtp_appname = $setting->value;
    //para habilitar el envio de copia
    if($copy){
        $setting = new settings(9);
        $mailcopy = $setting->value;
    }
    
    $body = html_entity_decode($body);
    $subject = str_replace(array('&aacute;', '&eacute;', '&iacute;', '&oacute;', '&uacute;', '&ntilde;', '&Aacute;', '&Eacute;', '&Iacute;', '&Oacute;', '&Uacute;', '&Ntilde;'), array('a', 'e', 'i', 'o', 'u', 'n', 'A', 'E', 'I', 'O', 'U', 'N'), $subject);
    $subject = html_entity_decode($subject);
    _::declare_component('phpmailer');
    $mail = new PHPMailer();
    $mail->CharSet='utf-8';
    $mail->SMTPDebug = 2;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = $smtp_host;
    $mail->Port = $smtp_port;
    $mail->Username = $emailWM;
    $mail->Password = $passWM;
    $mail->SetFrom($emailWM, $smtp_appname);
    $mail->Subject = $subject;
    $mail->IsHTML(true);
    $mail->Body = $body;
    //$mail->AltBody = strip_tags($body);
    //mail de copia
    if($copy){
        $mail->AddAddress($mailcopy);
    }
    if(!empty($to)){
        if(!is_array($to)) $mail->AddAddress($to);
        else foreach($to as $addr){
            $mail->AddAddress($addr);
        }
    }
    return $mail->Send();
}

function getStartTIMESTAMP(){
    list($y,$m,$d) = explode('-', date('Y-m-d', time()));
    $start = mktime(0,0,0,$m,$d,$y);
    //$end = mktime(0,0,0,$m,$d+1,$y);
    return $start;
}

function getEndTIMESTAMP(){
    list($y,$m,$d) = explode('-', date('Y-m-d', time()));
    //$start = mktime(0,0,0,$m,$d,$y);
    $end = mktime(0,0,0,$m,$d+1,$y);
    return $end;
}

function iploc($ip) {
	$html = file_get_contents("http://ipinfodb.com/ip_locator.php?ip=".$ip);
	preg_match("/<li>Country : (.*?) <img/",$html,$data);
	@$d['pais'] = $data[1];
	preg_match("/<li>State\/Province : (.*?)<\/li>/",$html,$data);
	@$d['state'] = $data[1];
	preg_match("/<li>City : (.*?)<\/li>/",$html,$data);
	@$d['city'] = $data[1];
	return ($d);
}
function getRealIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
 
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
 
    return $_SERVER['REMOTE_ADDR'];
}

include('pbkdf2.php');