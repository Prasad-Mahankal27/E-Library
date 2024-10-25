<?php
session_start();
header('Content-Type: application/json');

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'library');

// Connect to database
function connectDB() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        die(json_encode([
            'success' => false,
            'message' => 'Database connection failed'
        ]));
    }
    
    return $conn;
}

// Sanitize input
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = connectDB();
    
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']); // In production, use password_hash()
    $isRegister = isset($_POST['isRegister']) && $_POST['isRegister'] === 'true';

    if ($isRegister) {
        // Check if username already exists
        $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $check_stmt->bind_param("s", $username);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Username already exists. Please choose another username.'
            ]);
            exit;
        }

        // Register new user
        $insert_stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $insert_stmt->bind_param("ss", $username, $password);
        
        if ($insert_stmt->execute()) {
            $_SESSION['user_id'] = $conn->insert_id;
            echo json_encode([
                'success' => true,
                'message' => 'Registration successful. Welcome!'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Registration failed. Please try again.'
            ]);
        }
    } else {
        // Login existing user
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Username not found. Please register first.'
            ]);
        } else {
            $user = $result->fetch_assoc();
            if ($password === $user['password']) { // In production, use password_verify()
                $_SESSION['user_id'] = $user['id'];
                echo json_encode([
                    'success' => true,
                    'message' => 'Login successful. Welcome back!'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Incorrect password. Please try again.'
                ]);
            }
        }
    }
    
    $conn->close();
}
?>