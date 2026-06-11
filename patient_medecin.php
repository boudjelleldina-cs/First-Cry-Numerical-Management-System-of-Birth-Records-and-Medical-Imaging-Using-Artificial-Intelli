<!DOCTYPE html>
<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['log_u'])) {
    header('location:loginpage.php');
    die;
}
include 'connection.php';


//if (isset($_POST["submit"])) 
{
		$id = $_GET["id"];
	    
		$medecin = $_SESSION['nom']." ".$_SESSION['prenom'] ;
		$id_medecin = $_SESSION['login_id'];
		
		
		/*$insert = "INSERT INTO  `admission`(`id_p`, `id_med`, `id_lit`, `service`)
		
		VALUES ('$id_p','$id_med','$id_lit', '$service')";
		$qry = mysqli_query($link, $insert) or die(mysqli_error($link));*/
		
		$updateType_abn = "UPDATE patient SET `med_p`= '$medecin', `id_med_p`= '$id_medecin'   WHERE `id_patient` = '$id'";

		
		$response1 = mysqli_query($link, $updateType_abn) or die(mysqli_error($link));
		
		
					
		
		echo '<script>alert("Enregistrement");</script>';
        
		header('location:Patient_Table.php');	
		
}
#$link->close();

?>
