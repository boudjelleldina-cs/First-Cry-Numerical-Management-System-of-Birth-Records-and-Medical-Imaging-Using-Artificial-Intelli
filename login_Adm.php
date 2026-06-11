<?php include 'login_verify.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Connexion</title>

<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #ffffff;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.custom-card {
    width: 400px;
    border-radius: 10px;
    background: #f9f9f9;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    border: 1px solid #ddd;
}

.custom-card-header {
    background: #0f4c81;
    color: white;
    padding: 15px;
    font-weight: bold;
    text-align: center;
    font-size: 18px;
    border-radius: 10px 10px 0 0;
}

.custom-card-body {
    padding: 20px;
}

.custom-label-box {
    display: block;
    background: #e9ecef;
    padding: 8px;
    margin-top: 10px;
    margin-bottom: 5px;
    border-radius: 6px;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-bottom: 10px;
}

button {
    width: 100%;
    padding: 10px;
    background: #0f4c81;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background: #0b3a63;
}

.error {
    color: red;
    text-align: center;
    margin-bottom: 10px;
}
</style>
</head>

<body>

<div class="custom-card">

    <div class="custom-card-header">
        Authentification Admin
    </div>

    <div class="custom-card-body">

        <!-- ✅ ERROR MESSAGE -->
        <?php
        if (isset($_GET['error'])) {
            echo '<div class="error">Nom d\'utilisateur ou mot de passe incorrect !</div>';
        }
        ?>

        <form method="POST">

            <label class="custom-label-box">Nom d'utilisateur</label>
            <input type="text" name="username" required>

            <label class="custom-label-box">Mot de passe</label>
            <input type="password" name="password" required>
			
			<label class="custom-label-box">Role</label>
			<select class="custom-select2 form-control" id ="role" name="role" style="width: 100%; height: 38px;">
                <option value="Admin" >Admin</option>
				
            </select>

            <button type="submit" name="submit">Se connecter</button>

        </form>

    </div>
</div>

<!-- js -->
	


</body>
</html>