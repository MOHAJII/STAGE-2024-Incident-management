<?php
// Démarrage de la session
session_start();

 include_once 'db_connexion.php'; 
 $pdo = new connect();

// Traitement du formulaire après soumission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $password = $_POST["password"];

    if (!empty($login) && !empty($password)) {
        // Connexion à la base de données (supposant que $pdo est déjà défini)
        try {
            // Vérification dans la table des clients
            $stmt = $pdo->prepare("SELECT * FROM client WHERE login = :login AND password = :password");
            $stmt->execute(['login' => $login, 'password' => $password]);
            $client = $stmt->fetch(PDO::FETCH_ASSOC);
            

            if ($client) {
                // Stocker l'information utilisateur dans la session
                $_SESSION['user'] = $client;
                // Rediriger vers la page des clients
                header("Location: user_side");
                exit();
            }

            // Vérification dans la table des agents
            $stmt = $pdo->prepare("SELECT * FROM agent WHERE login = :login AND password = :password");
            $stmt->execute(['login' => $login, 'password' => $password]);
            $agent = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($agent) {
                $_SESSION['user'] = $agent;
                header("Location: agent_side");
                exit();
            }

            // Vérification dans la table des techniciens
            $stmt = $pdo->prepare("SELECT * FROM technicien WHERE login = :login AND password = :password");
            $stmt->execute(['login' => $login, 'password' => $password]);
            $technicien = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($technicien) {
                $_SESSION['user'] = $technicien;
                header("Location: technicien_side");
                exit();
            }

            // Si l'utilisateur n'est trouvé dans aucune table
            $error = "Login ou mot de passe incorrect.";
        } catch (PDOException $e) {
            $error = "Erreur de connexion : " . $e->getMessage();
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <?php
    if (isset($error)) {
        echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($error) . '</div>';
    }
    ?>

    <div class="container d-flex align-items-center justify-content-center">
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputlogin1" class="form-label">Login</label>
                <input type="text" class="form-control" name="login" placeholder="login" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>

</body>

</html>
