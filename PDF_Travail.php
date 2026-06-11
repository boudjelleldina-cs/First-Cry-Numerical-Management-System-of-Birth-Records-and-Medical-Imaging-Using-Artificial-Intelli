<?php
// 1. Connexion à la base de données et vérification de la session
include 'connection.php';
session_start();

if (!isset($_SESSION['log_u'])) {
    header('location:login.php');
    die;
}

// 2. Vérification de la présence de l'ID du patient dans l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("<p style='color:red; font-family:sans-serif;'>Erreur : L'identifiant de la patiente est manquant.</p>");
}

$id_patient = mysqli_real_escape_string($link, $_GET['id']);

// 3. Récupération des données (Jointure triple : Patient -> Grossesse -> Travail)
$query = "SELECT p.*, g.*, t.* FROM patient p
          LEFT JOIN grossesse g ON p.id_patient = g.rapport_id
          LEFT JOIN travail t ON p.id_patient = t.rapport_id
          WHERE p.id_patient = '$id_patient'
          ORDER BY g.id_grossesse DESC, t.id_travail DESC LIMIT 1"; 

$result = mysqli_query($link, $query) or die(mysqli_error($link));

if (mysqli_num_rows($result) == 0) {
    die("<p style='color:red; font-family:sans-serif;'>Aucune donnée médicale trouvée pour cette patiente.</p>");
}

$data = mysqli_fetch_assoc($result);

// 4. Calcul dynamique de l'âge de la patiente
$age = "Non renseigné";
if (!empty($data['date_nais_p'])) {
    $dateNaissance = new DateTime($data['date_nais_p']);
    $aujourdhui = new DateTime();
    $diff = $aujourdhui->diff($dateNaissance);
    $age = $diff->y . " ans";
}

// 5. Inclusion de la bibliothèque TCPDF
require_once('/tcpdf/tcpdf.php');

// 6. Personnalisation de l'En-tête et du Pied de page du PDF
class DossierPDF extends TCPDF {
    // En-tête de page modifié
    public function Header() {
        // Logo de l'établissement (Optionnel - décommentez si vous avez un logo dispo)
        // $this->Image('vendors/images/logo.png', 15, 8, 20, '', 'PNG');
        
        // Ligne 1 : Nom de l'établissement hospitalier
        $this->SetFont('helvetica', 'B', 11);
        $this->SetTextColor(71, 85, 105); // Couleur gris ardoise atténué (#475569)
        $this->Cell(0, 5, 'ÉTABLISSEMENT HOSPITALIER SPÉCIALISÉ (EHS) EL BOUNI', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
		$this->Ln();
		$this->Ln();
        // Ligne 2 : Titre du dossier médical
        $this->SetFont('helvetica', 'B', 14);
        $this->SetTextColor(15, 23, 42); // Couleur ardoise foncée (#0f172a)
        $this->Cell(0, 8, 'DOSSIER MÉDICAL : GROSSESSE & TRAVAIL', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        
        // Ligne graphique de séparation sous l'en-tête (redescendue à 24 pour laisser de l'espace au texte)
        $this->SetDrawColor(163, 157, 135); // Utilisation de votre couleur thème (#A39D87) pour la ligne
        $this->SetLineWidth(0.5);
        $this->Line(15, 24, 195, 24);
    }

    // Pied de page
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->SetTextColor(120, 120, 120);
        // Pagination et date de génération
        $this->Cell(0, 10, 'EHS EL BOUNI | Imprimé le ' . date('d/m/Y à H:i') . ' | Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C');
    }
}

// 7. Initialisation et configuration du document PDF
$pdf = new DossierPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Métadonnées du fichier
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('EHS El Bouni');
$pdf->SetTitle('Suivi Obstétrique - ' . $data['nom_p'] . ' ' . $data['prenom_p']);

// Définition des marges (La marge du haut passe à 30 pour éviter la superposition avec l'en-tête double ligne)
$pdf->SetMargins(15, 30, 15);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(15);

// Saut de page automatique
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Ajout de la première page
$pdf->AddPage();

// 8. Structure du document en HTML / CSS
$html = '
<style>
    .section-title {
        background-color: #A39D87;
        color: #ffffff;
        font-family: helvetica;
        font-size: 11pt;
        font-weight: bold;
        padding: 6px;
    }
    table {
        font-family: helvetica;
        font-size: 10pt;
        width: 100%;
    }
    td {
        padding: 5px;
    }
    .label {
        font-weight: bold;
        background-color: #f8fafc;
        color: #334155;
        width: 30%;
    }
    .value {
        width: 70%;
    }
    .grid-table {
        text-align: center;
    }
    .grid-table th {
        background-color: #f1f5f9;
        font-weight: bold;
        color: #0f172a;
    }
</style>

<br><br>
<!-- SECTION 1 : IDENTIFICATION -->
<table cellpadding="4">
    <tr><td class="section-title">1. Identification de la Patiente</td></tr>
</table>
<table border="0.5" cellpadding="5" cellspacing="0" style="border-color: #cbd5e1;">
    <tr>
        <td class="label">ID Patiente</td>
        <td class="value">' . htmlspecialchars($data['id_patient']) . '</td>
    </tr>
    <tr>
        <td class="label">Nom & Prénom</td>
        <td class="value">' . htmlspecialchars($data['nom_p']) . ' ' . htmlspecialchars($data['prenom_p']) . '</td>
    </tr>
    <tr>
        <td class="label">Date de Naissance</td>
        <td class="value">' . (!empty($data['date_nais_p']) ? date('d/m/Y', strtotime($data['date_nais_p'])) : 'Non renseignée') . ' (' . $age . ')</td>
    </tr>
</table>

<br><br>
<!-- SECTION 2 : HISTORIQUE DE GROSSESSE -->
<table cellpadding="4">
    <tr><td class="section-title">2. Historique de la Grossesse</td></tr>
</table>
<table border="0.5" cellpadding="5" cellspacing="0" style="border-color: #cbd5e1;">
    <tr>
        <td class="label">Semaine de gestation</td>
        <td class="value">' . htmlspecialchars($data['semaine_gestation']) . ' SA</td>
    </tr>
    <tr>
        <td class="label">Groupe Rhésus (RH)</td>
        <td class="value"><b>' . htmlspecialchars($data['groupe_rh']) . '</b></td>
    </tr>
    <tr>
        <td class="label">Anticorps</td>
        <td class="value">' . htmlspecialchars($data['anticorps']) . '</td>
    </tr>
    <tr>
        <td class="label">Particularité / Risques</td>
        <td class="value">' . htmlspecialchars($data['particularite']) . '</td>
    </tr>
</table>

<br><br>
<span style="font-family: helvetica; font-weight: bold; font-size: 10pt; color:#334155;">Profil Obstétrical (G / T / P / A / V / SGB) :</span><br><br>
<table class="grid-table" border="0.5" cellpadding="5" cellspacing="0" style="border-color: #cbd5e1;">
    <thead>
        <tr>
            <th><b>G</b></th>
            <th><b>T</b></th>
            <th><b>P</b></th>
            <th><b>A</b></th>
            <th><b>V</b></th>
            <th><b>SGB</b></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>' . htmlspecialchars($data['g']) . '</td>
            <td>' . htmlspecialchars($data['t']) . '</td>
            <td>' . htmlspecialchars($data['p']) . '</td>
            <td>' . htmlspecialchars($data['a']) . '</td>
            <td>' . htmlspecialchars($data['v']) . '</td>
            <td>' . htmlspecialchars($data['sgb']) . '</td>
        </tr>
    </tbody>
</table>

<br><br>
<!-- SECTION 3 : TRAVAIL -->
<table cellpadding="4">
    <tr><td class="section-title">3. Déroulement du Travail (1)</td></tr>
</table>
<table border="0.5" cellpadding="5" cellspacing="0" style="border-color: #cbd5e1;">
    <tr>
        <td class="label">Type de travail</td>
        <td class="value">' . htmlspecialchars($data['type_travail']) . '</td>
    </tr>
    <tr>
        <td class="label">Début du travail</td>
        <td class="value">' . (!empty($data['debut_travail']) ? date('d/m/Y à H:i', strtotime($data['debut_travail'])) : 'Non renseigné') . '</td>
    </tr>
    <tr>
        <td class="label">Membranes rompues</td>
        <td class="value">' . (!empty($data['membranes']) ? date('d/m/Y à H:i', strtotime($data['membranes'])) : 'Non renseigné') . '</td>
    </tr>
</table>

<br><br>
<!-- SECTION 4 : PROTOCOLE MÉDICAL -->
<table cellpadding="4">
    <tr><td class="section-title">4. Analgésie, Antibiotiques & Anesthésie (2)</td></tr>
</table>
<table border="0.5" cellpadding="5" cellspacing="0" style="border-color: #cbd5e1;">
    <tr>
        <td class="label">Analgésie</td>
        <td class="value">' . htmlspecialchars($data['analgesie']) . ' ' . (!empty($data['heure_analgesie']) ? '(à ' . htmlspecialchars($data['heure_analgesie']) . ')' : '') . '</td>
    </tr>
    <tr>
        <td class="label">Antibiotique</td>
        <td class="value">' . htmlspecialchars($data['antibiotique']) . ' ' . (!empty($data['heure_antibio']) ? '(à ' . htmlspecialchars($data['heure_antibio']) . ')' : '') . '</td>
    </tr>
    <tr>
        <td class="label">Anesthésie finale</td>
        <td class="value"><b>' . htmlspecialchars($data['anesthesie']) . '</b></td>
    </tr>
</table>
';

// 9. Écriture du bloc HTML dans le moteur TCPDF
$pdf->writeHTML($html, true, false, true, false, '');

// 10. Sortie et affichage du PDF
$pdf->Output('Dossier_Obstetrique_' . $id_patient . '.pdf', 'I');
?>