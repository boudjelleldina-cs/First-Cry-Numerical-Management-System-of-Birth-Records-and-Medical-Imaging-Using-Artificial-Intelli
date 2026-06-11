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
	    $nom_p = $_POST["nom_p"];
        $prenom_p = $_POST["prenom_p"];
	    $nom_nais = $_POST["nom_nais"];
	    $conjoint = $_POST["conjoint"];
		$datedenaissance = $_POST["datedenaissance"];
		$wilaya = $_POST["wilaya"];
		$nom_p_ar = $_POST["nom_p_ar"];
        $prenom_p_ar = $_POST["prenom_p_ar"];
	    $nom_nais_ar = $_POST["nom_nais_ar"];
	    $conjoint_ar = $_POST["conjoint_ar"];
		
	    $adresse = $_POST["adresse"];
		$wilaya_resid = $_POST["wilaya_resid"];
	    $num_tel = $_POST["numerodetelephone"];
		$nom_medc = $_POST["nom_medc"];
		$assurance = $_POST["assurance"];
   
	if (isset($_FILES['file'])) {
                 
					$gener = uniqid();					
					$image_base64 = addslashes(file_get_contents($_FILES['file']['tmp_name']));	
		
			$insert = "INSERT INTO `patient`( `nom_p`, `prenom_p`, `nom_p_nais`, `prenom_c`, `date_nais_p`, `wilaya_nais_p`, `nom_p_ar`, `prenom_p_ar`, `nom_p_nais_ar`, `prenom_c_ar`, `img_p`, `adres_p`, `lieu_res_p`, `tel_p`, `med_p`, `assur_p`) VALUES 
			('$nom_p','$prenom_p','$nom_nais','$conjoint','$datedenaissance','$wilaya','$nom_p_ar','$prenom_p_ar','$nom_nais_ar','$conjoint_ar', '{$image_base64}', '$adresse','$wilaya_resid','$num_tel','$nom_medc','$assurance')";
		
		$qry = mysqli_query($link, $insert) or die(mysqli_error($link));
		
		echo '<script>alert("Enregistrement");</script>';
        
		header('location:Patient_Table.php');	
	}	
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
	<!--
		<div class="sidebar-title">
			<h3 class="weight-600 font-16 text-blue">
				Layout Settings
				<span class="btn-block font-weight-400 font-12">User Interface Settings</span>
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll">
			<div class="right-sidebar-body-content">
				<h4 class="weight-600 font-18 pb-10">Header Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
				<div class="sidebar-radio-group pb-10 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="">
						<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">
						<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">
						<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
					</div>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
				<div class="sidebar-radio-group pb-30 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="">
						<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">
						<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">
						<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="">
						<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">
						<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">
						<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
					</div>
				</div>

				<div class="reset-options pt-30 text-center">
					<button class="btn btn-danger" id="reset-settings">Reset Settings</button>
				</div>
			</div>
		</div>
		-->
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
					<!--<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-edit2"></span><span class="mtext">Forms</span>
						</a>
						<ul class="submenu">
							<li><a href="form-basic.html">Form Basic</a></li>
							<li><a href="advanced-components.html">Advanced Components</a></li>
							<li><a href="form-wizard.html">Form Wizard</a></li>
							<li><a href="html5-editor.html">HTML5 Editor</a></li>
							<li><a href="form-pickers.html">Form Pickers</a></li>
							<li><a href="image-cropper.html">Image Cropper</a></li>
							<li><a href="image-dropzone.html">Image Dropzone</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-library"></span><span class="mtext">Tables</span>
						</a>
						<ul class="submenu">
							<li><a href="basic-table.html">Basic Tables</a></li>
							<li><a href="datatable.html">DataTables</a></li>
						</ul>
					</li>
					<li>
						<a href="calendar.html" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-calendar1"></span><span class="mtext">Calendar</span>
						</a>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-apartment"></span><span class="mtext"> UI Elements </span>
						</a>
						<ul class="submenu">
							<li><a href="ui-buttons.html">Buttons</a></li>
							<li><a href="ui-cards.html">Cards</a></li>
							<li><a href="ui-cards-hover.html">Cards Hover</a></li>
							<li><a href="ui-modals.html">Modals</a></li>
							<li><a href="ui-tabs.html">Tabs</a></li>
							<li><a href="ui-tooltip-popover.html">Tooltip &amp; Popover</a></li>
							<li><a href="ui-sweet-alert.html">Sweet Alert</a></li>
							<li><a href="ui-notification.html">Notification</a></li>
							<li><a href="ui-timeline.html">Timeline</a></li>
							<li><a href="ui-progressbar.html">Progressbar</a></li>
							<li><a href="ui-typography.html">Typography</a></li>
							<li><a href="ui-list-group.html">List group</a></li>
							<li><a href="ui-range-slider.html">Range slider</a></li>
							<li><a href="ui-carousel.html">Carousel</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-paint-brush"></span><span class="mtext">Icons</span>
						</a>
						<ul class="submenu">
							<li><a href="font-awesome.html">FontAwesome Icons</a></li>
							<li><a href="foundation.html">Foundation Icons</a></li>
							<li><a href="ionicons.html">Ionicons Icons</a></li>
							<li><a href="themify.html">Themify Icons</a></li>
							<li><a href="custom-icon.html">Custom Icons</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-analytics-21"></span><span class="mtext">Charts</span>
						</a>
						<ul class="submenu">
							<li><a href="highchart.html">Highchart</a></li>
							<li><a href="knob-chart.html">jQuery Knob</a></li>
							<li><a href="jvectormap.html">jvectormap</a></li>
							<li><a href="apexcharts.html">Apexcharts</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-right-arrow1"></span><span class="mtext">Additional Pages</span>
						</a>
						<ul class="submenu">
							<li><a href="video-player.html">Video Player</a></li>
							<li><a href="login.html">Login</a></li>
							<li><a href="forgot-password.html">Forgot Password</a></li>
							<li><a href="reset-password.html">Reset Password</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-browser2"></span><span class="mtext">Error Pages</span>
						</a>
						<ul class="submenu">
							<li><a href="400.html">400</a></li>
							<li><a href="403.html">403</a></li>
							<li><a href="404.html">404</a></li>
							<li><a href="500.html">500</a></li>
							<li><a href="503.html">503</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-copy"></span><span class="mtext">Extra Pages</span>
						</a>
						<ul class="submenu">
							<li><a href="blank.html">Blank</a></li>
							<li><a href="contact-directory.html">Contact Directory</a></li>
							<li><a href="blog.html">Blog</a></li>
							<li><a href="blog-detail.html">Blog Detail</a></li>
							<li><a href="product.html">Product</a></li>
							<li><a href="product-detail.html">Product Detail</a></li>
							<li><a href="faq.html">FAQ</a></li>
							<li><a href="profile.html">Profile</a></li>
							<li><a href="gallery.html">Gallery</a></li>
							<li><a href="pricing-table.html">Pricing Tables</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-list3"></span><span class="mtext">Multi Level Menu</span>
						</a>
						<ul class="submenu">
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
							<li class="dropdown">
								<a href="javascript:;" class="dropdown-toggle">
									<span class="micon fa fa-plug"></span><span class="mtext">Level 2</span>
								</a>
								<ul class="submenu child">
									<li><a href="javascript:;">Level 2</a></li>
									<li><a href="javascript:;">Level 2</a></li>
								</ul>
							</li>
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
						</ul>
					</li>
					<li>
						<a href="sitemap.html" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-diagram"></span><span class="mtext">Sitemap</span>
						</a>
					</li>
					<li>
						<a href="chat.html" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-chat3"></span><span class="mtext">Chat</span>
						</a>
					</li>
					<li>
						<a href="invoice.html" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-invoice"></span><span class="mtext">Invoice</span>
						</a>
					</li>
					<li>
						<div class="dropdown-divider"></div>
					</li>
					<li>
						<div class="sidebar-small-cap">Extra</div>
					</li>
					<li>
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-edit-2"></span><span class="mtext">Documentation</span>
						</a>
						<ul class="submenu">
							<li><a href="introduction.html">Introduction</a></li>
							<li><a href="getting-started.html">Getting Started</a></li>
							<li><a href="color-settings.html">Color Settings</a></li>
							<li><a href="third-party-plugins.html">Third Party Plugins</a></li>
						</ul>
					</li>
					<li>
						<a href="https://dropways.github.io/deskapp-free-single-page-website-template/" target="_blank" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-paper-plane1"></span>
							<span class="mtext">Landing Page <img src="vendors/images/coming-soon.png" alt="" width="25"></span>
						</a>
					// </li>  -->
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
<!--    <div style="
        position:absolute;
        top:10px;
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
-->
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
            Inscription d'un nouveau patient
        </h2>

    </div>

    <!-- CONTENT -->
<!--    <div class="row g-2">

        <div class="col-6">
            <div style="
                border:1px solid #e5e7eb;
                border-radius:12px;
                padding:8px;
                background:white;
                transition:0.2s;
            "
            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 14px rgba(0,0,0,0.08)'"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">

                <div style="font-size:9px;color:#6b7280;margin-bottom:3px;">
                    N° dossier
                </div>

                <input type="number" placeholder="----"
                    style="
                        width:100%;
                        border:none;
                        outline:none;
                        font-size:12px;
                        font-weight:600;
                        color:#1e3a8a;
                        background:transparent;
                    ">
            </div>
        </div>

        <div class="col-6">
            <div style="
                border:1px solid #e5e7eb;
                border-radius:12px;
                padding:8px;
                background:white;
                transition:0.2s;
            "
            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 14px rgba(0,0,0,0.08)'"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">

                <div style="font-size:9px;color:#6b7280;margin-bottom:3px;">
                    N° chambre
                </div>

                <input type="number" placeholder="----"
                    style="
                        width:100%;
                        border:none;
                        outline:none;
                        font-size:12px;
                        font-weight:600;
                        color:#1e3a8a;
                        background:transparent;
                    ">
            </div>
        </div>

    </div>
-->
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

    <!-- LEFT CARD (Identification) -->
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
							background:#0f4c81;
							color:white;
							padding:12px 15px;
							font-weight:700;
							font-size:1.2rem;
							margin: -20px -18px 15px -18px;
							border-radius:10px 10px 0 0;
							">
				Identification du Patient
				</div>
                    

             <div class="form-group">
				<div style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">   
				Nom    
				</div>
				<input type="text" id="nom_p" name="nom_p" class="form-control" placeholder="Entrer le Nom de la patiente">
				
				<div style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">   
				Prénom   
				</div>
				<input type="text" id="prenom_p" name="prenom_p" class="form-control" placeholder="Entrer le Prénom de la patiente">
				
				<div style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">   
				Nom à la naissance   
				</div>
                <input type="text" id="nom_nais" name="nom_nais" class="form-control" placeholder="Entrer le Nom à la naissance">					
              
				<div style="    background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">   
				Prénom du conjoint 
				</div>
                <input type="text" id="conjoint" name="conjoint" class="form-control" placeholder="Entrer le Prénom du conjoint">
              </div>
                <!--<div class="row">
                  <div class="col-md-12 col-sm-12">

					<div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">                        Sexe
                      </div>

                      <div style="display:flex; justify-content:center; align-items:center; gap:25px; height:40px;">
                        <div class="custom-control custom-radio">
                          <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                          <label class="custom-control-label" for="customRadio1">Féminin</label>
                        </div>

                        <div class="custom-control custom-radio">
                          <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                          <label class="custom-control-label" for="customRadio2">Masculin</label>
                        </div>
                      </div>

                  </div>
                </div>
				-->
                                                                            
                <div class="row">

                    <div class="col-md-6" style="padding-right:5px;">
                       <div class="form-group">
						<div style="    background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;"> 
						Date de naissance
                        </div>
                        <input type="date" id="datedenaissance" name="datedenaissance" class="form-control">
						
						
                       </div>
                    </div>
					
					<div class="col-md-6" style="padding-left:5px;">
                        <div class="form-group">
							<div style="    background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;"> 
							Wilaya	
                            </div>

                            <select class="custom-select2 form-control" id ="wilaya" name="wilaya" style="width: 100%; height: 38px;">
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

                    
                </div>



            </div>
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="col-md-6 mb-3">
        <!-- Address Card -->
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
					background:#0f4c81;
					color:white;
					padding:12px 15px;
					font-weight:700;
					font-size:1.2rem;
					margin: -20px -20px 20px -20px;
					border-radius:10px 10px 0 0;
					"
		>
               Identification du Patient (Arabe)
        </div>

             <div class="form-group">
				<div align="right" style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">   
				اللقب    
				</div>
				<input type="text" style="text-align: right;" id="nom_p_ar" name="nom_p_ar" class="form-control" placeholder="اللقب">
				
				<div align="right" style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">   
				الاسم   
				</div>
				<input type="text" style="text-align: right;" id="prenom_p_ar" name="prenom_p_ar" class="form-control" placeholder="الاسم">
				
				<div align="right" style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">   
				اللقب عند الولادة   
				</div>
                <input type="text" style="text-align: right;" id="nom_nais_ar" name="nom_nais_ar" class="form-control" placeholder="اللقب عند الولادة">					
              </div>
              
				<div align="right" style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">   
				اسم الزوج 
				</div>
                <input type="text" style="text-align: right;" id="conjoint_ar" name="conjoint_ar" class="form-control" placeholder="اسم الزوج">
				
				<div  style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">   
				Photo d'identité 
				</div>
				
				<label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
									<input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
									<span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs">
										<span class="fa fa-upload"></span>
									</span>
				</label>
				
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="col-md-6 mb-3">
        <!-- Address Card -->
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
					background:#0f4c81;
					color:white;
					padding:12px 15px;
					font-weight:700;
					font-size:1.2rem;
					margin: -20px -20px 20px -20px;
					border-radius:10px 10px 0 0;
					"
		>
               Adresse & Coordonnées
        </div>

            <div class="form-group">
				<div style="background:#e9ecef;color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">
				Adresse
                </div>
                <input type="text" id="adresse" name="adresse" class="form-control" 
                       placeholder="Ex: 12 Rue des Fleurs, Alger">
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

                <div class="col-md-6">
                    <div class="form-group">
						<div style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">                            
						Numéro de téléphone
                        </div>
                        <input type="text" id="numerodetelephone" name="numerodetelephone" class="form-control">
                    </div>
                </div>

            </div>
        </div>
    </div>					
								
 
        <!-- Assurance Card -->
	<div class="col-md-6 mb-3">

        <div style="
					border:1px solid #ccc; 
					border-radius:10px; 
					padding:20px; 
					background:#f9f9f9;
					box-shadow:0 6px 18px rgba(0,0,0,0.1);

					transition: all 0.25s ease;
					"
					onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 25px rgba(0,0,0,0.15)'"
					onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 6px 18px rgba(0,0,0,0.1)'"
		>

            <div style="
						background:#0f4c81;
						color:white;
						padding:12px 15px;
						font-weight:700;
						font-size:1.2rem;
						margin: -20px -20px 20px -20px;
						border-radius:10px 10px 0 0;
			">
                
				Assurance & Médecin Traitant
            </div>

            <div class="row">

                <div class="col-md-6">
                    <!-- <div class="form-group">
						<div style="    background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;"> 
						Nom du médecin traitant
                        </div>
                       
						<select class="custom-select2 form-control" id="nom_medc" name="nom_medc" style="width: 100%; height: 38px;">

                                <option value="" selected disabled hidden>Choisir un medecin</option>
                                <option value="Bouchami Ali">Bouchami Ali</option>
                                <option value="Merdaci Rabah">Merdaci Rabah</option>
						</select>		
                    </div> -->
                </div>

                <div class="col-md-6">
                    <div class="form-group">
						<div style="background:#e9ecef; color:black;padding:8px 12px;font-weight:600;margin-bottom:6px;border-radius:6px;">
						N° assurance 
                        </div>
                        <input type="text" id="assurance" name="assurance" class="form-control" placeholder="Entrez le N° assurance maladie">
                    </div>
                </div>

            </div>

        </div>

    </div>
<div style="display:flex; justify-content:flex-end; width:100%; gap:10px; margin-top:15px;">

    <!--<button
        id="resetbtn"
        onclick="resetForm()"
        style="
            display:flex;
            align-items:center;
            gap:8px;
            padding:8px 14px;
            font-size:14px;
            border:none;
            border-radius:10px;
            cursor:pointer;
            background:#f1f3f5;
            color:#333;
            font-weight:600;
            box-shadow:0 3px 10px rgba(0,0,0,0.1);
            transition:0.2s;
        "
        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 14px rgba(0,0,0,0.15)'"
        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 3px 10px rgba(0,0,0,0.1)'"
    >
        <i class="fa-solid fa-rotate-left"></i>
        Réinitialiser
    </button>
	-->
	<button type="button" class="btn btn-danger" onclick="window.location.href='Patient_Table.php';">Retour</button>
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