<?php
namespace App\Helpers\MtnMomo;

class Mtn_Momo
{
    protected $_sand_base_url = "https://sandbox.momodeveloper.mtn.com/v1_0";
    protected $_live_base_url = "https://proxy.momoapi.mtn.com";

    protected $_sand_colPrimKey;
    protected $_sand_colSecdKey;
    protected $_sand_colXRefId;
    protected $_sand_colApiUser;
    protected $_sand_colApiKey;
    
    protected $_colApiUser;
    protected $_colApiKey;

    public function __construct()
    {
        // _colXRefId === _colApiUser

        //SandBox
        $this->_sand_colPrimKey = "719ed8d944984a0ca4164479d62ad79b";
        $this->_sand_colSecdKey = "f0135702b4134c7f89dbfb54028c0baf";
        $this->_sand_colXRefId = "0cf29450-c4fc-47b8-9dca-9b57314fa5b9";
        $this->_sand_colApiUser = "0cf29450-c4fc-47b8-9dca-9b57314fa5b9";
        $this->_sand_colApiKey = "6ad90f5064e347229bd0a20c560f54fa";

        //Live
        $this->_colApiUser = "0cf29450-c4fc-47b8-9dca-9b57314fa5b9";
        $this->_colApiKey = "6ad90f5064e347229bd0a20c560f54fa";


    }

    public function apiUser($xRefID)
    {
        $data = '{
       "providerCallbackHost": "https://eoiib48gekedai.m.pipedream.net"
     }';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "$this->_sand_url/apiuser");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-Reference-Id: ' . $xRefID,
            'Ocp-Apim-Subscription-Key: ' . $this->_colPrimKey,
            'X-Target-Environment: sandbox'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($curl);
        curl_close($curl);

        var_dump($result);
    }

    public function apiUserKey($xRefID)
    {
        $data = '{}';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "$this->_sand_base_url/apiuser/{$xRefID}/apikey");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Ocp-Apim-Subscription-Key: ' . $this->_colPrimKey,
            'X-Target-Environment: sandbox'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);


        $result = curl_exec($curl);
        curl_close($curl);

        var_dump($result);
    }

    public function apiUserDetails($xRefID)
    {
        // this function is for getting the details of the apiuser created
        // _colXRefId or _colApiUser is passed as $xRefID
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "$this->_sand_base_url/apiuser/{$xRefID}");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Ocp-Apim-Subscription-Key: ' . $this->_colPrimKey
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($curl);
        curl_close($curl);

        var_dump($result);
    }

}
