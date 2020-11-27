<?php 
include '../lib/tspanel.class.php';
$apikey="YourApiKey";
$secret="YourApiSecretKey";

$api = new tspanel_api("https://panel.ts3.info.tr/api/"); // Bağlantı Sağlıyoruz
$api->SetApi($apikey,$secret); // Api kimliğimizi tanımlıyoruz
$api->SetAuth(1,"bayi@ts3.info.tr"); // Bayi Hesabımızı Doğruluyoruz
$api->SetHeader(); // Gerekli Bilgileri Header ile Bağlantı Adresine Gönderiyoruz

// Müşteri Hesabı Oluşturuyoruz
$api->SetAction('user_create'); // Müşteri Hesabı Oluşturacağımızı Belirttik
$api->SetParams(array("email" => "test@test.com", "name"=>"Test", "surname"=>"Test", "password"=>"test", "status" => 0)); // Gerekli bilgileri güncelliyoruz
$response = $api->send(); // Bağlantıyı sağlıyoruz ve post ediyoruz
$data=$response['data']; // Geri dönen verileri alıyoruz
?>

<?php 
if ($response['success'] == 1) {
?>
	<p>Oluşturulan Hesap: <?php echo $data['email']; ?></p>
<?php 
}else if($response['api_error'] == 1){
?>
    <div class="alert alert-danger"><?php echo $response['message']['api_error']; ?> | Hata Kodu:<?php echo $response['code']; ?></div>
<?php 
}else{
?>
    <div class="alert alert-danger">cURL Error: <?php echo $response['message']['curl_error']; ?></div>
<?php 
}
?>
