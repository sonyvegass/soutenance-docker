<?php
session_start();

function verify_session() {
    if (!isset($_SESSION['id_utilisateur']) || !isset($_SESSION['token'])) {
        return false;
    }

    $id_utilisateur = $_SESSION['id_utilisateur'];
    $token = $_SESSION['token'];

    $servername = "db";
    $username = "root";
    $password = "root";
    $dbname = "docker";

    // Créer la connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }

    // Préparer et exécuter la requête SQL
    $sql = "SELECT token_expiration FROM utilisateur WHERE id_utilisateur = ? AND token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $id_utilisateur, $token);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($token_expiration);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        // Vérifier si le token a expiré
        if (strtotime($token_expiration) > time()) {
            return true;
        } else {
            // Token expiré, déconnecter l'utilisateur
            session_destroy();
            return false;
        }
    } else {
        // Token non valide, déconnecter l'utilisateur
        session_destroy();
        return false;
    }

    $stmt->close();
    $conn->close();
}

$response = [
    'session_valid' => verify_session()
];

header('Content-Type: application/json');
echo json_encode($response);
?>
