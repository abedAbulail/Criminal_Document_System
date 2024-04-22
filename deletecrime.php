<?php

session_start();

if ($_SESSION['login'] != "true") {

    header("location: index.php");

}

?>

<?php
$i=0;

if(isset($_POST["c"])){
    $conn = new mysqli("localhost", "root", "", "ssedb");
     $i=-1;
    
    $stmtt = $conn->prepare("SELECT * FROM criminal WHERE Identification_number = ?");
    $stmtt->bind_param("s", $_POST['id']);
    $stmtt->execute();
    
    $res = $stmtt->get_result();

    if($res->num_rows == 0){
     $i=-1;
    }
    else {
        $stmt = $conn->prepare("DELETE FROM criminal WHERE Identification_number = ?");
        $stmt->bind_param("s", $_POST["id"]);
        $stmt->execute();

        $i = 1; // Initialize $i if needed
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .form{
 background-color: rgba(0, 0, 0, 0.263);
 width: 400px;
 margin: auto;
 padding: 20px;
 margin-top: 200px;
     border-radius:10px;

 
}
.topnav {
    overflow: hidden;
    display: flex;
    background-color: #333;
    direction: rtl;
}

.topnav a {
    float: left;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 14px;
}

.topnav a:hover {
    background-color: #545454;
    color: black;
}

.topnav a.active {
    background-color: #5c77e4;
    color: white;
}
.base{
    width: 100%;
    height: 800px;
}
input{
    border-radius:10px;
    direction:rtl;
}

    </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>حذف مجرم</title></head>
<body class="bg-dark ">
      <div class="topnav">
  <a href="main.php">الصفحة الرئيسية</a>
 
  <a href="logout.php">تسجيل الخروج</a>
</div>
    <div class="container">
        <div class="dis">

        </div>
        <div class="row justify-content-center text-light text-end">
            <div class="col-5">
                  <div class="form p-5" >
             <h1 class="text-center">حذف مجرم</h1> <br>
             <form action=""  method="POST">
             <label for="name">
               رقم الهوية
            </label><br>
                       
            
            <button class="btn btn-outline-danger m-3" name="c">حذف </button>
                        <input id="name" name="id" type="text" placeholder="الرجاء ادخال رقم الهوية"  required oninvalid="this.setCustomValidity('يرجا تعبئة هذا الحقل')" oninput="validateNumericInput(this);">

                    
             </form>
                        </div>
                    
                    </div>
      
        </div>
            </div>

        </div>
    </div>


      <?php
    if($i==1){
        echo"<h1 class='text-danger text-center m-5'> تم الحذف المجرم بنجاح</h1>";
    }
    elseif($i==-1){
                echo"<h1 class='text-danger text-center m-5'> لا يوجد مجرم بهذا الرقم</h1>";

    }
    ?>

    <script>
                function validateNumericInput(input) {
    input.value = input.value.replace(/[^0-9]/g, '');
}
    </script>
</body>
</html>