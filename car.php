<?php

session_start();
if($_SESSION['login']!=true){
  header("location: index.php");
}

?>

<?php
$number;
$type;
$color;
$model;
$awner;
if (isset($_POST["sub"])) {
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $number = $_POST["number"];
    $type = $_POST["type"];
    $color = $_POST["color"];
    $model = $_POST["model"];
    $Violated = $_POST["Violated"];
    $awner = $_POST["awner"];
    $area=$_POST["area"];
    $numberr='';
    $numberr=strval($number);
    $numberr=$numberr.$area;

   

    $conn = new mysqli("localhost", "root", "", "ssedb");
    
$stmt = $conn->prepare("INSERT INTO car (car_number, type_of_car, color, model, Violated, awner) VALUES (?, ?, ?, ?, ?, ?)");
    
    // Updated bind_param to use appropriate data types
   // Check for prepare errors
        if ($stmt === false) {
            die("Error in prepare statement: " . $conn->error);
        }

        // Updated bind_param to use appropriate data types
        $stmt->bind_param("sssssi", $numberr, $type, $color, $model, $Violated, $awner);
 
    $stmt->execute();
    
    
    $stmt->close();
    $conn->close();
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
    border:1px white solid;
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
           margin-top:-10px;
            

           
        }
    
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اضافة سيارة</title>
</head>
<body class="bg-dark text-light">
        <div class="topnav">
  <a href="main.php">الصفحة الرئيسية</a>
 
  <a href="logout.php">تسجيل الخروج</a>
</div>

<div class="container">
    <div class="text-center mt-5">
        <h1>اضافة سيارة المجرم</h1>
    </div>

    <div class="row bg-dark">
        <div class="col-lg-7 mx-auto bg-dark ccc">
            <div class="card mt-2 mx-auto p-4 bg-dark">
                <div class="card-body bg-dark ccc">
                    <form id="contact-form" role="form" action="car.php" method="POST" enctype="multipart/form-data">
                        <div class="row justify-content-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_name" class="form-label">رقو لوحة السيارة *</label>
                                 <input value="<?php
                if(!empty($number)){
                  echo"$number";
                }
                ?>" id="form_name" type="text" name="number" class="form-control rtl-input" placeholder="الرجاء ادخال رقم السيارة *" required
                                >
                                </div>
                            </div>
                                  <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_lastname" class="form-label">النوع *</label>
                                    <input value="<?php
                if(!empty($type)){
                  echo"$type";
                }
                ?>" id="form_lastname" type="text" name="type" class="form-control rtl-input" placeholder="الرجاء ادخال نوع اسيارة *" required oninvalid="this.setCustomValidity('يرجا تعبئة هذا الحقل')" data-error="Lastname is required.">
                                </div>
                            </div>
                        
                              <div class="col-md-6">
                                <div class="form-group m-2">
                                    <label for="form_need" class="form-label">المديرية*</label>
                                    <select name="area" class="sel rtl-input" id="violation_type" >
    <option value="A"> جنين</option>
    <option value="B">طول كرم</option>
    <option value="C">طوباس</option>
    <option value="D">نابلس</option>
    <option value="E">قلقيلية</option>
    <option value="F">سلفيت</option>
    <option value="G">اريحا</option>
    <option value="H">رام الله والبيرة</option>
    <option value="J">القدس</option>
    <option value="K">بيت لحم</option>
    <option value="L">الخليل</option>
    <option value="M">دورا</option>
    <option value="N">يطا</option>




</select>
   </div>
                            </div>
                            
                        
                      
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_email" class="form-label">اللون *</label>
<input value="<?php
                if(!empty($color)){
                  echo"$color";
                }
                ?>" id="form_email" type="text" name="color" class="form-control rtl-input" placeholder="الرجاء ادخال اللون *" required
    pattern="[ء-ي\s]+" title="يجب أن يحتوي هذا الحقل على نص باللغة العربية فقط"
    oninvalid="this.setCustomValidity('يجب أن يحتوي هذا الحقل على نص باللغة العربية فقط')"
    oninput="this.setCustomValidity('')"
    >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_need1" class="form-label">الموديل *</label>
                                    <input value="<?php
                if(!empty($model)){
                  echo"$model";
                }
                ?>" id="form_need1" type="text" name="model" class="form-control rtl-input" placeholder="الرجاء ادخال الموديل *" required="required" data-error="Valid height is required."
                                    pattern="[0-9]{4}" title="الرجاء ادخال الموديل بشكل صحيح"
                                        oninvalid="this.setCustomValidity('الرجاء ادخال الموديل بشكل صحيح')"
                                        oninput="this.setCustomValidity('')"
                                        >
                                </div>
                            </div>
                              <div class="col-md-6">
                                <div class="form-group m-2">
                                    <label for="form_need" class="form-label">هل يوجد مخالفة *</label>
                                    <select name="Violated" class="sel rtl-input" id="violation_type" >
    <option value="تجاوز_السرعة_المحددة">تجاوز السرعة المحددة</option>
    <option value="عدم_ارتداء_حزام_الأمان">عدم ارتداء حزام الأمان</option>
    <option value="استخدام_الهاتف_المحمول_أثناء_القيادة">استخدام الهاتف المحمول أثناء القيادة</option>
    <option value="عدم_الامتثال_لإشارات_المرور">عدم الامتثال لإشارات المرور</option>
    <option value="التجاوز_غير_الآمن">التجاوز غير الآمن</option>
    <option value="عدم_التزام_بقوانين_الأولوية">عدم التزام بقوانين الأولوية</option>
    <option value="تجاوز_حاجز_الإشارة_المتحرك">تجاوز حاجز الإشارة المتحرك</option>
    <option value="تجاوز_السكة_الحديدية_عندما_تكون_الإشارة_مفتوحة">تجاوز السكة الحديدية عندما تكون الإشارة مفتوحة</option>
    <option value="عدم_استخدام_المؤشرات">عدم استخدام المؤشرات</option>
    <option value="عدم_التزام_بقوانين_الركن">عدم التزام بقوانين الركن</option>
        <option value="لا يوجد">لا يوجد مخالفات</option>

</select>

                                    <!-- <input id="form_need" type="text" name="Violated" class="form-control" placeholder="Please enter Violated *"  data-error="Valid height is required."> -->
                                </div>
                            </div>
                        
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_need" class="form-label">رقم هوية المالك *</label>
                                    <input id="form_need" type="number" name="awner" class="form-control rtl-input" placeholder="الرجاء ادخال رقم المالك *" required="required" data-error="Valid height is required."
                                    pattern="[0-9]{9}" title="يجب أن يكون الرقم مكون من 9 خانة" 
    oninvalid="this.setCustomValidity('يجب أن يكون الرقم مكون من 9 خانة')"
    oninput="this.setCustomValidity('')"
    value="<?php
                if(!empty($awner)){
                  echo"$awner";
                }
                ?>"
                                    >
                                </div>
                            </div>
                        
                      
                        <div class="row justify-content-end">
                            <div class="col-3 col-md-2 bg-dark">
                                <input type="submit" class="btn btn-outline-primary    m-3" name="sub" value="حفظ">
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
        // Add script tag for JavaScript
        // You can also place this script in an external .js file

        // Reset custom validity when the input is valid
        
        
        
        
        
        document.getElementById("form_name").addEventListener('input', function () {
            this.setCustomValidity('');
        });
         document.getElementById("form_lastname").addEventListener('input', function () {
            this.setCustomValidity('');
        });
         document.getElementById("form_email").addEventListener('input', function () {
            this.setCustomValidity('');
        });
         document.getElementById("form_need1").addEventListener('input', function () {
            this.setCustomValidity('');
        });
         document.getElementById("form_need").addEventListener('input', function () {
            this.setCustomValidity('');
        });
         document.getElementById("violation_type").addEventListener('input', function () {
            this.setCustomValidity('');
        });
    </script>
</body>
</html>
