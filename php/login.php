<?php 
$servername = "localhost";
$username = "root";
$password = "1234";
$database = "phptest";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$email = $_POST["email"];
$password = $_POST["password"];

$result = mysqli_query($conn, "SELECT * FROM contacts WHERE email = '$email'");
if (mysqli_num_rows($result) == 0) {
    $response = array(
        "status" => "error",
        "message" => "User not found"
    );
    echo json_encode($response);
} else {
    $row = mysqli_fetch_assoc($result);
    
    if($password== $row['password']){
        $session_id = uniqid();
        $redis->set("session:$session_id", $email);
        $redis->expire("session:$session_id", 10*60);
        
        $payload = array(
            "email" => $row['email'],
            "expires_at" => time() + 3600 // Expires in 1 hour
        );

        
        $access_token = base64_encode(json_encode($payload));
        $response = array(
            "status" => "success",
            "message" => "Login successful",
            // "access_token" => $access_token
            'session_id' => $session_id

        );
        echo json_encode($response);
    } else {
        $response = array(
            "status" => "error",
            "message" => "Incorrect password"
        );
        die(json_encode($response));
    }
}

?>
