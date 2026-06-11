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

// 4. Inclusion de la bibliothèque TCPDF
require_once('tcpdf/tcpdf.php');

// 5. Initialisation et configuration du PDF pour un format Bracelet (180mm x 40mm, Paysage)
$bracelet_format = array(180, 40);
$pdf = new TCPDF('L', 'mm', $bracelet_format, true, 'UTF-8', false);

// Désactiver les en-têtes/pieds par défaut
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Marges chirurgicales ajustées pour accueillir l'en-tête (Haut : 2mm)
$pdf->SetMargins(4, 2, 4);
$pdf->SetAutoPageBreak(TRUE, 1);

// Ajouter une page
$pdf->AddPage();

// -----------------------------------------------------------------------------
// CHARGEMENT DE LA POLICE UNIVERSELLE (GÈRE LE FRANÇAIS ET L'ARABE)
// -----------------------------------------------------------------------------
$pdf->SetFont('dejavusans', '', 8);

// -----------------------------------------------------------------------------
// STYLE & ARCHITECTURE DU BRACELET
// -----------------------------------------------------------------------------
$shared_styles = '
<style>
    table.bracelet-table { width: 100%; border-collapse: collapse; font-family: dejavusans; }
    table.bracelet-table td { border: 1px solid #718096; padding: 2px 3px; vertical-align: middle; }
    
    .hospital-header { font-size: 7pt; font-weight: bold; color: #1a365d; border-bottom: 2px solid #2b6cb0 !important; background-color: #f7fafc; }
    .hospital-header-ar { font-size: 7.5pt; font-weight: bold; color: #1a365d; border-bottom: 2px solid #2b6cb0 !important; background-color: #f7fafc; text-align: right; }
    
    .label { background-color: #e2e8f0; color: #1a365d; font-weight: bold; font-size: 7pt; text-align: left; }
    .value { color: #1a365d; font-weight: bold; font-size: 7.5pt; text-align: left; }
    
    .label-ar { background-color: #e2e8f0; color: #1a365d; font-weight: bold; font-size: 7.5pt; text-align: right; }
    .value-ar { color: #1a365d; font-weight: bold; font-size: 8.5pt; text-align: right; }
    
    .id-box { background-color: #1a365d; color: #ffffff; font-weight: bold; font-size: 8.5pt; text-align: center; }
    .gender-box { background-color: #2b6cb0; color: #ffffff; font-weight: bold; font-size: 7.5pt; text-align: center; }
    .blood-box { background-color: #c53030; color: #ffffff; font-weight: bold; font-size: 7.5pt; text-align: center; }
</style>
';

// Concaténation du nom et prénom arabe
$nom_complet_ar = $data['nom_ar'] . ' ' . $data['prenom_ar'];

$bracelet_html = $shared_styles . '
<table class="bracelet-table" cellpadding="2">
    <tr>
        <td class="hospital-header" colspan="3" style="width: 50%;">
            EHS EL BOUNI - SERVICE GYNÉCOLOGIE
        </td>
        <td class="hospital-header-ar" colspan="3" style="width: 50%;" direction="rtl">
            مستشفى البوني - مصلحة أمراض النساء
        </td>
    </tr>

    <tr>
        <td class="label" style="width: 14%;">ID Bébé:</td>
        <td class="id-box" style="width: 18%;">' . htmlspecialchars($data['id']) . '</td>
        
        <td class="label" style="width: 10%;">Sexe:</td>
        <td class="gender-box" style="width: 18%;">' . htmlspecialchars($data['sexe']) . '</td>
        
        <td class="label" style="width: 15%;">Gr. Sanguin:</td>
        <td class="blood-box" style="width: 25%;">' . htmlspecialchars($data['groupesanguin']) . '</td>
    </tr>
    
    <tr>
        <td class="label" style="width: 14%;">Nom & Prénom:</td>
        <td class="value" colspan="5" style="width: 86%;">' . htmlspecialchars(strtoupper($data['nom']) . ' ' . ucfirst($data['prenom'])) . '</td>
    </tr>

    <tr>
        <td class="value-ar" colspan="5" style="width: 84%;" direction="rtl">' . $nom_complet_ar . '</td>
        <td class="label-ar" style="width: 16%;" direction="rtl">اللقب والاسم:</td>
    </tr>

    <tr>
        <td class="label" style="width: 14%;">Mère:</td>
        <td class="value" style="width: 40%; font-size: 7pt;">' . htmlspecialchars($data['nomprenommere']) . '</td>
        
        <td class="label" style="width: 16%;">Date / Heure:</td>
        <td class="value" colspan="2" style="width: 30%; font-size: 7pt;">' . htmlspecialchars($data['date']) . ' à ' . htmlspecialchars($data['temps']) . '</td>
    </tr>
</table>
';

$pdf->writeHTML($bracelet_html, true, false, true, false, '');

// 6. Sortie du PDF
$pdf->Output('Bracelet_Nouveau_Ne_' . $id_nee . '.pdf', 'I');
?>