<?php 
include '../lib/tspanel.class.php';
$apikey="YourApiKey";
$secret="YourApiSecretKey";

$api = new tspanel_api("https://www.tspanel.pro/api/"); // Bağlantı Sağlıyoruz
$api->SetApi($apikey,$secret); // Api kimliğimizi tanımlıyoruz
$api->SetAuth(1,"bayi@tspanel.pro"); // Bayi Hesabımızı Doğruluyoruz
$api->SetHeader(); // Gerekli Bilgileri Header ile Bağlantı Adresine Gönderiyoruz

// Tek Seferlik Giriş Kodu Oluşturuyoruz
$api->SetAction('create_user_session'); // Session Oluşturacağımızı Belirttik
$api->SetParams(array("user_id" => 1, "user_email"=> "test@test.com")); // Gerekli bilgileri güncelliyoruz
$response = $api->send(); // Bağlantıyı sağlıyoruz ve post ediyoruz
$code=$response['data']; // Session Kodumuz
?>

<?php 
if ($response['success'] == 1) {
?>
	<p>Oturum Açılacak Hesap: test@test.com</p>
	<p>Oturum Kodunuz: <?php echo $code; ?></p>
	<a href="https://www.tspanel.pro/api/session/<?php echo $code; ?>">Giriş yapmak için tıklayınız</a>
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