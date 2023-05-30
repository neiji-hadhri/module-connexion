<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $login = $_POST["login"];
        $password = $_POST["password"];

        $username = "nom_utilisateur";
        $servername = "root";
        $password_db = "N1610J2803C2912s?";
        $dbname = "moduleconnexion";
        $connexion = new mysqli($username, $servername, $password_db, $dbname);


        if ($connexion -> connect_error){
            die ("Erreur de connexion à la base de données" . $connexion ->connect_error);
        }

        $verifutilisateur = "SELECT * FROM UTILISATEUR WHERE login = '$login' AND password = '$password'";
        $result = $connexion ->query($verifutilisateur); 

        if ($result -> num_rows == 1){
            $_SESSION["logged_in"] = TRUE;

            header("Location= index.php");
            exit();
        }else{
            echo "Identifiants de connexion invalides .Veuillez réessayer";
        }
        $connexion -> close();

    }

    ?>

<form action = "<?php echo $_SERVER["PHP_SELF"]; ?>"method = "POST">

<label for = "login">Login : </label>
<input type = "text" id = "login" name = "login" required><br><br>

<label for = "password">Mot de passe : </label>
<input type = "password" id = "password" name = "password" required><br><br>

<input type = "submit" value = "Connexion">
</form>
    
</body>
</html>