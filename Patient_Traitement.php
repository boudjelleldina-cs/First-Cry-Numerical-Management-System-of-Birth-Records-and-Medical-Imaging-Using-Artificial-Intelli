
<!DOCTYPE html>
<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['log_u'])) {
    header('location:loginpage.php');
    die;
}



/* SAVE TRAITEMENT */

if(isset($_POST['submit']))
{
    $id_patient = $_GET['id'];

    $traitement = $_POST['submit'];

    /*$check = mysqli_query($link,"
        SELECT * FROM traitement_patient
        WHERE id_patient='$id_patient'
    ");

    if(mysqli_num_rows($check) > 0)
    {
        mysqli_query($link,"
            UPDATE traitement_patient
            SET
            traitement='$traitement',
            date_traitement=NOW()
            WHERE id_patient='$id_patient'
        ");
    }
    else*/
    {
		$insert = "INSERT INTO `traitement_patient`( `id_patient`, `traitement`) VALUES 
			('$id_patient','$traitement')";
		
		$qry = mysqli_query($link, $insert) or die(mysqli_error($link));

		
    }

    echo "
    <script>
        alert('Traitement enregistré avec succès');
        window.location.href=window.location.href;
    </script>
    ";
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
            Traitement
        </h2>

    </div>
</div>
    <?php

$id_patient = intval($_GET['id']);

$res_patient = mysqli_query($link,"
    SELECT * FROM patient
    WHERE id_patient='$id_patient'");

$patient = mysqli_fetch_assoc($res_patient);

$tr = mysqli_query($link,"
    SELECT * FROM traitement_patient
    WHERE id_patient='$id_patient'
    ORDER BY id_traitement DESC
    LIMIT 1
");

$data_tr = mysqli_fetch_assoc($tr);

?>

<!-- CONTENT -->

<div class="row justify-content-center mt-4">

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

            <!-- HEADER -->

            <div class="p-12 md:p-8" style="padding:0;">

                <div style="
                    background:#0f4c81;
                    color:white;
                    padding:12px 15px;
                    font-weight:700;
                    font-size:1.2rem;
                    margin:-20px -18px 20px -18px;
                    border-radius:10px 10px 0 0;
                ">
                    <i class="fa fa-notes-medical"></i>
                    Traitement Patient
                </div>

                <!-- BODY -->

                <div style="padding:10px;">

                    <div class="row">

    <div class="col-md-3 mb-3">

        <div class="card-box p-3" style="
            border-radius:12px;
            border:1px solid #e2e8f0;
            background:white;
            box-shadow:0 4px 15px rgba(0,0,0,0.08);
        ">

            <div style="font-size:13px;color:#64748b;font-weight:600;">
                ID PATIENT
            </div>

            <div style="font-size:20px;font-weight:700;color:#0f172a;">
                <?php echo $patient['id_patient']; ?>
            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card-box p-3" style="
            border-radius:12px;
            border:1px solid #e2e8f0;
            background:white;
            box-shadow:0 4px 15px rgba(0,0,0,0.08);
        ">

            <div style="font-size:13px;color:#64748b;font-weight:600;">
                NOM
            </div>

            <div style="font-size:20px;font-weight:700;color:#0f172a;">
                <?php echo $patient['nom_p']; ?>
            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card-box p-3" style="
            border-radius:12px;
            border:1px solid #e2e8f0;
            background:white;
            box-shadow:0 4px 15px rgba(0,0,0,0.08);
        ">

            <div style="font-size:13px;color:#64748b;font-weight:600;">
                PRENOM
            </div>

            <div style="font-size:20px;font-weight:700;color:#0f172a;">
                <?php echo $patient['prenom_p']; ?>
            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card-box p-3" style="
            border-radius:12px;
            border:1px solid #e2e8f0;
            background:white;
            box-shadow:0 4px 15px rgba(0,0,0,0.08);
        ">

            <div style="font-size:13px;color:#64748b;font-weight:600;">
                DATE NAISSANCE
            </div>

            <div style="font-size:20px;font-weight:700;color:#0f172a;">
                <?php echo $patient['date_nais_p']; ?>
            </div>

        </div>

    </div>

</div>


                    <!-- FORMULAIRE -->

                    <form method="POST">

                        <input type="hidden"
                               name="id_patient"
                               value="<?php echo $patient['id_patient']; ?>">

                        <!-- TEXTAREA CARD -->

                        <div style="
                            background:white;
                            border-radius:10px;
                            padding:20px;
                            box-shadow:0 4px 12px rgba(0,0,0,0.08);
                            margin-top:10px;
                            margin-bottom:20px;
                        ">

                            <label style="
                                font-weight:700;
                                font-size:17px;
                                margin-bottom:14px;
                                display:block;
                                color:#0f172a;
                            ">

                                <i class="fa fa-file-medical"></i>
                                Traitement médical

                            </label>

                            <textarea
                                name="traitement"
                                rows="12"
                                class="form-control"
                                style="
                                    border-radius:10px;
                                    padding:18px;
                                    resize:none;
                                    font-size:15px;
                                    border:1px solid #d1d5db;
                                    box-shadow:none;
                                    transition:0.2s;
                                "
                                onfocus="this.style.border='1px solid #0f4c81'; this.style.boxShadow='0 0 0 3px rgba(15,76,129,0.15)'"
                                onblur="this.style.border='1px solid #d1d5db'; this.style.boxShadow='none'"
                                placeholder="Écrire le traitement du patient ici..."
                                required><?php echo isset($data_tr['traitement']) ? $data_tr['traitement'] : ''; ?></textarea>

                        </div>

                        <!-- DATE -->

                        <?php if(isset($data_tr['date_traitement'])) { ?>

                        <div style="
                            background:#ecfeff;
                            border:1px solid #a5f3fc;
                            padding:14px 18px;
                            border-radius:10px;
                            color:#155e75;
                            font-weight:600;
                            margin-bottom:20px;
                        ">

                            <i class="fa fa-clock"></i>

                            Dernière modification :

                            <?php echo $data_tr['date_traitement']; ?>

                        </div>

                        <?php } ?>

                        <!-- BUTTONS -->

                       <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:20px;">

    <button 
        type="button" 
        class="btn btn-danger"
        onclick="window.location.href='Medecin_Table.php';"
    >
        Retour
    </button>

    <input
        type="submit"
        id="submit"
        name="submit"
        class="btn btn-primary"
        value="Enregistrer"
        style="
            transition:0.3s;
            box-shadow:0 4px 12px rgba(59,130,246,0.3);
        "
        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 18px rgba(59,130,246,0.4)'"
        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(59,130,246,0.3)'"
    >
	
</div>


	
	<div class="p-12 md:p-8" style="padding:0;">
				<div style="
							background:#0f4c81;
							color:white;
							padding:12px 15px;
							font-weight:700;
							font-size:1.2rem;
							margin: -20px -18px 15px -18px;
							border-radius:10px 10px 0 0;
							">
				Liste des traitements
				</div>
                    

             <div class="form-group">
				<table id="myTable" class="table table-striped table-hover">
        <thead>
            <tr>
                <th><div class="custom-label-box">ID</div></th>
                <th><div class="custom-label-box">Traitement</div></th>
                <th><div class="custom-label-box">Date de naissance</div></th>
				
                <th class="text-center"><div class="custom-label-box">Action</div></th>
            </tr>
        </thead>

        <tbody>

        <?php
        
		
    $res = mysqli_query($link,"SELECT * FROM traitement_patient WHERE id_patient='$id_patient'");


        while ($row = mysqli_fetch_assoc($res)) {
        ?>

        <tr>
            <td><?php echo $row['id_traitement']; ?></td>
            <td><?php echo $row['traitement']; ?></td>
            <td><?php echo $row['date_traitement']; ?></td>
			
			
			<td>
				<div class="text-center dropdown">
					<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<i class="dw dw-more"></i>
					</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
					<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> Détail</a>
					<a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Modifier</a>
					<a class="dropdown-item" href="analyse_table.php?id=<?php echo $row['id_patient']; ?>"><i class="fa fa-flask"></i> Analyses</a>
					<a class="dropdown-item" href="Admission_Ajout.php?id=<?php echo $row['id_patient']; ?>"><i class="fas fa-baby"></i> Admission</a>
					<a class="dropdown-item"href="Patient_Traitement.php?id=<?php echo $row['id_patient']; ?>"><i class="fa fa-notes-medical"></i>Traitement</a>
					<a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Supprimer</a>
				</div>
				</div>
			</td>
			
        </tr>
		
        <?php } ?>

        </tbody>
    </table>
									
              </div>
	
	



				
       
        


</div>

                        
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- JS -->

<script>
function saveForm() {

    const btn = document.getElementById("savebtn");

    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Enregistrement...';
    btn.disabled = true;

    setTimeout(() => {

        btn.innerHTML = '<i class="fa-solid fa-check"></i> Succès';
        btn.style.background = "#22c55e";

        setTimeout(() => {
            btn.innerHTML = '<i class="fa-solid fa-save"></i> Enregistrer';
            btn.style.background = "linear-gradient(135deg,#0f4c81,#2563eb)";
            btn.disabled = false;
        }, 2000);

    }, 1200);
}
</script>

<!-- JS FILES -->

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

</body>
</html>