<?php
session_start();
include 'connection.php';

// 1. Vérification de la session
if (!isset($_SESSION['log_u'])) {
    header('location:login.php');
    die;
}

// 2. Récupération et sécurisation de l'ID du nouveau-né
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID du nouveau-né manquant.");
}
$id_nee = mysqli_real_escape_string($link, $_GET['id']);

// 3. Requête d'extraction des données
$query = "SELECT * FROM `nee` WHERE `id` = '$id_nee' LIMIT 1"; 
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) == 0) {
    die("Aucun enregistrement trouvé pour ce nouveau-né.");
}

$data = mysqli_fetch_assoc($result);

// 4. Inclusion de la bibliothèque TCPDF
require_once('tcpdf/tcpdf.php');

// 5. Configuration de la classe TCPDF
class MYPDF extends TCPDF {
    public function Header() {
        // Géré dans le flux HTML
    }
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'EHS El Bouni - Annaba | Document Généré Numériquement | Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// 6. Initialisation du document PDF
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator('EHS_App');
$pdf->SetAuthor('EHS El Bouni');
$pdf->SetTitle('Extrait de Naissance');

// Marges épurées
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(TRUE, 15);
$pdf->SetFont('dejavusans', '', 10);
$pdf->AddPage();

// 7. Préparation des variables de l'État Civil
$nom_fr = strtoupper($data['nom']);
$prenom_fr = ucfirst($data['prenom']);
$nom_ar = $data['nom_ar'];
$prenom_ar = $data['prenom_ar'];
$sexe = $data['sexe'];
$date_nais = date('d/m/Y', strtotime($data['date']));
$heure_nais = $data['temps'];
$lieu_resid = $data['lieu_nais'];
$mere = $data['nomprenommere'];
$pere = $data['papa'];

// 8. Construction du contenu HTML (Style "Bandeau & Blocs")
$html = '
<table cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td width="50%" style="text-align: left; font-size: 9px; color: #334155; line-height: 1.5;">
            <b>RÉPUBLIQUE ALGÉRIENNE DÉMOCRATIQUE ET POPULAIRE</b><br>
            MINISTÈRE DE LA SANTÉ<br>
            DIRECTION DE LA SANTÉ - WILAYA DE ANNABA<br>
            <span style="color: #1e3a8a; font-weight: bold;">EHS MÈRE-ENFANT EL BOUNI</span>
        </td>
        <td width="50%" style="text-align: right; font-size: 10px; color: #334155; line-height: 1.5;" dir="rtl">
            <b>الجمهورية الجزائرية الديمقراطية الشعبية</b><br>
            وزارة الصحة<br>
            مديرية الصحة لولاية عنابة<br>
            <span style="color: #1e3a8a; font-weight: bold;">المؤسسة الإستشفائية المتخصصة الأم والطفل البوني</span>
        </td>
    </tr>
</table>

<br><br>
<div style="background-color: #1e3a8a; height: 3px;"></div>
<br><br>

<table cellpadding="5" cellspacing="0">
    <tr>
        <td width="1%" bgcolor="#1e3a8a"></td>
        <td width="99%" bgcolor="#f1f5f9" style="padding-left: 15px;">
            <span style="font-size: 18px; font-weight: bold; color: #1e3a8a;">
                EXTRAIT DE NAISSANCE / <span style="font-size: 16px;">مستخرج الولادة</span>
            </span>
        </td>
    </tr>
</table>

<br><br><br>

<div style="font-size: 11px; font-weight: bold; color: #1e3a8a; letter-spacing: 0.5px;">
    I. INFORMATIONS D\'ÉTAT CIVIL (FRANÇAIS)
</div>
<hr style="color: #e2e8f0; height: 1px; background-color: #e2e8f0; border:none;">
<br>

<table cellpadding="4" cellspacing="0">
    <tr>
        <td width="25%" style="color: #64748b;">Nom :</td>
        <td width="75%" style="color: #0f172a; font-weight: bold;">'.$nom_fr.'</td>
	</tr>
	<tr>
		<td width="25%" style="color: #64748b;">Prénom :</td>
        <td width="75%" style="color: #0f172a; font-weight: bold;">'.$prenom_fr.'</td>
    </tr>
    <tr>
        <td style="color: #64748b;">Date de naissance :</td>
        <td style="color: #0f172a;">'.$date_nais.'</td>
    </tr>
    <tr>
        <td style="color: #64748b;">Heure de naissance :</td>
        <td style="color: #0f172a;">'.$heure_nais.'</td>
    </tr>
    <tr>
        <td style="color: #64748b;">Sexe du nouveau-né :</td>
        <td style="color: #0f172a;">'.$sexe.'</td>
    </tr>
</table>

<br><br>

<div style="font-size: 11px; font-weight: bold; color: #1e3a8a; text-align: right;" dir="rtl">
    II. الحالة المدنية للمولود (باللغة العربية)
</div>
<hr style="color: #e2e8f0; height: 1px; background-color: #e2e8f0; border:none;">
<br>

<table cellpadding="4" cellspacing="0" dir="rtl">
   
	<tr>
        <td width="25%" style="color: #64748b; text-align: right;">اللقب و :</td>
        <td width="75%" style="color: #0f172a; font-weight: bold; text-align: right;">'.$nom_ar.' '.$prenom_ar.'</td>
		
    </tr>
	<tr>
        
		<td width="25%" style="color: #64748b; text-align: right;">و الاسم :</td>
        <td width="75%" style="color: #0f172a; font-weight: bold; text-align: right;">'.$nom_ar.' '.$prenom_ar.'</td>
    </tr>
    <tr>
        <td style="color: #64748b; text-align: right;">تاريخ الولادة :</td>
        <td style="color: #0f172a; text-align: right;">'.$date_nais.'</td>
    </tr>
    <tr>
        <td style="color: #64748b; text-align: right;">ساعة الولادة :</td>
        <td style="color: #0f172a; text-align: right;">الساعة '.$heure_nais.'</td>
    </tr>
    <tr>
        <td style="color: #64748b; text-align: right;">الجنس :</td>
        <td style="color: #0f172a; text-align: right;">'.($sexe == "Masculin" || $sexe == "M" ? "ذكر" : "أنثى").'</td>
    </tr>
</table>

<br><br>

<div style="font-size: 11px; font-weight: bold; color: #1e3a8a;">
    III. FILIATION ET RÉSIDENCE DES PARENTS / النسبة و الإقامة
</div>
<hr style="color: #e2e8f0; height: 1px; background-color: #e2e8f0; border:none;">
<br>

<table cellpadding="5" cellspacing="0">
    <tr>
        <td width="18%" style="color: #64748b;">Nom du Père :</td>
        <td width="32%" style="color: #0f172a; font-weight: bold;">'.$pere.'</td>
        <td width="18%" style="color: #64748b; text-align: right;" dir="rtl">اسم الأب :</td>
        <td width="32%" style="color: #0f172a; font-weight: bold; text-align: right;" dir="rtl">'.$pere.'</td>
    </tr>
    <tr>
        <td style="color: #64748b;">Nom de la Mère :</td>
        <td style="color: #0f172a; font-weight: bold;">'.$mere.'</td>
        <td style="color: #64748b; text-align: right;" dir="rtl">اسم الأم :</td>
        <td style="color: #0f172a; font-weight: bold; text-align: right;" dir="rtl">'.$mere.'</td>
    </tr>
    <tr>
        <td style="color: #64748b;">Résidence (Wilaya) :</td>
        <td style="color: #0f172a;">'.$lieu_resid.'</td>
        <td style="color: #64748b; text-align: right;" dir="rtl">ولاية الإقامة :</td>
        <td style="color: #0f172a; text-align: right;" dir="rtl">'.$lieu_resid.'</td>
    </tr>
</table>

<br><br><br><br><br>

<table cellpadding="0" cellspacing="0">
    <tr>
        <td width="50%" style="vertical-align: middle;">
            <span style="font-size: 8px; color: #94a3b8; line-height: 1.4;">
                * Extrait extrait de l\'application de gestion des naissances.<br>
                Généré le '.date('d/m/Y à H:i').' par le personnel habilité.
            </span>
        </td>
        <td width="50%" style="text-align: right;">
            <div style="padding: 10px; border-top: 1px solid #cbd5e1;">
                <span style="font-size: 10px; color: #334155;">Fait à Annaba, le '.date('d/m/Y').'</span><br><br>
                <b style="color: #1e3a8a; font-size: 10px;">Le Responsable du Service État Civil</b><br>
                <span style="font-size: 8px; color: #94a3b8;">Cachet de l\'Établissement & Signature</span>
            </div>
        </td>
    </tr>
</table>
';

// 9. Écriture du HTML épuré dans le PDF
$pdf->writeHTML($html, true, false, true, false, '');

// 10. Sortie du fichier (Affichage immédiat sur le navigateur)
$pdf->Output('Extrait_Naissance_'.$nom_fr.'_'.$prenom_fr.'.pdf', 'I');
?>