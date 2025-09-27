<?php
include 'db.php';


if(!isset($_POST['email'])) {
die("No se recibió email.");
}


$email = strtolower(trim($_POST['email']));
$ip = $_SERVER['REMOTE_ADDR'];


$geo = json_decode(file_get_contents("http://ip-api.com/json/$ip"));
$country = $geo->country ?? '';
$city = $geo->city ?? '';


try {
$stmt = $pdo->prepare("INSERT INTO subscribers (email, ip, country, city) VALUES (?, ?, ?, ?)");
$stmt->execute([$email, $ip, $country, $city]);
echo "✅ Gracias, suscripción guardada.";
} catch (Exception $e) {
echo "❌ Ya estás suscrito o hubo un error.";
}
?>