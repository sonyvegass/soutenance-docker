<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données envoyées en JSON
    $input = json_decode(file_get_contents('php://input'), true);

    $email = $input['email'];
    $mot_de_passe = $input['mot_de_passe'];
    $type_utilisateur = $input['type_utilisateur'];

    // Préparer et exécuter la requête SQL
    $sql = "SELECT id_utilisateur, mot_de_passe FROM utilisateur WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (!password_verify($mot_de_passe, $user['mot_de_passe'])) {
            echo json_encode(['success' => false, 'message' => 'Mot de passe incorrect']);
        } else {
            $_SESSION['id_utilisateur'] = $user['id_utilisateur'];
            $_SESSION['token'] = bin2hex(random_bytes(16));
            $expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));

            $sql = "UPDATE utilisateur SET token = ?, token_expiration = ? WHERE id_utilisateur = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$_SESSION['token'], $expiration, $user['id_utilisateur']]);

            // Rediriger tous les utilisateurs vers ../accueil/index.php
            $redirect_url = '../accueil/index.php';

            // Retourner une réponse JSON
            echo json_encode(['success' => true, 'redirect_url' => $redirect_url]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Vous n\'êtes pas encore inscrit']);
    }
}
?>
