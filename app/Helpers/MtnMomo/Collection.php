<?php

namespace App\Helpers\MtnMomo;

class Collection extends Mtn_Momo
{
    protected $_base_url = "https://sandbox.momodeveloper.mtn.com";

    //collection
    public function colToken()
    {
        // and if the token expires, you can generate another token
        // encode the the apiuser and apiuserkey generated to base 64
        // the encoded base 64 is sent using the Bearer token
        $base64 = base64_encode($this->_colApiUser . ":" . $this->_colApiKey);
        return $base64;
        $data = '{}';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->_base_url.'/collection/token/');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Ocp-Apim-Subscription-Key:  $this->_colPrimKey",
            'Content-Type: application/json',
            'Authorization: Basic '.$base64
        ));

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

//        $result = curl_exec($curl);
        $result = json_decode(curl_exec($curl));
        curl_close($curl);

        return $result->access_token;

//         var_dump($result);
    }

    public function colRequestToPay($amount, $number, $currency)
    {
        // encode the the apiuser and apiuserkey generated to base 64
        // the access taken returned from the colToken() function is sent using the Basic token
        $externalID = "YourExternalID";
        $data = '{
        "amount": "' . $amount . '",
        "currency": "' . $currency . '",
        "externalId": "' . $externalID . '",
        "payer": {
            "partyIdType": "MSISDN",
            "partyId": "' . $number . '"
        },
        "payerMessage": "From:",
        "payeeNote": "Transaction ID ' . $externalID . '"
        }';

        //print_r($data);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "$this->_base_url/collection/v1_0/requesttopay");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Ocp-Apim-Subscription-Key: ' . $this->_colPrimKey,
            'X-Target-Environment: sandbox',
            'Authorization: Bearer ' . $this->colToken(),
            'X-Reference-Id: ' . $this->_colXRefId
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($curl);
        curl_close($curl);

        var_dump($result);
    }

    public function colStatus()
    {
        // this function is for checking the status of the transaction
        // the access taken returned from the colToken() function is sent using the Basic token
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "$this->_base_url/collection/v1_0/requesttopay/{$this->_colXRefId}");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Ocp-Apim-Subscription-Key: ' . $this->_colSecdKey,
            'X-Target-Environment: sandbox',
            'Authorization: Bearer ' . $this->colToken()
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($curl);
        curl_close($curl);

        var_dump($result);
    }

    public function colCheckBalance()
    {
        // the access taken returned from the colToken() function is sent using the Basic token
        // for checking of balance
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "$this->_base_url/collection/v1_0/account/balance");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Ocp-Apim-Subscription-Key: ' . $this->_colPrimKey,
            'X-Target-Environment: sandbox',
            'Authorization: Bearer ' . $this->colToken()
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($curl);
        curl_close($curl);

        var_dump($result);
    }

    public function colCheckAccountHolder($accountHolderId)
    {
        // the access taken returned from the colToken() function is sent using the Basic token
        // this function is used to check the account holder of the user or client
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "$this->_base_url/collection/v1_0/accountholder/msisdn/{$accountHolderId}/active");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Ocp-Apim-Subscription-Key: ' . $this->_colSecdKey,
            'X-Target-Environment: sandbox',
            'Authorization: Bearer ' . $this->colToken()
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($curl);
        curl_close($curl);

        var_dump($result);
    }
}
