
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
	
	<!-- statistic CSS -->
        
		<link rel="stylesheet" href="vendors/styles/statistic.css">
	
	
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
	
	<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	
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
		<!--	<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div> -->
		<!--	<div class="header-search">
				<form>
					<div class="form-group mb-0">
						<i class="dw dw-search2 search-icon"></i>
						<input type="text" class="form-control search-input" placeholder="Search Here">
						<div class="dropdown">
							<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
								<i class="ion-arrow-down-c"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">From</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">To</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">Subject</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="text-right">
									<button class="btn btn-primary">Search</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>  -->
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
			<!--
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
						<i class="icon-copy dw dw-notification"></i>
						<span class="badge notification-active"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
							<ul>
								<li>
									<a href="#">
										<img src="vendors/images/img.jpg" alt="">
										<h3>John Doe</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/photo1.jpg" alt="">
										<h3>Lea R. Frith</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/photo2.jpg" alt="">
										<h3>Erik L. Richards</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/photo3.jpg" alt="">
										<h3>John Doe</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/photo4.jpg" alt="">
										<h3>Renee I. Hansen</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/img.jpg" alt="">
										<h3>Vicki M. Coleman</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				-->
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
					<li class="dropdown">
						<a href="logout.php" class="dropdown-toggle">
							<span class="micon fa fa-sign-out"></span><span class="mtext">Deconnexion</span>
						</a>
						
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

     <!--   <div style="
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
		</div> -->	 
         

        <h2 style="
            margin:6px 0 0 0;
            font-weight:700;
            font-size:1.92rem;
            color:#0f172a;
        ">
            Administration
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
<div class="main-container">

<div class="row justify-content-center">

        <div class="col-md-10">
            <div class="row g-4">
                <!-- Revenue Card -->
                <div class="col-md-3">
                    <div class="stat-card p-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="stat-icon bg-success bg-opacity-10">
                                <i class="fas fa-bed text-success fs-4"></i>
                            </div>
                            <span class="badge bg-success"></span>
                        </div>
                        <h5 class="mb-1">Nbr des patients</h5>
                        <h3 class="mb-3">325</h3>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 32.5%"></div>
                        </div>
                        <small class="text-muted">Mois de Juin: 40</small>
                    </div>
                </div>
                <!-- Users Card -->
                <div class="col-md-3">
                    <div class="stat-card2 p-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="stat-icon bg-primary bg-opacity-10">
                                <i class="fas fa-user-md text-primary fs-4"></i>
                            </div>
                            <span class="badge bg-success">+8.2%</span>
                        </div>
                        <h5 class="mb-1">Nbr des medecins</h5>
                        <h3 class="mb-3">1249</h3>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 65%"></div>
                        </div>
                        <small class="text-muted">Monthly active users growth</small>
                    </div>
                </div>
                <!-- Orders Card -->
                <div class="col-md-3">
                    <div class="stat-card3 p-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="stat-icon bg-warning bg-opacity-10">
                                <i class="fas fa-user-tie text-warning fs-4"></i>
                            </div>
                            <span class="badge bg-success">+15.7%</span>
                        </div>
                        <h5 class="mb-1">Nbr des agents</h5>
                        <h3 class="mb-3">1,483</h3>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 85%"></div>
                        </div>
                        <small class="text-muted">Monthly order completion rate</small>
                    </div>
                </div>
				<!-- Revenue Card -->
                <div class="col-md-3">
                    <div class="stat-card p-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="stat-icon bg-primary bg-opacity-10">
                                <i class="fas fa-chart-line text-primary fs-4"></i>
                            </div>
                            <span class="badge bg-success"></span>
                        </div>
                        <h5 class="mb-1">Nbr des patients</h5>
                        <h3 class="mb-3">325</h3>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 32.5%"></div>
                        </div>
                        <small class="text-muted">Mois de Juin: 40</small>
                    </div>
                </div>
            </div>
        </div>
    </div>	


	

<div class="pd-ltr-20 xs-pd-20-10">

			<div class="min-height-200px">
				<div class="container pd-0">		
	<div class="col-md-12 mb-3">					
       			<div class="contact-directory-list">						
						<ul class="row">
							<li class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
								<div class="contact-directory-box">
									<div class="contact-dire-info text-center">
										<div class="contact-avatar">
											<span>
												<img src="vendors/images/Agent1.jpg" alt="">
											</span>
										</div>
										<div class="contact-name">
											<h4><span class="badge badge-pill badge-primary">Agent</span></h4>
											
											<div class="work text-success"><i class="ion-android-person"></i> Freelancer</div>
										</div>
										
										
									</div>
									<div class="view-contact">
										<a href="agent_table.php">Détails</a>
									</div>
								</div>
							</li>
							<li class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
								<div class="contact-directory-box">
									<div class="contact-dire-info text-center">
										<div class="contact-avatar">
											<span>
												<img src="vendors/images/infermier1.jpg" alt="">
											</span>
										</div>
										<div class="contact-name">
											<h4><span class="badge badge-pill badge-primary">Infermier</span></h4>
											
											<div class="work text-success"><i class="ion-android-person"></i> Freelancer</div>
										</div>
										
										
									</div>
									<div class="view-contact">
										<a href="Infirmier_Table.php">Détails</a>
									</div>
								</div>
							</li>
							<li class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
								<div class="contact-directory-box">
									<div class="contact-dire-info text-center">
										<div class="contact-avatar">
											<span>
												<img src="vendors/images/medecin2.jpg" alt="">
											</span>
										</div>
										<div class="contact-name">
											<h4><span class="badge badge-pill badge-primary">Medecin</span></h4>
											
											<div class="work text-success"><i class="ion-android-person"></i> Freelancer</div>
										</div>
										
										
									</div>
									<div class="view-contact">
										<a href="Medecin_Table.php">Détails</a>
									</div>
								</div>
							</li>
							<li class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
								<div class="contact-directory-box">
									<div class="contact-dire-info text-center">
										<div class="contact-avatar">
											<span>
												<img src="vendors/images/patient1.jpg" alt="">
											</span>
										</div>
										<div class="contact-name">
											<h4><span class="badge badge-pill badge-primary">Patient</span></h4>
											
											<div class="work text-success"><i class="ion-android-person"></i> Freelancer</div>
										</div>
										
										
									</div>
									<div class="view-contact">
										<a href="Patient_Menu.php">Détails</a>
									</div>
								</div>
							</li>
							<li class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
								<div class="contact-directory-box">
									<div class="contact-dire-info text-center">
										<div class="contact-avatar">
											<span>
												<img src="vendors/images/hopital3.jpg" alt="">
											</span>
										</div>
										<div class="contact-name">
											<h4><span class="badge badge-pill badge-primary">Hopital</span></h4>
											
											<div class="work text-success"><i class="ion-android-person"></i> Freelancer</div>
										</div>
										
										
									</div>
									<div class="view-contact">
										<a href="lit_table.php">Détails</a>
									</div>
								</div>
							</li>
							
						</ul>
					</div>
					

					
                    
                            					
					
									
              </div>
			  
			  
                
                                                                            
                
				



            </div>
        </div>
    </div>
	
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
	 
	 <!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	
	
	
	<script src="src/plugins/jQuery-Knob-master/jquery.knob.min.js"></script>
	<script src="src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
	<script src="src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>
	<script src="src/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
	<script src="src/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="vendors/scripts/dashboard2.js"></script>
	
	
	
	
</body>
</html>