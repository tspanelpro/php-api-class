# php-api-class
 TS3.INFO.TR Tam otomatik PHP Api Class

# Sayfaya Dahil Etme
  		<?php 
  		include 'tspanel.class.php';
  		?>

# Örnek Bağlantı

  		<?php
  		$apikey="ApiKey";
		$secret="ApiSecretKey";

		$api = new tspanel_api("https://panel.ts3.info.tr/api/"); // Bağlantı Sağlıyoruz
		$api->SetApi($apikey,$secret); // Api kimliğimizi tanımlıyoruz
		$api->SetAuth(BayiID(Integer),"BayiEmail"); // Bayi Hesabımızı Doğruluyoruz
		$api->SetHeader(); // Gerekli Bilgileri Header ile Bağlantı Adresine Gönderiyoruz
  		?>

# Örnek Api İşlemi
         <?php
         	// Bayi hesabımızın bilgilerini alıyoruz
			$api->SetAction('account'); // Bayi Hesabının Bilgilerini Alacağımızı Belirttik
			$response = $api->send(); // Bağlantıyı sağlıyoruz ve post ediyoruz
			$status=$response['success']; // Geri dönen verileri alıyoruz
         ?>
# Api Dökümasyonları https://panel.ts3.info.tr/dev/intro

# Powered and Created by TS3.INFO.TR
