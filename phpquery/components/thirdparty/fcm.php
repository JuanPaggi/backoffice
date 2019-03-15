<?php

/*
 * FIREBASE CLOUD MESSAGING
 * Adaptado por Alexander Eberle. <alexander.eberle@aizensoft.com>
 */
class FirebaseCloudMessaging
{

    protected $endpoint = 'https://fcm.googleapis.com/fcm/send';

    protected $serverKey;

    protected $headers = array(
        'Content-Type: application/json'
    );

    protected $lastError;

    protected $timeOut = 6000;

    // server key FirebaseConsole->project setting->cloud messaging -> server key
    public function __construct($serverKey)
    {
        $this->serverKey = $serverKey;
        $this->headers[] = 'Authorization:key=' . $this->serverKey;
    }

    public function send(FCMP $payload)
    {
        $optArray = array(
            CURLOPT_URL => $this->endpoint,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            // CURLOPT_FOLLOWLOCATION => true,
            // CURLOPT_CONNECTTIMEOUT => $this->timeOut,
            CURLOPT_POSTFIELDS => $payload->getArrayFields()
        );
        $curl = curl_init();
        curl_setopt_array($curl, $optArray);
        $result = curl_exec($curl);
        $this->lastError = curl_error($curl);
        curl_close($curl);
        return $result;
    }

    public function getError()
    {
        return $this->lastError;
    }
}

// para detalles referirse a https://firebase.google.com/docs/cloud-messaging/admin/send-messages
interface FCMP
{

    public function getArrayFields();
}

class httpFCMPayload implements FCMP
{

    protected $target = null;

    protected $registration_ids = null;

    protected $condition = null;

    protected $priority = null;

    protected $time_to_live = 432000;

    // 4 días
    public $data;

    // clave valor interno
    public $notification = array('title' => 'demo', 'body' => 'gg izi');

    // clave valor visible
    protected $isAndroid = false;

    public function __construct($isAndroid = true)
    {
        $this->isAndroid = $isAndroid;
        $this->setPriority();
    }

    public function setTopic($topic)
    {
        $this->target = '/topics/'.$topic;
    }

    // array o strings de Registration tokens.
    public function setRegistrations($id)
    {
        if (is_array($id)) {
            $this->registration_ids = $id;
        } else {
            $this->to = $id;
        }
    }

    // referirse a https://firebase.google.com/docs/cloud-messaging/http-server-ref?hl=es-419#send-downstream
    public function setConditions($conditions)
    {
        $this->condition = $condition;
    }

    // 'normal' o 'high'
    public function setPriority($priority = 'normal')
    {
        if ($this->isAndroid)
            $this->priority = $priority;
        else {
            if ($priority == 'normal')
                $this->priority = 5;
            else
                $this->priority = 10;
        }
    }

    public function getArrayFields()
    {
        $out = array();
        
        if (! empty($this->target))
            $out['to'] = $this->target;
        
        if (! empty($this->registration_ids))
            $out['registration_ids'] = $this->registration_ids;
        
        if (! empty($this->condition))
            $out['condition'] = $this->condition;
        
        if (! empty($this->priority))
            $out['priority'] = $this->priority;
        
        if (! empty($this->time_to_live))
            $out['time_to_live'] = $this->time_to_live;
        
        if (! empty($this->data))
            $out['data'] = $this->data;
        
        if (! empty($this->notification))
            $out['notification'] = $this->notification;
        
        return json_encode($out);
    }
}

class FCMPayload implements FCMP
{

    public $data = array(
        'testKey' => 'testValue'
    );

    public $notificacion = array(
        'title' => 'Notifty Titulo',
        'body' => 'Notify body'
    );

    public $token = null;

    // token del dispositivo al que hay que enviar notificación
    public $topic = 'generalTopic';

    // tema suscrito al que hay que enviar notificación
    public $condition = null;

    // condiciones que se tienen que cumplir para enviar notificación
    public $android;

    // especificaciones para android
    // public $apns = new FCMPApple(); // especificaciones para apple push network service.
    public function getArrayFields()
    {
        $out = array();
        $data = array_filter(get_object_vars($this));
        foreach ($data as $key => $value)
            // if(is_string($value))
            // $out[$key] = $value;
            // else
            // $out[$key] = (string)$value;
            $out[$key] = $value;
        return json_encode($out);
    }

    public function __toString()
    {
        return json_encode($this->getArrayFields());
    }

    public function __construct()
    {
        $this->android = new FCMPAndroid();
    }
}

class FCMPAndroid
{

    public $ttl = 3600 * 1000;

    // tiempo máximo que esperará FCM para tratar de enviar la notificación, (Máximo 4 semanas)
    public $priority = 'normal';

    // normal o high
    public $data;

    // data para android.
    public $notificacion;

    public function __construct()
    {
        $this->notificaciones = new AndroidPushNotify();
    }

    public function __toString()
    {
        return json_encode(array_filter(get_object_vars($this)));
    }
}

class AndroidPushNotify
{

    public $title;

    public $body;

    public $icon;

    public $color;

    public $sound;

    public $tag;

    public $clickAction;

    public $bodyLocKey;

    public $bodyLocArgs;

    public $titleLocKey;

    public $titleLocArgs;

    public function __toString()
    {
        return json_encode(array_filter(get_object_vars($this)));
    }
}

/*
 * para más información referirse a :
 * https://developer.apple.com/library/content/documentation/NetworkingInternet/Conceptual/RemoteNotificationsPG/CommunicatingwithAPNs.html
 * https://developer.apple.com/library/content/documentation/NetworkingInternet/Conceptual/RemoteNotificationsPG/PayloadKeyReference.html
 */
class FCMPApple
{

    public $header = array(
        'apns-priority' => 10
    );

    public $payload = array(
        'aps' => array(
            'alert' => array(
                'title' => '',
                'body' => ''
            ),
            'badge' => 42
        )
    );

    public $topic = '';

    public function __toString()
    {
        return json_encode(array_filter(get_object_vars($this)));
    }
}