<?php
include('db.php');
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: index.html");
    exit();
}

$email = $_SESSION['user_email'];

try {
    $sql = "SELECT first_name, mobile, email, address, nic_number, parent_first_name, parent_mobile FROM students WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$student) {
        die("Student data not found.");
    }
} catch (PDOException $e) {
    echo "Error fetching data: " . $e->getMessage();
}
?>
<html>

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
			float : right;
			color: black;
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
		.container {
      max-width: 700px;
	    height:380px;
      margin: 65px auto;
      padding: 50px;
      background: rgba(0, 0, 0, 0.6);
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.8);
    }
    .profile-header {
      text-align: center;
      margin-bottom: 20px;
	    color:white;
	  }
	 .profile-header h1 {
      font-size: 24px;
      margin: 0;
	    color:white;
    }
    .profile-header p {
      font-size: 18px;
      margin: 5px 0 20px;
      color: #aaa;
    }
    .profile-details {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .profile-details div {
      display: flex;
      justify-content: space-between;
      font-size: 16px;
	    color:white;
    }
    .profile-details span {
      color: #00aced;
    }
    .edit-btn {
      display: block;
      width: 150px;
      margin: 30px auto 0;
      text-align: center;
      padding: 10px;
      background-color: #2196f3;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
      transition: background-color 0.3s;
    }
    .edit-btn:hover {
      background-color: #1976d2;
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
                <li><a href="homepage.html">HOME</a></li>
                <li><a href="aboutus.html">ABOUT</a></li>
				<li><a href="stacademic.html">ACADEMIC</a></li>		
                <li><a href="stclass.html">CLASSES</a></li>
                <li><a href="notice.html">NOTICES</a></li>
                <li><a href="stprofile.php"class="active">PROFILE</a></li>
            </ul>
        </nav>
    </header>
	<div class="container">
    <div class="profile-header">
      <h1> <?=htmlspecialchars($student['first_name']) ?> </h1>
      <p>Student</p>
    </div>
    <div class="profile-details" >
      <div><strong>Name</strong><span><?= htmlspecialchars($student['first_name']) ?></span></div>
      <div><strong>Phone Number</strong><span><?= htmlspecialchars($student['mobile']) ?></span></div>
      <div><strong>Email</strong><span><?= htmlspecialchars($student['email']) ?></span></div>
      <div><strong>Address</strong><span><?= htmlspecialchars($student['address']) ?></span></div>
      <div><strong>NIC Number</strong><span><?= htmlspecialchars($student['nic_number']) ?></span></div>
      <div><strong>Parent Name</strong><span><?= htmlspecialchars($student['parent_first_name']) ?></span></div>
      <div><strong>Parent Phone Number</strong><span><?= htmlspecialchars($student['parent_mobile']) ?></span></div>
    </div>
    <a href="profileedit.php" class="edit-btn">Edit Profile</a>
  </div>
      
</body>
</html>