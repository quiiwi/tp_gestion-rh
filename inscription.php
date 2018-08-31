<?php

require_once 'init.inc.php';


if(!empty($_POST)){ 

	if (!isset($_POST['pseudo']) || strlen($_POST['pseudo']) <4 || strlen($_POST['pseudo']) >20    ) $contenu .= '<div">Le pseudo doit contenir entre 4 et 20 caract�res.</div>';

	if (!isset($_POST['mot_de_passe']) || strlen($_POST['mot_de_passe']) <4 || strlen($_POST['mot_de_passe']) >32    ) $contenu .= '<div">Le mot de passe doit contenir entre 4 et 32 caract�res.</div>';

	if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $contenu .= '<div">L\'email n\'est pas correct.</div>'; 

	if (empty($contenu)){
		$membre = executeRequete("SELECT * FROM inscrit WHERE pseudo = :pseudo", array(':pseudo' => $_POST['pseudo'])); 

		if($membre -> rowCount() > 0) { 
			$contenu .= '<div"> Le pseudo est indisponible. Veuillez en choisir un autre. </div>';
		} else {
			
			executeRequete("INSERT INTO inscrit (pseudo, mot_de_passe, email, statut) VALUES (:pseudo, :mot_de_passe, :email, 0) ",
				array(':pseudo' => $_POST['pseudo'],
					  ':mot_de_passe' => $_POST['mot_de_passe'],
					  ':email' => $_POST['email'],
                ));
                
            $contenu .= '<div class="bg-success"> Vous êtes inscrit à notre site. <a href="connexion.php"> cliquez ici pour vous connecter. </a>  </div>';


		}//fin du else


	} //fin du if (empty($contenu))


} //fin du if(!empty($_POST)){
    $yolooo ='<li> <a class="nav-link" href="'. RACINE_SITE .'connexion.php">Connexion</a></li>';
    echo $yolooo;
    echo $contenu;

?>





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>

    <form action="" method="post">

        <label for="pseudo">Pseudo</label><br>
        <input type="text" name="pseudo" id="pseudo"><br><br>

        <label for="mot_de_passe">Mot de passe</label><br>
        <input type="text" name="mot_de_passe" id="pseudo"><br><br>

        <label for="email">Email</label><br>
        <input type="text" name="email" id="email"><br><br>
    
        <input type="submit" name="inscription" value="Vous inscrire">
    
    </form>


</body>
</html>