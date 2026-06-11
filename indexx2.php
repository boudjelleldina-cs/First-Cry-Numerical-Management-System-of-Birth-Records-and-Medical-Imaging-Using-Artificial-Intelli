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
            'nom','prenom','date_naissance','nom_agent','type_travail',
            'indication','semaine_gestation','groupe_rh','g','t','p','a','v','sgb',
            'anticorps','particularite','debut_travail','membranes',
            'analgesie','heure_analgesie','corticosteroides','heure_cortico',
            'antibiotique','heure_antibio','anesthesie'
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

        /* PATIENT */

        $nom = trim($_POST['nom']);
        $prenom = trim($_POST['prenom']);
        $dateNaissance = $_POST['date_naissance'];

        $stmt = mysqli_prepare($link,
            "INSERT INTO patient(nom, prenom, date_naissance)
             VALUES (?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "sss", $nom, $prenom, $dateNaissance);
        mysqli_stmt_execute($stmt);

        $patient_id = mysqli_insert_id($link);

        /*  AGENT */

        $nomAgent = trim($_POST['nom_agent']);

        $stmtAgent = mysqli_prepare($link,
            "INSERT INTO agent(nom_agent)
             VALUES (?)"
        );
        mysqli_stmt_bind_param($stmtAgent, "s", $nomAgent);
        mysqli_stmt_execute($stmtAgent);

        $agent_id = mysqli_insert_id($link);

        /*RAPPORT  */

        $stmtRapport = mysqli_prepare($link,
            "INSERT INTO rapport_grossesse(patient_id, agent_id)
             VALUES (?, ?)"
        );
        mysqli_stmt_bind_param($stmtRapport, "ii", $patient_id, $agent_id);
        mysqli_stmt_execute($stmtRapport);

        $rapport_id = mysqli_insert_id($link);

        /* GROSSESSE */

        $stmtGrossesse = mysqli_prepare($link,
            "INSERT INTO grossesse(
                rapport_id, semaine_gestation, groupe_rh,
                g, t, p, a, v, sgb,
                anticorps, particularite
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmtGrossesse,
            "iisiiiiiiss",
            $rapport_id,
            $_POST['semaine_gestation'],
            $_POST['groupe_rh'],
            $_POST['g'],
            $_POST['t'],
            $_POST['p'],
            $_POST['a'],
            $_POST['v'],
            $_POST['sgb'],
            $_POST['anticorps'],
            $_POST['particularite']
        );

        mysqli_stmt_execute($stmtGrossesse);

        /*TRAVAIL */

        $debutTravail = str_replace("T", " ", $_POST['debut_travail']) . ":00";
        $membranes = str_replace("T", " ", $_POST['membranes']) . ":00";

        $stmtTravail = mysqli_prepare($link,
            "INSERT INTO travail(
                rapport_id, type_travail, indication,
                debut_travail, membranes,
                analgesie, heure_analgesie,
                corticosteroides, heure_cortico,
                antibiotique, heure_antibio,
                anesthesie
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmtTravail,
            "isssssssssss",
            $rapport_id,
            $_POST['type_travail'],
            $_POST['indication'],
            $debutTravail,
            $membranes,
            $_POST['analgesie'],
            $_POST['heure_analgesie'],
            $_POST['corticosteroides'],
            $_POST['heure_cortico'],
            $_POST['antibiotique'],
            $_POST['heure_antibio'],
            $_POST['anesthesie']
        );

        mysqli_stmt_execute($stmtTravail);

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
.custom-card {
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 25px;
    background: #f9f9f9;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    position: relative;
}

.custom-card-header {
    background: #0f4c81;
    color: white;
    padding: 12px 15px;
    font-weight: 700;
    font-size: 1.2rem;
    margin: -20px -20px 20px -20px;
    border-radius: 10px 10px 0 0;
}

.custom-label-box {
    background: #e9ecef;
    color: black;
    padding: 8px 12px;
    font-weight: 600;
    margin-bottom: 6px;
    border-radius: 6px;
}

.page-grossesse-travail .custom-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.page-grossesse-travail .custom-grid .custom-card:nth-child(1) {
    grid-column: 1;
    grid-row: 1;
}

.page-grossesse-travail .custom-grid .custom-card:nth-child(2) {
    grid-column: 1;
    grid-row: 2;
}

.page-grossesse-travail .custom-grid .custom-card:nth-child(3) {
    grid-column: 2;
    grid-row: 1 / span 2;
}

.btn-container {
    display: flex;
    justify-content: flex-end;
    margin-top: 10px;
}

input, select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
}
.btn-container{
    display:flex;
    justify-content:flex-end;
    margin-top:15px;
}
</style>

<div class="main-container page-grossesse-travail">
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
<div class="custom-card-header">Patient</div>

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

<!--  GROSSESSE  -->
<div class="custom-card">
<div class="custom-card-header">Historique de Grossesse</div>

<div class="row">

<div class="col-md-6 mb-3">
<div class="custom-label-box">Semaine de gestation</div>
<input type="number" name="semaine_gestation">
</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Groupe RH</div>
<select name="groupe_rh">
<option>A+</option><option>A-</option>
<option>B+</option><option>B-</option>
<option>O+</option><option>O-</option>
<option>AB+</option><option>AB-</option>
</select>
</div>

</div>

<div class="table-responsive mb-3">
<table class="table table-bordered">
<thead>
<tr>
<th>G</th><th>T</th><th>P</th><th>A</th><th>V</th><th>SGB</th>
</tr>
</thead>
<tbody>
<tr>
<td><input name="g"></td>
<td><input name="t"></td>
<td><input name="p"></td>
<td><input name="a"></td>
<td><input name="v"></td>
<td><input name="sgb"></td>
</tr>
</tbody>
</table>
</div>

<div class="row">
<div class="col-md-6 mb-3">
<div class="custom-label-box">Anticorps</div>
<input type="text" name="anticorps">
</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Particularité</div>
<input type="text" name="particularite">
</div>
</div>

</div>

<!--  TRAVAIL  -->
<div class="custom-card">
<div class="custom-card-header">Travail</div>

<div class="row">

<div class="col-md-6 mb-3">
<div class="custom-label-box">Type de travail</div>
<label><input type="radio" name="type_travail" value="Spontané"> Spontané</label><br>
<label><input type="radio" name="type_travail" value="Stimulation"> Stimulation</label><br>
<label><input type="radio" name="type_travail" value="Déclenché"> Déclenché</label><br>
<label><input type="radio" name="type_travail" value="Maturation"> Maturation</label>
</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Indication</div>
<label><input type="radio" name="indication" value="Sonde"> Sonde</label><br>
<label><input type="radio" name="indication" value="Ocytocine"> Ocytocine</label><br>
<label><input type="radio" name="indication" value="PGE2"> PGE2</label><br>
<label><input type="radio" name="indication" value="Amniotomie"> Amniotomie</label>
</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Début travail</div>
<input type="datetime-local" name="debut_travail">
</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Membranes rompues</div>
<input type="datetime-local" name="membranes">
</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Analgésie</div>
<input type="text" name="analgesie">
</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Heure analgésie</div>
<input type="time" name="heure_analgesie">
</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Corticostéroïdes</div>
<input type="text" name="corticosteroides">
</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Heure cortico</div>
<input type="time" name="heure_cortico">
</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Antibiotique</div>
<input type="text" name="antibiotique">
</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Heure antibiotique</div>
<input type="time" name="heure_antibio">
</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Anesthésie</div>
<label><input type="radio" name="anesthesie" value="Aucune"> Aucune</label><br>
<label><input type="radio" name="anesthesie" value="Générale"> Générale</label><br>
<label><input type="radio" name="anesthesie" value="Péridurale"> Péridurale</label><br>
<label><input type="radio" name="anesthesie" value="Locale"> Locale</label>
</div>

<div class="col-md-6 mb-3">
<div class="custom-label-box">Nom agent</div>
<input type="text" name="nom_agent">
</div>

</div>
</div>

</div>

<div class="btn-container">
<button type="submit" name="submit" class="btn-save">Enregistrer</button>
</div>

</form>