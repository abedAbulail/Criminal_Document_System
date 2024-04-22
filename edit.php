<?php
session_start();
if ($_SESSION['login'] != "true") {
    header("location: index.php");
}
$msg='';
if (isset($_POST["btn"])) {
    $conn = new mysqli("localhost", "root", "", "ssedb");
    $id = $_POST["id"];
    $stmt = $conn->prepare("SELECT * FROM criminal WHERE Identification_number = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    
}
if(isset($_POST["edit"])){
       $conn = new mysqli("localhost", "root", "", "ssedb");
    
    // Retrieve form data
    $age = $_POST["age"];
    $name = $_POST["name"];
    $hair = $_POST["hair"];
    $height = $_POST["height"];
    $address = $_POST["address"];
    $cases = $_POST["cases"];
    $severity = $_POST["severity"];

    // Update query
    $updateStmt = $conn->prepare("UPDATE criminal SET age=?, namec=?, hair_color=?, height=?, xaddress=?, cases=?, clevel=? WHERE Identification_number = ?");
    $updateStmt->bind_param("ississsi", $age, $name, $hair, $height, $address, $cases, $severity, $id);
    
    if ($updateStmt->execute()) {
        $msg= "تم التعديل بنجاح";
    }
    
    $updateStmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .row1 {
            margin-top: 50px;
        }

        .crime {
            width: 100%;
            padding: 30px;
            background-color: blue;
        }
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
    <title>تعديل مجرم</title>
</head>
<body class="bg-dark text-light">
       <div class="topnav">
  <a href="main.php">الصفحة الرئيسية</a>
 
  <a href="logout.php">تسجيل الخروج</a>
</div>


<div class="container">
    <div class="row row1 justify-content-between">
        <div class="col-7">
            <?php
            if (isset($_POST["btn"])) {

                if ($res->num_rows == 0) {
                    echo "<h3 class='text-danger m-5'>لا يوجد شخص بهذا الرقم</h3>";
                } else {
                    while($row=$res->fetch_assoc()){
                    echo "
    <div class='container'>
        <div class='text-center mt-5'>
            <h1>التعديل على المجرم " .$row["namec"]."</h1>
        </div>

        <div class='row'>
            <div class='col-lg-12 mx-auto'>
                <div class='card mt-2 mx-auto p-4 bg-dark ccc'>
                    <div class='card-body bg-dark ccc'>
                        <form id='contact-form' role='form' action='edit.php' method='POST' enctype='multipart/form-data'>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='form-label' for='form_lastname'>العمر *</label>
                                        <input value='".$row["age"]."' id='form_lastname' type='number' name='age' class='form-control rtl-input'
                                               min='18' max='60' placeholder='الرجاء ادخال العمر *' required='required'
                                               data-error='Lastname is required.'
                                               oninvalid='this.setCustomValidity(".'يجب أن يكون الرقم بين 18 و 60'."'
                                               oninput='this.setCustomValidity('')'
                                        >
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='form-label' for='form_name'>الاسم *</label>
                                        <input value='".$row["namec"]."' id='form_name' type='text' name='name' class='form-control rtl-input'
                                               placeholder='الرجاء ادخال الاسم *' required='required' data-error='Firstname is required.'
                                               pattern='[ء-ي\s]+' title='يجب أن يحتوي هذا الحقل على نص باللغة العربية فقط'
                                               oninvalid='this.setCustomValidity(".'يجب أن يحتوي هذا الحقل على نص باللغة العربية فقط'."'
                                               oninput='this.setCustomValidity('')'
                                               value=''>
                                    </div>
                                </div>
                            </div>

                            <div class='row justify-content-end'>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='form-label' for='form_email'>لون الشعر *</label>
                                        <select class='sel rtl-input' id='color' name='hair' value='".$row["hair_color"]."'>
                                            <option value='اسود' " . ($row["hair_color"] == 'اسود' ? 'selected' : '') . " >اسود</option>
                                            <option value='اشقر' " . ($row["hair_color"] == 'اشقر' ? 'selected' : '') . " >اشقر</option>
                                            <option value='بني' " . ($row["hair_color"] == 'بني' ? 'selected' : '') . " >بني</option>
                                            <option value='ابيض' " . ($row["hair_color"] == 'ابيض' ? 'selected' : '') . " >ابيض</option>
                                            <option value='رمادي' " . ($row["hair_color"] == 'رمادي' ? 'selected' : '') . " >رمادي</option>
                                            <option value='اصلع' " . ($row["hair_color"] == 'اصلع' ? 'selected' : '') . " >اصلع</option>
                                        </select>
                                    </div>
                                </div>
                                               <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='form-label' for='form_email'>لون العين *</label>
                                        <select class='sel rtl-input' id='color' name='eye value='".$row["eye_color"]." '>
                                            <option value='اسود' " . ($row["eye_color"] == 'اسود' ? 'selected' : '') . " >اسود</option>
                                            <option value='عسلي' " . ($row["eye_color"] == 'عسلي' ? 'selected' : '') . " >عسلي</option>
                                            <option value='بني' " . ($row["eye_color"] == 'بني' ? 'selected' : '') . " >بني</option>
                                            <option value='اخضر' " . ($row["eye_color"] == 'اخضر' ? 'selected' : '') . " >اخضر</option>
                                            <option value='ازرق' " . ($row["eye_color"] == 'ازرق' ? 'selected' : '') . " >ازرق</option>
                                            <option value='رمادي' " . ($row["eye_color"] == 'رمادي' ? 'selected' : '') . " >رمادي</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='form-label' for='form_need'>الطول *</label>
                                        <input value='".$row["height"]."' id='form_need' type='number' name='height' min='100' max='300'
                                               class='form-control rtl-input' placeholder='الرجاء ادخال الطول بوحدة سم *' required='required'
                                               data-error='Valid height is required.'
                                               oninvalid='this.setCustomValidity('يجب أن يكون الرقم بين 100 و 300')'
                                               oninput='this.setCustomValidity('')'
                                        >
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='form-label' for='form_need'>العنوان *</label>
                                        <input value='".$row["xaddress"]."' id='form_need' type='text' name='address' class='form-control rtl-input'
                                               placeholder='الرجاء ادخال عنوان السكن *' required='required' data-error='Valid height is required.'>
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='form-label' for='form_need1'>رقم الهوية *</label>
                                        <input value='".$row["Identification_number"]."' id='form_need1' type='number' name='id' class='form-control rtl-input'
                                               placeholder='الرجاء ادخال رقم الهوية *' required='required' data-error='Valid height is required.'
                                               pattern='[0-9]{9}' title='يجب أن يكون الرقم مكون من 9 خانة'
                                               oninvalid='this.setCustomValidity('يجب أن يكون الرقم مكون من 9 خانة')'
                                               oninput='if(this.value.length == 11) this.setCustomValidity(''); else this.setCustomValidity('الرجاء إدخال 11 رقم')'
                                        
                                        disabled       >
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='form-label' for='form_need2'>الاسبقات *</label>
                                        <select name='cases' class='sel rtl-input' id='violation_type' value='".$row["cases"]."'>
                                            <option value='السرقة' " . ($row["cases"] == 'السرقة' ? 'selected' : '') . ">السرقة</option>
            <option value='الاحتيال' " . ($row["cases"] == 'الاحتيال' ? 'selected' : '') . ">الاحتيال</option>
            <option value='الاعتداء' " . ($row["cases"] == 'الاعتداء' ? 'selected' : '') . ">الاعتداء</option>
            <option value='التزوير' " . ($row["cases"] == 'التزوير' ? 'selected' : '') . ">التزوير</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='form-label' for='form_need3'>درجة الخطورة *</label>
                                        <select name='severity' class='sel rtl-input' id='severity_type'>
                                            <option value='عادي' " . ($row["clevel"] == 'عادي' ? 'selected' : '') . "> عادي</option>
        <option value='متوسط الخطور' " . ($row["clevel"] == 'متوسط الخطور' ? 'selected' : '') . ">متوسط الخطور</option>
        <option value='خطير' " . ($row["clevel"] == 'خطير' ? 'selected' : '') . ">خطير</option>
        <option value='خطير جدا' " . ($row["clevel"] == 'خطير جدا' ? 'selected' : '') . ">خطير جدا</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                          
                            <div class='row justify-content-end'>
                                <div class='col-md-2'>
                                    <input type='submit' class='btn btn-outline-primary m-3 text-end' name='edit' value='حفظ'>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
";
                    }
                }
            }

            if(!empty($msg)){
                 echo "<h3 class='text-success m-5'>".$msg."</h3>";

            }
            ?>

        </div>
        <div class="col-4 text-end">
            <form action="edit.php" method="POST" enctype="multipart/form-data">
                <label for="">ادخل رقم هوية المجرم</label><br>
                <button class="btn btn-primary" name="btn">بحث</button>
                <input type="number" name="id"><br>
            </form>
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
