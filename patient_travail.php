<!DOCTYPE html>
<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['log_u'])) {
    header('location:login.php');
    die;
}

include 'connection.php';
if(isset($_POST['submit']))
{
    $id_patient = $_POST['id'];

    /* GROSSESSE */
    $semaine_gestation = $_POST['semaine_gestation'];
    $groupe_rh = $_POST['groupe_rh'];

    $g = $_POST['g'];
    $t = $_POST['t'];
    $p = $_POST['p'];
    $a = $_POST['a'];
    $v = $_POST['v'];

    $sgb = $_POST['sgb'];
    $anticorps = $_POST['anticorps'];
    $particularite = $_POST['particularite'];

    /* TRAVAIL */
    $type_travail = $_POST['type_travail'];
    $debut_travail = $_POST['debut_travail'];
    $membranes = $_POST['membranes'];

    $analgesie = $_POST['analgesie'];
    $heure_analgesie = $_POST['heure_analgesie'];

    $antibiotique = $_POST['antibiotique'];
    $heure_antibio = $_POST['heure_antibio'];

    $anesthesie = $_POST['anesthesie'];

    mysqli_query($link,"
        INSERT INTO grossesse
        (
            rapport_id,
            semaine_gestation,
            groupe_rh,
            g,
            t,
            p,
            a,
            v,
            sgb,
            anticorps,
            particularite
        )
        VALUES
        (
            '$id_patient',
            '$semaine_gestation',
            '$groupe_rh',
            '$g',
            '$t',
            '$p',
            '$a',
            '$v',
            '$sgb',
            '$anticorps',
            '$particularite'
        )
    ") or die(mysqli_error($link));

    mysqli_query($link,"
        INSERT INTO travail
        (
            rapport_id,
            type_travail,
            debut_travail,
            membranes,
            analgesie,
            heure_analgesie,
            antibiotique,
            heure_antibio,
            anesthesie
        )
        VALUES
        (
            '$id_patient',
            '$type_travail',
            '$debut_travail',
            '$membranes',
            '$analgesie',
            '$heure_analgesie',
            '$antibiotique',
            '$heure_antibio',
            '$anesthesie'
        )
    ") or die(mysqli_error($link));

    echo "<script>
            alert('Enregistrement réussi');
            window.location='admission_Table_medecin.php';
          </script>";
}
?>

<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

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
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="vendors/images/logo.png" alt="" width="300" height="300"></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div>

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
		</div>
	</div>
	
	
	<div class="right-sidebar">
	</div>
	

	<div class="left-side-bar">
		<div class="brand-logo">
		</div>
		<div class="brand-logo">
			<a href="index.html">
				<img src="vendors/images/logo.PNG" alt="" width="100" height="40" class="light-logo">
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
							<li><a href="Patient_Ajout.php">Inscription</a></li>
							<li><a href="Patient_Table.php">Dossier</a></li>
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
							<li><a href="Medecin_Ajout.php">Inscription</a></li>
							<li><a href="Medecin_Table.php">Dossier</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon icon-copy fi-torso-business"></span><span class="mtext">Agent</span>
						</a>
						<ul class="submenu">
							<li><a href="Agent_Ajout.php">Inscription</a></li>
							<li><a href="Agent_Table.php">Dossier</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon fas fa-user-nurse"></span><span class="mtext">Infermière</span>
						</a>
						<ul class="submenu">
							<li><a href="Infirmier_Ajout.php">Inscription</a></li>
							<li><a href="Infirmier_Table.php">Dossier</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon fas fa-baby"></span><span class="mtext">Nouveau né(e)</span>
						</a>
						<ul class="submenu">
							<li><a href="NouveauNe_Ajout.php">Inscription</a></li>
							<li><a href="NouveauNe_Table.php">Dossier</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon fas fa-hand-holding-medical"></span><span class="mtext">Scanner</span>
						</a>
						<ul class="submenu">
							<li><a href="Scanner_IA.php">Tumeur avec IA</a></li>
							<li><a href="Scanner_Table.php">Dossier</a></li>
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
            background:#E32929;
            border-radius:12px;
            display:flex;
            align-items:center;
            justify-content:center;
            box-shadow:0 6px 14px rgba(30,99,238,0.25);
        ">
            <i class="fa fa-briefcase" style="color:white; font-size:20px;"></i>
        </div>

        <h2 style="
            margin:6px 0 0 0;
            font-weight:700;
            font-size:1.92rem;
            color:#0f172a;
        ">
            Grossesse et Travail
        </h2>
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

    <!-- LEFT CARD: Identification -->
    <div class="col-md-6 mb-3">
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
           <div class="p-6 md:p-8" style="padding:0;">
				<div style="
							background:#A39D87;
							color:black;
							padding:12px 15px;
							font-weight:700;
							font-size:1.2rem;
							margin: -20px -18px 15px -18px;
							border-radius:10px 10px 0 0;
							">
				Identification de la patiente
				</div>
				
				<?php
					$id = $_GET["id"];
					$result = mysqli_query($link, "SELECT * FROM patient WHERE id_patient='$id'");

					while ($row = mysqli_fetch_array($result)) 
					{
					?>
				
				<div class="row">	
             
				<div class="col-md-6">
				<div class="form-group">
				<div style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">   
				ID Patient    
				</div>
				<input type="text" id="id" name="id" class="form-control" value="<?php echo $row['id_patient'];?>" placeholder="" readonly>
				</div>
				</div>
				
				</div>
				
				<div class="row">	
             
				<div class="col-md-6">
				<div class="form-group">
				<div style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">   
				Nom    
				</div>
				<input type="text" id="nom" name="nom" class="form-control" value="<?php echo $row['nom_p'];?>" placeholder="" readonly>
				</div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
				<div style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">   
				Prénom   
				</div>
				<input type="text" id="prenom" name="prenom" class="form-control" value="<?php echo $row['prenom_p'];?>" placeholder="" readonly>
				</div>
				</div>
				</div>
				
				
			
			  
              <div class="row">
                    <div class="col-md-6" style="padding-right:5px;">
                       <div class="form-group">
						<div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;"> 
						Date de naissance
                        </div>
                        <input type="date" id="date_naissance" name="date_naissance" class="form-control" value="<?php echo $row['date_nais_p'];?>" placeholder="" readonly>
                       </div>
                    </div>
					<div class="col-md-6">
				<div class="form-group">
				<div style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">   
				AGE   
				</div>
				
				<?php 
				        $dateNaissance = $row['date_nais_p'];
						$aujourdhui = date("Y-m-d");
						$diff = date_diff(date_create($dateNaissance), date_create($aujourdhui));
				?>						
				<input type="text" id="age" name="age" class="form-control" value="<?php echo $diff->format('%y')." ans";?>" placeholder="" readonly>
				</div>
				</div>
                </div>
				<?php
					}
					?>
            </div>
        </div>
    </div>
			    <!-- BOTTOM LEFT: Adresse -->
    <div class="col-md-6 mb-3">
      <div style="
					border:1px solid #ccc; 
					border-radius:10px; 
					padding:16px; 
					background:#f9f9f9;
					box-shadow:0 6px 18px rgba(0,0,0,0.1);
					margin-bottom:20px;
					transition: all 0.25s ease;
					"
			onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 25px rgba(0,0,0,0.15)'"
			onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 6px 18px rgba(0,0,0,0.1)'"
		>

        <div style="
					background:#A39D87;
					color:black;
					padding:12px 15px;
					font-weight:700;
					font-size:1.2rem;
					margin: -20px -20px 20px -20px;
					border-radius:10px 10px 0 0;
					"
		>
               Travail(1)
        </div>

            <div class="form-group">
				<div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">
				Type de travail
                </div>
				<div class="custom-control custom-radio mb-5">
					<input type="radio" id="type_travail1" name="type_travail" value="Spontané" class="custom-control-input" >
					<label class="custom-control-label" for="type_travail1">Spontané</label>
				</div>	
				<div class="custom-control custom-radio mb-5">
					<input type="radio" id="type_travail2" name="type_travail" value="Stimulation" class="custom-control-input">
					<label class="custom-control-label" for="type_travail2">Stimulation</label>
				</div>
				<div class="custom-control custom-radio mb-5">
					<input type="radio" id="type_travail3" name="type_travail" value="Déclenché" class="custom-control-input" > 
					<label class="custom-control-label" for="type_travail3"> Déclenché</label>
				</div>
				<div class="custom-control custom-radio mb-5">
					<input type="radio" id="type_travail4" name="type_travail" value="Maturation" class="custom-control-input" >
					<label class="custom-control-label" for="type_travail4">Maturation</label>
				</div>
			</div>
			
			<div class="row">	
             
				<div class="col-md-6">
				<div class="form-group">
				<div style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">
				Début travail 
                </div>
				<input type="datetime-local" id="debut_travail" name="debut_travail" class="form-control" placeholder="">
				</div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
              <div style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">
				Membranes rompues 
              </div>
             <input type="datetime-local" id="membranes" name="membranes" class="form-control" placeholder="">
			</div>
			</div>
			</div>
			</div>
			</div>
			
	
    <!-- RIGHT CARD: Poste & Affectation -->
    <div class="col-md-6 mb-3">
        <div style="
					border:1px solid #ccc; 
					border-radius:10px; 
					padding:16px; 
					background:#f9f9f9;
					box-shadow:0 6px 18px rgba(0,0,0,0.1);
					margin-bottom:20px;
					transition: all 0.25s ease;
					"
			onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 25px rgba(0,0,0,0.15)'"
			onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 6px 18px rgba(0,0,0,0.1)'"
		>

        <div style="
					background:#A39D87;
					color:black;
					padding:12px 15px;
					font-weight:700;
					font-size:1.2rem;
					margin: -20px -20px 20px -20px;
					border-radius:10px 10px 0 0;
					"
		>
               Historique de Grossesse
        </div>

            <div class="form-group">
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<div style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">                            
							Semaine de gestation 
							</div>
							<input type="number" id="semaine_gestation" name="semaine_gestation" class="form-control" placeholder="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">
							Groupe RH
							</div>
							<select class="custom-select2 form-control" id="groupe_rh" name="groupe_rh" style="width: 100%; height: 38px;">
								<option>A+</option><option>A-</option>
								<option>B+</option><option>B-</option>
								<option>O+</option><option>O-</option>
								<option>AB+</option><option>AB-</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:8px;">
                    <div class="table-responsive mb-3">
						<table class="table table-bordered">
						<thead>
						<tr>
						<th>G</th><th>T</th><th>P</th><th>A</th><th>V</th><th>SGB</th>
						</tr>
						</thead>
						<tbody>
						<tr>
						<td><input type="number" name="g" class="form-control"></td>
						<td><input type="number" name="t" class="form-control"></td>
						<td><input type="number" name="p" class="form-control"></td>
						<td><input type="number" name="a" class="form-control"></td>
						<td><input type="number" name="v" class="form-control"></td>
						<td><input type="text" name="sgb" class="form-control"></td>
						</tr>
						</tbody>
						</table>
					</div>
					<div class="col-md-6" style="padding-left:5px;">
                        <div class="form-group">
						<div style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">
						Anticorps 
                        </div>
                        <input type="text" id="anticorps" name="anticorps" class="form-control" placeholder="">
                        
						</div>
                    </div>
					
					<div class="col-md-6" style="padding-left:5px;">
                        
                        <div style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">
						Particularité 
                        </div>
                        <input type="text" id="particularite" name="particularite" class="form-control" placeholder="">
						</div>
                    </div>
                </div>


			</div>
		
        </div>
		
	    <!-- BOTTOM LEFT: Adresse -->
    <div class="col-md-6 mb-3">
      <div style="
					border:1px solid #ccc; 
					border-radius:10px; 
					padding:16px; 
					background:#f9f9f9;
					box-shadow:0 6px 18px rgba(0,0,0,0.1);
					margin-bottom:20px;
					transition: all 0.25s ease;
					"
			onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 25px rgba(0,0,0,0.15)'"
			onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 6px 18px rgba(0,0,0,0.1)'"
		>

        <div style="
					background:#A39D87;
					color:black;
					padding:12px 15px;
					font-weight:700;
					font-size:1.2rem;
					margin: -20px -20px 20px -20px;
					border-radius:10px 10px 0 0;
					"
		>
               Travail(2)
        </div>

            
			
			<div class="row">	
             
				<div class="col-md-6">
				<div class="form-group">
				<div style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">
				Analgésie
                </div>
				<input type="text" id="analgesie" name="analgesie" class="form-control" placeholder="">
				</div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
				<div style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">
				Heure analgésie 
				</div>
				<input type="time" id="heure_analgesie" name="heure_analgesie" class="form-control" placeholder="">
				</div>
				</div>
			</div>
			<div class="row">	
             
				<div class="col-md-6">
				<div class="form-group">
				<div style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">
				Antibiotique
                </div>
				<input type="text" id="antibiotique" name="antibiotique" class="form-control" placeholder="">
				</div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
				<div style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">
				Heure antibiotique 
				</div>
				<input type="time" id="heure_antibio" name="heure_antibio" class="form-control" placeholder="">
				</div>
				</div>
			</div>
			<div class="row">	
             
			<div class="form-group">
				<div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">
				Anesthésie
                </div>
				<div class="custom-control custom-radio mb-5">
					<input type="radio" id="type_travail5" name="anesthesie" value="Aucune" class="custom-control-input" >
					<label class="custom-control-label" for="type_travail5">Aucune</label>
				</div>	
				<div class="custom-control custom-radio mb-5">
					<input type="radio" id="type_travail6" name="anesthesie" value="Générale" class="custom-control-input">
					<label class="custom-control-label" for="type_travail6">Générale</label>
				</div>
				<div class="custom-control custom-radio mb-5">
					<input type="radio" id="type_travail7" name="anesthesie" value="Péridurale" class="custom-control-input" > 
					<label class="custom-control-label" for="type_travail7"> Péridurale</label>
				</div>
				<div class="custom-control custom-radio mb-5">
					<input type="radio" id="type_travail8" name="anesthesie" value="Locale" class="custom-control-input" >
					<label class="custom-control-label" for="type_travail8">Locale</label>
				</div>
			</div>
			</div>
		</div>
		</div>

    </div>


<div style="display:flex; justify-content:flex-end; width:100%; gap:10px; margin-top:15px;">
	<button type="button" class="btn btn-danger" onclick="window.location.href='admission_Table_medecin.php';">Retour</button>
	<input
        type="submit"
		id="submit"
        name="submit"
		class="btn btn-primary"
        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 18px rgba(59,130,246,0.4)'"
        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(59,130,246,0.3)'"
		value="Enregistrer"
    >
</div>

</div><!-- end .row -->
</form>
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