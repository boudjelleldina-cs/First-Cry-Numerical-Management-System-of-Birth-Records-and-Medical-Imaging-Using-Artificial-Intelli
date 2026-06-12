<?php
ini_set('memory_limit', '256M'); // Alloue 256 Mo au script au lieu de la limite standard
// 1. Activer la mise en tampon pour capturer et effacer tout texte parasite
ob_start();
session_start();
// Définir le type de contenu de la réponse (JSON)
header('Content-Type: application/json; charset=utf-8');
// Si l'utilisateur n'est pas connecté, renvoyer une erreur JSON propre (pas une redirection HTML)
if (!isset($_SESSION['log_u'])) {
    ob_end_clean();
    http_response_code(401); // Non autorisé
    echo json_encode(['error' => 'Session expirée. Veuillez vous reconnecter.']);
    exit;
}

// Inclusion du fichier de connexion (vérifiez que la variable de connexion s'appelle bien $link)


// 2. Vérifier si l'ID est bien envoyé via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['id'])) {
    ob_end_clean(); 
    http_response_code(400);
    echo json_encode(['error' => 'ID agent manquant ou requête invalide.']);
    exit;
}


include 'connection2.php';
// Ajoutez cette ligne immédiatement après la connexion :
mysqli_set_charset($link, "utf8mb4");

// 4. Sécuriser l'identifiant reçu
$userId = $_POST['id'];

// 5. Exécution de la requête SQL (Correction de l'orthographe : id_agent)
$result = mysqli_query($link, "SELECT * FROM agent WHERE id_agent=$userId LIMIT 1" );
//$result = mysqli_query($link, $sql);

//if ($result) 
{
    // 6. Utilisation de mysqli_num_rows pour vérifier si l'agent existe
    if (mysqli_num_rows($result) == 1) {
        // Récupération des données sous forme de tableau associatif
        $user = mysqli_fetch_assoc($result);
        
        // Libération immédiate de la mémoire de cette requête
        mysqli_free_result($result);
        
		$user['photo'] = base64_encode($user['photo']);
		
        // Nettoyage final du tampon de sortie pour garantir un JSON 100% propre
        ob_end_clean();
        
		
        // Envoi des données de l'utilisateur
        echo json_encode($user);
        exit; 
    } else {
        mysqli_free_result($result);
        ob_end_clean();
        http_response_code(404);
        echo json_encode(['error' => 'Agent introuvable.']);
        exit;
    }
} //else 
{
    // Si mysqli_query a échoué, pas besoin de libérer $result
    $errorMsg = mysqli_error($link); // Optionnel : pour le débug
    ob_end_clean();
    http_response_code(500);
    echo json_encode(['error' => 'Erreur lors de l\'exécution de la requête SQL : ' . $errorMsg]);
    exit;
}

// Fermeture de la connexion
//mysqli_close($link);