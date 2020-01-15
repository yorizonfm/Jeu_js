<?php
include ('config.php');
try {

$bdd = new PDO(DSN, USERNAME, PWD);
}
catch(PDOException $e){
    echo $e -> getMessage();
}

$pseudo = $_POST["pseudo"];
$mail = $_POST["mail"];
$password = $_POST["pwd"];
$repassword = $_POST["pwd2"];
$submit = $_POST["submit"];
                                  // nettoyage et cryptage //
$pseudo = htmlspecialchars(trim($_POST['pseudo']));
$mail = htmlspecialchars(trim($_POST['mail']));
$password = htmlspecialchars(trim($_POST['pwd']));
$hashpassword = password_hash($password, PASSWORD_DEFAULT);

                                // verif et insertion//
if(isset($submit)){
    if(!empty($pseudo) AND !empty($mail) AND !empty($password) AND !empty($repassword)){
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
            if($password === $repassword){
                $request = $bdd ->prepare("SELECT * FROM users WHERE mail = ? AND pseudo = ?");
                $request->execute(array($mail, $pseudo));
                $requestexist = $request->rowCount();
                $error = "Votre compte a bien été créé";

                if($requestexist === 0){
                    $insert = $bdd->prepare("INSERT INTO users (pseudo, mail, password) VALUES(?, ?, ?)");
                    $insert->execute(array($pseudo, $mail, $hashpassword));
                }
                else{
                    $error = 'Cette email/pseudo est déjà utilisé';
                }
            }
            else{
                $error = 'Les mots de passe ne correspondent pas';
            }
        }
        else{
            $error = 'Email non valide';
        }
    }
    else{
        $error = 'Veuillez remplire tout les champs';
    }
}
?>