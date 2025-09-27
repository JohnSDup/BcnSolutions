<?php
$user = 'admin';
$pass = 'changeme';


if (!isset($_SERVER['PHP_AUTH_USER']) ||
$_SERVER['PHP_AUTH_USER'] !== $user ||
$_SERVER['PHP_AUTH_PW'] !== $pass) {
header('WWW-Authenticate: Basic realm="Admin"');
header('HTTP/1.0 401 Unauthorized');
echo 'Autenticación requerida.';
exit;
}


include 'db.php';
$subs = $pdo->query("SELECT * FROM subscribers ORDER BY created_at DESC LIMIT 100")->fetchAll(PDO::FETCH_ASSOC);
$views = $pdo->query("SELECT * FROM pageviews ORDER BY created_at DESC LIMIT 100")->fetchAll(PDO::FETCH_ASSOC);
?>


<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>BcnSolutions - Panel Admin</title>
</head>
<body>
<h1>BcnSolutions - Panel Admin</h1>


<h2>Últimos suscriptores</h2>
<table border="1">
<tr><th>ID</th><th>Email</th><th>IP</th><th>Ciudad</th><th>País</th><th>Fecha</th></tr>
<?php foreach($subs as $s): ?>
<tr>
<td><?= $s['id'] ?></td>
<td><?= htmlspecialchars($s['email']) ?></td>
<td><?= $s['ip'] ?></td>
<td><?= $s['city'] ?></td>
<td><?= $s['country'] ?></td>
<td><?= $s['created_at'] ?></td>
</tr>
<?php endforeach; ?>
</table>


<h2>Últimos pageviews</h2>
<table border="1">
<tr><th>ID</th><th>Path</th><th>IP</th><th>Ciudad</th><th>País</th><th>User Agent</th><th>Fecha</th></tr>
<?php foreach($views as $v): ?>
<tr>
<td><?= $v['id'] ?></td>
<td><?= htmlspecialchars($v['path']) ?></td>
<td><?= $v['ip'] ?></td>
<td><?= $v['city'] ?></td>
<td><?= $v['country'] ?></td>
<td><?= htmlspecialchars($v['user_agent']) ?></td>
<td><?= $v['created_at'] ?></td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>