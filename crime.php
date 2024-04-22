<?php

session_start();
if($_SESSION['login']!=true){
  header("location: index.php");
}

?>

<?php
$name='';
$age;
$hair;
$height;
$addr;
$id;
$cases;
$level;

if (isset($_POST["sub"])) {
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $age = $_POST["age"];
    $hair = $_POST["hair"];
    $eye = $_POST["eye"];
    $height = $_POST["height"];
    $addr = $_POST["address"];
    $id = $_POST["id"];
    $cases = $_POST["cases"];
    $level = $_POST["level"];



    $targetFile = "";
    $uploadOk = 1; // Initialize $uploadOk to 1

    // Check image using getimagesize function and get size
    if (isset($_FILES["image"])) {
        // directory name to store the uploaded image files
        // this should have sufficient read/write/execute permissions
        // if not already exists, please create it in the root of the
        // project folder
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if the file already exists in the same path
    // if (file_exists($targetFile)) {
    //     echo "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }

    // Check file size and throw an error if it is greater than
    // the predefined value, here it is 500000
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Check for uploaded file formats and allow only 
    // jpg, png, jpeg, and gif
    // If you want to allow more formats, declare it here
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
    
       if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
    // echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";

    $conn = new mysqli("localhost", "root", "", "ssedb");
$stmt = $conn->prepare("INSERT INTO criminal (namec, age, hair_color,eye_color, height, xaddress, Identification_number,cases,clevel, img) VALUES (?, ?, ?,?, ?, ?, ?,?,?, ?)");
    
    // Updated bind_param to use appropriate data types
   // Check for prepare errors
        if ($stmt === false) {
            die("Error in prepare statement: " . $conn->error);
        }

        // Updated bind_param to use appropriate data types
        $stmt->bind_param("sississsss", $name, $age, $hair,$eye, $height, $addr, $id,$cases,$level ,$targetFile);
 
    $stmt->execute();
    
    
    $stmt->close();
    $conn->close();
} else {
    echo "Sorry, there was an error uploading your file.";
}
    }
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .topnav {
    overflow: hidden;
    background-color: #333;
}

.topnav a {
    float: right;
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
.ccc{
    border: 1px white solid;
}
      .form-label {
            text-align: right;
            width: 100%;
            display: block;
            padding: 3px;
        
            
            
        }

        .rtl-input {
            direction: rtl;
            
        }
           .sel{
           width: 100%;
           height: 40px;
        
            

           
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اضافة مجرم</title>
</head>
<body class="bg-dark text-light">
        <div class="topnav">
  <a href="main.php">الصفحة الرئيسية</a>
 
  <a href="logout.php">تسجيل الخروج</a>
</div>

<div class="container">
    <div class="text-center mt-5">
        <h1>اضافة مجرم</h1>
    </div>

    <div class="row">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-dark ccc">
                <div class="card-body bg-dark ccc">
                    <form id="contact-form" role="form" action="crime.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="form_lastname">العمر *</label>
                                    <input value="<?php
                if(!empty($age)){
                  echo"$age";
                }
                ?>" id="form_lastname" type="number" name="age" class="form-control rtl-input"  min="18" max="60" placeholder="الرجاء ادخال العمر *" required="required" data-error="Lastname is required."
                                    oninvalid="this.setCustomValidity('يجب أن يكون الرقم بين 18 و 60')"     oninput="this.setCustomValidity('')"

                                    >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="form_name">الاسم *</label>
                                    <input value="<?php
                if(!empty($name)){
                  echo"$name";
                }
                ?>" id="form_name" type="text" name="name" class="form-control rtl-input" placeholder="الرجاء ادخال الاسم *" required="required" data-error="Firstname is required."
                                    
                                      pattern="[ء-ي\s]+" title="يجب أن يحتوي هذا الحقل على نص باللغة العربية فقط"
    oninvalid="this.setCustomValidity('يجب أن يحتوي هذا الحقل على نص باللغة العربية فقط')"
    oninput="this.setCustomValidity('')"
    value="">
                                </div>
                            </div>
                           
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="form_email">لون الشعر *</label> 
                                    <select class="sel rtl-input"  id="color" name="hair">
  <option value="اسود">اسود</option>
  <option value="اشقر">اشقر</option>
  <option value="بني">بني</option>
    <option value="ابيض">ابيض</option>
  <option value="رمادي">رمادي</option>
  <option value="اصلع">اصلع</option>

</select>               
                                    
                                    <!-- <input id="form_email" type="text" name="hair" class="form-control" placeholder="الرجاء ادخال لون الشعر *" required="required" data-error="Valid email is required."> -->
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="form_email">لون العين *</label> 
                                    <select class="sel rtl-input"  id="color" name="eye">
  <option value="اسود">اسود</option>
  <option value="عسلي">عسلي</option>
  <option value="بني">بني</option>
  <option value="اسود">اخضر</option>
  <option value="ازرق">ازرق</option>
  <option value="رمادي">رمادي</option>

</select>
                   
                                    <!-- <input id="form_email" type="text" name="hair" class="form-control" placeholder="الرجاء ادخال لون الشعر *" required="required" data-error="Valid email is required."> -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="form_need">الطول *</label>
                                    <input value="<?php
                if(!empty($height)){
                  echo"$height";
                }
                ?>" id="form_need" type="number" name="height"  min="100" max="300" class="form-control rtl-input" placeholder="الرجاء ادخال الطول بوحدة سم *" required="required" data-error="Valid height is required."
                                    oninvalid="this.setCustomValidity('يجب أن يكون الرقم بين 100 و 300')"     oninput="this.setCustomValidity('')"

                                    >
                                </div>
                            </div>
                          
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="form_need">العنوان *</label>
                                    <input value="<?php
                if(!empty($addr)){
                  echo"$addr";
                }
                ?>" id="form_need" type="text" name="address" class="form-control rtl-input" placeholder="الرجاء ادخال عنوان السكن *" required="required" data-error="Valid height is required.">
                                </div>
                            </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="form_need">رقم الهوية *</label>
                                    
                                  <input value="<?php
                if(!empty($id)){
                  echo"$id";
                }
                ?>" id="form_need1" 
       type="number" 
       name="id" 
       class="form-control rtl-input" 
       placeholder="الرجاء ادخال رقم الهوية *" 
       required="required" 
       data-error="Valid height is required."
       pattern="[0-9]{9}"
       title="يجب أن يكون الرقم مكون من 9 خانة" 
       oninvalid="this.setCustomValidity('يجب أن يكون الرقم مكون من 9 خانة')"
       oninput="if(this.value.length == 9) this.setCustomValidity(''); else this.setCustomValidity('الرجاء إدخال 9 رقم')"
>
                                </div>
                            </div>
                           <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="form_need">الاسبقات *</label>
                                                     <select name="cases" class="sel rtl-input" id="violation_type" >
    <option value="السرقة">السرقة</option>
    <option value="الاحتيال">الاحتيال</option>
    <option value="الاعتداء">الاعتداء</option>
    <option value="التزوير">التزوير</option>




</select>
                                  
                                    <!-- <input id="form_need2" type="text" name="cases" class="form-control rtl-input" placeholder="الرجاء ادخال  الاسبقيات *" required="required" data-error="Valid height is required."> -->
                                </div>
                            </div>
                        
                           <div class="col-md-6">
                                <div class="form-group">
                                   <label class="form-label" for="form_need">درجة الخطورة *</label>
                                                                                        <select name="level" class="sel rtl-input" id="violation_type" >
    <option value="عادي">عادي</option>
    <option value="م">متوسط الخطور</option>
    <option value="الاعتداء">خطير</option>
    <option value="التزوير">خطير جدا</option>




</select>
                                   <!-- <input id="form_need3" type="text" name="level" class="form-control rtl-input" placeholder="الرجاء ادخال درجة الخطورة *" required="required" data-error="Valid height is required."> -->
                                </div>
                            </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="form_image">صورة *</label>
                                    <input id="form_image" type="file" name="image" class="form-control rtl-input" required="required" data-error="This is required.">
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                         <div class="col-md-2">
                            <input type="submit" class="btn btn-outline-primary m-3 text-end"
                            name="sub" value="اضافة">
                         </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
                                <script>
function validateAge(input) {
    var age = parseInt(input.value);
    var ageError = document.getElementById("ageError");

    if (isNaN(age) || age < 18 || age > 60) {
        ageError.textContent = "يجب أن يكون العمر ب";
        input.setCustomValidity("Invalid age");
    } else {
        ageError.textContent = "يجب أن يكون العمر ب";
        input.setCustomValidity("يجب أن يكون العمر ب");
    }
}
</script>
<script>
function validateHeight(input) {
    var height = parseInt(input.value);
    var heightError = document.getElementById("heightError");

    if (isNaN(height) || height < 100 || height > 300) {
        heightError.textContent = "يجب أن يكون الطول بين 100 و 300.";
        input.setCustomValidity("الطول غير صالح");
    } else {
        heightError.textContent = "";
        input.setCustomValidity("");
    }
}
    
</script>

</body>
</html>
