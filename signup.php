<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    try {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password]);
        echo "<div class='alert alert-success'>Signup successful. <a href='login.php'>Login here</a></div>";
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            echo "<div class='alert alert-danger'>Username or email already exists.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background: linear-gradient(135deg, #74ebd5, #9face6);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: Arial, sans-serif;
    }
    .form-container {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }
    .form-container h2 {
        margin-bottom: 1.5rem;
        color: #6c63ff;
        text-align: center;
    }
    .btn-custom {
        background: #6c63ff;
        color: white;
        border: none;
        width: 100%;
        padding: 0.75rem;
        font-size: 1rem;
        margin-top: 1rem;
        border-radius: 5px;
    }
    .btn-custom:hover {
        background: #574bbd;
    }
    a {
        text-decoration: none;
        color: #6c63ff;
    }
    a:hover {
        text-decoration: underline;
    }
</style>

</head>
<body>
    <div class="form-container">
        <h2>Signup</h2>
        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-custom">Signup</button>
        </form>
        <p class="text-center mt-3">Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
