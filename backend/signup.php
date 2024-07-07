<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/db.php'; // Assurez-vous d'inclure correctement votre fichier de configuration PDO

function signup($data) {
    global $pdo;

    try {
        // Récupération des données du formulaire
        $genre = $data['genre'] === 'homme' ? 0 : 1;
        $nom = $data['nom'];
        $prenom = $data['prenom'];
        $email = $data['email'];
        $mot_de_passe = $data['mot_de_passe'];
        $date_naissance = $data['date_naissance'];
        $numero_telephone = isset($data['numero_telephone']) ? $data['numero_telephone'] : null;
        $indicatif_telephonique = isset($data['indicatif_telephonique']) ? $data['indicatif_telephonique'] : null;
        $newsletter = isset($data['newsletter']) ? 1 : 0;
        $is_prestataire = isset($data['prestataire']) ? 1 : 0;
        $is_bailleur = isset($data['bailleur']) ? 1 : 0;
        $is_voyageur = 1; // Always set voyageur to 1 during signup
    
        // Validation des champs
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["error" => "L'email n'est pas valide."]);
            exit();
        }
    
        if (!preg_match("/^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*\d)[A-Za-z\d!@#$%^&*]{8,}$/", $mot_de_passe)) {
            echo json_encode(["error" => "Le mot de passe doit contenir au moins 8 caractères, une majuscule, un caractère spécial et un chiffre."]);
            exit();
        }
    
        if (!preg_match("/^[A-Za-zÀ-ÿ]+$/", $nom) || !preg_match("/^[A-Za-zÀ-ÿ]+$/", $prenom)) {
            echo json_encode(["error" => "Le nom et le prénom doivent contenir uniquement des lettres."]);
            exit();
        }
    
        // Vérification si l'email existe déjà
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM utilisateur WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) {
            echo json_encode(["error" => "Email déjà existant."]);
            exit();
        }
    
        // Hashage du mot de passe
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_BCRYPT);
    
        // Date d'inscription
        $date_inscription = date('Y-m-d H:i:s');
    
        // Préparation de la requête SQL avec PDO
        $stmt = $pdo->prepare("INSERT INTO utilisateur (genre, nom, prenom, email, mot_de_passe, date_inscription, date_naissance, numero_telephone, indicatif_telephonique, newsletter, prestataire, bailleur, voyageur)
                               VALUES (:genre, :nom, :prenom, :email, :mot_de_passe, :date_inscription, :date_naissance, :numero_telephone, :indicatif_telephonique, :newsletter, :is_prestataire, :is_bailleur, :is_voyageur)");
    
        // Liaison des paramètres
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mot_de_passe', $mot_de_passe_hash); // Utilisation du mot de passe hashé
        $stmt->bindParam(':date_inscription', $date_inscription);
        $stmt->bindParam(':date_naissance', $date_naissance);
        $stmt->bindParam(':numero_telephone', $numero_telephone, PDO::PARAM_STR);
        $stmt->bindParam(':indicatif_telephonique', $indicatif_telephonique, PDO::PARAM_STR);
        $stmt->bindParam(':newsletter', $newsletter, PDO::PARAM_INT);
        $stmt->bindParam(':is_prestataire', $is_prestataire, PDO::PARAM_INT);
        $stmt->bindParam(':is_bailleur', $is_bailleur, PDO::PARAM_INT);
        $stmt->bindParam(':is_voyageur', $is_voyageur, PDO::PARAM_INT); // Bind voyageur as integer
    
        // Exécution de la requête
        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
            exit;
        } else {
            echo json_encode(["error" => "Erreur lors de l'inscription."]);
            exit;
        }
    } catch (\Throwable $th) {
        echo json_encode(["error" => $th->getMessage()]);
        exit;
    }
}

// Traitement de la requête POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    signup($_POST);
}
?>
