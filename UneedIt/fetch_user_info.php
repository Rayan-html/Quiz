<?php
session_start();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $userId = $user['id'];

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=uneedit', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode($userData);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error fetching user information: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'User not logged in']);
}
?>