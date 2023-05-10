<?php
	
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);

    // ----------------  Include config files e.g dbname, host, port, user, password ---------------- 
	include("config.php");

	header('Content-Type: application/json; charset=UTF-8');

    // Get the user's input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to the database
    $pdo = new PDO("mysql:host=$cd_host;dbname=$cd_dbname", $cd_user);
    
    // Prepare the query
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');

    // Bind the parameters
    $stmt->bindParam(1, $username);

    // Execute the query
    $stmt->execute();

    // Get the user's data
    $user = $stmt->fetch();

    // Check if the password is correct
    // NOTE: password_verify takes the string valid from the front end
    // and presumes the password stored in the database is already hashed
    // password_verify($STRING, HASHED_PASSWORD)
    if ($user && password_verify($password, $user['password'])) {
        // Login successful
        $output = "success";
        echo json_encode($output);
        
        session_start();
        $_SESSION['user_id'] = $user['id'];
    } else {
        // Login failed
        echo json_encode('Incorrect username or password');
    }

?>