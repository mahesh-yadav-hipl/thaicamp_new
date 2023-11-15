<?php
function send_sms($mobile='',$message='')
{
    $mobile=urlencode($mobile);
    $message = urlencode(substr($message, 0, 140));
    if(empty($mobile)){
        error("SMS_ERROR",'mobile can not be empty');
    }
    elseif(empty($message)){
        error("SMS_ERROR",'message can not be empty');
    }else{
        $curl = curl_init();
        $url="http://site23.way2sms.com/";
        curl_setopt($curl, CURLOPT_URL, $url."Login1.action");
        curl_setopt($curl, CURLOPT_POSTFIELDS, "username=".urlencode(SMS_ID)."&password=".urlencode(SMS_PASSWORD)."&button=Login");
        curl_setopt($curl, CURLOPT_COOKIESESSION, 1);
        curl_setopt($curl, CURLOPT_COOKIEFILE, "cookie_way2sms");
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);
    
        $token_text = curl_exec($curl);

        $token_start=strpos($token_text,'Token=')+6;
        if(!$token_start){
            error("SMS_ERROR",'Invalid SMS ID/PASSWORD');
        }else{
            $token=substr($token_text,$token_start,37);
            curl_setopt($curl, CURLOPT_URL,$url.'smstoss.action');
            curl_setopt($curl, CURLOPT_POSTFIELDS, "ssaction=ss&Token=".$token."&mobile=".$mobile."&message=".$message."&Send=Send SMS");
        
            $contents = curl_exec($curl);
            $sent = strpos($contents, 'Message has been submitted successfully');
            curl_setopt($curl, CURLOPT_URL, $url."LogOut");
            curl_exec($curl);
            curl_close($curl);
            return $sent?true:false;
        }
    }
}
?>