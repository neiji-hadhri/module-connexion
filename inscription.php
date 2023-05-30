<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription-Neimiane</title>
</head>
<body>
<h1>Page d'inscription pour un compte Neimiane</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $login = $_POST["login"];
        $prenom = $_POST["prenom"];
        $nom = $_POST["nom"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        if (empty($login) || empty($prenom) || empty($nom) || empty($password) || empty($confirm_password)){
            echo "Veuillez remplir tout les champs fournis.";
        }
        elseif($password != $confirm_password){
            echo "Le mot de passe n'est pas identique à la confirmation du mot de passe.Veuillez réesayer.";
        }
        elseif(strlen($password)< 8 ||
        !preg_match('/[a-z]/', $password) ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[0-9]/', $password) ||
        !preg_match('/[^a-zA-Z0-9]/', $password)){
            echo "Le mot de passe fournit ne contient pas les caractères : Il doit contenir au minimum 8 caractères, une minuscule, une majuscule, un chiffre et un caractère spécial.";
        }
        else{
            $servername = "localhost";
            $username = "root";
            $password = "N1610J2803C2912s?";
            $dbname = "moduleconnexion";
            $connexion = new mysqli ($servername, $username, $password, $dbname);
        
        if ($connexion -> connect_error){
            echo ("Erreur de connexion à la base de données : ". $connexion -> connect_error);
        }
            $sql = "INSERT INTO utilisateurs(login, prenom, nom, password) VALUES ('$login', '$prenom', '$nom', '$password')";
            if ($connexion ->query($sql) == TRUE){
                header("Location: connexion.php");
                exit();
        }else{
            echo "Erreur lors de l'inscription : " . $connexion -> error;
        }
        $connexion -> close();
    }
}
    ?>
    <form action = "<?php echo $_SERVER["PHP_SELF"]; ?>"method = "POST">

    <label for = "login">Login : </label>
    <input type ="text" id = "login" name = "login" required><br><br>

    <label for = "prenom">Prenom : </label>
    <input type = "text" id = "prenom" name = "prenom" required><br><br>

    <label for = "nom">Nom : </label>
    <input type = "text" id = "nom" name = "nom" required><br><br>


    <label for = "password">Mot de passe : </label>
    <input type = "password" id = "password" name = "password" required><br><br>

    <label for = "confirm_password">Confirmer le mot de passe : </label>
    <input type = "password" id = "confirm_password" name = "confirm_password" required><br><br>

    <input type = "submit" value = "Inscription">
    </form>

    
</body>
</html>