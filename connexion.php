<?php

require_once 'init.inc.php';


if (isset($_GET['action']) && $_GET['action'] == 'deconnexion'){

	session_destroy();

}


if(!empty($_POST)){

	if(!isset($_POST['pseudo']) || empty($_POST['pseudo'])) {
		$contenu .= '<div"> Le pseudo est requis. </div>';
	}

	if(!isset($_POST['mot_de_passe']) || empty($_POST['mot_de_passe'])) {
		$contenu .= '<div> Le mot de passe est requis. </div>';
	}


	if (empty($contenu)) {

		$membre = executeRequete("SELECT * FROM inscrit WHERE pseudo = :pseudo AND mot_de_passe = :mot_de_passe", array( ':pseudo' => $_POST['pseudo'], ':mot_de_passe' => $_POST['mot_de_passe']));

		if ($membre -> rowCount() >0 ){ 

            $informations = $membre->fetch(PDO::FETCH_ASSOC); 
            

			$_SESSION['inscrit'] = $informations;

			header('location:ajout_salarie.php');
			exit();
		
		} else {
			
			$contenu .= '<div> Erreur sur les identifiants. </div>';
		}
	
	}


}
$yoloo = '<li> <a class="nav-link" href="'. RACINE_SITE .'inscription.php">Inscription</a></li>';
echo $yoloo;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>
</head>
<body>
    <h1 class="mt-4"> Connexion </h1>
	<?php echo $contenu; ?>

	<form method="post" action="">
		
		<label for="pseudo">Pseudo</label><br>
		<input type="text" name="pseudo" id="pseudo" value=""><br><br>

		<label for="mot_de_passe">Mot de passe</label><br>
		<input type="password" name="mot_de_passe" id="mot_de_passe" value=""><br><br>

		<input type="submit" value="Se connecter">
	</form>
</body>
</html>