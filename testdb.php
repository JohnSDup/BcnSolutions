<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=bcnsolutions", "root", "");
    echo "¡Conexión exitosa!";
} catch (Exception $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>