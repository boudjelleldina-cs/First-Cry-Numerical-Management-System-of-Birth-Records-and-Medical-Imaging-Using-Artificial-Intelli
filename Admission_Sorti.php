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
	    
		$date_sortie = date('Y/m/d H:i:s');
		
		
		/*$insert = "INSERT INTO  `admission`(`id_p`, `id_med`, `id_lit`, `service`)
		
		VALUES ('$id_p','$id_med','$id_lit', '$service')";
		$qry = mysqli_query($link, $insert) or die(mysqli_error($link));*/
		
		$updateType_abn = "UPDATE admission SET `date_sorti`= '$date_sortie', `admis`= 'Sortie'  WHERE `id_admis` = '$id'";

		
		$response1 = mysqli_query($link, $updateType_abn) or die(mysqli_error($link));
		
		
					$res3 = mysqli_query($link, "SELECT * FROM admission WHERE `id_admis` = '$id'");

					while ($row3 = mysqli_fetch_assoc($res3)) {
						$Id_chambre = $row3['id_lit'];
						$res5 = "UPDATE lit SET `statut`= 'Disponible' WHERE `id` = '$Id_chambre'";
						$response5 = mysqli_query($link, $res5) or die(mysqli_error($link));
					}
		
		echo '<script>alert("Enregistrement");</script>';
        
		header('location:Admission_Table_Agent.php');	
		
}
#$link->close();

?>
