<!DOCTYPE html>
<?php
include 'connection.php';
session_start();

if (!isset($_SESSION['log_u'])) {
    header("Location: login.php");
    exit();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$message = null;

if (isset($_POST['submit'])) {

    try {

        mysqli_begin_transaction($link);

        /* VALIDATION */

        $requiredFields = [
            'nom','prenom','date_naissance',
            'couches','hb_basse','hem','transfusion',
            'anti_d','vaccin','date_vaccin','remarque',
            'fievre','remarque_fievre'
        ];

        $error = false;

        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
                $error = true;
                break;
            }
        }

        if ($error) {
            throw new Exception(" Tous les champs sont obligatoires !");
        }

        /* PATIENT*/

        $nom = trim($_POST['nom']);
        $prenom = trim($_POST['prenom']);
        $date = $_POST['date_naissance'];

        $stmt = mysqli_prepare($link,
            "SELECT id FROM patient WHERE nom=? AND prenom=? AND date_naissance=?"
        );
        mysqli_stmt_bind_param($stmt, "sss", $nom, $prenom, $date);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $patient_id = $row['id'];
        } else {
            $stmtInsert = mysqli_prepare($link,
                "INSERT INTO patient(nom, prenom, date_naissance)
                 VALUES (?, ?, ?)"
            );
            mysqli_stmt_bind_param($stmtInsert, "sss", $nom, $prenom, $date);
            mysqli_stmt_execute($stmtInsert);

            $patient_id = mysqli_insert_id($link);
        }

        /* RAPPORT */

        $stmtRapport = mysqli_prepare($link,
            "SELECT id FROM rapport_grossesse 
             WHERE patient_id=? 
             ORDER BY id DESC LIMIT 1"
        );
        mysqli_stmt_bind_param($stmtRapport, "i", $patient_id);
        mysqli_stmt_execute($stmtRapport);
        $resRapport = mysqli_stmt_get_result($stmtRapport);

        if ($rowRapport = mysqli_fetch_assoc($resRapport)) {
            $rapport_id = $rowRapport['id'];
        } else {
            throw new Exception(" Remplir la page 1 d'abord !");
        }

        /*SUITE DE COUCHES*/

        $stmt2 = mysqli_prepare($link,
            "INSERT INTO suite_couches(
                rapport_id, couches, hb_basse, hemorragie,
                transfusion, anti_d, vaccin, date_vaccin, remarque
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt2,
            "issssssss",
            $rapport_id,
            $_POST['couches'],
            $_POST['hb_basse'],
            $_POST['hem'],
            $_POST['transfusion'],
            $_POST['anti_d'],
            $_POST['vaccin'],
            $_POST['date_vaccin'],
            $_POST['remarque']
        );

        mysqli_stmt_execute($stmt2);

        /* FIEVRE*/

        $contraception = isset($_POST['contraception']) ? 1 : 0;

        $stmt3 = mysqli_prepare($link,
            "INSERT INTO fievre(
                rapport_id, type_fievre, remarque, contraception
            )
            VALUES (?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt3,
            "issi",
            $rapport_id,
            $_POST['fievre'],
            $_POST['remarque_fievre'],
            $contraception
        );

        mysqli_stmt_execute($stmt3);

        mysqli_commit($link);

        $message = "<div style='background:#d4edda;color:#155724;padding:10px;border-radius:5px'>
        ✔ Enregistrement réussi
        </div>";

    } catch (Exception $e) {

        mysqli_rollback($link);

        $message = "<div style='background:#f8d7da;color:#721c24;padding:10px;border-radius:5px'>
        ❌ ".$e->getMessage()."
        </div>";
    }
}
?>
<?php if (isset($_POST['submit']) && $message !== null): ?>
    <?php echo $message; ?>
<?php endif; ?>

<style>
.custom-card{
    border:1px solid #ccc;
    border-radius:10px;
    padding:20px;
    margin-bottom:25px;
    background:#f9f9f9;
    box-shadow:0 6px 18px rgba(0,0,0,0.1);
    position:relative;
}

.custom-card-header{
    background:#0f4c81;
    color:white;
    padding:12px 15px;
    font-weight:700;
    font-size:1.2rem;
    margin:-20px -20px 20px -20px;
    border-radius:10px 10px 0 0;
}

.custom-label-box{
    background:#e9ecef;
    color:black;
    padding:8px 12px;
    font-weight:600;
    margin-bottom:6px;
    border-radius:6px;
}

.page-evaluation-mere .custom-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    grid-template-areas:
        "patient suite"
        "fievre suite";
    gap:20px;
}

.page-evaluation-mere .custom-grid > div:nth-child(1){
    grid-area:patient;
}

.page-evaluation-mere .custom-grid > div:nth-child(2){
    grid-area:suite;
}

.page-evaluation-mere .custom-grid > div:nth-child(3){
    grid-area:fievre;
}

input,select{
    width:100%;
    padding:8px;
    border:1px solid #ccc;
    border-radius:6px;
}

.btn-container{
    display:flex;
    justify-content:flex-end;
    margin-top:15px;
}
</style>


<div class="main-container page-evaluation-mere">
<div class="pd-ltr-20">
<div style="display:flex; justify-content:flex-end; margin-bottom:15px;">
    <a href="logout.php"
       style="background:#dc3545;color:white;
       padding:8px 14px;border-radius:6px;
       text-decoration:none;font-weight:bold;">
        Déconnexion
    </a>
</div>
<form method="POST">

<div class="custom-grid">

<!--  PATIENT -->
<div class="custom-card">

<div class="custom-card-header">
Patient
</div>

<div class="row">

<div class="col-md-6 mb-3">
<div class="custom-label-box">Nom</div>
<input type="text" name="nom" >
</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Prénom</div>
<input type="text" name="prenom" >
</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Date de naissance</div>
<input type="date" name="date_naissance" >
</div>


</div>
</div>


<!-- SUITE DE COUCHES  -->
<div class="custom-card">

<div class="custom-card-header">
Suite de couches
</div>

<div class="row">

<div class="col-md-6 mb-3">
<div class="custom-label-box">Couches</div>

<label><input type="radio" name="couches" value="Normale"> Normale</label><br>
<label><input type="radio" name="couches" value="Anormale"> Anormale</label>

</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Hb la plus basse</div>
<input type="text" name="hb_basse">
</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Hémorragie puerpérale</div>

<label><input type="radio" name="hem" value="Immediate"> Immediate</label><br>
<label><input type="radio" name="hem" value="Tardive"> Tardive</label>

</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Transfusion</div>
<input type="text" name="transfusion">
</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Immunoglobuline Anti-D</div>
<input type="date" name="anti_d">
</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Vaccin rubéole</div>

<label><input type="radio" name="vaccin" value="MMR"> MMR</label><br>
<label><input type="radio" name="vaccin" value="Monovalent"> Monovalent</label><br>
<label><input type="radio" name="vaccin" value="Autre"> Autre</label>

</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Vaccin donné le</div>
<input type="date" name="date_vaccin">
</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Remarque</div>
<input type="text" name="remarque">
</div>

</div>
</div>


<!-- FIEVRE  -->
<div class="custom-card">

<div class="custom-card-header">
Fièvre
</div>

<div class="row">

<div class="col-md-6 mb-3">
<div class="custom-label-box">Fièvre</div>

<select name="fievre">
<option value="Oui">Oui</option>
<option value="Non">Non</option>
<option value="Thrombo-Embolie">Thrombo-Embolie</option>
<option value="Endometrie">Endometrie</option>
<option value="Infection Urinaire">Infection Urinaire</option>
<option value="Infection Respiratoire">Infection Respiratoire</option>
<option value="Autre Infection Pelvienne">Autre Infection Pelvienne</option>
</select>

</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Remarque</div>
<input type="text" name="remarque_fievre">
</div>

<div class="col-md-12 mb-3">
<div class="custom-label-box">Médication au départ</div>

<label>
<input type="checkbox" name="contraception" value="1">
Contraception
</label>

</div>

</div>
</div>

</div>

<div class="btn-container">
<button type="submit" name="submit" class="btn-save">
Enregistrer
</button>
</div>

</form>

</div>
</div>