<?php 

require_once 'init.inc.php';

$alert='';

if(!empty($_POST)){

    if (!isset($_POST['nom']) || strlen($_POST['nom']) <2 || strlen($_POST['nom']) >20 ) $alert .= '<div >Le nom doit contenir entre 2 et 20 caractères.</div>';

    if (!isset($_POST['prenom']) || strlen($_POST['prenom']) <2 || strlen($_POST['prenom']) >20 ) $alert .= '<div >Le prénom doit contenir entre 2 et 20 caractères.</div>';

    if (!isset($_POST['civilite']) || ($_POST['civilite'] != 'm' && $_POST['civilite'] != 'f')) $alert .= '<div >La civilité n\'est pas valide.</div>';

    if (!isset($_POST['poste']) || ($_POST['poste'] != 'directeur' && $_POST['poste'] != 'chef_cuisinier' && $_POST['poste'] != 'serveur' && $_POST['poste'] != 'caisse' && $_POST['poste'] != 'livreur')) $alert .= '<div >Le poste n\'est pas valide.</div>';

    if (!isset($_POST['service']) || strlen($_POST['service']) <2 || strlen($_POST['service']) >50 ) $alert .= '<div >Le service doit contenir entre 2 et 50 caractères.</div>';

    function validateDate($date, $format = 'd-m-Y') { 
		
		$d = DateTime::createFromFormat($format, $date); 

		if ($d && $d->format($format) == $date) {
			return true;
		} else {
			return false;
		}	
	}

    if (!isset($_POST['date_naissance']) || !validateDate($_POST['date_naissance'], 'Y') || $_POST['date_naissance'] < (date('Y')-100) || $_POST['date_naissance'] > date('Y')) $alert .= '<div >La date n\'est pas valide.</div>';

   
    

} //fin du if(!empty($_POST)){
    $yolo = '<li> <a class="nav-link" href="'. RACINE_SITE .'connexion.php?action=deconnexion">Se déconnecter</a></li>';
echo $alert;
echo $yolo;

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Salariés</title>
</head>
<body>
    

    <h1>Salariés</h1>

    <form action="" method="post">
        <label for="nom">Nom</label><br>
        <input type="text" name="nom" id="nom"><br><br>

        <label for="prenom">Prénom</label><br>
        <input type="text" name="prenom" id="prenom"><br><br>



        <label for="date_naissance">Date naissance</label><br>
<?php
        $annees = '';
            $annees .= '<select name="date_naissance">';
            for($i = date('Y'); $i >= date('Y')-100; $i--){ // date('Y') donne l'année en cours soit 2018.
                $annees .= "<option>". $i ."</option>";
            }
            $annees .= '</select> <br><br>';
        echo $annees;
?>

        <label for="civilite">Civilité</label><br>
        <select name="civilite">
            <option value="m">Homme</option>
            <option value="f">Femme</option>
        </select><br><br>

        <label for="poste">Poste</label><br>
        <select name="poste">
            <option value="directeur">Directeur</option>
            <option value="chef_cuisinier">Chef cuisinier</option>
            <option value="serveur">Serveur</option>
            <option value="caisse">Caisse</option>
            <option value="livreur">Livreur</option>
        </select><br><br>
        
        <label for="service">Service</label><br>
        <input type="text" name="service" id="service"><br><br>
    
        <input type="submit" name="ajouter_bdd" value="Ajouter à la bdd">
        
    </form>

</body>
</html>