<?php include 'login_verify.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>First Cry - Hospital Management</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{

    min-height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    background:
    linear-gradient(
        135deg,
        #f8fafc,
        #dbeafe,
        #eff6ff
    );

    overflow:hidden;
}

/* Decorative circles */

body::before{

    content:'';

    position:absolute;

    width:400px;
    height:400px;

    border-radius:50%;

    background:rgba(59,130,246,.10);

    top:-150px;
    left:-150px;

    filter:blur(40px);
}

body::after{

    content:'';

    position:absolute;

    width:350px;
    height:350px;

    border-radius:50%;

    background:rgba(217,4,41,.08);

    bottom:-120px;
    right:-120px;

    filter:blur(40px);
}

/* Login Card */

.login-card{

    width:340px;

    background:white;

    border-radius:24px;

    padding:30px;

    box-shadow:
    0 15px 40px rgba(0,0,0,.08);

    position:relative;
    z-index:10;
}

/* Logo */

.logo-area{

    text-align:center;

    margin-bottom:15px;
}

.logo-area img{

    width:90px;

    height:90px;

    object-fit:contain;
}

/* Title */

.login-title{

    text-align:center;

    color:#111827;

    font-size:28px;

    font-weight:700;

    margin-bottom:5px;
}

.subtitle{

    text-align:center;

    color:#6b7280;

    font-size:13px;

    margin-bottom:25px;
}

/* Error */

.alert-error{

    background:#fee2e2;

    color:#b91c1c;

    padding:10px;

    border-radius:10px;

    text-align:center;

    margin-bottom:15px;
}

/* Fields */

.field{

    margin-bottom:15px;
}

.field label{

    display:block;

    margin-bottom:6px;

    color:#374151;

    font-size:14px;

    font-weight:600;
}

.field input,
.field select{

    width:100%;

    height:48px;

    border:1px solid #e5e7eb;

    border-radius:12px;

    padding:0 15px;

    font-size:14px;

    transition:.3s;
}

.field input:focus,
.field select:focus{

    outline:none;

    border-color:#2563eb;

    box-shadow:
    0 0 0 3px rgba(37,99,235,.10);
}

/* Button */

.btn-login{

    width:100%;

    height:50px;

    border:none;

    border-radius:12px;

    background:
    linear-gradient(
        135deg,
        #c54242,
        #ce4b4b
    );

    color:white;

    font-size:15px;

    font-weight:600;

    cursor:pointer;

    transition:.3s;
}

.btn-login:hover{

    transform:translateY(-2px);

    box-shadow:
    0 8px 20px rgba(37,99,235,.25);
}

/* Mobile */

@media(max-width:500px){

    .login-card{

        width:92%;
    }
}

</style>

</head>

<body>

<div class="login-card">

    <div class="logo-area">

        <img src="logo.png" alt="First Cry Logo">

    </div>

    <h1 class="login-title">
        First Cry
    </h1>

    <p class="subtitle">
        Hospital Management System
    </p>

    <?php if(isset($_GET['error'])): ?>

    <div class="alert-error">
        Nom d'utilisateur ou mot de passe incorrect !
    </div>

    <?php endif; ?>

    <form method="POST">

        <div class="field">

            <label>Nom d'utilisateur</label>

            <input
                type="text"
                name="username"
                placeholder="Votre nom d'utilisateur"
                required>

        </div>

        <div class="field">

            <label>Mot de passe</label>

            <input
                type="password"
                name="password"
                placeholder="••••••••"
                required>

        </div>

        <div class="field">

            <label>Rôle</label>

            <select name="role">

                
                <option value="Agent">Agent</option>
                <option value="Infermier">Infirmier</option>
                <option value="Medecin">Médecin</option>

            </select>

        </div>

        <button
            type="submit"
            name="submit"
            class="btn-login">

            Se connecter

        </button>

    </form>

</div>

</body>
</html>