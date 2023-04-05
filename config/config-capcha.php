<?php
// Backend CloudFare Turnstile Captcha
$SECRET_KEY = '0x4AAAAAAADR2xz5lPYphZCyMeSrpixEzk8';
$login = $_POST['login'];
$pswd = $_POST['password'];
include_once 'db.php';

$formData = array(
	'secret' => $SECRET_KEY,
	'response' => $_POST['cf-turnstile-response'],
);

$url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
$options = array(
	'http' => array(
		'header' => "Content-type: application/x-www-form-urlencoded\r\n",
		'method' => 'POST',
		'content' => http_build_query($formData),
	),
);

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$outcome = json_decode($result, true);

//verification du résultat du capcha
if ($outcome['success']) {
	// si ok recupération des identifiants envoyés
	$_SESSION["captcha"] = true;
	$_POST['login'] = $login;
	$_POST['password'] = $pswd;
	//puis verification de leur authenticité
	configLogin($login, $pswd);
} else {
	header("Location: /login");
}

//verification de l'utilisateur dans la bd et association du rôles associé
function configLogin($login, $password){
	try {
		$pdo = new PDO("mysql:dbname=db_tuniv;host=localhost", "root", "", [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
	} catch (PDOException $e) {
		die();
	}
	$statement = $pdo->prepare("SELECT count(*) FROM Utilisateurs WHERE Identifiant =:varLogin");
	$statement->execute(['varLogin' => "$login"]);
	$res = $statement->fetch();

	if ($res[0] == 1) { // On vérifie qu'il existe un utilisateur avec l'identifiant donné
		$statement = $pdo->prepare("SELECT Mot_de_passe FROM Utilisateurs WHERE Identifiant=:varLogin");
		$statement->execute(['varLogin' => "$login",]);
		$passwordHashe = $statement->fetch()[0];
		if (password_verify($password,$passwordHashe)) { // Si oui, on vérifie que le mot de passe donné correspond à celui de l'utilisateur
			$statement = $pdo->prepare("SELECT Type_user FROM Utilisateurs WHERE Identifiant=:varLogin");
			$statement->execute(['varLogin' => "$login"]);
			$type = $statement->fetch()[0];
			if ($type == 0) {
				$_SESSION["loggedIn"] = true;
				$statement = $pdo->prepare("SELECT ID_User FROM Utilisateurs WHERE Identifiant=:varLogin AND Mot_de_passe=:varPassword");
				$statement->execute(['varLogin' => "$login", 'varPassword' => "$passwordHashe"]);
				$res = $statement->fetch();
				$_SESSION["userId"] = $res[0];
				$_SESSION["type"] = "administrateur";
				header("Location: /index");
			} else if ($type == 1) {
				$_SESSION["loggedIn"] = true;
				$statement = $pdo->prepare("SELECT ID_User FROM Utilisateurs WHERE Identifiant=:varLogin AND Mot_de_passe=:varPassword");
				$statement->execute(['varLogin' => "$login", 'varPassword' => "$passwordHashe"]);
				$res = $statement->fetch();
				$_SESSION["userId"] = $res[0];
				$_SESSION["type"] = "arbitre";
				header("Location: /index");
			} else {
				$_SESSION["loggedIn"] = true;
				$statement = $pdo->prepare("SELECT ID_User FROM Utilisateurs WHERE Identifiant=:varLogin AND Mot_de_passe=:varPassword");
				$statement->execute(['varLogin' => "$login", 'varPassword' => "$passwordHashe"]);
				$res = $statement->fetch();
				$_SESSION["userId"] = $res[0];
				$_SESSION["type"] = "capitaine";
				header("Location: /index");
			}
		} else {
			// Si le mot de passe n'est pas bon, on le renvoie vers la page de connexion avec un message d'erreur
			$_SESSION["errorMessage"] = "Mot de passe incorrect";
			header("Location: /login");
		}
	} else {
		// Si l'utilisateur n'existe pas, on le renvoie vers la page de connexion avec un message d'erreur
		$_SESSION["errorMessage"] = "L'utilisateur n'existe pas.";
		header("Location: /login");
	}
};
?>