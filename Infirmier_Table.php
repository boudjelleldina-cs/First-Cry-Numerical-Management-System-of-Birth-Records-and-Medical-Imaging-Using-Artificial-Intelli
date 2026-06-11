<!DOCTYPE html>
<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['log_u'])) {
    header('location:loginpage.php');
    die;
}

include 'connection.php';

// --- Suppression ---
if (isset($_GET['supprimer']) && $_GET['supprimer'] == '1' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        mysqli_query($link, "DELETE FROM infirmier WHERE id_infirmier = $id");
    }
    header('location:Infirmier_Table.php');
    die;
}

if (isset($_GET['carte']) && $_GET['carte'] == '1' && isset($_GET['id'])) {

    $id = intval($_GET['id']);
    if ($id <= 0) { die("ID invalide."); }

    $res = mysqli_query($link, "SELECT * FROM infirmier WHERE id_infirmier = $id");
    if (!$res || mysqli_num_rows($res) === 0) { die("Infirmier(e) introuvable."); }
    $inf = mysqli_fetch_assoc($res);

    $dateNais = !empty($inf['date_naissance']) ? date('d/m/Y', strtotime($inf['date_naissance'])) : '-';

    $age = '-';
    if (!empty($inf['date_naissance'])) {
        $birthDate = new DateTime($inf['date_naissance']);
        $today     = new DateTime();
        $age       = $birthDate->diff($today)->y . ' ans';
    }

    $statusColor = ($inf['statut'] == 'Actif') ? '#16a34a' : '#dc2626';
    $statusBg    = ($inf['statut'] == 'Actif') ? '#dcfce7' : '#fee2e2';

    if (!empty($inf['photo'])) {
        $photoSrc = 'data:image/jpeg;base64,' . base64_encode($inf['photo']);
    } else {
        $photoSrc = 'data:image/svg+xml;base64,' . base64_encode('
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
              <rect width="100" height="100" fill="#1E63EE"/>
              <circle cx="50" cy="35" r="20" fill="white" opacity="0.85"/>
              <ellipse cx="50" cy="80" rx="30" ry="22" fill="white" opacity="0.85"/>
            </svg>
        ');
    }
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Carte Infirmier(e) – <?php echo htmlspecialchars($inf['prenom'] . ' ' . $inf['nom']); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f1f5f9; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; min-height: 100vh; padding: 30px 20px; }
        .toolbar { display: flex; gap: 12px; margin-bottom: 28px; }
        .btn-tool { display: inline-flex; align-items: center; gap: 8px; padding: 10px 22px; border-radius: 8px; font-size: 0.9rem; font-weight: 600; cursor: pointer; border: none; transition: all 0.2s; text-decoration: none; }
        .btn-print { background: #1E63EE; color: white; }
        .btn-print:hover { background: #1a52cc; }
        .btn-back { background: #e2e8f0; color: #334155; }
        .btn-back:hover { background: #cbd5e1; }
        .card-wrapper { display: flex; flex-direction: column; align-items: center; gap: 20px; }
        .card-front { width: 340px; height: 210px; border-radius: 16px; background: linear-gradient(135deg, #0f4c81 0%, #1E63EE 55%, #3b82f6 100%); color: white; box-shadow: 0 20px 50px rgba(30,99,238,0.35); position: relative; overflow: hidden; display: flex; flex-direction: column; justify-content: space-between; padding: 20px; }
        .card-front::before { content: ''; position: absolute; top: -40px; right: -40px; width: 140px; height: 140px; background: rgba(255,255,255,0.08); border-radius: 50%; }
        .card-front::after { content: ''; position: absolute; bottom: -50px; left: -20px; width: 160px; height: 160px; background: rgba(255,255,255,0.05); border-radius: 50%; }
        .card-header-row { display: flex; align-items: center; justify-content: space-between; position: relative; z-index: 1; }
        .hospital-name { font-size: 0.65rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; opacity: 0.9; }
        .card-type { font-size: 0.55rem; opacity: 0.7; margin-top: 2px; letter-spacing: 0.5px; }
        .card-chip { width: 36px; height: 28px; background: linear-gradient(135deg, #fbbf24, #f59e0b); border-radius: 5px; box-shadow: 0 2px 6px rgba(0,0,0,0.3); }
        .card-body-row { display: flex; align-items: flex-end; gap: 14px; position: relative; z-index: 1; }
        .nurse-photo { width: 62px; height: 62px; border-radius: 50%; border: 3px solid rgba(255,255,255,0.7); object-fit: cover; flex-shrink: 0; box-shadow: 0 4px 12px rgba(0,0,0,0.25); }
        .nurse-name { font-size: 1rem; font-weight: 700; line-height: 1.2; }
        .nurse-service { font-size: 0.72rem; opacity: 0.85; margin-top: 3px; font-weight: 500; }
        .card-footer-row { display: flex; align-items: center; justify-content: space-between; position: relative; z-index: 1; }
        .card-id { font-size: 0.6rem; opacity: 0.7; letter-spacing: 1px; font-family: monospace; }
        .card-status-badge { font-size: 0.6rem; font-weight: 700; padding: 3px 10px; border-radius: 999px; background: rgba(255,255,255,0.2); backdrop-filter: blur(4px); border: 1px solid rgba(255,255,255,0.35); letter-spacing: 0.5px; }
        .card-status-badge.actif { background: rgba(34,197,94,0.25); border-color: rgba(34,197,94,0.5); }
        .card-status-badge.inactif { background: rgba(239,68,68,0.25); border-color: rgba(239,68,68,0.5); }
        .card-back { width: 340px; min-height: 210px; border-radius: 16px; background: white; box-shadow: 0 8px 30px rgba(0,0,0,0.12); overflow: hidden; }
        .card-back-header { background: #0f4c81; color: white; padding: 10px 18px; font-size: 0.75rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; }
        .card-back-body { padding: 14px 18px; }
        .info-row { display: flex; align-items: flex-start; padding: 6px 0; border-bottom: 1px solid #f1f5f9; gap: 10px; }
        .info-row:last-child { border-bottom: none; }
        .info-icon { width: 28px; height: 28px; border-radius: 7px; background: #eff6ff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .info-icon i { font-size: 11px; color: #1E63EE; }
        .info-label { font-size: 0.62rem; color: #94a3b8; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; line-height: 1; }
        .info-value { font-size: 0.82rem; color: #1e293b; font-weight: 600; margin-top: 2px; }
        @media print {
            @page { size: A4; margin: 15mm; }
            body { background: white; padding: 0; }
            .toolbar { display: none !important; }
            .card-front, .card-back { box-shadow: none; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .card-wrapper { gap: 15mm; }
        }
    </style>
</head>
<body>
    <div class="toolbar">
        <button class="btn-tool btn-print" onclick="window.print()">
            <i class="fa fa-print"></i> Imprimer / PDF
        </button>
        <a href="javascript:history.back()" class="btn-tool btn-back">
            <i class="fa fa-arrow-left"></i> Retour
        </a>
    </div>

    <div class="card-wrapper">
        <div class="card-front">
            <div class="card-header-row">
                <div>
                    <div class="hospital-name">Établissement de Santé</div>
                    <div class="card-type">Carte Professionnelle – Infirmier(e)</div>
                </div>
                <div class="card-chip"></div>
            </div>
            <div class="card-body-row">
                <img class="nurse-photo" src="<?php echo $photoSrc; ?>" alt="Photo infirmier(e)">
                <div>
                    <div class="nurse-name"><?php echo htmlspecialchars($inf['prenom'] . ' ' . $inf['nom']); ?></div>
                    <div class="nurse-service">
                        <i class="fas fa-user-nurse" style="font-size:10px;opacity:0.8;"></i>
                        <?php echo htmlspecialchars(!empty($inf['service']) ? $inf['service'] : 'Service non défini'); ?>
                    </div>
                </div>
            </div>
            <div class="card-footer-row">
                <div class="card-id">ID – <?php echo str_pad($inf['id_infirmier'], 6, '0', STR_PAD_LEFT); ?></div>
                <div class="card-status-badge <?php echo strtolower(!empty($inf['statut']) ? $inf['statut'] : 'inactif'); ?>">
                    <?php echo htmlspecialchars(!empty($inf['statut']) ? $inf['statut'] : 'Inconnu'); ?>
                </div>
            </div>
        </div>

        <div class="card-back">
            <div class="card-back-header">
                <i class="fas fa-user-nurse" style="margin-right:6px;"></i>
                Informations de l'Infirmier(e)
            </div>
            <div class="card-back-body">
                <div class="info-row">
                    <div class="info-icon"><i class="fa fa-hashtag"></i></div>
                    <div>
                        <div class="info-label">Numéro d'identifiant</div>
                        <div class="info-value"><?php echo str_pad($inf['id_infirmier'], 6, '0', STR_PAD_LEFT); ?></div>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-icon"><i class="fa fa-user"></i></div>
                    <div>
                        <div class="info-label">Nom complet</div>
                        <div class="info-value"><?php echo htmlspecialchars($inf['prenom'] . ' ' . $inf['nom']); ?></div>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-icon"><i class="fa fa-calendar"></i></div>
                    <div>
                        <div class="info-label">Date de naissance</div>
                        <div class="info-value"><?php echo $dateNais; ?> &nbsp;(<?php echo $age; ?>)</div>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-icon"><i class="fas fa-user-nurse"></i></div>
                    <div>
                        <div class="info-label">Service</div>
                        <div class="info-value"><?php echo htmlspecialchars(!empty($inf['service']) ? $inf['service'] : '-'); ?></div>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-icon"><i class="fa fa-briefcase"></i></div>
                    <div>
                        <div class="info-label">Poste / Grade</div>
                        <div class="info-value"><?php echo htmlspecialchars((!empty($inf['poste']) ? $inf['poste'] : '-') . (!empty($inf['grade']) ? ' — ' . $inf['grade'] : '')); ?></div>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-icon"><i class="fa fa-circle-check"></i></div>
                    <div>
                        <div class="info-label">Statut</div>
                        <div class="info-value" style="color:<?php echo $statusColor; ?>;background:<?php echo $statusBg; ?>;display:inline-block;padding:2px 10px;border-radius:999px;font-size:0.75rem;">
                            <?php echo htmlspecialchars(!empty($inf['statut']) ? $inf['statut'] : 'Inconnu'); ?>
                        </div>
                    </div>
                </div>
                <?php if (!empty($inf['telephone'])): ?>
                <div class="info-row">
                    <div class="info-icon"><i class="fa fa-phone"></i></div>
                    <div>
                        <div class="info-label">Téléphone</div>
                        <div class="info-value"><?php echo htmlspecialchars($inf['telephone']); ?></div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($inf['email'])): ?>
                <div class="info-row">
                    <div class="info-icon"><i class="fa fa-envelope"></i></div>
                    <div>
                        <div class="info-label">Email</div>
                        <div class="info-value"><?php echo htmlspecialchars($inf['email']); ?></div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    exit;
}
?>

<html>
<head>
	
	<meta charset="utf-8">
	<title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

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
            background:linear-gradient(135deg,#1E63EE,#3b82f6);
            border-radius:12px;
            display:flex;
            align-items:center;
            justify-content:center;
            box-shadow:0 6px 14px rgba(30,99,238,0.25);
        ">
            <i class="fas fa-user-nurse" style="color:white; font-size:20px;"></i>
        </div>

        <h2 style="
            margin:6px 0 0 0;
            font-weight:700;
            font-size:1.92rem;
            color:#0f172a;
        ">
            Gestion dossier infermier(e)
        </h2>
    </div>

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
                        <h5 class="mb-1 text-success">Actif</h5>
                        <h3 class="mb-3"><?php
										$res = mysqli_query($link, "SELECT COUNT(*) AS total FROM infirmier WHERE statut='Actif'");
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
                                <i class="fas fa-user-tie text-warning fs-4"></i>
                            </div>
                            
                        </div>
                        <h5 class="mb-1 text-warning">Congé</h5>
                        <h3 class="mb-3"><?php
										$res = mysqli_query($link, "SELECT COUNT(*) AS total FROM infirmier WHERE statut='Congé'");
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
                        <h5 class="mb-1 text-danger">Inactif</h5>
                        <h3 class="mb-3"><?php
										$res = mysqli_query($link, "SELECT COUNT(*) AS total FROM infirmier WHERE statut='Inactif'");
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
  background-color: red;
  border-radius: 50%;
}
.green-circle {
  width: 15px;
  height: 15px;
  background-color: green;
  border-radius: 50%;
}
</style>

<div class="row">

    <!-- TABLE CARD -->
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
							background:#D48A8A;
							color:white;
							padding:12px 15px;
							font-weight:700;
							font-size:1.2rem;
							margin: -20px -18px 15px -18px;
							border-radius:10px 10px 0 0;
							display:flex;
							align-items:center;
							justify-content:space-between;
							">
				Liste des infirmier(e)s
				<a href="Admin_Acceuil.php" style="background:#D42424;color:white;font-weight:700;
					padding:5px 14px;border-radius:6px;text-decoration:none;font-size:0.9rem;">
					<i class="fa-solid fa-backward"></i> Retour
				</a>
				<a href="Infirmier_Ajout.php" style="background:white;color:#0f4c81;font-weight:700;padding:5px 14px;border-radius:6px;text-decoration:none;font-size:0.9rem;">
					<i class="fa fa-plus"></i> Ajouter
				</a>
				</div>
                    

             <div class="form-group">
				<table id="myTable" class="table table-striped table-hover">
        <thead>
            <tr>
                <th><div class="custom-label-box">ID</div></th>
                <th><div class="custom-label-box">Nom</div></th>
                <th><div class="custom-label-box">Prénom</div></th>
                <th><div class="custom-label-box">Date de naissance</div></th>
				<th><div class="custom-label-box">Service</div></th>
				<th><div class="custom-label-box">Quart</div></th>
				<th><div class="custom-label-box">Statut</div></th>
                <th class="text-center"><div class="custom-label-box">Action</div></th>
            </tr>
        </thead>

        <tbody>

        <?php
        $res = mysqli_query($link, "SELECT * FROM infirmier");

        while ($row = mysqli_fetch_assoc($res)) {
        ?>

        <tr>
            <td><?php echo $row['id_infirmier']; ?></td>
            <td><?php echo $row['nom']; ?></td>
            <td><?php echo $row['prenom']; ?></td>
            <td><?php echo $row['date_naissance']; ?></td>
			<td><?php echo $row['service']; ?></td>
			<td><?php echo $row['quart_travail']; ?></td>
			<td class="text-center">
			<?php
					if ($row['statut'] == 'Actif') {
						echo '<div><span class="badge badge-pill badge-success">'.$row['statut'].'</span></div>';
							} elseif ($row['statut'] == 'Congé') {
							echo '<div><span class="badge badge-pill badge-warning">'.$row['statut'].'</span></div>';
							} else {
							echo '<div><span class="badge badge-pill badge-danger">'.$row['statut'].'</span></div>';
								}
			?>
			
			<td>
				<div class="text-center" class="dropdown">
					<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<i class="dw dw-more"></i>
					</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
					<a class="dropdown-item" href="Infirmier_detail.php?id=<?php echo $row['id_infirmier']; ?>"><i class="dw dw-eye"></i> Détail</a>
					<a class="dropdown-item" href="Infirmier_modifier.php?id=<?php echo $row['id_infirmier']; ?>"><i class="dw dw-edit2"></i> Modifier</a>
					<a class="dropdown-item" href="Infirmier_table.php?carte=1&id=<?php echo $row['id_infirmier']; ?>" target="_blank"><i class="fa fa-id-card"></i> Carte Infirmier(e)</a>
					<a class="dropdown-item" href="Infirmier_table.php?supprimer=1&id=<?php echo $row['id_infirmier']; ?>" onclick="return confirm('Confirmer la suppression de cet(te) infirmier(e) ?')"><i class="dw dw-delete-3"></i> Supprimer</a>
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

function resetForm() {
    if (confirm("Voulez-vous vraiment réinitialiser le formulaire ?")) {
        document.querySelectorAll("input").forEach(input => {
            if (input.type === "checkbox" || input.type === "radio") {
                input.checked = false;
            } else {
                input.value = "";
            }
        });
        alert("Formulaire réinitialisé !");
    }
}

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
              var queryString = "id_cupboard=" + selectedValue + "&id_membre=" + membre_id;
              var url = "update_cupboard.php?" + queryString;
              window.location.href = url;
            }
            function navigate(link) {
              window.location.href = link; 
            }
			function navigate_print(link) {
              window.open(link, '_blank');
            }
			
     </script>
</body>
</html>