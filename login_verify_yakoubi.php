<?php
require 'connection.php';
session_start();

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $pass = $_POST['password'];
	
	$role = $_POST['role'];;

	switch ($role) {
			case 'Admin': $select = "SELECT * FROM administrateur WHERE id_adm='$username' AND pass_adm='$pass'";
			case 'Agent': $select = "SELECT * FROM administrateur WHERE id_adm='$username' AND pass_adm='$pass'";
			case 'Medecin': 
			case 'Infermiere':	
        break; // Stop execution here

    case 'subscriber':
        echo "You can only read content.";
        break;

    default:
        echo "Access denied.";
        break;
}
	
    $select = "SELECT * FROM administrateur WHERE id_adm='$username' AND pass_adm='$pass'";
    $result = mysqli_query($link, $select);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        $_SESSION['log_u'] = true;
        $_SESSION['login_id'] = $row['id_adm'];
        $_SESSION['nom'] = $row['nom_adm'];
        $_SESSION['prenom'] = $row['prenom_adm'];
		$_SESSION['img'] = $row['img_adm'];
		
		//header("Location:medecin_ajout.php ");
		header("Location:Admin_Acceuil2.php ");
                break;
		
        /*$_SESSION['role'] = $row['role'];

        switch ($row['role']) {

            case 'admin':
                header("Location:table.php ");
                break;

            case 'sage_femme':
                header("Location: index2.php");
                break;

            case 'medecin':
                header("Location: index.php");
                break;

            default:
                header("Location: login.php");
        }*/

        exit();

    } else {
        header("Location: login.php?error=1");
        exit();
    }
}