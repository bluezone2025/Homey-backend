<?php
function db($host,$name,$user,$pass){
    $connect = new PDO("mysql:host=$host;dbname=$name", $user, $pass);
$connect->query("set names utf8");
$connect->query("set character set utf8");
}

$apiURL = "https://api.myfatoorah.com";

// You can get the API Key for regular payment or direct payment and recurring from here:
// https://myfatoorah.readme.io/docs/demo-information
$token =
    "bearer mzVLXxiwdZTWCAAfy6AOVB_3mIZ0zIox7n8y7Rvj1xxTKPPO6rTPW2oSWSceYl-62vRVehkAvw40jbgHsJSgjE4JSoV3wWfBkieQ59jht_-wYdwRhB37Z65ZzGjHnGOX3StEzwJFfJ7P5XDe4oMGz32Vcw9qehaRccwna_ZdmOVrysHYOSBC95CJtofAMcjVqZ3fDDApx6H6Jbg95Mq9jWLDOtdbI7cD54XfxpO5t1uVtKo4Zf0s0mQs1xSvEd9GG3FSfh1N8gMTBk0R35x05xp9RZbqHtNsEWop34G1cdpT3CiOwTTcvFoBpUgEw6shLEGc7qzLB7YD5ryiD3di-SLfuY2DtaCadG9uWnAfa3kJzwzNfts82fQgGVQDEa-ZZ0bU2RF5wd49VnhmZCMwodgnQ12JnuvmjVUtgOgALVGVqugF3m-K2WWTXtKC21VwoisVveNPydrU0qF9HlEirVFWC8m_wZJhUSa4GIHHND5quokUiQBrTPRb_CObeGNgI3Y2sRKiOHHuC3aB77jW0JQIfvBOthBKekIs9lKmjjHk-nwmoY_I1Q-wcM7oRkMiK6hohia47wRfDwWaqXzU1K0ZkKtybdd3Bc6KPgXsvfmsTbNF7KZSqkIRMX32OkiZJHAj8IwVYAobERwM8wzbwEvl5asnJ2kAFWbxTkgAnASEFYj5lTQxMP8wCddrKEVNIK6PAUclNyaEHAhancPdv8LC6L4";

$postFields = [
    // Fill required Data
        "KeyType" => "invoiceId",
        "Key"     => $inovic_id,
        "Amount"  =>$amount, // should counvert amount to portal currency ( can be full / partial refund)
        "Comment" => "Test Refund",
    //Fill optional Data
        //"RefundChargeOnCustomer"  => false,
        //"ServiceChargeOnCustomer" => false,
        //"AmountDeductedFromSupplier"=> 0
];
	
	
	
	//------------- Call MakeRefund Endpoint ------------
$response   = callAPI($token, "$apiURL/v2/MakeRefund", $postFields,$amount);
$json       = json_decode($response);
echo 'Result: ' . $json->Message;

}

function callAPI($token, $apiURL, $postFields,$amount) {
    $curl     = curl_init($apiURL);
    curl_setopt_array($curl, array(
        CURLOPT_CUSTOMREQUEST  => "POST",
        CURLOPT_POSTFIELDS     => json_encode($postFields),
        CURLOPT_HTTPHEADER     => array("Authorization: Bearer $token", 'Content-Type: application/json'),
        CURLOPT_RETURNTRANSFER => true,
    ));
    $response = curl_exec($curl);
    $err      = curl_error($curl);
    curl_close($curl);
    if ($err) {
        // Curl is not working in your server
     dd( 'ERROR: ' . $err);
	
		return  500;
        die;
    } else {
        dd($response);
			return 	200 ;

    }
}

?>