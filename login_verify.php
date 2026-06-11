<?php
require 'connection.php';
session_start();

if (isset($_POST['submit'])) {
	
	
	$username = $_POST['username'];
    $pass = $_POST['password'];
	
	$role = $_POST['role'];;

	switch ($role) {
			case 'Admin': $select = "SELECT * FROM administrateur WHERE id_adm='$username' AND pass_adm='$pass'";
							$select_admin = mysqli_query($link, $select);

							if (mysqli_num_rows($select_admin) > 0) 
							{
								$row = mysqli_fetch_assoc($select_admin);
								$_SESSION['log_u'] = true;
								$_SESSION['role'] = 'admin';
								$_SESSION['login_id'] = $row['id_adm'];
								$_SESSION['nom'] = $row['nom_adm'];
								$_SESSION['prenom'] = $row['prenom_adm'];
								$_SESSION['img'] = $row['img_adm'];

								header("Location: Admin_Acceuil.php");
								exit();
							}
			
			
			
			case 'Agent': $select = "SELECT * FROM agent WHERE id_agent='$username' AND password='$pass'";
							$select_admin = mysqli_query($link, $select);

							if (mysqli_num_rows($select_admin) > 0) 
							{
								$row = mysqli_fetch_assoc($select_admin);
								$_SESSION['log_u'] = true;
								$_SESSION['role'] = 'agent';
								$_SESSION['login_id'] = $row['id_agent'];
								$_SESSION['nom'] = $row['nom'];
								$_SESSION['prenom'] = $row['prenom'];
								$_SESSION['img'] = $row['photo'];

								header("Location: Agent_Menu.php");
								exit();
							}
			case 'Medecin':$select = "SELECT * FROM medecin WHERE id_med='$username' AND pass_med='$pass'";
					$select_admin = mysqli_query($link, $select);

							if (mysqli_num_rows($select_admin) > 0) 
							{
								$row = mysqli_fetch_assoc($select_admin);
								$_SESSION['log_u'] = true;
								$_SESSION['role'] = 'medecin';
								$_SESSION['login_id'] = $row['id_med'];
								$_SESSION['nom'] = $row['nom_med'];
								$_SESSION['prenom'] = $row['prenom_med'];
								$_SESSION['img'] = $row['img_med'];

								header("Location: Medecin_Menu.php"); 
								exit();
							}
			case 'Infermier':$select = "SELECT * FROM infirmier WHERE id_infirmier='$username' AND pass_inf='$pass'";
							$select_admin = mysqli_query($link, $select);

							if (mysqli_num_rows($select_admin) > 0) 
							{
								$row = mysqli_fetch_assoc($select_admin);
								$_SESSION['log_u'] = true;
								$_SESSION['role'] = 'medecin';
								$_SESSION['login_id'] = $row['id_med'];
								$_SESSION['nom'] = $row['nom_med'];
								$_SESSION['prenom'] = $row['prenom_med'];
								$_SESSION['img'] = $row['img_med'];

								header("Location: Nee_Table_Infirmier.php"); 
								exit();
							}
			
			break; // Stop execution here
			

					}

    /*
	$username = mysqli_real_escape_string($link, $_POST['username']);
    $pass     = mysqli_real_escape_string($link, $_POST['password']);
	*/
    /* LOGIN ADMIN */

    $select_admin = mysqli_query($link,
    "SELECT * FROM administrateur
     WHERE id_adm='$username'
     AND pass_adm='$pass'");

    if (mysqli_num_rows($select_admin) > 0) {

        $row = mysqli_fetch_assoc($select_admin);

        $_SESSION['log_u'] = true;
        $_SESSION['role'] = 'admin';

        $_SESSION['login_id'] = $row['id_adm'];
        $_SESSION['nom'] = $row['nom_adm'];
        $_SESSION['prenom'] = $row['prenom_adm'];
        $_SESSION['img'] = $row['img_adm'];

        header("Location: Medecin_Table.php");
        exit();
    }

    /*LOGIN MEDECIN*/

    $select_med = mysqli_query($link,
    "SELECT * FROM medecin
     WHERE mail_med='$username'
     AND pass_med='$pass'");

    if (mysqli_num_rows($select_med) > 0) {

        $row = mysqli_fetch_assoc($select_med);

        $_SESSION['log_u'] = true;
        $_SESSION['role'] = 'medecin';

        $_SESSION['id_med'] = $row['id_med'];
        $_SESSION['nom'] = $row['nom_med'];
        $_SESSION['prenom'] = $row['prenom_med'];
        $_SESSION['img'] = $row['img_med'];

        header("Location: Patient_Table.php");
        exit();
    }

    /* LOGIN FAILED*/
    header("Location: login.php?error=1");
    exit();
}
?>