<?php

namespace App\Models\BaseModel\Traits;

use Illuminate\Support\Facades\Log;

trait SmsTrait{

    public function sendSms(array $data)
    {
        $curl = curl_init();
        $phone=$data['phone'];
        $sms=$data['sms'];
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://messaging-service.co.tz/api/sms/v1/test/text/single',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{"from":"RMNDR", "to":"'.$phone.'",  "text": "'.$sms.'", "reference": "aswqetgcv"}',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic ZWRnYXJmd2Fsbzk5QGdtYWlsLmNvbTpTYWdlc2l2QG5uYTE=',
            'Content-Type: application/json',
            'Accept: application/json'
        ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        dump($response);            
        }
    }  