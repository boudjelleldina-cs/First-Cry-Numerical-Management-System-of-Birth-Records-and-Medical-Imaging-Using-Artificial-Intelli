<!DOCTYPE html>
<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['log_u'])) {
    header('location:loginpage.php');
    die;
}

include 'connection.php';


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
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	
	
	<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
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
			<!--
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
						<i class="dw dw-settings2"></i>
					</a>
				</div>
			-->
			</div>
			
			
	<div class="user-notification">
			<!-- STATUS (PULSE) -->
    <div style="
        position:absolute;
        top:20px;
        right:10px;
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
            <i class="icon-copy fa fa-user-md" style="color:white; font-size:20px;"></i>
        </div>

        <h2 style="
            margin:6px 0 0 0;
            font-weight:700;
            font-size:1.92rem;
            color:#0f172a;
        ">
            Gestion dossier admission
        </h2>

    </div>

    <!-- CONTENT -->

</div>

</div>

<div class="col-md-10">
            <div class="row g-4">
                <!-- Revenue Card -->
                <div class="col-md-3">
                    <div class="stat-card p-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="stat-icon bg-success bg-opacity-10">
                                <i class="fas fa-user-tie text-primary fs-4"></i>
                            </div>
                           
                        </div>
                        <h5 class="mb-1 text-primary">Total</h5>
                        <h3 class="mb-3"><?php
										$res = mysqli_query($link, "SELECT COUNT(*) AS total FROM agent");
										$tot = mysqli_fetch_assoc($res);
										echo $tot['total'];										
										?>				
						</h3>
                        
                    </div>
                </div>
                <!-- Users Card -->
                <div class="col-md-3">
                    <div class="stat-card2 p-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="stat-icon bg-primary bg-opacity-10">
                                <i class="fas fa-user-tie text-success fs-4"></i>
                            </div>
                            
                        </div>
                        <h5 class="mb-1 text-success">Admis</h5>
                        <h3 class="mb-3"><?php
										$res = mysqli_query($link, "SELECT COUNT(*) AS total FROM agent WHERE statut='Actif'");
										$tot = mysqli_fetch_assoc($res);
										echo $tot['total'];										
										?>				
						</h3>
                        
                    </div>
                </div>
				
                <!-- Orders Card -->
                <div class="col-md-3">
                    <div class="stat-card3 p-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="stat-icon bg-warning bg-opacity-10">
                                <i class="fas fa-user-tie text-danger fs-4"></i>
                            </div>
                            
                        </div>
                        <h5 class="mb-1 text-danger">Sortie</h5>
                        <h3 class="mb-3"><?php
										$res = mysqli_query($link, "SELECT COUNT(*) AS total FROM agent WHERE statut='Inactif'");
										$tot = mysqli_fetch_assoc($res);
										echo $tot['total'];										
										?>				
						</h3>
                        
                    </div>
                </div>
				
            </div>
        </div>


<style>
@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(34,197,94,0.6); }
    70% { box-shadow: 0 0 0 8px rgba(34,197,94,0); }
    100% { box-shadow: 0 0 0 0 rgba(34,197,94,0); }
}
</style>
<style>
.red-circle {
  width: 15px;
  height: 15px;
  background-color: red; /* Or use HEX: #FF0000 */
  border-radius: 50%;
}
.green-circle {
  width: 15px;
  height: 15px;
  background-color: green; /* Or use HEX: #FF0000 */
  border-radius: 50%;
}
</style>

<div class="row">

    <!-- LEFT CARD (Identification) -->
    <div class="col-md-12 mb-3">

       <div style="
			border:1px solid #ccc; 
			border-radius:10px; 
			padding:16px; 
			background:#f9f9f9;
			box-shadow:0 6px 18px rgba(0,0,0,0.1);
			margin-bottom:20px;
			transition: all 0.25s ease;"
			onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 25px rgba(0,0,0,0.15)'"
			onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 6px 18px rgba(0,0,0,0.1)'"
		>

           <div class="p-12 md:p-8" style="padding:0;">
				<div style="
							background:#1C0804;
							color:white;
							padding:12px 15px;
							font-weight:700;
							font-size:1.2rem;
							margin: -20px -18px 15px -18px;
							border-radius:10px 10px 0 0;
							">
				Liste des admissions
				<a href="Medecin_Menu.php" style="background:#D42424;color:white;font-weight:700;
										padding:5px 14px;border-radius:6px;text-decoration:none;font-size:0.9rem;">
										<i class="fa-solid fa-backward"></i> Retour
									</a>
									
				</div>
                    

             <div class="form-group">
				<table id="myTable" class="table table-striped table-hover">
        <thead>
            <tr>
                <th><div class="custom-label-box">ID</div></th>
                <th><div class="custom-label-box">Nom</div></th>
                <th><div class="custom-label-box">Prénom</div></th>
				<th><div class="custom-label-box">Nom à la naissance</div></th>
                <th><div class="custom-label-box">Date de naissance</div></th>
				<th><div class="custom-label-box">Service</div></th>
				<th><div class="custom-label-box">Chambre</div></th>
				<th><div class="custom-label-box">Date entree</div></th>
				<th><div class="custom-label-box">Medecin traitant</div></th>
				<th><div class="custom-label-box">Status</div></th>
				<th><div class="custom-label-box">Date de sortie</div></th>
				
                <th class="text-center"><div class="custom-label-box">Action</div></th>
            </tr>
        </thead>

        <tbody>

        <?php
        $res = mysqli_query($link, "SELECT * FROM admission");

        while ($row = mysqli_fetch_assoc($res)) {
        ?>

        <tr>
            <td><?php echo $row['id_admis']; ?></td>
			
			<?php
					$id_p=$row['id_p'];
					$res1 = mysqli_query($link, "SELECT * FROM patient WHERE `id_patient` = '$id_p'");

					while ($row1 = mysqli_fetch_assoc($res1)) {
			?>
            <td><?php echo $row1['nom_p']; ?></td>
            <td><?php echo $row1['prenom_p']; ?></td>
			<td><?php echo $row1['nom_p_nais']; ?></td>
			<td><?php echo $row1['date_nais_p']; ?></td>
			<?php } ?>
			
			<td><?php echo $row['service']; ?></td>
			
			<?php
					$id_lit=$row['id_lit'];
					$res2 = mysqli_query($link, "SELECT * FROM lit WHERE `id` = '$id_lit'");

					while ($row2 = mysqli_fetch_assoc($res2)) {
			?>			
			
			<td><?php echo $row2['chambre_id'].' '. $row2['numero_lit']; ?></td>
			<?php } ?>
			
			<td><?php echo $row['date_entre']; ?></td>
			
			<?php
					$id_med=$row['id_med'];
					$res3 = mysqli_query($link, "SELECT * FROM medecin WHERE `id_med` = '$id_med'");

					while ($row3 = mysqli_fetch_assoc($res3)) {
			?>			
			
			<td><?php echo $row3['nom_med'].' '. $row3['prenom_med']; ?></td>
			<?php } ?>
			
			<td>
			<?php 
			if ($row['admis']=="Entree")
			{
			echo "<span class=\"badge badge-success\"> ".$row['admis']." </span>"; 
			}
			else {
			echo "<span class=\"badge badge-danger\">". $row['admis']." </span>"; 
			}
			?>
			</td>
			<td><?php echo $row['date_sorti']; ?></td>
			
			
			
			
			<td>
				<div class="text-center" class="dropdown">
					<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<i class="dw dw-more"></i>
					</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list" style="background-color: #C7EFF2;">
				
					<?php 
						if ($row['admis']=="Entree")
						{
							echo "<a class=\"dropdown-item\" href=\"Nee_Ajout.php?id=". $row['id_p']."\"><i class=\"fas fa-baby\"></i>Nouveau né(e)</a>";
							echo "<a class=\"dropdown-item\" href=\"patient_rapport_details.php?id=". $row['id_p']."\"><i class=\"fa fa-book\"></i>Historique</a>";	
							echo "<a class=\"dropdown-item\" href=\"patient_rapport_ajout.php?id=". $row['id_p']."\"><i class=\"fa fa-pencil-square-o\"></i>Rapport</a>";
							echo "<a class=\"dropdown-item\" href=\"patient_infermier_ajout.php?id=". $row['id_p']."\"><i class=\"fa fa-flask\"></i>+ Infermier</a>";							
							echo "<a class=\"dropdown-item\" href=\"patient_travail.php?id=". $row['id_p']."\"><i class=\"fa fa-briefcase\"></i>Grossesse & Travail</a>";
							echo "<a class=\"dropdown-item\" href=\"patient_suite.php?id=". $row['id_p']."\"><i class=\"fas fa-baby\"></i>Suite de couche</a>"; 							 
							echo "<a class=\"dropdown-item\" href=\"PDF_travail.php?id=". $row['id_p']."\"><i class=\"fa fa-print\"></i>PDF Grossesse & Travail</a>"; 
							echo "<a class=\"dropdown-item\" href=\"PDF_Admission.php?id=". $row['id_admis']."\"><i class=\"fa fa-print\"></i>PDF Admission</a>"; 
echo "<a class=\"dropdown-item\" href=\"PDF_patient_rapport_details.php?id=". $row['id_p']."\"><i class=\"fa fa-print\"></i>Historique</a>";							
							echo "<a class=\"dropdown-item\" href=\"patient_analyse_ajout.php?id=". $row['id_p']."\"><i class=\"fa fa-flask\"></i>Analyses</a>"; 
							
						} else
						{
							
							echo "<a class=\"dropdown-item\" href=\"patient_rapport_details.php?id=". $row['id_p']."\"><i class=\"fa fa-book\"></i>Historique</a>";
							echo "<a class=\"dropdown-item\" href=\"PDF_travail.php?id=". $row['id_p']."\"><i class=\"fa fa-print\"></i>PDF Grossesse & Travail</a>"; 
							echo "<a class=\"dropdown-item\" href=\"PDF_Admission.php?id=". $row['id_admis']."\"><i class=\"fa fa-print\"></i>PDF Admission</a>";  
							echo "<a class=\"dropdown-item\" href=\"PDF_patient_rapport_details.php?id=". $row['id_p']."\"><i class=\"fa fa-print\"></i>PDF Historique</a>";
							echo "<a class=\"dropdown-item\" href=\"PDF_Sorti.php?id=". $row['id_admis']."\"><i class=\"fa fa-print\"></i>PDF Sortie</a>"; 
							
						}
					?>
					
				</div>
				</div>
			</td>
			
        </tr>

        <?php } ?>
   

    </div>
  </div>
</div>
        </tbody>
    </table>
									
              </div>
			  
			  
                
                                                                            
                
				



            </div>
        </div>
    </div>

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
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

	<script>
	$(document).ready(function() {
    $('#myTable').DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        }
		});
		});
	</script>
	<script>
            function goToPage(selectedValue, membre_id) {
              var queryString = "id_cupboard=" + selectedValue + "&id_membre=" + membre_id; // Construct the query string
              var url = "update_cupboard.php?" + queryString; // Construct the URL
              window.location.href = url; // Navigate to the URL
            }
            function navigate(link) {
              window.location.href = link; // Navigate to the URL
            }
			function navigate_print(link) {
              //window.location.href = link; // Navigate to the URL
			  window.open(link, '_blank');
            }
			
     </script>
</body>
</html>