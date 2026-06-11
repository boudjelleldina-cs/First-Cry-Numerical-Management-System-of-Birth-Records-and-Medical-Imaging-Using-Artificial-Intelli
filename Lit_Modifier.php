<!DOCTYPE html>
<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['log_u'])) {
    header('location:loginpage.php');
    die;
}

include 'connection.php';

$id = $_GET['id'];

$res = mysqli_query($link,"SELECT * FROM lit WHERE id='$id'");
$row = mysqli_fetch_assoc($res);

if(isset($_POST['Update']))
{
    $chambre_id = $_POST['chambre_id'];
    $numero_lit = $_POST['numero_lit'];
    $service    = $_POST['service'];
    $type_lit   = $_POST['type_lit'];
    $statut     = $_POST['statut'];

    $update = "
    UPDATE lit SET
        chambre_id='$chambre_id',
        numero_lit='$numero_lit',
        Service='$service',
        type_lit='$type_lit',
        statut='$statut'
    WHERE id='$id'
    ";

    $qry = mysqli_query($link,$update);

  if($qry)
{
    header("Location: lit_table.php");
    exit();
}
else
{
    die(mysqli_error($link));
}
   
}
?>


<html>
<head>
	<meta charset="utf-8">
	<title>Lit - Modification</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
			<div class="loading-text">Loading...</div>
		</div>
	</div>

	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
		</div>

		<div class="header-right">
			<div class="dashboard-setting user-notification"></div>

			<div class="user-notification">
				<div style="
					position:absolute;top:20px;right:10px;
					display:flex;align-items:center;gap:6px;
					background:rgba(236,253,245,0.9);padding:4px 10px;
					border-radius:999px;border:1px solid #a7f3d0;backdrop-filter:blur(6px);">
					<span style="width:8px;height:8px;background:#22c55e;border-radius:50%;
						box-shadow:0 0 0 0 rgba(34,197,94,0.7);animation:pulse 1.5s infinite;"></span>
					<span style="font-size:10px;color:#166534;font-weight:700;">Actif</span>
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
			<div class="user-info-dropdown"><div class="dropdown"></div></div>
			<div class="user-info-dropdown"><div class="dropdown"></div></div>
			<div class="user-info-dropdown"><div class="dropdown"></div></div>
			<div class="user-info-dropdown"><div class="dropdown"></div></div>
			<div class="user-info-dropdown"><div class="dropdown"></div></div>
			<div class="user-info-dropdown"><div class="dropdown"></div></div>
			<div class="user-info-dropdown"><div class="dropdown"></div></div>
			<div class="user-info-dropdown"><div class="dropdown"></div></div>
		</div>
	</div>

	<div class="right-sidebar"></div>

	<div class="left-side-bar">
		<div class="brand-logo"></div>
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
							<li><a href="Medecin_Ajout.php">Inscription</a></li>
							<li><a href="Medecin_Table.php">Dossier</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon icon-copy fi-torso-business"></span><span class="mtext">Agent</span>
						</a>
						<ul class="submenu">
							<li><a href="agent_ajout.php">Inscription</a></li>
							<li><a href="agent_table.php">Dossier</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon fas fa-user-nurse"></span><span class="mtext">Infermière</span>
						</a>
						<ul class="submenu">
							<li><a href="infirmier_ajout.php">Inscription</a></li>
							<li><a href="infirmier_table.php">Dossier</a></li>
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
			<div class="col-xl-12 mb-30">
				<div class="card-box height-100-p pd-20">
					<div class="col-12 mb-2">
						<div style="
							position:relative;border:1px solid rgba(226,232,240,0.8);border-radius:14px;
							padding:14px;background:linear-gradient(145deg,#ffffff,#f8fafc);
							box-shadow:0 10px 25px rgba(0,0,0,0.08);overflow:hidden;">
							<div style="display:flex;flex-direction:column;align-items:center;text-align:center;margin-bottom:12px;">
								<div style="
									width:38px;height:38px;
									background:linear-gradient(135deg,#1E63EE,#3b82f6);
									border-radius:12px;display:flex;align-items:center;justify-content:center;
									box-shadow:0 6px 14px rgba(30,99,238,0.25);">
									<i class="icon-copy fi-torso-business" style="color:white;font-size:20px;"></i>
								</div>
								<h2 style="margin:6px 0 0 0;font-weight:700;font-size:1.92rem;color:#0f172a;">
									Inscription d'un nouveau lit
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

					<form action="lit_modifier.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle mt-2">
						<?php
						if (isset($error)) {
							foreach ($error as $e) {
								echo '<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">';
								echo '<span class="font-medium">' . $e . '</span>';
								echo '</div>';
							}
						}
						?>

						<div class="row">

							<!-- LEFT CARD: Identification -->
							<div class="col-md-6 mb-3">
								<div style="border:1px solid #ccc;border-radius:10px;padding:16px;background:#f9f9f9;
									box-shadow:0 6px 18px rgba(0,0,0,0.1);margin-bottom:20px;transition:all 0.25s ease;"
									onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 25px rgba(0,0,0,0.15)'"
									onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 6px 18px rgba(0,0,0,0.1)'">
									<div style="background:#2D30ED;color:white;padding:12px 15px;font-weight:700;font-size:1.2rem;
										margin:-20px -18px 15px -18px;border-radius:10px 10px 0 0;">
										Information Lit
									</div>

									<div class="form-group">
										<div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">Chambre</div>
										<input type="text"name="chambre_id"class="form-control"value="<?php echo $row['chambre_id']; ?>">

										<div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">Numéro lit</div>
										<input type="text" name="numero_lit"class="form-control"value="<?php echo $row['numero_lit']; ?>">
									</div>

									<div class="form-group">
										<div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">Service</div>
										<div class="custom-control custom-radio mb-5">
											 <input type="radio"id="service1"name="service"value="Gynecologie"class="custom-control-input"
											 <?php if($row['Service']=="Gynecologie") echo "checked"; ?>>
											 <label class="custom-control-label" for="service1">    Gynecologie</label>
										</div>
										<div class="custom-control custom-radio mb-5">
											<input type="radio"
       id="service2"
       name="service"
       value="Cardiologie"
       class="custom-control-input"
       <?php if($row['Service']=="Cardiologie") echo "checked"; ?>>

<label class="custom-control-label" for="service2">
    Cardiologie
</label>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6" style="padding-right:5px;">
											<div class="form-group">
												<div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">Type lit</div>
												<input type="text"name="type_lit"class="form-control"value="<?php echo $row['type_lit']; ?>">
											</div>
										</div>
									
                                        <div class="form-group">
										<div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">Statut</div>
										<div class="custom-control custom-radio mb-3">
    <input type="radio"
           id="statut1"
           name="statut"
           value="Disponible"
           class="custom-control-input"
           <?php if($row['statut']=="Disponible") echo "checked"; ?>>

    <label class="custom-control-label text-success font-weight-bold"
           for="statut1">
        Disponible
    </label>
</div>

<div class="custom-control custom-radio mb-3">
    <input type="radio"
           id="statut2"
           name="statut"
           value="Occupe"
           class="custom-control-input"
           <?php if($row['statut']=="Occupe") echo "checked"; ?>>

    <label class="custom-control-label text-warning font-weight-bold"
           for="statut2">
        Occupé
    </label>
</div>

<div class="custom-control custom-radio mb-3">
    <input type="radio"
           id="statut3"
           name="statut"
           value="Endommage"
           class="custom-control-input"
           <?php if($row['statut']=="Endommage") echo "checked"; ?>>

    <label class="custom-control-label text-danger font-weight-bold"
           for="statut3">
        Endommagé
    </label>
</div>
									</div>
									</div>
								</div>
							</div>

						

							

							
						</div><!-- end .row -->

						<div style="display:flex;justify-content:flex-end;width:100%;gap:10px;margin-top:15px;">
							<button type="button" class="btn btn-danger" onclick="window.location.href='lit_table.php';">Retour</button>
							<input type="submit" id="submit" name="Update" class="btn btn-primary"
								onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 18px rgba(59,130,246,0.4)'"
								onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 12px rgba(59,130,246,0.3)'"
								value="Enregistrer">
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

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