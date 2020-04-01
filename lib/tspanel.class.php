<?php 
class tspanel_api
{

  public $site_url_save; 
  public $site_url; 
  public $user_api; 
  public $user_secret; 
  public $user_id; 
  public $user_email; 
  public $curl_header; 
  public $curl_params; 

  public function __construct($siteURL = "http://localhost") { 
    $this->site_url = $siteURL;
    $this->site_url_save = $siteURL;
  }

  // Sender IP Functions

  public function ip() {
   if(getenv("HTTP_CLIENT_IP")) 
    $ip = getenv("HTTP_CLIENT_IP");
  else if(getenv("HTTP_X_FORWARDED_FOR")){
    $ip = getenv("HTTP_X_FORWARDED_FOR");
    if (strstr($ip, ',')){
     $tmp = explode (',', $ip); $ip = trim($tmp[0]);
   }} 
   else 
    $ip = getenv("REMOTE_ADDR");
  return $ip;
}

  // Sender Info Functions

public function setApi($api_key = NULL,$secret_key = NULL){ 
  $this->user_api = $api_key;
  $this->user_secret = $secret_key;
}  
public function setAuth($id = NULL,$email = NULL){ 
  $this->user_id = $id;
  $this->user_email = $email;
}  
public function setHeader(){ 
  $this->curl_header = array("APIKEY: ".$this->user_api, "SECRETKEY: ".$this->user_secret,"USERID: ".$this->user_id,"USEREMAIL: ".$this->user_email);
}  
public function setAction($action = NULL){ 
  $this->site_url = NULL;
  $this->site_url = $this->site_url_save.$action;
}  
public function setParams($getparam = "none"){ 
  $this->curl_params = http_build_query($getparam);
}  

  // Curl Funcitons

public function StartCurl($ch)
{ 
}

public function CurlHeader($ch)
{
}

public function CurlPost($ch)
{
}

  // Curl Send Funcitons

public function send(){  
    $ch = curl_init(); 
    curl_setopt($ch,CURLOPT_URL, $this->site_url); 
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true); 
    curl_setopt($ch,CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $this->curl_header);
    curl_setopt($ch, CURLOPT_POST, count($this->curl_params));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $this->curl_params); 
    $output=curl_exec($ch); 

    if($output === false){
      $output=array("error"=>1,"curl_error"=>1,"api_error"=>0,"code"=>"curl_error","message"=>array("curl_error"=>curl_error($ch),"api_error"=>NULL));
    }else{
      $json=json_decode($output,true);
      if ($json['success'] == 0) {
        $output=array("error"=>1,"curl_error"=>0,"api_error"=>1,"code"=>$json['code'],"message"=>array("curl_error"=>NULL,"api_error"=>$json['message']),"data" => $json['data']);
      }else if($json['success'] == 1) {
        $output=array("success"=>1,"commands"=>$json['commands'],"message"=>"Successful","code"=>0,"data"=>$json['data']);
      }else{
        $output=array("error"=>1,"curl_error"=>0,"api_error"=>0,"Unknown"=>1,"code"=>"0099","message"=>array("curl_error"=>"Unknown error.","api_error"=>"Unknown error.","Unknown"=>"Unknown error."),"data" => NULL);
      }
    }

    curl_close($ch); 
    return $output; 
}  

}
?>




