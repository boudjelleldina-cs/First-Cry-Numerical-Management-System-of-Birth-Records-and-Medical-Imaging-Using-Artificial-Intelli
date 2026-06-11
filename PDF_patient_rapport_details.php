<?php
include 'connection.php';
session_start();

// 1. Vérification de la session
if (!isset($_SESSION['log_u'])) {
    header('location:loginpage.php');
    die;
}

// 2. Sécurisation et récupération de l'ID Patient
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID du patient manquant.");
}
$id_patient = mysqli_real_escape_string($link, $_GET['id']);

// 3. Récupération des données du patient
$res_patient = mysqli_query($link, "SELECT * FROM patient WHERE id_patient='$id_patient' LIMIT 1");
if (mysqli_num_rows($res_patient) == 0) {
    die("Aucun patient trouvé.");
}
$patient = mysqli_fetch_assoc($res_patient);

// Calcul précis de l'âge
$dateNaissance = $patient['date_nais_p'];
$aujourdhui = date("Y-m-d");
$diff = date_diff(date_create($dateNaissance), date_create($aujourdhui));
$age = $diff->format('%y') . " ans";

// 4. Inclusion de la bibliothèque TCPDF
require_once('tcpdf/tcpdf.php');

// 5. Initialisation du document PDF (A4 Vertical)
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Désactivation des en-têtes/pieds par défaut pour intégrer notre propre design minimaliste
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Marges cliniques standards (15mm)
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(TRUE, 20);

// Ajouter la page
$pdf->AddPage();

// Utilisation du pack de polices dejavusans (UTF-8 / Support bilingue Arabe-Français fluide)
$pdf->SetFont('dejavusans', '', 9);

// 6. Feuille de style CSS Avancée (Design Corporate / Clinique)
$css_styles = '
<style>
    /* En-tête administratif */
    .hospital-title { font-size: 10pt; color: #0f172a; font-weight: bold; font-family: "dejavusans"; }
    .hospital-subtitle { font-size: 8.5pt; color: #475569; }
    .doc-date { font-size: 7.5pt; color: #94a3b8; }
    
    /* Titre Principal du Document */
    .doc-title { font-size: 18pt; color: #1e3a8a; font-weight: bold; text-align: center; letter-spacing: 0.5px; }
    .doc-id { font-size: 9.5pt; color: #475569; text-align: center; font-weight: bold; }
    
    /* Titres de Sections Épurés */
    .section-header { color: #1e3a8a; font-weight: bold; font-size: 11pt; border-bottom: 1px solid #cbd5e1; padding-bottom: 4px; text-transform: uppercase; }
    
    /* Grille d Identification Patient (Flat Borderless Design) */
    table.patient-grid { width: 100%; margin-top: 5px; }
    table.patient-grid td { padding: 6px 4px; font-size: 9.5pt; vertical-align: middle; }
    .grid-label { color: #64748b; font-weight: bold; width: 20%; border-bottom: 1px dashed #f1f5f9; }
    .grid-value { color: #0f172a; width: 30%; font-weight: 500; border-bottom: 1px dashed #f1f5f9; }
    
    /* Conteneur de Rapport Clinique (Timeline Minimaliste) */
    table.timeline-container { width: 100%; margin-bottom: 18px; }
    .timeline-left-axis { width: 4%; text-align: center; color: #1e3a8a; font-size: 12pt; vertical-align: top; }
    .timeline-content-box { width: 96%; padding-left: 10px; vertical-align: top; }
    
    .report-meta-title { font-size: 10pt; font-weight: bold; color: #1e3a8a; margin-bottom: 4px; }
    .report-body-text { color: #334155; font-size: 9.5pt; text-align: justify; line-height: 1.4; }
    
    /* Styles pour l exécution du code HTML à l intérieur du rapport */
    .report-body-text h1, .report-body-text h2, .report-body-text h3 { color: #0f172a; margin-top: 10px; margin-bottom: 4px; font-size: 10.5pt; }
    .report-body-text ul { margin: 4px 0 8px 15px; padding: 0; }
    .report-body-text li { margin-bottom: 2px; color: #334155; }
    .report-body-text strong { color: #0f172a; font-weight: bold; }
    .report-body-text table { width: 100%; border-collapse: collapse; margin: 8px 0; }
    .report-body-text table th { background-color: #f8fafc; color: #1e3a8a; font-weight: bold; padding: 5px; text-align: left; border: 1px solid #e2e8f0; }
    .report-body-text table td { padding: 5px; border: 1px solid #e2e8f0; }
    
    /* Bloc de Validation Signature */
    .signature-section { text-align: right; }
    .signature-title { font-size: 9.5pt; font-weight: bold; color: #1e3a8a; text-decoration: underline; }
    .signature-sub { font-size: 7.5pt; color: #94a3b8; }
</style>
';

// --- INITIATION DE LA STRUCTURE HTML ---
$html = $css_styles;

// BLOCK 1 : L'EN-TÊTE OFFICIELLE (Conservée à l'identique, séparateur affiné)
$html .= '
<table style="width: 100%; border-bottom: 1px solid #cbd5e1; padding-bottom: 8px;">
    <tr>
        <td style="width: 50%; text-align: left; vertical-align: middle;">
            <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td style="width: 18%; text-align: left; vertical-align: middle;">
                        <img src="vendors/images/logo.png" width="40" height="40" />
                    </td>
                    <td style="width: 82%; text-align: left; vertical-align: middle;">
                        <span class="hospital-title">ÉTABLISSEMENT HOSPITALIER SPÉCIALISÉ</span><br>
                        <span class="hospital-subtitle">SERVICE MÉDICAL</span><br>
                        <span class="doc-date">Date d\'édition : ' . date('d/m/Y à H:i') . '</span>
                    </td>
                </tr>
            </table>
        </td>
        <td style="width: 50%; text-align: right; vertical-align: middle;">
            <table cellpadding="0" cellspacing="0" border="0" direction="rtl">
                <tr>
                    <td style="width: 82%; text-align: right; vertical-align: middle;">
                        <span class="hospital-title">المؤسسة العمومية الاستشفائية المتخصصة</span><br>
                        <span class="hospital-subtitle">المصلحة الطبية</span>
                    </td>
                    <td style="width: 18%; text-align: right; vertical-align: middle;">
                        <img src="vendors/images/logo_EHS.png" width="40" height="40" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<br><br>';

// BLOCK 2 : TITRE DU DOCUMENT (Conservé à l'identique)
$html .= '
<table style="width: 100%; text-align: center;">
    <tr>
        <td>
            <div class="doc-title">DOSSIER & RAPPORT MÉDICAL</div>
            <div class="doc-id">N° ID PATIENT : ' . htmlspecialchars($patient['id_patient']) . '</div>
        </td>
    </tr>
</table>
<br><br>';

// BLOCK 3 : NOUVEAU DESIGN PLAT POUR L'IDENTIFICATION DU PATIENT
$html .= '
<div class="section-header">1. Identification du Patient</div>
<br>
<table class="patient-grid" cellpadding="4">
    <tr>
        <td class="grid-label">Nom :</td>
        <td class="grid-value" style="text-transform: uppercase; font-weight: bold; color: #1e3a8a;">' . htmlspecialchars($patient['nom_p']) . '</td>
        <td class="grid-label">ID Unique :</td>
        <td class="grid-value" style="font-weight: bold;">' . htmlspecialchars($patient['id_patient']) . '</td>
    </tr>
    <tr>
        <td class="grid-label">Prénom :</td>
        <td class="grid-value">' . htmlspecialchars($patient['prenom_p']) . '</td>
        <td class="grid-label">Âge actuel :</td>
        <td class="grid-value" style="font-weight: bold;">' . $age . '</td>
    </tr>
    <tr>
        <td class="grid-label">Né(e) le :</td>
        <td class="grid-value">' . date('d/m/Y', strtotime($patient['date_nais_p'])) . '</td>
        <td class="grid-label">Sexe :</td>
        
    </tr>
</table>
<br><br><br>';

// BLOCK 4 : TIMELINE AVANCÉE ÉPURÉE (Exécute le code HTML des variables de rapports)
$html .= '
<div class="section-header">2. Évolution Clinique & Compte-Rendus</div>
<br><br>';

$res_rapports = mysqli_query($link, "SELECT * FROM rapport WHERE id_patient ='$id_patient' ORDER BY date_rapport DESC");

if (mysqli_num_rows($res_rapports) == 0) {
    $html .= '<p style="color:#94a3b8; font-style:italic; text-align:center;">Aucune observation enregistrée dans le dossier de ce patient.</p>';
} else {
    while ($row6 = mysqli_fetch_assoc($res_rapports)) {
        
        // Exécution directe du code HTML stocké en BDD (sans htmlspecialchars)
        $texte_html_execute = $row6['rapport'];
        
        $html .= '
        <table class="timeline-container" cellpadding="0" cellspacing="0">
            <tr>
                <td class="timeline-left-axis">▪</td>
                
                <td class="timeline-content-box">
                    <div class="report-meta-title">Rapport de consultation du ' . date('d/m/Y', strtotime($row6['date_rapport'])) . '</div>
                    <div class="report-body-text">' . $texte_html_execute . '</div>
                    <br><hr style="height:1px; border:none; color:#f1f5f9; background-color:#f1f5f9;" />
                </td>
            </tr>
        </table>';
    }
}

$html .= '<br><br>';

// BLOCK 5 : ESPACE SIGNATURE MINIMALISTE ET COORDONNÉES
$html .= '
<table style="width: 100%; page-break-inside: avoid;">
    <tr>
        <td style="width: 55%; vertical-align: bottom; color: #94a3b8; font-size: 7.5pt;">
            * Ce document informatique extrait du dossier patient informatisé fait foi de rapport médical officiel.
        </td>
        <td style="width: 45%;" class="signature-section">
            <span class="signature-title">Validation Médicale</span><br>
            <span class="signature-sub">Cachet d\'authentification & Signature</span>
            <br><br><br><br><br>
        </td>
    </tr>
</table>';

// 7. Génération finale du HTML par TCPDF
$pdf->writeHTML($html, true, false, true, false, '');

// 8. Rendu : Mode Affichage ("I" pour Inline) pour l'ouvrir directement dans le navigateur
$pdf->Output('Rapport_Medical_' . $id_patient . '.pdf', 'I');
?>