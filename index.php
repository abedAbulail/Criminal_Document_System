<?php
 $errors="";
 $errornumber=0;
require_once "config.php";
 
    if (isset($_POST["sub"])) {
     
        $name = $_POST["username"];
        $pass = $_POST["password"];
        $conn = new mysqli("localhost", "root", "", "SSEDB");
        $result = mysqli_query($conn, "select * from user where number_S='$name' ");
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) > 0) {
            if ($pass == $row["user_pass"]) {
                session_start();
                $_SESSION["role"] = $row["role_s"];

                $_SESSION["login"] = true;

                // if($row["role_s"]=="admin"){
                //
                // }
                 header("location: main.php");
              
                exit;
            } else {
              $errornumber=1;
              $errors="كلمة المرور غير صحيحة";
                // echo "<script>alert('password is not valid') </script>";
            }
        } else {
          $errornumber=2;
          $errors="رقم التجنيد غير صحيح";
            // echo "<script>alert('number is not valid') </script>";
            // If you're redirecting here, make sure there's no other output
            // before the header function
           
        }
    }

    ob_end_flush(); // Flush the output buffer
    ?>



<!DOCTYPE html>
<head>

    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type="number"] {
    -moz-appearance: textfield;
}
.eror{
  width: 100%;
  height: 30px;
  border:1px red solid;
 
}
.erer h5{
  margin-top:10px
}
    </style>
    <title>تسجيل الدخول</title>
</head>
<body>
 
  <section> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> 
   
<div class="signin"> 
     
    <div class="content"> 
     <img src="police-removebg-preview.png" alt="" width="120" srcset="">
     <h2>تسجل الدخول</h2> 
      <form action="index.php" method="POST" class="form"  autocomplete="off"> 

        <div class="inputBox"> 

          <input id="username"class="
         <?php
         if($errornumber==2){
          echo "bg-danger";
         }
         ?>
         "
          pattern="[0-9]{8}"  type="number" name="username" required oninvalid="this.setCustomValidity('يرجا تعبئة هذا الحقل')"> <i class="text-light">رقم التجنيد</i>

        </div> 

        <div class="inputBox"> 

         <input id="password" class="
         <?php
         if($errornumber==1){
          echo "bg-danger";
         }
         ?>
         " type="password" name="password"  required oninvalid="this.setCustomValidity('يرجا تعبئة هذا الحقل')"> <i class="text-light">كلمة السر</i>

       </div> 


         <div class="inputBox"> 

         <input type="submit" class="btn btn-light" name="sub" value="تسجيل الدخول"> 
       </div> 
       <div class="eror" style="
       <?php
       if($errornumber==0){
       echo  "display:none";
          
       }
       ?>
       ">
       <h5 class="text-center text-danger">
       <?php
       if(!empty($errors))
       echo$errors;
       ?> 
       </h5>
       </div>
     </form>

    </div> 

</div> 


  </section> <!-- partial --> 

  


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
        <script src="index.js"></script>
      
            <script>
        // Add script tag for JavaScript
        // You can also place this script in an external .js file

        // Reset custom validity when the input is valid
        
        
        
        
        
        document.getElementById("username").addEventListener('input', function () {
            this.setCustomValidity('');
        });
         document.getElementById("password").addEventListener('input', function () {
            this.setCustomValidity('');
        });
 
    </script>
 </body>

</html>