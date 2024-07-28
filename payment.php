<?php
class MpesaApi
{
	private $id;
	private $url;
	private $consumerKey;
	private $consumerSecret;
	private $credentials;
	private $BusinessShortCode;
	private $Timestamp ;
	private $PartyA ;
	private $PartyB ;
	private $PhoneNumber;
	private $CallBackURL;
	private $AccountReference;
	private $TransactionDesc;
	private $Amount;
	private $PassKey;
	private $Password;
	private $curl;
	private $response;
	private $accessToken;
	private $tockenString;
	public function __construct($id)
	{
		// product id
		$this->id = $id;
		// tocken requirements
		$this->consumerKey     	 ="7iPrpUxqGY9QL5I1IhDEQVbQeCPfOxh6ojZQC2ZjZIC8SUaP";
		$this->consumerSecret    ="HTbyVzGd3dkeDKoXSWwBAvTt4RPUb2LZkGYkGXX6rdCdvNPC9J534SLUQxq1yfnn";
		$this->credentials     	 = base64_encode($this->consumerKey.":".$this->consumerSecret);		
		//process requirements		
		$this->BusinessShortCode = 174379;
		$this->Timestamp 		 = date("YmdHis");
		$this->PartyA 			 = 600982;
		$this->PartyB 			 = 600000;
		$this->PhoneNumber       = "254708374149";
		$this->CallBackURL       = "https://34e6-105-61-149-195.eu.ngrok.io/PAM/mpesa/index.php?orderId=".$id;
		$this->AccountReference  = 'Malika Properties';
		$this->TransactionDesc   = 'Booking Payment';		
		$this->PassKey           = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
		$this->Password          = base64_encode($this->BusinessShortCode.$this->PassKey.$this->Timestamp);
		$this->Amount 			 = "";
		$this->curl   			 = "";
		$this->response          = "";
		$this->accessToken       = "";
		$this->tockenString      = "";
		$this->url  			 = "";
		// $date = DateTime::createFromFormat('YmdGisu', $this->Timestamp);
		// echo date('Y-m-d H:i:s');
        // $milliseconds = $this->Timestamp;
		// $seconds = (int) ($milliseconds / 1000); // convert milliseconds to seconds
		// $date = date('Y-m-d H:i:s', strtotime("1970-01-01 +$seconds seconds")); // convert seconds to Unix timestamp and format date
		// echo $date;


		// print();
		// die();

	}
	public function get_access_tocken()
	{
		$this->url 			   = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';		
		$this->curl 		   = curl_init();
		$this->credentials     = base64_encode($this->consumerKey.":".$this->consumerSecret);
		curl_setopt($this->curl, CURLOPT_URL, $this->url);
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$this->credentials));
		curl_setopt($this->curl, CURLOPT_HEADER,false);
		curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
		$this->response   		= curl_exec($this->curl);
		$this->accessToken   	= json_decode($this->response);
		
		$this->tockenString  = $this->accessToken->access_token;
        // print_r($this->accessToken);
        // die();
		return $this->tockenString;
	}
	public function stk_push($accessToken, $amaunt, $PhoneNumber)
	{
		$this->Amount = $amaunt;
		$this->accessToken = $accessToken;
		$this->url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
		$this->curl = curl_init();
		curl_setopt($this->curl, CURLOPT_URL, $this->url);
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization:Bearer '.$this->accessToken));
		$post_data = array(
			"BusinessShortCode" => $this->BusinessShortCode,
			"Password" => $this->Password,
			"Timestamp"=> $this->Timestamp,
			"TransactionType" => "CustomerPayBillOnline",
			"Amount" => $this->Amount,
			"PartyA" => $this->PartyA,
			"PartyB"=> $this->BusinessShortCode,
			"PhoneNumber" => $PhoneNumber,
			"CallBackURL" => $this->CallBackURL,
			"AccountReference" => $this->AccountReference,
			"TransactionDesc" => $this->TransactionDesc
		);
		$data_string           = json_encode($post_data);
		// print($data_string);
		// die();

		curl_setopt($this->curl, CURLOPT_POST,1);
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
		$this->response       = curl_exec($this->curl);
		
		return $this->response;
	}


	public function setCallBackUrl($url)
	{
		$this->CallBackURL = $url."/malikaproperties/mpesa/index.php?orderId=".$this->id;
	}

	public function verifyTransactionDetails($transactionID){
		$access_token = $this->get_access_tocken();
		$url = 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';
		

		$headers = [
			'Authorization: Bearer ' . $access_token,
			'Content-Type: application/json'
		];
		
		$data = [
			"BusinessShortCode" => $this->BusinessShortCode,
			"Password" => $this->Password,
			"Timestamp"=> $this->Timestamp,
			"CheckoutRequestID"=>$transactionID,
			'Initiator' => $this->BusinessShortCode,
			'SecurityCredential' => $this->PassKey,
			'CommandID' => 'TransactionStatusQuery',
			'TransactionID' => $transactionID,
			'PartyA' => $this->PartyA,
			'IdentifierType' => '4',
			'ResultURL' => 'https://example.com',
			'QueueTimeOutURL' => "https://example.com",
			'Remarks' => 'Check transaction status',
			'Occasion' => ''
		];
		
		$data_string = json_encode($data);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		
		$result = curl_exec($ch);
		return $result;
	}
}


?>