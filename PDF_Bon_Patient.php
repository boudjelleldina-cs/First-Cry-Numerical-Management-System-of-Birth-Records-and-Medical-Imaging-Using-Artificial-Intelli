<?php
session_start();
include 'connection.php';

// 1. Vérification de la session sécurisée
if (!isset($_SESSION['log_u'])) {
    header('location:loginpage.php');
    die;
}

// 2. Récupération et sécurisation de l'ID du patient
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Identifiant du patient manquant.");
}
$id_patient = mysqli_real_escape_string($link, $_GET['id']);

// 3. Extraction des données du patient
$query = "SELECT * FROM `patient` WHERE `id_patient` = '$id_patient' LIMIT 1"; 
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) == 0) {
    die("Aucun dossier trouvé pour ce patient.");
}

$data = mysqli_fetch_assoc($result);

// 4. Inclusion de la bibliothèque TCPDF
require_once('tcpdf/tcpdf.php');

// 5. Personnalisation graphique de la structure
class BONPDF extends TCPDF {
    public function Header() {
        // Top-bar bicolore moderne (Saphir & Turquoise)
        $this->SetFillColor(14, 43, 73); // Bleu Saphir
        $this->Rect(0, 0, $this->getPageWidth(), 3, 'F');
        
        $this->SetFillColor(0, 168, 150); // Turquoise Médical
        $this->Rect(0, 3, $this->getPageWidth(), 1, 'F');
    }
    public function Footer() {
        $this->SetY(-10);
        $this->SetFont('helvetica', 'I', 6);
        $this->SetTextColor(156, 163, 175); 
        $this->Cell(0, 5, 'EHS El Bouni — Système d\'Information Hospitalier', 0, false, 'C');
    }
}

// 6. INITIALISATION (Format Ticket : 80mm x 145mm)
$pdf = new BONPDF('P', 'mm', array(80, 145), true, 'UTF-8', false);

$pdf->SetCreator('EHS_App');
$pdf->SetAuthor('EHS El Bouni');
$pdf->SetTitle('Ticket Patient avec Code-barres Centré');

$pdf->SetMargins(6, 10, 6);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->SetFont('dejavusans', '', 8);
$pdf->AddPage();

// 7. Préparation des données
$nom_fr = strtoupper($data['nom_p']);
$prenom_fr = ucfirst($data['prenom_p']);
$nom_p_nais = !empty($data['nom_p_nais']) ? strtoupper($data['nom_p_nais']) : '-';

$nom_ar = $data['nom_p_ar'];
$prenom_ar = $data['prenom_p_ar'];
$date_nais = date('d/m/Y', strtotime($data['date_nais_p']));

$id_operateur = isset($_SESSION['login_id']) ? $_SESSION['login_id'] : $_SESSION['log_u'];
$raw_code = str_pad($data['id_patient'], 6, '0', STR_PAD_LEFT); 
$code_bon = "BON-" . date('Ymd') . "-" . str_pad($data['id_patient'], 4, '0', STR_PAD_LEFT);

// 8. Architecture HTML (Première partie)
$html = '
<table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td style="text-align: center; font-size: 7px; color: #1e293b; font-weight: bold; line-height: 1.3;">
            MINISTÈRE DE LA SANTÉ<br>
            <span style="color: #0e2b49; font-size: 8.5px; font-weight: 800; letter-spacing: 0.3px;">EHS MÈRE-ENFANT EL BOUNI - ANNABA</span><br>
            <span style="font-size: 7px; font-weight: normal; color: #64748b;" dir="rtl">المؤسسة الإستشفائية المتخصصة الأم والطفل البوني - عنابة</span>
        </td>
    </tr>
</table>

<br><br>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td style="text-align: center; font-size: 6px; color: #94a3b8; font-weight: bold; letter-spacing: 0.8px;">ID ENREGISTREMENT</td>
    </tr>
    <tr>
        <td style="text-align: center; font-size: 11px; font-weight: bold; color: #00a896;">'.$code_bon.'</td>
    </tr>
</table>
';

// Écriture du premier bloc HTML
$pdf->writeHTML($html, true, false, true, false, '');

// ==================== GENERATION DU CODE-BARRES CENTRÉ ====================
$barcode_width = 54; // Largeur du code-barres en mm
$page_width = $pdf->getPageWidth(); // Récupère les 80mm de la page
$x_centered = ($page_width - $barcode_width) / 2; // Formule de centrage (Résultat : 13mm)

$style_barcode = array(
    'position' => '',
    'align' => 'C', // Alignement interne du texte sous le code-barres
    'stretch' => false,
    'fitwidth' => false,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => 0,
    'vpadding' => 0,
    'fgcolor' => array(14, 43, 73), // Bleu Saphir
    'bgcolor' => false,
    'text' => true, 
    'font' => 'helvetica',
    'fontsize' => 7,
    'stretchtext' => 4
);

$pdf->Ln(2); 
// En passant $x_centered (13), le bloc se place exactement au milieu horizontal
$pdf->write1DBarcode($raw_code, 'C128', $x_centered, '', $barcode_width, 11, 0.4, $style_barcode, 'N');
$pdf->Ln(3); 
// ===========================================================================

// Continuation de l'architecture HTML (Seconde partie)
$html_suite = '
<div style="text-align: center;">
    <span style="font-size: 9px; font-weight: bold; color: #ffffff; background-color: #0e2b49; padding: 4px 14px; border-radius: 3px;">
        ADMISSION / استشفاء
    </span>
</div>

<br><br><br>

<table cellpadding="5" cellspacing="0" border="0" width="100%" style="font-size: 8px;">
    <tr style="background-color: #f1f5f9;">
        <td width="35%" style="color: #475569; font-weight: bold;">Patient</td>
        <td width="65%" style="color: #0f172a; font-weight: bold; text-align: right;">'.$nom_fr.' '.$prenom_fr.'</td>
    </tr>
    <tr>
        <td width="35%" style="color: #475569; font-weight: bold;">المريض</td>
        <td width="65%" style="color: #0f172a; font-weight: bold; text-align: right; font-size: 9px;" dir="rtl">'.$nom_ar.' '.$prenom_ar.'</td>
    </tr>
    <tr style="background-color: #f1f5f9;">
        <td width="35%" style="color: #475569;">Né(e) le</td>
        <td width="65%" style="color: #0e2b49; text-align: right; font-weight: bold;">'.$date_nais.'</td>
    </tr>';

if ($nom_p_nais !== '-') {
    $html_suite .= '
    <tr>
        <td width="35%" style="color: #475569;">Nom J.F</td>
        <td width="65%" style="color: #0f172a; text-align: right;">'.$nom_p_nais.'</td>
    </tr>';
}

$html_suite .= '
</table>

<div style="background-color: #e2e8f0; height: 1px; margin-top: 6px;"></div>

<br><br><br>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td style="text-align: center; font-size: 6.5px; color: #64748b; line-height: 1.4;">
            Généré le '.date('d/m/Y à H:i').'<br>
            Agent d\'accueil : <span style="color: #00a896; font-weight: bold;">'.strtoupper($id_operateur).'</span>
        </td>
    </tr>
    <br><br>
    <tr>
        <td style="text-align: center;">
            <div style="border: 1px solid #cbd5e1; background-color: #f8fafc; padding: 7px; color: #475569; font-size: 6.5px; font-weight: bold; letter-spacing: 0.3px;">
                VISA & CACHET BUREAU DES ENTRÉES
            </div>
        </td>
    </tr>
</table>
';

// 9. Écriture de la suite du HTML dans le document
$pdf->writeHTML($html_suite, true, false, true, false, '');

// 10. Rendu final direct
$pdf->Output('Ticket_Saphir_Centred_'.$nom_fr.'.pdf', 'I');
?>