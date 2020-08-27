<?php
  class SmsGateway 
  {
    function outbox($fullurl,$fields)
    {
      $jsonnya = json_encode($fields);
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_VERBOSE, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_FAILONERROR, 0);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($ch, CURLOPT_URL, $fullurl);
      curl_setopt($ch, CURLOPT_POSTFIELDS,$jsonnya);
      $returned =  curl_exec($ch);
      return(json_decode($returned));
    }
      
  }
?>