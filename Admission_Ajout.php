<!DOCTYPE html>
<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['log_u'])) {
    header('location:loginpage.php');
    die;
}
include 'connection.php';


if (isset($_POST["submit"])) {
	    $id_p = $_POST["id_patient"];
        $id_med = $_POST["id_med"];
		$id_lit = $_POST["id_lit"];
		$service = $_POST["service"];
		$staut_chambre = 'Occupe';
		
	
		
		$insert = "INSERT INTO  `admission`(`id_p`, `id_med`, `id_lit`, `service`)
		
		VALUES ('$id_p','$id_med','$id_lit', '$service')";
		$qry = mysqli_query($link, $insert) or die(mysqli_error($link));
		
		$updateType_abn = "UPDATE lit SET `statut`= '$staut_chambre' WHERE `id` = '$id_lit'";

		
		$response1 = mysqli_query($link, $updateType_abn) or die(mysqli_error($link));
		
		echo '<script>alert("Enregistrement");</script>';
        
		header('location:Admission_Table_Agent.php');	
		
}
#$link->close();

?>

<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

	<!-- Site favicon -->
<!--<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">
-->
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body>
	

	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
		
		</div>
		
		<div class="header-right">
			
			<div class="dashboard-setting user-notification">
			
			</div>
			
			
			<div class="user-notification">
			<!-- STATUS (PULSE) -->
    <div style="
        position:absolute;
        top:20px;
        right:220px;
        display:flex;
        align-items:center;
        gap:6px;
        background:rgba(236,253,245,0.9);
        padding:4px 10px;
        border-radius:999px;
        border:1px solid #a7f3d0;
        backdrop-filter:blur(6px);
    ">

        <span style="
            width:8px;
            height:8px;
            background:#22c55e;
            border-radius:50%;
            box-shadow:0 0 0 0 rgba(34,197,94,0.7);
            animation:pulse 1.5s infinite;
        "></span>

        <span style="
            font-size:10px;
            color:#166534;
            font-weight:700;
        ">
            Actif
        </span>
    </div>
			
			</div>
			
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($_SESSION['img']); ?> " alt="" />
						</span>
						<span class="user-name"> <?php echo '' . $_SESSION['nom'] . ' '.$_SESSION['prenom'].''; ?>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Paramètres</a>
						<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a>
						<a class="dropdown-item" href="login.html"><i class="dw dw-logout"></i> Deconnexion</a>
					</div>
				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					
				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					
				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					
				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					
				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					
				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					
				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					
				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					
				</div>
			</div>
			<!--<div class="github-link">
				<a href="#" target="_blank"><img src="vendors/images/logo.png" alt="" width="50" height="50"></a>
			</div>-->
		</div>
	</div>
	
	
	<div class="right-sidebar">
	
	</div>
	

	<div class="left-side-bar">
		<div class="brand-logo">
			
				<!--<img src="vendors/images/logo.PNG" alt="" width="0" height="0" class="dark-logo">-->
				<!-- <img src="vendors/images/logo.PNG" alt="" class="light-logo"> -->		
		</div>
		<div class="brand-logo">
			<a href="index.html">
				<img src="vendors/images/logo.PNG" alt="" width="100" height="40" class="light-logo">
				<!-- <img src="vendors/images/logo.PNG" alt="" class="light-logo"> -->
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon icon-copy fi-torsos-female-male"></span><span class="mtext">Patient</span>
						</a>
						<ul class="submenu">
							<li><a href="index.html">Inscription</a></li>
							<li><a href="index2.html">Dossier</a></li>
							<li><a href="index2.html">Admission</a></li>
							<li><a href="index2.html">Sortie</a></li>
							<li><a href="index2.html">Analyses</a></li>
							
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon fa fa-user-md"></span><span class="mtext">Medecin</span>
						</a>
						<ul class="submenu">
							<li><a href="index.html">Inscription</a></li>
							<li><a href="index2.html">Dossier</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon icon-copy fi-torso-business"></span><span class="mtext">Agent</span>
						</a>
						<ul class="submenu">
							<li><a href="index.html">Inscription</a></li>
							<li><a href="index2.html">Dossier</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon fas fa-user-nurse"></span><span class="mtext">Infermière</span>
						</a>
						<ul class="submenu">
							<li><a href="index.html">Inscription</a></li>
							<li><a href="index2.html">Dossier</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon fas fa-baby"></span><span class="mtext">Nouveau né(e)</span>
						</a>
						<ul class="submenu">
							<li><a href="index.html">Inscription</a></li>
							<li><a href="index2.html">Dossier</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon fas fa-hand-holding-medical"></span><span class="mtext">Scanner</span>
						</a>
						<ul class="submenu">
							<li><a href="index.html">Tumeur avec IA</a></li>
							<li><a href="index2.html">Dossier</a></li>
						</ul>
					</li>
					
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
			<div class="row">
				<div class="col-xl-12 mb-30 ">
    <div class="card-box height-100-p pd-20">
<div class="col-12 mb-2">

<div style="
    position:relative;
    border:1px solid rgba(226,232,240,0.8);
    border-radius:14px;
    padding:14px;
    background:linear-gradient(145deg,#ffffff,#f8fafc);
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
    overflow:hidden;
">

    <!-- STATUS (PULSE) -->

    <!-- HEADER -->
    <div style="
        display:flex;
        flex-direction:column;
        align-items:center;
        text-align:center;
        margin-bottom:12px;
    ">

        <div style="
            width:38px;
            height:38px;
            background:linear-gradient(135deg,#1E63EE,#3b82f6);
            border-radius:12px;
            display:flex;
            align-items:center;
            justify-content:center;
            box-shadow:0 6px 14px rgba(30,99,238,0.25);
        ">
            <i class="icon-copy fi-torsos-female-male" style="color:white; font-size:20px;"></i>
        </div>

        <h2 style="
            margin:6px 0 0 0;
            font-weight:700;
            font-size:1.92rem;
            color:#0f172a;
        ">
            Admission de patient
        </h2>

    </div>

    <!-- CONTENT -->

</div>

</div>

<style>
@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(34,197,94,0.6); }
    70% { box-shadow: 0 0 0 8px rgba(34,197,94,0); }
    100% { box-shadow: 0 0 0 0 rgba(34,197,94,0); }
}
</style>
<form id="register" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle mt-2">
                                        <?php
                                        if (isset($error)) {
                                            foreach ($error as $e) {
                                                echo '<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">';
                                                echo '<span class="font-medium">' . $e . '</span>';
                                                echo '</div>';
                                            };
                                        };
                                        ?>
<div class="row">

    <!-- LEFT CARD -->
    <div class="col-lg-6 col-md-12">
     <div style="
    border:1px solid #ccc; 
    border-radius:10px; 
    padding:20px; 
    margin-bottom:25px;
    background:#f9f9f9;
    box-shadow:0 6px 18px rgba(0,0,0,0.1);
   
">
<div style="
    background:#0f4c81;
    color:white;
    padding:12px 15px;
    font-weight:700;
    font-size:1.2rem;
    margin: -20px -20px 20px -20px;
    border-radius:10px 10px 0 0;
">Informations Générale</div>
         
<div class="row">
	<?php
	$id = $_GET["id"];
	$result = mysqli_query($link, "SELECT * FROM patient WHERE id_patient='$id'");

	while ($row = mysqli_fetch_array($result)) 
	{
	
									
	?>
	<div class="col-md-6 col-sm-12 mb-3">
   <div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">ID Mère</div>
        <input type="text" style="color: red;" id="id_patient" name="id_patient" class="form-control" value="<?php echo $row['id_patient'];?>" placeholder="" readonly>
   </div>
    <div class="col-md-6 col-sm-12 mb-3">
   <div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">Nom</div>
        <input type="text" style="color: red;" id="nom" name="nom" class="form-control" value="<?php echo $row['nom_p'];?>" placeholder="" readonly >
    </div>
	<div class="col-md-6 col-sm-12 mb-3">
   <div style="    background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;" >Prénom</div>
        <input type="text" style="color: red;" id="prenom" name="prenom" class="form-control" value="<?php echo $row['prenom_p'];?>" placeholder="" readonly>
    </div>
	<div class="col-md-6 col-sm-12 mb-3">
   <div style="    background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;" >Nom à la naissance</div>
        <input type="text" style="color: red;" id="nom_nais" name="nom_nais" class="form-control" value="<?php echo $row['nom_p_nais'];?>" placeholder="" readonly>
    </div>
	<div class="col-md-6 col-sm-12 mb-3">
   <div style="    background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;" >Prénom conjoint</div>
        <input type="text" style="color: red;" id="prenom_c" name="prenom_c" class="form-control" value="<?php echo $row['prenom_c'];?>" placeholder="" readonly>
    </div>

		<div class="col-md-6 col-sm-12 mb-3">
        <div style="
            background:#e9ecef;
            color:black;
            padding:8px 12px;
            font-weight:600;
            margin-bottom:6px;
            border-radius:6px;">
            Date de naissance
        </div>

        <input type="date" id="date_saisie" name="date_saisie" class="form-control" value="<?php echo $row['date_nais_p'];?>" readonly>
    </div>
	<?php
	}
	?>
	<div class="col-md-6">
                    <div class="form-group">
					<div style="background:#8AFF8A; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">                            
					service 
                    </div>
                      <select class="custom-select2 form-control" id ="service" name="service" style="width: 100%; height: 38px;" required>
                                <option value="" selected disabled hidden>Choisir une chambre</option>
                                <?php
									
									$result = mysqli_query($link, "SELECT * FROM service_hopital;");

									while ($row = mysqli_fetch_array($result)) 
									{
									
										#echo'<option value="'.$row['wilaya_name_ascii'].'">'.$row['wilaya_name_ascii'].'</option>';
										#echo '<option value="chambre ' . $row['chambre_id'] . ' '. $row['numero_lit'] .'">' .'chambre '. $row['chambre_id'] .' '. $row['numero_lit'] . '</option>';
										echo '<option value="' . $row['nom_serv'] .'">' . $row['nom_serv'] .'</option>';
									}
									?>

                       </select>
                    </div>
    </div>
	<div class="col-md-6">
                    <div class="form-group">
					<div style="background:#8AFF8A; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">                            
					Numéro de lit 
                    </div>
                      <select class="custom-select2 form-control" id ="id_lit" name="id_lit" style="width: 100%; height: 38px;" required>
                                <option value="" selected disabled hidden>Choisir une chambre</option>
                                <?php
									
									$result = mysqli_query($link, "SELECT * FROM lit WHERE statut = 'Disponible';");

									while ($row = mysqli_fetch_array($result)) 
									{
									
										#echo'<option value="'.$row['wilaya_name_ascii'].'">'.$row['wilaya_name_ascii'].'</option>';
										#echo '<option value="chambre ' . $row['chambre_id'] . ' '. $row['numero_lit'] .'">' .'chambre '. $row['chambre_id'] .' '. $row['numero_lit'] . '</option>';
										echo '<option value="' . $row['id'] .'">' .'chambre '. $row['chambre_id'] .' '. $row['numero_lit'] . '</option>';
									}
									?>

                       </select>
                    </div>
    </div>
	<div class="col-md-6">
                    <div class="form-group">
					<div style="background:#8AFF8A; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">                            
					Medecin traitant 
                    </div>
                      <select class="custom-select2 form-control" id ="id_med" name="id_med" style="width: 100%; height: 38px;" required>
                                
                                <?php
									
									$result = mysqli_query($link, "SELECT * FROM patient WHERE id_patient='$id'");

									while ($row = mysqli_fetch_array($result)) 
									{
									
										#echo'<option value="'.$row['wilaya_name_ascii'].'">'.$row['wilaya_name_ascii'].'</option>';
										#echo '<option value="chambre ' . $row['chambre_id'] . ' '. $row['numero_lit'] .'">' .'chambre '. $row['chambre_id'] .' '. $row['numero_lit'] . '</option>';
										echo '<option value="' . $row['id_med_p'] .'">' .''. $row['med_p'] . '</option>';
									}
									?>

                       </select>
                    </div>
    </div>
   
  
	
	
   
   
   
</div>
	
            


	</div> <!-- CLOSE LEFT CARD -->
</div> <!-- CLOSE LEFT COLUMN -->





       


	    <!-- RIGHT SIDE -->
    
 <div style="display:flex; justify-content:flex-end; width:100%; gap:10px; margin-top:15px;">
<button type="button" class="btn btn-danger" onclick="window.location.href='Admission_Table_Agent.php';">Retour</button>
	<input
        type= "submit"
		id="submit"
        name = "submit"
		class="btn btn-primary"
        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 18px rgba(59,130,246,0.4)'"
        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(59,130,246,0.3)'"
		value ="Enregistrer"
    >
    

</div>

<script>

// RESET FORM
function resetForm() {
    if (confirm("Voulez-vous vraiment réinitialiser le formulaire ?")) {

        document.querySelectorAll("input").forEach(input => {
            if (input.type === "checkbox" || input.type === "radio") {
                input.checked = false;
            } else {
                input.value = "";
            }
        });

        document.querySelectorAll(".apgar-score-btn").forEach(btn => {
            btn.classList.remove("selected");
        });

        const total = document.getElementById("totalApgar");
        const s1 = document.getElementById("score1min");
        const s5 = document.getElementById("score5min");
        const s10 = document.getElementById("score10min");

        if (total) total.textContent = "0";
        if (s1) s1.textContent = "-";
        if (s5) s5.textContent = "-";
        if (s10) s10.textContent = "-";

        alert("Formulaire réinitialisé !");
    }
}


// SAVE FORM (PRO ANIMATION)
function saveForm() {

    const btn = document.getElementById("savebtn");

    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Enregistrement...';
    btn.disabled = true;

    setTimeout(() => {

        btn.innerHTML = '<i class="fa-solid fa-check"></i> Succès';
        btn.style.background = "#22c55e";

        setTimeout(() => {
            btn.innerHTML = '<i class="fa-solid fa-save"></i> Enregistrer';
            btn.style.background = "linear-gradient(135deg, #4f46e5, #3b82f6)";
            btn.disabled = false;
        }, 2000);

    }, 1200);
}

</script>
</div>

    </div>
				
</div>
</div>
</div>
	
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="vendors/scripts/dashboard.js"></script>
</body>
</html>