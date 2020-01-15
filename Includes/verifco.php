<?php
// include ('verif.php');
include ('config.php');
session_start();
try {
$bdd= new PDO(DSN, USERNAME, PWD);
}
catch(PDOException $e){
    echo $e -> getMessage();
}

$pseudo = $_POST["pseudo"];
//$mail = $_POST["mail"];
$password = $_POST["pwd"];
$submit = $_POST["submit"];

if(isset($submit)){
    if(!empty($pseudo) AND !empty($password)){
        // $request = $bdd->prepare("SELECT * FROM user WHERE pseudo = ? AND password = ?");
        // select user from db where pseudo === pseudo in db
        $request = $bdd->prepare("SELECT * FROM users WHERE pseudo = ?");
        $request->execute(array($pseudo));
        // $request->execute(array($pseudo, $password));
        $userexist = $request->rowCount();

        // check if password matches password in db
          if($userexist === 1){
              $userinfo = $request->fetch(PDO::FETCH_ASSOC);
            if(password_verify($_POST["pwd"], $userinfo['password'])){
                echo "Vous etes connecté";
                $_SESSION['id'] = $userinfo['id'];
                $_SESSION['pseudo'] = $userinfo['pseudo'];
                //$_SESSION['pwd'] = $userinfo['pwd'];
                header("location: user?id=".$_SESSION['id']);
            } else {
                $error = "Mauvais mot de passe";
            }
        }
            else {
                $error = "Mauvais pseudo";
            }
        }
        else {
            $error = 'Veuillez remplir tout les champs';
        }
    }

?>