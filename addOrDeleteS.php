<?php

session_start();
if($_SESSION['login']!="true"){
  header("location: index.php");
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/add.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .in{
    direction: rtl;
    border-radius: 5px;;
}

.form{
 background-color: rgba(0, 0, 0, 0.263);
 width: 400px;
 margin: auto;
 padding: 20px;
 margin-top: 100px;
 
}
.hh{
 
    padding:10px;
    text-align:center;

}
    </style>
    <title>اضافة شرطي وضابط</title>
</head>
<body class="bg-dark text-light">
    <div class="topnav">
  <a href="main.php">الصفحة الرئيسية</a>
 
  <a href="logout.php">تسجيل الخروج</a>
</div>


    <div class="container text-end">
      
        <div class="row">
            <div class="col col-md-6">
<div class="form  p-4">
    <h1>اضافة شرطي او ضابط</h1>
        <form action="" method="POST">
          <label for="name">
            رقم التجنيد
          </label><br>
          <input class="in" id="name" name="name" type="number"
            pattern="[0-9]{10}"
            oninvalid="this.setCustomValidity('يجب أن يحتوي هذا الحقل على ارقام فقط')" required

          ><br><br>
          <label for="password">
            كلمة السر
          </label><br>
          <input class="in" id="password" name="password" type="password"
            pattern="^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
       title="يجب أن تحتوي كلمة السر على الأقل 8 أحرف، وتتضمن أحرفًا كبيرة وصغيرة وأرقام ورموز خاصة"
       required
          ><br><br>
           <label for="phone">
            رقم الهاتف
           </label><br>
           <input class="in" id="phone" name="phone" type="number"
             pattern="[0-9]{9}"
                   oninvalid="this.setCustomValidity('يجب أن يحتوي هذا الحقل على ارقام من تسع خانات فقط')" required

           ><br><br>
          <button class="btn btn-outline-primary" name="addS">اضافة ضابط</button>
           <button class="btn btn-outline-primary" name="addB">اضافة شرطي</button>

        </form>
        </div>
        </div>
    
         <div class="col col-md-6">
            <div class="form p-3" >
             <h1>حذف شرطي او ضابط</h1>
             <form action=""  method="POST">
             <label for="name">
               رقم التجنيد
            </label><br><br>
            <input class="in" id="name" name="name1" type="number"
                 pattern="[0-9]{8}" 
                   oninvalid="this.setCustomValidity('يجب أن يحتوي هذا الحقل على ارقام فقط')" required

            ><br><br>
                       
            <button class="btn btn-outline-danger" name="deleteS">حذف ضابط</button>
            <button class="btn btn-outline-danger" name="deleteB">حذف شرطي</button>
                    
             </form>
                        </div>
                    
                    </div>
      
        </div>
    </div>


    
  




    



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
    <?php
    if (isset($_POST["addS"]) || isset($_POST["addB"])) {
    // ... your existing code ...

    $pass = $_POST["password"];

    // Validate password format using regex
    if (!preg_match("/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $pass)) {
        echo "<h5 class='hh text-center m-5 text-danger'>كلمة السر يجب أن تحتوي على الأقل 8 أحرف، وتتضمن أحرفًا كبيرة وصغيرة وأرقام ورموز خاصة</h5>";
        exit; // Stop execution if there's an error
    }

    // ... continue with your existing code ...
}
if (isset($_POST["addS"])) {
    $name = $_POST["name"];
    $pass = $_POST["password"];
    $role = "supervisor";  // Corrected the role name
    $phone = $_POST["phone"];

    // Create a new mysqli connection
    $conn = new mysqli("localhost", "root", "", "ssedb");

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the username already exists
    $checkStmt = $conn->prepare("SELECT number_S FROM user WHERE number_S = ?");
    $checkStmt->bind_param("s", $name);
    $checkStmt->execute();
    $checkStmt->store_result();

    // If a matching username is found, display an error
    if ($checkStmt->num_rows > 0) {
        echo "<h5 class='hh text-center m-5 text-danger'>.هذا الضابط موجود</h5>";
        $checkStmt->close();
        $conn->close();
        exit; // Stop execution if there's an error
    }

    // Close the check statement
    $checkStmt->close();

    // Prepare an SQL statement for execution
    $insertStmt = $conn->prepare("INSERT INTO user (number_S, user_pass, role_s, phonenumber) VALUES (?, ?, ?, ?)");

    // Check if the statement was prepared successfully
    if ($insertStmt) {
        // Bind parameters to the prepared statement
        $insertStmt->bind_param("ssss", $name, $pass, $role, $phone);

        // Execute the prepared statement
        if ($insertStmt->execute()) {
            echo "<h5 class='hh text-center m-5 text-success'>تمت الاضافة بنجاح</h5>";
        } else {
            echo "<h5 class='hh text-center m-5 text-danger'>خطا في الادخال</h5>";
       
        }

        // Close the insert statement
        $insertStmt->close();
    }
    //  else {
    //     echo "Error preparing statement: " . $conn->error;
    // }

    // Close the connection
    $conn->close();
}

if(isset($_POST["deleteS"])){
 $name=$_POST["name1"];
  $role="supervisor";

   $conn= new mysqli("localhost","root","","ssedb");
   $stmtt=$conn->prepare("select * from user where number_s=? and role_s=?");
   $stmtt->bind_param("is",$name,$role);
   $stmtt->execute();
   $res=$stmtt->get_result();
   if($res->num_rows>0){
   $stmt=$conn->prepare("Delete From user Where number_S=? AND role_s=?");
   $stmt->bind_param("ss",$name,$role);
   $stmt->execute();
   
 echo"<h5 class='hh text-center m-5 text-success'>تم الحذف بنجاح</h5>";
   }
   else{
     echo"<h5 class='hh text-center m-5 text-danger'>الرقم الذي ادخلته غير موجود</h5>";

   }

  $conn->close();
}




if (isset($_POST["addB"])) {
    $name = $_POST["name"];
    $pass = $_POST["password"];
    $role = "policeman";
    $phone = $_POST["phone"];

    // Create a new mysqli connection
    $conn = new mysqli("localhost", "root", "", "ssedb");

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the username already exists
    $checkStmt = $conn->prepare("SELECT number_S FROM user WHERE number_S = ?");
    $checkStmt->bind_param("s", $name);
    $checkStmt->execute();
    $checkStmt->store_result();

    // If a matching username is found, display an error
    if ($checkStmt->num_rows > 0) {
        echo "<h5 class='hh text-center m-5 text-danger'>هاذا المستخدم موجود</h5>";
        $checkStmt->close();
        $conn->close();
        exit; // Stop execution if there's an error
    }

    // Close the check statement
    $checkStmt->close();

    // Prepare an SQL statement for execution
    $insertStmt = $conn->prepare("INSERT INTO user (number_S, user_pass, role_s, phonenumber) VALUES (?, ?, ?, ?)");

    // Check if the statement was prepared successfully
    if ($insertStmt) {
        // Bind parameters to the prepared statement
        $insertStmt->bind_param("ssss", $name, $pass, $role, $phone);

        // Execute the prepared statement
        if ($insertStmt->execute()) {
            echo "<h5 class='hh text-center m-5 text-success'>تمت الاضافة بنجاح</h5>";
        } else {
            echo "<h5 class='hh text-center m-5 text-danger'> يوجد خطا</h5>";
        }

        // Close the insert statement
        $insertStmt->close();
    }

    // Close the connection
    $conn->close();
}


if(isset($_POST["deleteB"])){
 $name=$_POST["name1"];
  $role="policeman";
  
   $conn= new mysqli("localhost","root","","ssedb");
    $stmtt=$conn->prepare("select * from user where number_s=? and role_s=?");
   $stmtt->bind_param("is",$name,$role);
   $stmtt->execute();
   $res=$stmtt->get_result();
   if($res->num_rows>0){
   $stmt=$conn->prepare("Delete From user Where number_S=? AND role_s=?");
   $stmt->bind_param("ss",$name,$role);
   $stmt->execute();
   
 echo"<h5 class='hh text-center m-5 text-success'>تم الحذف</h5>";
   }
   else{
         echo"<h5 class='hh text-center m-5 text-danger'>الرقم الذي ادخلته غير موجود</h5>";

   }
  $conn->close();
}

?>
     
</body>
</html>