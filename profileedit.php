<?php
include('db.php'); 
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: index.html");
    exit();
}

$email = $_SESSION['user_email'];

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $phone = $_POST['phone'];
    $nic_number = $_POST['nic_number'];
    $address = $_POST['address'];
    $parent_phone = $_POST['parent_phone'];

    try {
        $sql = "UPDATE students
        SET mobile = :phone, nic_number = :nic_number, address = :address, parent_mobile = :parent_phone
        WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':phone' => $phone,
            ':nic_number' => $nic_number,
            ':address' => $address,
            ':parent_phone' => $parent_phone,
            ':email' => $email,
        ]);
        echo "<script>
            alert('Profile updated successfully!');
            window.location.href = 'profileedit.php';
        </script>";
    } catch(PDOException $e) {
        echo "Error updating profile: ".$e->getMessage();
    }
} else {
    try {
        $sql = "SELECT mobile, nic_number, address, parent_mobile FROM students WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($student) {
            $phone = $student['mobile'];
            $nic_number = $student['nic_number'];
            $address = $student['address'];
            $parent_phone = $student['parent_mobile'];
        } else {
            die("Student data not found.");
        }
    } catch (PDOException $e) {
        echo "Error fetching profile: " . $e->getMessage();
    }
}
?>

<html >
<head>
   
    <title>Unique Education</title>
    <style>
        

        header {
            background-image:"background.jpg";
            padding: 5px;
        }

        header img {
            max-width: 100px;
        }

        header nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        header nav li {
            display: inline-block;
            margin-right: 20px;
        }
        header nav a {
            text-decoration: none;
            color: #333;
        }
		.listup
			{
			font-size:25px;
			font-family:fantasy;
			float:right;
			color:white;
			}
		body {
            background-image: url('background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
		.sq
			{
			background-color:#9eb0f7 ;
			width:1350px;
			height:2px;
			position: absolute;
            top: 75px; 
			}
		#id05
			{
			font-size:30px;
			font-family: fantasy;
			color:#9eb0f7;
			position: absolute;
			top:-15px;
			left:59;
			}
		#id06
			{
			font-size:19px;
			font-family: fantasy;
			color:#9eb0f7;
			position: absolute;
            top: 30px; 
			left:60px;
			}
		nav a {
      text-decoration: none;
      color: white;
      font-size: 16px;
      padding: 5px 10px;
      border-radius: 5px;
      transition: background-color 0.3s;
    }
    nav a:hover {
      background-color: rgba(255, 255, 255, 0.2);
    }
    nav .active {
      background-color: rgba(255, 255, 255, 0.3);
    }
	.container {
      padding: 70px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    .profile {
      background: rgba(0, 0, 0, 0.7);
      padding: 30px;
      border-radius: 10px;
      width: 400px;
    }
    .profile h1 {
      font-size: 28px;
      margin-bottom: 10px;
      text-align: center;
	  color:white;
    }
    .profile label {
      display: block;
      margin-top: 15px;
      font-size: 16px;
	  color:white;
    }
    .profile input {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: none;
      border-radius: 5px;
      background: #e0e0e0;
      font-size: 16px;
      color:black;
    }
    .profile button {
      margin-top: 20px;
      width: 100%;
      padding: 10px;
      background: #1e88e5;
      border: none;
      border-radius: 5px;
      color: white;
      font-size: 16px;
      cursor: pointer;
    }
    .profile button:hover {
      background: #1565c0;
    }
	#id01
		{
		color:white;
		}

			</style>
	</head>
	<body>
	
	<p id="id05">U N I Q U E</p>
	<p id="id06">E D U C A T I O N</p>
	<div class="sq">
	</div>
	
    <header>
        <nav>
            <ul class="listup">
                <li><a href="homepage.html" >HOME</a></li>
                <li><a href="aboutus.html">ABOUT</a></li>
				<li><a href="stacademic.html">ACADEMIC</a></li>		
                <li><a href="stclass.html">CLASSES</a></li>
                <li><a href="notice.html">NOTICES</a></li>
                <li><a href="stprofile.php"class="active">PROFILE</a></li>
            </ul>
        </nav>
    </header>
	<div class="container">
    <div class="profile">
      <h1>ST_0000</h1>
      <p style="text-align: center;" id="id01" >Student</p>

      <form method="POST" action="profileedit.php">
      <label for="phone">Phone Number</label>
      <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" placeholder="Enter phone number">

      <label for="nic_number">NIC Number</label>
      <input type="nic_number" id="nic_number" name="nic_number" value="<?php echo htmlspecialchars($nic_number); ?>" placeholder="Enter NIC Number">

      <label for="address">Address</label>
      <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" placeholder="Enter address">

      <label for="parent-phone">Parent Phone Number</label>
      <input type="text" id="parent-phone" name="parent_phone" value="<?php echo htmlspecialchars($parent_phone); ?>" placeholder="Enter parent phone number">

      <button type="submit">Save</button>
    </div>
  </div>
            
</body>
</html>