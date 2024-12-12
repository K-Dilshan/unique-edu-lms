<?php
include('db.php'); 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email']; 
    $password = $_POST['password']; 

    try {
        $sql = "SELECT password FROM students WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);

        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo "<script>
                alert('Email not found in database.');
                window.location.href = 'index.html';
            </script>";
        } else {
            echo "Debugging info:<br>";
            echo "Entered Email: $email<br>";
            echo "Stored Hash: " . $user['password'] . "<br>";
            echo "Entered Password: $password<br>";

            if (password_verify($password, $user['password'])) {
                echo "Password verification successful";
                session_start();
                $_SESSION['user_email'] = $email; // Store email in session
                header("Location: homepage.html");
                exit();
            } else {
                echo "<script>
                    alert('Invalid password. Please try again.');
                    window.location.href = 'index.html';
                </script>";
            }
        }
    } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
    }
}
?>
