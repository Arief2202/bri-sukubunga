<?php
    header('Content-Type: application/json; charset=utf-8');

    $client_id = "2avG4HxQZZoWsj8r2XY6CBWyKMS2PcLn";
    $client_secret = "IcIUhx37m3zkj61P";

    $partner_code = "ashdnjlasndlasduiwASD";

    $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");

    $path = "/v2.0/valas-info/kurs-counter";

    $payload = '{"dealtCurrency":"IDR","counterCurrency":"USD"}';

    function BRIAPI_login($client_id, $client_secret){
        $urlBRIoauth = "https://sandbox.partner.api.bri.co.id/oauth/client_credential/accesstoken?grant_type=client_credentials";
        $data = "client_id=".$client_id."&client_secret=".$client_secret;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlBRIoauth);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $json = json_decode($result, true);
        return $json;
    }

    function BRIAPI_generate_signature_get($path, $token, $timestamp, $secret){
        $payloads = "path=$path&verb=GET&token=Bearer $token&timestamp=$timestamp&body=";
        $signPayload = hash_hmac('sha256', $payloads, $secret, TRUE);
        $base64 = base64_encode($signPayload);
        return $base64;
    }

    function BRIAPI_generate_signaturev2($path, $verb, $token, $timestamp, $payload, $secret){
        $payloads = "path=$path&verb=$verb&token=Bearer $token&timestamp=$timestamp&body=$payload";
        $signPayload = hash_hmac('sha256', $payloads, $secret, TRUE);
        $base64 = base64_encode($signPayload);
        return $base64;
    }

    
    function BRIAPI_valas($token, $signature, $timestamp, $dealt, $counter){
        $urlBRI_valas = "https://sandbox.partner.api.bri.co.id/v1/valas/getrate/$dealt/$counter";
        $header = array(
            "Authorization: Bearer ".$token,
            "BRI-Signature: ".$signature,
            "BRI-Timestamp: ".$timestamp,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlBRI_valas);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $result = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $result;
    }

    function BRIAPI_valasv2($token, $signature, $timestamp, $payload, $secret){
        $urlBRI_valas = "https://sandbox.partner.api.bri.co.id/v2.0/valas-info/kurs-counter";
        $header = array(
            "Content-Type: application/json",
            "Authorization: Bearer ".$token,
            "BRI-Timestamp: ".$timestamp,
            "BRI-Signature: ".$signature,
            "partnerCode: ".$secret
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlBRI_valas);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $result = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $result;
    }

    
    $token = BRIAPI_login($client_id, $client_secret)['access_token'];

    // $signature =  BRIAPI_generate_signaturev2($path, "POST", $token, $timestamp, $payload, $client_secret);
    
    $signature_GET = BRIAPI_generate_signature_get("/v1/valas/getrate/USD/IDR", $token, $timestamp, $client_secret);
    // echo json_encode([
    //     "token" => $token,
    //     "timestamp" => $timestamp,
    //     "client_secret" => $client_secret,
    //     "signature" => $signature_GET

    // ]);

    $returnValas_GET = BRIAPI_valas($token, $signature_GET, $timestamp, "USD", "IDR");


    // $returnValas = BRIAPI_valasv2($token, $signature, $timestamp, $payload, $client_secret);

    // echo $signature;



    echo $returnValas_GET;