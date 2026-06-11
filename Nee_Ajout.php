<!DOCTYPE html>
<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['log_u'])) {
    header('location:login.php');
    die;
}
include 'connection.php';


if (isset($_POST["submit"])) {
	    $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
		$nom_ar = $_POST["nom_ar"];
		$prenom_ar = $_POST["prenom_ar"];
		$id_patient = $_POST["id_patient"];
	    $nomprenom_mere = $_POST["nomprenommere"];
		$prenom_pere = $_POST["papa"];
	    $date_nais = $_POST["date_saisie"];
		$lieu_nais = $_POST["wilaya_resid"];
		$num = $_POST["poids"];
		$time = $_POST["heure"];
	    $sexe = $_POST["sexe"];
	    $etat = $_POST["etat"];
		$groupe_sanguin = $_POST["groupesanguin"];
		$parents_informes = $_POST["parentsinformes"];
        $medicaments = $_POST["medicaments"] ;
		$string_medicaments = implode(",", $medicaments); 
		$interventions = $_POST["interventions"] ;
		$string_interventions = implode(",", $interventions); 
		$reanimation = $_POST["reanimation"] ;
		$rx = $_POST["rx"];
		$infos = $_POST["infos"];
		$string_infos = implode(",", $infos); 
		$specifier = $_POST["specifier"]; 
		$aspiration = $_POST["aspiration"] ;
		$string_aspiration = implode(",", $aspiration); 
		$alimentation = $_POST["alimentation"] ;
		$string_alimentation = implode(",", $alimentation); 
		$phcordon = (float)$_POST["phcordon"];
		$veineuxval = (float)$_POST["veineuxval"];
		$arterielval = (float)$_POST["arterielval"];
		$battements = $_POST["apgarBattements"];
		$b1 = (float)$_POST["apgarbattements1"];
		$b5 = (float)$_POST["apgarbattements5"];
		$b10 = (float)$_POST["apgarbattements10"];
		$efforts = $_POST["apgarEfforts"];
		$e1 = (float)$_POST["apgarefforts1"];
		$e5 = (float)$_POST["apgarefforts5"];
		$e10 = (float)$_POST["apgarefforts10"];
		$tonus = $_POST["apgarTonus"];
		$t1 = (float)$_POST["apgartonus1"];
		$t5 = (float)$_POST["apgartonus5"];
		$t10 = (float)$_POST["apgartonus10"];
		$reflexes = $_POST["apgarReflexes"];
		$r1 = (float)$_POST["apgarreflexes1"];
		$r5 = (float)$_POST["apgarreflexes5"];
		$r10 = (float)$_POST["apgarreflexes10"];
		
	
		
		$insert = "INSERT INTO `nee`(`nom`, `nom_ar`, `prenom`, `prenom_ar`, `id_mere`, `nomprenommere`, `papa`, `date`, `lieu_nais`, `nombre`, `temps`, `sexe`, `etat`, `groupesanguin`, `parentsinformes`, `medicaments`, `interventions`, `reanimation`, `rx`, `infos`, `specifier`, `aspiration`, `alimentation`, `phcordon`, `veineuxval`, `arterielval`, `apgarBattements`, `apgarbattements1`, `apgarbattements5`, `apgarbattements10`, `apgarEfforts`, `apgarefforts1`, `apgarefforts5`, `apgarefforts10`, `apgarTonus`, `apgartonus1`, `apgartonus5`, `apgartonus10`, `apgarReflexes`, `apgarreflexes1`, `apgarreflexes5`, `apgarreflexes10`)
		
		VALUES ('$nom','$nom_ar','$prenom','$prenom_ar', '$id_patient', '$nomprenom_mere', '$prenom_pere', '$date_nais', '$lieu_nais', '$num','$time','$sexe','$etat','$groupe_sanguin','$parents_informes','$string_medicaments','$string_interventions','$reanimation','$rx','$string_infos','$specifier','$string_aspiration','$string_alimentation','$phcordon','$veineuxval','$arterielval','$battements','$b1','$b5','$b10','$efforts','$e1','$e5','$e10','$tonus','$t1','$t5','$t10','$reflexes','$r1','$r5','$r10')";
		$qry = mysqli_query($link, $insert) or die(mysqli_error($link));
		
		echo '<script>alert("Enregistrement");</script>';
        
		header('location:Nee_Table.php');	
		
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
            Inscription d'un nouveau né(e)
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
   <div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">Nom</div>
        <input type="text" style="color: red;" id="nom" name="nom" class="form-control" value="<?php echo $row['nom_p'];?>" placeholder="" readonly >
    </div>
	<div class="col-md-6 col-sm-12 mb-3">
	<div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">اللقب</div>
        <input type="text" style="color: red;" id="nom_ar" name="nom_ar" class="form-control" value="<?php echo $row['nom_p_ar'];?>" placeholder="" readonly>
    </div>
	
    <div class="col-md-6 col-sm-12 mb-3">
   <div style="    background:#2798F5; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">Prénom</div>
        <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Entrer le Prénom">
    </div>
	<div class="col-md-6 col-sm-12 mb-3">
   <div style="    background:#2798F5; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">الاسم</div>
        <input type="text" id="prenom_ar" name="prenom_ar" class="form-control" placeholder="Entrer le Prénom">
    </div>
	<div class="col-md-6 col-sm-12 mb-3">
   <div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">ID Mère</div>
        <input type="text" style="color: red;" id="id_patient" name="id_patient" class="form-control" value="<?php echo $row['id_patient'];?>" placeholder="" readonly>
   </div>
	<div class="col-md-6 col-sm-12 mb-3">
   <div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">ID Mère</div>
        <input type="text" style="color: red;" id="id_patient" name="id_patient" class="form-control" value="<?php echo $row['id_patient'];?>" placeholder="" readonly >
   </div>
   
   <div class="col-md-6 col-sm-12 mb-3">
   <div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">Nom & Prénom Mère</div>
        <input type="text" style="color: red;" id="nomprenommere" name="nomprenommere" class="form-control" value="<?php echo $row['nom_p_nais'].' '. $row['prenom_p'];?>"  placeholder="" readonly >
   </div>
   <div class="col-md-6 col-sm-12 mb-3">
   <div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">Prénom Père</div>
        <input type="text" style="color: red;" id="papa" name="papa" class="form-control" value="<?php echo $row['prenom_c'];?> " placeholder="" readonly>
   </div>
   <?php
	}
	?>
</div>
	
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
   <div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">Sexe</div>
                        <div class="d-flex flex-column gap-2">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="sexemasculin" name="sexe"  value="Masculin" class="custom-control-input">
                                <label class="custom-control-label" for="sexemasculin">Masculin</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="sexefeminin" name="sexe" value="Féminin" class="custom-control-input">
                                <label class="custom-control-label" for="sexefeminin">Féminin</label>
                            </div>
                        </div>
                    </div>
                </div>
				

                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
   <div style="    background:#e9ecef;
color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">État</div>
                        <div class="d-flex flex-column gap-2">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="etatvivant" name="etat" value="Vivant"  class="custom-control-input">
                                <label class="custom-control-label" for="etatvivant">Vivant</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="etatmortne" name="etat" value="Mort-né" class="custom-control-input">
                                <label class="custom-control-label" for="etatmortne">Mort-né</label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
			<div class="row">
    <!-- DATE -->
    <div class="col-md-6 col-sm-12 mb-3">
        <div style="
            background:#e9ecef;
            color:black;
            padding:8px 12px;
            font-weight:600;
            margin-bottom:6px;
            border-radius:6px;">
            Date
        </div>

        <input type="date" id="date_saisie" name="date_saisie" class="form-control">
    </div>

    <!-- HEURE -->
    <div class="col-md-6 col-sm-12 mb-3">
        <div style="
            background:#e9ecef;
            color:black;
            padding:8px 12px;
            font-weight:600;
            margin-bottom:6px;
            border-radius:6px;"> Heure  </div>
        <input type="time" id="heure" name="heure" class="form-control">
    </div>
</div>
  <div class="row">
  <div class="col-md-6">
                    <div class="form-group">
					<div style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">                            
					Lieu de Residance 
                    </div>
                      <select class="custom-select2 form-control" id ="wilaya_resid" name="wilaya_resid" style="width: 100%; height: 38px;">
                                <option value="" selected disabled hidden>Choisir une wilaya</option>
                                <?php
									
									$result = mysqli_query($link, "SELECT DISTINCT wilaya_name_ascii FROM wilaya");

									while ($row = mysqli_fetch_array($result)) 
									{
									
										#echo'<option value="'.$row['wilaya_name_ascii'].'">'.$row['wilaya_name_ascii'].'</option>';
										echo '<option value="' . $row['wilaya_name_ascii'] . '">' . $row['wilaya_name_ascii'] . '</option>';
									}
									?>

                            </select>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
        
   <div style="    background:#e9ecef;
color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">Poids</div>
                <div class="input-group">
                    <input type="number" id="poids" name="poids" step="0.1" class="form-control" placeholder="Ex: 3.4">
                    <div class="input-group-append">
                        <span class="input-group-text">kg</span>
                    </div>
                </div>
            </div>
                <div class="col-md-6 col-sm-12">
   <div style="    background:#e9ecef;
color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">Groupe Sanguin (ABO & Rh) </div>
 <select id="groupesanguin" name="groupesanguin" class="selectpicker form-control" data-style="btn-outline-primary" data-size="5">
        <option value="" selected disabled>-- Sélectionner --</option>

        <optgroup label="Groupe A">
            <option value="A+">A+</option>
            <option value="A-">A-</option>
        </optgroup>

        <optgroup label="Groupe B">
            <option value="B+">B+</option>
            <option value="B-">B-</option>
        </optgroup>

        <optgroup label="Groupe AB">
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
        </optgroup>

        <optgroup label="Groupe O">
            <option value="O+">O+</option>
            <option value="O-">O-</option>
        </optgroup>

    </select>
            </div>
			  <div class="col-md-12 col-sm-12" style="margin-top:20px;">
        
   <div style="background:#e9ecef;
color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">Parents informés </div>
    <div style="display:flex; justify-content:center; align-items:center; gap:40px; height:60px;">
        <div class="custom-control custom-radio">
            <input type="radio" id="yesinformes" name="parentsinformes" value="Oui" class="custom-control-input">
            <label class="custom-control-label" for="yesinformes">Oui</label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" id="noinformes" name="parentsinformes" value="Non"  class="custom-control-input">
            <label class="custom-control-label" for="noinformes">Non</label>
        </div>
        </div>
		 </div>
    </div>
	</div> <!-- CLOSE LEFT CARD -->
</div> <!-- CLOSE LEFT COLUMN -->

 <!--  RIGHT SIDE -->
 
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
">  Médicaments Administrés</div>
        <div class="form-group">
   <div style="background:#e9ecef;
color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">Médicaments </div>
            <div style="display:flex; justify-content:center; align-items:center; gap:40px; flex-wrap:wrap;">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="gouttesphtalmiques" name="medicaments[]" value="Gouttes ophtalmiques" >
        <label class="custom-control-label" for="gouttesphtalmiques"> Gouttes ophtalmiques</label>
    </div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="vitamink" name="medicaments[]" value="Vitamin K">
        <label class="custom-control-label" for="vitamink"> Vitamin K</label>
    </div>
</div>
        </div>
    </div>
	
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
">  Alimentation & pH Cordon        </div>
        <!-- Alimentation -->
       <div style="display:flex; justify-content:center; align-items:center; gap:40px; flex-wrap:wrap;">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="maternelle" name="alimentation[]" value="Maternelle">
        <label class="custom-control-label" for="maternelle">
            Maternelle
        </label>
    </div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="artificielle" name="alimentation[]" value="Artificielle">
        <label class="custom-control-label" for="artificielle">
            Artificielle
        </label>
    </div>
</div>

        <!-- pH cordon -->
        <div class="form-group">
   <div style="background:#e9ecef;
color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">pH cordon </div>
            <div class="custom-control custom-radio">
                <input type="radio" id="pharteriel" name="phcordon" class="custom-control-input" value="Artériel">
                <label class="custom-control-label" for="pharteriel">Artériel</label>
                <input type="text" id="arterielval" name="arterielval"class="form-control" style="width:120px; display:inline-block; margin-left:10px;">
            </div>
            <div class="custom-control custom-radio" style="margin-top:10px;">
                <input type="radio" id="phveineux" name="phcordon" class="custom-control-input" value="Veineux">
                <label class="custom-control-label" for="phveineux`">Veineux</label>
                <input type="text"  id="veineuxval" name="veineuxval"class="form-control" style="width:120px; display:inline-block; margin-left:10px;">
            </div>

        </div>

    </div>

</div>



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
">Réanimation & Aspiration    </div>
<!-- Réanimation -->
<div class="form-group">
   <div style="background:#e9ecef;
color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">Réanimation effectuée ?
</div>
        <div style="display:flex; justify-content:center; align-items:center; gap:40px; height:60px;">
            <div class="custom-control custom-radio">
                <input type="radio" id="yesreanimation" name="reanimation"  value="Oui" class="custom-control-input">
                <label class="custom-control-label" for="yesreanimation">Oui</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" id="noreanimation" name="reanimation"  value="Non" class="custom-control-input">
                <label class="custom-control-label" for="noreanimation">Non</label>
            </div>
        </div>

</div>
   <div style="background:#e9ecef;
color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">Interventions</div>
<div class="form-group">
    <div class="col-md-12">
        <div class="row">
           <div class="col-md-4">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="vpp" name="interventions[]" value="VPP">
                    <label class="custom-control-label" for="vpp">VPP</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="vppo2" name="interventions[]" value="VPP + Oxygene">
                    <label class="custom-control-label" for="vppo2">VPP + O₂</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="massage" name="interventions[]" value="Massage cardiaque">
                    <label class="custom-control-label" for="massage">Massage cardiaque</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="intubation" name="interventions[]" value="Intubation">
                    <label class="custom-control-label" for="intubation">Intubation</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="toilette" name="interventions[]" value="Toilette trachéale">
                    <label class="custom-control-label" for="toilette">Toilette trachéale</label>
                </div>
            </div>
        </div>
    </div>
</div>
         <div class="form-group">
   <div style="    background:#e9ecef;
color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">Rx</div>
    <input class="form-control" type="text" name="rx" id="rx" placeholder="">
</div>	

	<div class="col-md-12 col-sm-12">
 <div class="row" style="margin-top:20px;">

    <!-- Infos -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <div style="display:flex; flex-direction:column; gap:12px; padding-left:10px; margin-top:70px;">                
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="anomalies"    name="infos[]"  value="Anomalies">
                    <label class="custom-control-label" for="anomalies">Anomalies</label>
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="complications"   name="infos[]"  value="Complications">
                    <label class="custom-control-label" for="complications">Complications</label>
                </div>
            </div>
        </div>
    </div>
   <!-- Spécifier -->
<div class="col-md-6 col-sm-12">
    <div class="form-group">
     <div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">Spécifier</div>
        <textarea id="specifier" name="specifier" class="form-control" rows="4" placeholder="Précisez les détails ici..."></textarea>
    </div>
</div>
</div>
</div>
						<!-- Aspiration -->
       <div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">Aspiration</div>
		<div class="form-group">
    <div class="col-md-12" class="col-md-12">
        <div style="display:flex; gap:200px; align-items:center;">
            <div class="custom-control custom-checkbox mb-5">
                <input type="checkbox" class="custom-control-input" id="alapoire"  name="aspiration[]" value="A la poire">
                <label class="custom-control-label" for="alapoire">À la poire</label>
            </div>
            <div class="custom-control custom-checkbox mb-5">
                <input type="checkbox" class="custom-control-input" id="orogastrique" name="aspiration[]" value="Avec tube oro-gastrique">
                <label class="custom-control-label" for="orogastrique">Avec tube oro-gastrique</label>
            </div>
        </div>
    </div>
</div>
</div>
    </div>
	    <!-- RIGHT SIDE -->
    <div class="col-lg-6 col-md-12">

        <!--  APGAR CARD -->
  <div style="
    border:1px solid #ccc; 
    border-radius:10px; 
    padding:20px; 
    margin-bottom:25px;
    background:#f9f9f9;
    box-shadow:0 6px 18px rgba(0,0,0,0.1);
">
         <div class="p-6 md:p-8" style="padding:0;">
        <div style="
          background:#0f4c81;
          color:white;
          padding:12px 15px;
          font-weight:700;
          font-size:1.2rem;
          margin: -20px -20px 20px -20px;
          border-radius:10px 10px 0 0;">APGAR</div>
<!-- Battements cardiaques -->
<div class="form-group d-flex align-items-start mb-3" style="gap:20px; padding:5px 0;">
    <div style="flex:2; display:flex; flex-direction:column;">
        <label><strong>Battements cardiaques</strong></label>
        <select class="selectpicker form-control" id="apgarBattements" name="apgarBattements" data-style="btn-outline-primary" data-size="4">
            <option value="" selected disabled hidden>Rien sélectionné</option>
            <option value="absents">Absents</option>
            <option value="moins">Moins de 100</option>
            <option value="plus">Plus de 100</option>
        </select>
    </div>
    <div style="flex:1; display:flex; flex-direction:column;">
        <label><strong>1 min</strong></label>
        <input type="number" id="apgarbattements1" name="apgarbattements1" class="form-control" placeholder="Score">
    </div>
    <div style="flex:1; display:flex; flex-direction:column;">
        <label><strong>5 min</strong></label>
        <input type="number" id="apgarbattements5" name="apgarbattements5" class="form-control" placeholder="Score">
    </div>
    <div style="flex:1; display:flex; flex-direction:column;">
        <label><strong>10 min</strong></label>
        <input type="number" id="apgarbattements10" name="apgarbattements10" class="form-control" placeholder="Score">
    </div>
</div>

<!-- Efforts respiratoires -->
<div class="form-group d-flex align-items-start mb-3" style="gap:20px; padding:5px 0;">
    <div style="flex:2; display:flex; flex-direction:column;">
        <label><strong>Efforts respiratoires</strong></label>
        <select class="selectpicker form-control" id="apgarEfforts" name="apgarEfforts" data-style="btn-outline-primary" data-size="4">
            <option value="" selected disabled hidden>Rien sélectionné</option>
            <option value="absents">Absents</option>
            <option value="moins">Lents irréguliers</option>
            <option value="plus">Bons pleurs</option>
        </select>
    </div>
    <div style="flex:1; display:flex; flex-direction:column;">
        <label><strong>1 min</strong></label>
        <input type="number" id="apgarefforts1" name="apgarefforts1" class="form-control" placeholder="Score">
    </div>
    <div style="flex:1; display:flex; flex-direction:column;">
        <label><strong>5 min</strong></label>
        <input  type="number" id="apgarefforts5" name="apgarefforts5" class="form-control" placeholder="Score">
    </div>
    <div style="flex:1; display:flex; flex-direction:column;">
        <label><strong>10 min</strong></label>
        <input type="number" id="apgarefforts10" name="apgarefforts10" class="form-control" placeholder="Score">
    </div>
</div>

<!-- Tonus musculaire -->
<div class="form-group d-flex align-items-start mb-3" style="gap:20px; padding:5px 0;">
    <div style="flex:2; display:flex; flex-direction:column;">
        <label><strong>Tonus musculaire</strong></label>
        <select class="selectpicker form-control" id="apgarTonus" name="apgarTonus" data-style="btn-outline-primary" data-size="4">
            <option value="" selected disabled hidden>Rien sélectionné</option>
            <option value="absents">Flasque</option>
            <option value="moins">Flexion des extrémités</option>
            <option value="plus">Mouvements actifs</option>
        </select>
    </div>
    <div style="flex:1; display:flex; flex-direction:column;">
        <label><strong>1 min</strong></label>
        <input type="number" id="apgartonus1" name="apgartonus1" class="form-control" placeholder="Score">
    </div>
    <div style="flex:1; display:flex; flex-direction:column;">
        <label><strong>5 min</strong></label>
        <input type="number" id="apgartonus5" name="apgartonus5" class="form-control" placeholder="Score">
    </div>
    <div style="flex:1; display:flex; flex-direction:column;">
        <label><strong>10 min</strong></label>
        <input type="number" id="apgartonus10" name="apgartonus10" class="form-control" placeholder="Score">
    </div>
</div>

<!-- Réflexes à la stimulation -->
<div class="form-group d-flex align-items-start mb-3" style="gap:20px; padding:5px 0;">
    <div style="flex:2; display:flex; flex-direction:column;">
        <label><strong>Réflexes à la stimulation</strong></label>
        <select class="selectpicker form-control" id="apgarReflexes" name="apgarReflexes" data-style="btn-outline-primary" data-size="4">
            <option value="" selected disabled hidden>Rien sélectionné</option>
            <option value="absents">Absents</option>
            <option value="moins">Grimace</option>
            <option value="plus">Pleure avec force</option>
        </select>
    </div>
    <div style="flex:1; display:flex; flex-direction:column;">
        <label><strong>1 min</strong></label>
        <input type="number" id="apgarreflexes1" name="apgarreflexes1" class="form-control" placeholder="Score">
    </div>
    <div style="flex:1; display:flex; flex-direction:column;">
        <label><strong>5 min</strong></label>
        <input type="number" id="apgarreflexes5" name="apgarreflexes5" class="form-control" placeholder="Score">
    </div>
    <div style="flex:1; display:flex; flex-direction:column;">
        <label><strong>10 min</strong></label>
        <input type="number" id="apgarreflexes10" name="apgarreflexes10" class="form-control" placeholder="Score">
    </div>
</div>

<!-- Coloration de téguments -->
<div class="form-group d-flex align-items-start mb-3" style="gap:20px; padding:5px 0;">
    <div style="flex:2; display:flex; flex-direction:column;">
        <label><strong>Coloration de téguments</strong></label>
        <select class="selectpicker form-control" id="apgarColoration" name="apgarColoration" data-style="btn-outline-primary" data-size="4">
            <option value="" selected disabled hidden>Rien sélectionné</option>
            <option value="absents">Bleu pâle</option>
            <option value="moins">Corps rose, extrémités bleues</option>
            <option value="plus">Entièrement rose</option>
        </select>
    </div>
    <div style="flex:1; display:flex; flex-direction:column;">
        <label><strong>1 min</strong></label>
        <input type="number" id="apgarcoloration1" name="apgarcoloration1" class="form-control" placeholder="Score">
    </div>
    <div style="flex:1; display:flex; flex-direction:column;">
        <label><strong>5 min</strong></label>
        <input type="number" id="apgarcoloration5" name="apgarcoloration5" class="form-control" placeholder="Score">
    </div>
    <div style="flex:1; display:flex; flex-direction:column;">
        <label><strong>10 min</strong></label>
        <input type="number" id="apgarcoloration10" name="apgarcoloration10" class="form-control" placeholder="Score">
    </div>
        </div>

    </div>



					

</div>
 <div style="display:flex; justify-content:flex-end; width:100%; gap:10px; margin-top:15px;">
<button type="button" class="btn btn-danger" onclick="window.location.href='Nee_Table.php';">Retour</button>
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