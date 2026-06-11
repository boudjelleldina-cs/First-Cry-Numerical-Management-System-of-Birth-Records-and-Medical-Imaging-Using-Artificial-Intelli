<?php
session_start();
include 'connection.php';

// 1. Vérification de la session
if (!isset($_SESSION['log_u'])) {
    header('location:loginpage.php');
    die;
}

// 2. Récupération et sécurisation de l'ID d'admission passé en paramètre URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID d'admission manquant.");
}
$id_admission = mysqli_real_escape_string($link, $_GET['id']);

// 3. Récupération des données complètes de l'admission et de la sortie avec jointures
$query = "SELECT a.*, 
                 p.nom_p, p.prenom_p, p.nom_p_nais, p.date_nais_p, p.wilaya_nais_p,
                 m.nom_med, m.prenom_med,
                 l.chambre_id, l.numero_lit
          FROM `admission` a
          LEFT JOIN `patient` p ON a.id_p = p.id_patient
          LEFT JOIN `medecin` m ON a.id_med = m.id_med
          LEFT JOIN `lit` l ON a.id_lit = l.id
          WHERE a.id_admis = '$id_admission' LIMIT 1"; 

$result = mysqli_query($link, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Aucun enregistrement trouvé pour cet ID.");
}

$data = mysqli_fetch_assoc($result);

// Formatage des dates (Entrée et Sortie automatique à la date du jour)
$date_entree_raw = $data['date_entre'];
$date_sortie_raw = !empty($data['date_sorti']) ? $data['date_sorti'] : date('Y-m-d H:i:s');

$date_entree_formated = !empty($date_entree_raw) ? date('d/m/Y à H:i', strtotime($date_entree_raw)) : '/';
$date_sortie_formated = date('d/m/Y à H:i', strtotime($date_sortie_raw));

// Calcul automatique de la durée de séjour
$durée_sejour = '/';
if (!empty($date_entree_raw)) {
    $datetime1 = new DateTime($date_entree_raw);
    $datetime2 = new DateTime($date_sortie_raw);
    $interval = $datetime1->diff($datetime2);
    $durée_sejour = $interval->format('%a jours');
    if ($interval->days == 0) {
        $durée_sejour = "Moins d'un jour";
    }
}

// 4. Inclusion de la bibliothèque TCPDF
require_once('tcpdf/tcpdf.php');

// 5. Initialisation et configuration du PDF (Format A4 Vertical)
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Désactiver les en-têtes/pieds automatiques par défaut pour un design personnalisé
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Marges standard de document officiel
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(TRUE, 15);

// Ajouter la page
$pdf->AddPage();

// Utilisation d'une police bilingue stable supportant le français et l'arabe
$pdf->SetFont('dejavusans', '', 10);

// -----------------------------------------------------------------------------
// STYLES CSS DU DOCUMENT SORTIE (Optimisé pour la charte graphique Orange/Ambre)
// -----------------------------------------------------------------------------
$css_styles = '
<style>
    .hospital-title { font-size: 11pt; color: #1a365d; font-weight: bold; }
    .hospital-subtitle { font-size: 9pt; color: #4a5568; font-weight: normal; }
    .main-title { font-size: 18pt; color: #7b341e; font-weight: bold; text-align: center; }
    .section-header { background-color: #dd6b20; color: #ffffff; font-weight: bold; font-size: 11pt; }
    table.data-table { width: 100%; border-collapse: collapse; margin-top: 5px; }
    table.data-table td { border: 1px solid #cbd5e0; }
    td.label { background-color: #f7fafc; color: #4a5568; font-weight: bold; width: 35%; }
    td.value { color: #2d3748; width: 65%; font-weight: 500; }
    .signature-title { font-size: 9pt; font-weight: bold; color: #1a365d; }
</style>
';

// --- BLOCK 1 : EN-TÊTE INSTITUTIONNELLE AVEC LES DEUX LOGOS ---
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

<div class="main-title">BULLETIN DE SORTIE HOSPITALIÈRE</div>
<div style="text-align: center; color: #4a5568; font-size: 10pt; font-weight: bold; margin-top: 5px;">
    Réf. Admission N° : <span style="color: #7b341e;">' . htmlspecialchars($data['id_admis']) . '</span>
</div>
<br><br>

<table class="data-table" cellpadding="6">
    <tr>
        <td class="section-header" colspan="2">1. IDENTIFICATION DU PATIENT / المريض</td>
    </tr>
    <tr>
        <td class="label">ID Unique Patient :</td>
        <td class="value">' . htmlspecialchars($data['id_p']) . '</td>
    </tr>
    <tr>
        <td class="label">Nom & Prénom :</td>
        <td class="value" style="font-size: 11pt; text-transform: uppercase; font-weight: bold;">' . htmlspecialchars($data['nom_p'] . ' ' . $data['prenom_p']) . '</td>
    </tr>
    <tr>
        <td class="label">Nom à la naissance :</td>
        <td class="value">' . htmlspecialchars(!empty($data['nom_p_nais']) ? $data['nom_p_nais'] : '-') . '</td>
    </tr>
    <tr>
        <td class="label">Date de naissance :</td>
        <td class="value">' . (!empty($data['date_nais_p']) ? date('d/m/Y', strtotime($data['date_nais_p'])) : '/') . '</td>
    </tr>
    <tr>
        <td class="label">Lieu de naissance :</td>
        <td class="value">' . htmlspecialchars($data['wilaya_nais_p']) . '</td>
    </tr>
</table>
<br><br>

<table class="data-table" cellpadding="6">
    <tr>
        <td class="section-header" colspan="2">2. HISTORIQUE DU SÉJOUR & SORTIE / تفاصيل الإستشفاء والخروج</td>
    </tr>
    <tr>
        <td class="label">Date & Heure d\'Entrée :</td>
        <td class="value">' . $date_entree_formated . '</td>
    </tr>
    <tr>
        <td class="label">Date & Heure de Sortie :</td>
        <td class="value" style="font-weight: bold; color: #b7791f;">' . $date_sortie_formated . '</td>
    </tr>
    <tr>
        <td class="label">Durée totale du séjour :</td>
        <td class="value" style="font-weight: bold; color: #2f855a;">' . $durée_sejour . '</td>
    </tr>
    <tr>
        <td class="label">Structure / Service :</td>
        <td class="value">' . htmlspecialchars($data['service']) . ' (Chambre : ' . htmlspecialchars($data['chambre_id']) . ', Lit : ' . htmlspecialchars($data['numero_lit']) . ')</td>
    </tr>
    <tr>
        <td class="label">Médecin Traitant :</td>
        <td class="value">Dr. ' . htmlspecialchars(strtoupper($data['nom_med']) . ' ' . $data['prenom_med']) . '</td>
    </tr>
    <tr>
        <td class="label">Autorisation médicale :</td>
        <td class="value" style="color: #2f855a; font-weight: bold;">Sortie autorisée par le médecin traitant</td>
    </tr>
</table>
<br><br><br>

<table style="width: 100%; margin-top: 20px;">
    <tr>
        <td style="width: 31%; text-align: center; border: 1px dashed #cbd5e0; background-color: #f7fafc; padding: 10px;">
            <span class="signature-title">Signature de l\'Agent <br>/ العون</span><br>
            <br><br><br><br>
        </td>
        
        <td style="width: 3.5%;"></td>
        
        <td style="width: 31%; text-align: center; border: 1px dashed #cbd5e0; background-color: #f7fafc; padding: 10px;">
            <span class="signature-title">Cachet du Bureau <br>des Entrées / Sorties</span><br>
            <br><br><br><br>
        </td>
        
        <td style="width: 3.5%;"></td>
        
        <td style="width: 31%; text-align: center; border: 1px dashed #cbd5e0; background-color: #f7fafc; padding: 10px;">
            <span class="signature-title">Signature du Médecin <br>/ الطبيب المعالج</span><br>
            <br><br><br><br>
        </td>
    </tr>
</table>
';

// Écriture du bloc HTML complet consolidé
$pdf->writeHTML($html, true, false, true, false, '');

// 6. Sortie du PDF (Ouvrir directement dans le navigateur)
$pdf->Output('Bulletin_Sortie_' . $id_admission . '.pdf', 'I');
?>