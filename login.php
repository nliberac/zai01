<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == "true"){
    header("location: index.php");
    exit;
}
require_once "config.php";

$username = $password ="";
$username_err = $password_err = $login_err = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Prosze wprowadzic nazwé uzytkownika.";
    } else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Prosze wprowadzic nazwe uzytkownika";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty($username_err) && empty($password_err)){
        $sql = "select id, username, password from users where username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_sername);

            $param_sername=$username;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            
                            header("location: index.php");
                    }    else {
                        $login_err = "Niepoprawne haslo";
                    }
        }
    } else {
        $login_err = "Nie znaleziono konta z taka nazwa uzytkownika";
    }
} else {
    echo "Cos poszlo nie tak";
}
mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}
?>
