<?php
session_start();
include 'connection.php';

// 1. Vérification de la session
if (!isset($_SESSION['log_u'])) {
    header('location:login.php');
    die;
}

// 2. Récupération et sécurisation de l'ID passé en paramètre URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID du nouveau-né manquant.");
}
$id_nee = mysqli_real_escape_string($link, $_GET['id']);

// 3. Récupération des données du nouveau-né depuis la base de données
$query = "SELECT * FROM `nee` WHERE `id` = '$id_nee' LIMIT 1"; 
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) == 0) {
    die("Aucun enregistrement trouvé pour cet ID.");
}

$data = mysqli_fetch_assoc($result);

// Formatage de la date de naissance si valide
$date_nais_formated = !empty($data['date']) ? date('d/m/Y', strtotime($data['date'])) : '/';

// -----------------------------------------------------------------------------
// DÉTERMINATION DYNAMIQUE DE LA COULEUR DE L'ÉTAT DE NAISSANCE
// -----------------------------------------------------------------------------
$etat_texte = !empty($data['etat']) ? trim($data['etat']) : 'Vivant';

// On passe en minuscules pour éviter les pièges de casse (Mort-né, mort-ne, MORT-NÉ)
$etat_check = mb_strtolower($etat_texte, 'UTF-8');

if (strpos($etat_check, 'mort') !== false) {
    // Si l'état contient "mort", affichage en Rouge
    $color_etat = '#e53e3e'; 
} else {
    // Sinon (Vivant, Sain, etc.), affichage en Vert
    $color_etat = '#38a169'; 
}

// 4. Inclusion de la bibliothèque TCPDF
require_once('tcpdf/tcpdf.php');

// 5. Initialisation et configuration du PDF (A4 Vertical)
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(15, 12, 15);
$pdf->SetAutoPageBreak(TRUE, 15);
$pdf->AddPage();

// Utilisation de dejavusans pour le bilinguisme parfait
$pdf->SetFont('dejavusans', '', 9);

// -----------------------------------------------------------------------------
// CHARTE GRAPHIQUE HYBRIDE (En-tête Orange #dd6b20 & Corps Bleu #1e3a8a)
// -----------------------------------------------------------------------------
$css_styles = '
<style>
    /* Styles de l\'en-tête (Conservés en Orange #dd6b20 pour l\'entité administrative) */
    .hospital-title { font-size: 11pt; color: #1a365d; font-weight: bold; }
    .hospital-subtitle { font-size: 9pt; color: #4a5568; font-weight: normal; }
    
    /* Styles du corps (Modifiés en Bleu Clinique Professionnel) */
    .main-title { font-size: 16pt; color: #0f172a; font-weight: bold; text-align: center; letter-spacing: 0.5px; }
    
    .section-header { color: #1e3a8a; font-weight: bold; font-size: 11pt; border-bottom: 2px solid #1e3a8a; padding-bottom: 3px; }
    
    table.data-flat { width: 100%; margin-top: 8px; border-collapse: collapse; }
    table.data-flat td { padding: 8px 5px; border-bottom: 1px solid #edf2f7; font-size: 9.5pt; }
    
    td.label-flat { color: #64748b; font-weight: bold; width: 35%; }
    td.value-flat { color: #334155; width: 65%; font-weight: 500; }
    
    .signature-card { text-align: center; border: 1px solid #e2e8f0; background-color: #fff; padding: 15px; }
    .signature-title { font-size: 9.5pt; font-weight: bold; color: #1e3a8a; }
</style>
';

// --- BLOCK 1 : EN-TÊTE INSTITUTIONNELLE STRICTEMENT CONSERVÉE EN ORANGE ---
$html = $css_styles . '
<table style="width: 100%; border-bottom: 2px solid #dd6b20; padding-bottom: 10px;">
    <tr>
        <td style="width: 50%; text-align: left; vertical-align: middle;">
            <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td style="width: 22%; text-align: left; vertical-align: middle;">
                        <img src="vendors/images/logo.png" width="48" height="48" align="middle" />
                    </td>
                    <td style="width: 78%; text-align: left; vertical-align: middle;">
                        <span class="hospital-title">ÉTABLISSEMENT HOSPITALIER SPÉCIALISÉ</span><br>
                        <span class="hospital-subtitle">SERVICE GYNÉCOLOGIE & OBSTÉTRIQUE</span><br>
                        <span style="font-size: 8pt; color: #718096;">Délivré le : ' . date('d/m/Y à H:i') . '</span>
                    </td>
                </tr>
            </table>
        </td>
        
        <td style="width: 50%; text-align: right; vertical-align: middle;">
            <table cellpadding="0" cellspacing="0" border="0" direction="rtl">
                <tr>
                    <td style="width: 78%; text-align: right; vertical-align: middle;">
                        <span class="hospital-title">المؤسسة العمومية الاستشفائية المتخصصة</span><br>
                        <span class="hospital-subtitle">مصلحة أمراض النساء والتوليد</span>
                    </td>
                    <td style="width: 22%; text-align: right; vertical-align: middle;">
                        <img src="vendors/images/logo_EHS.png" width="48" height="48" align="middle" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<br><br>

<table style="width: 100%; text-align: center;">
    <tr>
        <td>
            <div class="main-title">DOCUMENT D\'INSCRIPTION NOUVEAU-NÉ</div>
            <span style="font-size: 10pt; color: #64748b;">N° d\'enregistrement : <b>' . htmlspecialchars($data['id']) . '</b></span>
        </td>
    </tr>
</table>
<br><br>

<div class="section-header" style="text-align: right;">1. الهوية باللغة العربية</div>
<table class="data-flat" cellpadding="6" direction="rtl">
    <tr>
        <td style="width: 30%; color: #64748b; font-weight: bold; text-align: right;">اللقب :</td>
        <td style="width: 70%; color: #334155; font-weight: bold; font-size: 12pt; text-align: right;">' . htmlspecialchars($data['nom_ar']) . '</td>
    </tr>
    <tr>
        <td style="width: 30%; color: #64748b; font-weight: bold; text-align: right;">الاسم :</td>
        <td style="width: 70%; color: #334155; font-weight: bold; font-size: 12pt; text-align: right;">' . htmlspecialchars($data['prenom_ar']) . '</td>
    </tr>
</table>
<br><br>

<div class="section-header">2. Informations Générales</div>
<table class="data-flat" cellpadding="5">
    <tr>
        <td class="label-flat">Nom de famille :</td>
        <td class="value-flat" style="text-transform: uppercase; font-weight: bold; color: #334155;">' . htmlspecialchars($data['nom']) . '</td>
    </tr>
    <tr>
        <td class="label-flat">Prénom :</td>
        <td class="value-flat" style="font-weight: bold; color: #334155;">' . htmlspecialchars($data['prenom']) . '</td>
    </tr>
    
    <tr>
        <td class="label-flat">Père & Mère   :</td>
        <td class="value-flat">Fils/Fille de <b>' . htmlspecialchars($data['papa']) . '</b> et de <b>' . htmlspecialchars($data['nomprenommere']) . '</b></td>
    </tr>
    <tr>
        <td class="label-flat">Sexe :</td>
        <td class="value-flat" style="font-weight: bold;">' . htmlspecialchars($data['sexe']) . '</td>
    </tr>
    <tr>
        <td class="label-flat">Naissance :</td>
        <td class="value-flat"><b>' . $date_nais_formated . '</b> à <b>' . htmlspecialchars($data['temps']) . '</b> — à : ' . htmlspecialchars($data['lieu_nais']) . '</td>
    </tr>
    <tr>
        <td class="label-flat">Poids corporel :</td>
        <td class="value-flat" style="font-weight: bold; color: #1e3a8a;">' . htmlspecialchars($data['nombre']) . ' kg</td>
    </tr>
    <tr>
        <td class="label-flat">Groupe Sanguin :</td>
        <td class="value-flat" style="font-weight: bold; color: #e53e3e;">' . htmlspecialchars($data['groupesanguin']) . '</td>
    </tr>
    <tr>
        <td class="label-flat">État à la naissance :</td>
        <td class="value-flat" style="font-weight: bold; color: ' . $color_etat . '; text-transform: uppercase;">' . htmlspecialchars($etat_texte) . '</td>
    </tr>
</table>
<br><br>

<div class="section-header">3. Données Médicales & Suivi Clinique</div>
<table class="data-flat" cellpadding="5">
    <tr>
        <td class="label-flat">Traitements / Médicaments :</td>
        <td class="value-flat">' . (!empty($data['medicaments']) ? htmlspecialchars($data['medicaments']) : '<span style="color:#94a3b8;">Aucun traitement particulier</span>') . '</td>
    </tr>
    <tr>
        <td class="label-flat">Alimentation prescrite :</td>
        <td class="value-flat">' . (!empty($data['alimentation']) ? htmlspecialchars($data['alimentation']) : 'Non spécifiée') . '</td>
    </tr>
    <tr>
        <td class="label-flat">Réanimation :</td>
        <td class="value-flat" style="font-weight: bold;">' . htmlspecialchars($data['reanimation']) . '</td>
    </tr>
    <tr>
        <td class="label-flat">Interventions chirurgicales :</td>
        <td class="value-flat">' . (!empty($data['interventions']) ? htmlspecialchars($data['interventions']) : 'Aucune') . '</td>
    </tr>
    <tr>
        <td class="label-flat">pH Cordon :</td>
        <td class="value-flat">
            Artériel : <span style="font-weight: bold; color: #4a5568;">' . htmlspecialchars($data['arterielval']) . '</span> &nbsp;|&nbsp; 
            Veineux : <span style="font-weight: bold; color: #4a5568;">' . htmlspecialchars($data['veineuxval']) . '</span>
        </td>
    </tr>
    <tr>
        <td class="label-flat">Examen Radiologique (Rx) :</td>
        <td class="value-flat">' . htmlspecialchars($data['rx']) . '</td>
    </tr>
    <tr>
        <td class="label-flat">Spécifications additionnelles :</td>
        <td class="value-flat" style="font-style: italic; color: #718096;">' . (!empty($data['specifier']) ? htmlspecialchars($data['specifier']) : '-') . '</td>
    </tr>
</table>
<br><br><br>

<table style="width: 100%; margin-top: 10px;">
    <tr>
        <td class="signature-card" style="width: 48%;">
            <br>
            <span class="signature-title">Le Pédiatre Traitant</span><br>
            <span style="font-size: 7.5pt; color: #a0aec0;">Signature & Cachet médical</span>
            <br><br><br><br>
        </td>
        
        <td style="width: 4%;"></td>
        
        <td class="signature-card" style="width: 48%;">
            <br>
            <span class="signature-title">Surveillance du Service</span><br>
            <span style="font-size: 7.5pt; color: #a0aec0;">Validation de l\'inscription</span>
            <br><br><br><br>
        </td>
    </tr>
</table>
';

// Écriture du code HTML
$pdf->writeHTML($html, true, false, true, false, '');

// 6. Rendu direct dans le navigateur
$pdf->Output('Fiche_Nouveau_Ne_Moderne_' . $id_nee . '.pdf', 'I');
?>