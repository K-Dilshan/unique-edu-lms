<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $nic_number = $_POST['nic_number'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $school = $_POST['school'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $parent_first_name = $_POST['parent_first_name'];
    $parent_last_name = $_POST['parent_last_name'];
    $parent_mobile = $_POST['parent_mobile'];
    $parent_email = $_POST['parent_email'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO students (first_name, last_name, nic_number, birthday, gender, mobile, email, school, password, address, parent_first_name, parent_last_name, parent_mobile, parent_email)
                VALUES (:first_name, :last_name, :nic_number, :birthday, :gender, :mobile, :email, :school, :password, :address, :parent_first_name, :parent_last_name, :parent_mobile, :parent_email)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':nic_number' => $nic_number,
            ':birthday' => $birthday,
            ':gender' => $gender,
            ':mobile' => $mobile,
            ':email' => $email,
            ':school' => $school,
            ':password' => $hashed_password,
            ':address' => $address,
            ':parent_first_name' => $parent_first_name,
            ':parent_last_name' => $parent_last_name,
            ':parent_mobile' => $parent_mobile,
            ':parent_email' => $parent_email,
        ]);

        echo "<script>
            alert('Registration complete!');
            window.location.href = 'index.html';
            </script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
