<?php
session_start();
if ($_SESSION['login'] != "true") {
    header("location: index.php");
}

?>

<?php
$name='';
$hight;
$add="";
$age;
$hair;
$id;


if (isset($_POST["sub"])) {
    $name = $_POST["name"];
    $hight = $_POST["hight"];
    $add = $_POST["address"];
    $age = $_POST["age"];
    $hair = $_POST["hair"];
    $id = $_POST["id"];
    $min =$_POST["min"];
    $max =$_POST["max"];
       $agemin =$_POST["agemin"];
    $agemax =$_POST["agemax"];
    $erros=[];
  


    $conn = new mysqli("localhost", "root", "", "ssedb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conditions = array();

    $bindTypes = '';
     if(empty($name)&&empty($age)&&empty($hair)&&empty($hight)&&empty($add)&&empty($id)&&(empty($min)||empty($max)&&empty($hight))&&(empty($agemin)||empty($agemax)&&empty($age))){
 
        $errors[] = "الرجاء ملئ حقل واحد على الاقل.";
    
     }
     
     if(empty($errors))
     {
    if (!empty($name)) {
        $conditions[] = "namec=?";
        $bindTypes .= 's';
    }
   
    if (!empty($age)) {
        $conditions[] = "age=?";
        $bindTypes .= 's';
    }

    if (!empty($hair)) {
        $conditions[] = "hair_color=?";
        $bindTypes .= 's';
    }
   
    if (!empty($hight)) {
        $conditions[] = "height=?";
        $bindTypes .= 's';
    }
   
    
    if (!empty($add)) {
        $conditions[] = "xaddress=?";
        $bindTypes .= 's';
    }
   
    if (!empty($id)) {
        $conditions[] = "Identification_number=?";
        $bindTypes .= 's';
    }
    if(!empty($min)&&!empty($max)&&empty($hight)){
            $conditions[] = "height BETWEEN ? AND ?";
            $bindTypes .= 'ii';

    }
    if(!empty($agemin)&&!empty($agemax)&&empty($age)){
            $conditions[] = "age BETWEEN ? AND ?";
            $bindTypes .= 'ii';

    }

    $whereClause = '';
    if (!empty($conditions)) {
        $whereClause = "WHERE " . implode(" AND ", $conditions);
    }

    $stmt = $conn->prepare("SELECT * FROM criminal " . $whereClause);

    if ($stmt === false) {
        die("Error in prepare statement: " . $conn->error);
    }


if (!empty($bindTypes)) {
    $bindParams = [];
    $bindParams[] = $bindTypes;

    if (!empty($name)) {
        $bindParams[] = &$name;
    }
    if (!empty($age)) {
        $bindParams[] = &$age;
    }
    if (!empty($hair)) {
        $bindParams[] = &$hair;
    }
    if (!empty($hight)) {
        $bindParams[] = &$hight;
    }
   
    if (!empty($add)) {
        $bindParams[] = &$add;
    }
    if (!empty($id)) {
        $bindParams[] = &$id;
    }
    if (!empty($min) && !empty($max)&&empty($hight)) {
                $bindParams[] = &$min;
                $bindParams[] = &$max;
    }
      if (!empty($agemin) && !empty($agemax)&&empty($age)) {
                $bindParams[] = &$agemin;
                $bindParams[] = &$agemax;
    }


    call_user_func_array([$stmt, 'bind_param'], $bindParams);
}


    $stmt->execute();

    if ($stmt->errno) {
        die("Error in execute statement: " . $stmt->error);
    }

    $result = $stmt->get_result();
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
      <link rel="stylesheet" href="styles/serch.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بحث مجرم</title>
    <style>
      .card-container {
  width: 450px;
  height: 450px;
  position: relative;
  border-radius: 10px;
  
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
  overflow: hidden;
}

.card {
  width: 100%;
  height: 100%;
  border-radius: inherit;

}

.card .front-content {
  width: 100%;
  height: 100%;
  display: flex;
  background-size:cover;
  align-items: center;
  justify-content: center;
  transition: all 2.6s cubic-bezier(0.23, 1, 0.320, 1)
}

.card .front-content p {
  font-size: 26px;
  font-weight: 400;
  opacity: 1;
  background: linear-gradient(-45deg, #f89b29 0%, #ff0f7b 100% );
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  transition: all 0.6s cubic-bezier(0.23, 1, 0.320, 1)
}

.card .content {
  position: absolute;
  top: 0;
  left: 0;
  width: 101%;
  height: 100%;
  display: flex;
  flex-direction: column;
     
  
  gap: 10px;
  background: linear-gradient(-45deg,   #000c30 20%,  #00101c 50% );
  color: #e8e8e8;
  padding: 20px;
  line-height: 1.5;
  border-radius: 5px;
  pointer-events: none;
  transform: translatex(100%);
  transition: all 1.6s cubic-bezier(0.23, 1, 0.320, 1);
}

.card .content .heading {
  font-size: 32px;
  font-weight: 700;
     
}

.card:hover .content {
  transform: translateY(0);
}

.card:hover .front-content {
  transform: translateX(20%);
}

.card:hover .front-content p {
  opacity: 0;
}
.res{
  margin-top:50px;
}
.dist{
  margin-top:50px;
}
     .form-label {
            text-align: right;
            display: block;
            padding: 3px;
            
            margin-bottom:-25px;
            
        }

        .rtl-input {
            direction: rtl;
            
        }

       .sticky-form {
        margin-top:50px;
            position: sticky;
            top: 0;
            z-index: 1000; /* Ensure the form is above other elements */
        }
        .erormsg{
          margin-top:50px;
          border:1px red solid;
          padding: 20px;
          text-align:center;
          direction: rtl;


        }
          .erormsg2{
          margin-top:50px;
          border:1px red solid;
          padding: 10px;
          text-align:center;
          direction: rtl;


        }
    </style>
</head>
<body class="bg-dark text-light">
   <div class="topnav">
   <a href="main.php">الصفحة الرئيسية</a>
 
  <a href="logout.php">تسجيل الخروج</a>
    </div>
    <div class="container">
      
     
      <div class="row justify-content-center">
        <div class="col-7">

<div class='container'>
  <div class='row'>

          <?php
      if (isset($_POST["sub"])&&empty($errors)) {
     if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
echo "
    <div class='col dist'>
<div class='card-container bg-dark'>
  <div class='card bg-dark'>
  <div class='front-content' style='background-image:url(". $row['img'] .");'>
 
  </div>
  <div class='content'>
    <p class='heading'>".$row["namec"] ."</p>
    <p>
     العمر ".  $row["age"] ."
    </p>

    <p>
   الطول ".$row["height"]."
    </p>
    <p>
     رقم الهوية ".$row["Identification_number"] ."
    </p>
      

    <p>
         لون الشعر: ".$row["hair_color"] ."
    </p>
     <p>
         لون العين: ".$row["eye_color"] ."
    </p>
    <p>
    العنوان: ".$row["xaddress"]."
      </p>
             <p>
    درجة الخطورة: ".$row["clevel"]."
      </p>
          <p>
    الاسبقيات: ".$row["cases"]."
      </p>
   
  </div>
</div>
</div>

</div>";     
                 
                
                
                 
                 
                
             
                
             
    }
} else {
  
  echo "<div class='container'>
  <div class='row justify-content-center'>
    <div class='col-6'>
      <h1 class='m-5 text-danger erormsg2'>لا توجد نتيجة</h1>
    </div>
  </div>
</div>";
}
      }
        
     
               
  
     

?>



</div>

</div>

        </div>
        <div class="col-5">
<form id="stickyForm" class="sticky-form" action="serch.php" method="POST">
                <div class="row ">
            
                 <div class="col-6">
                   <label class="form-label" for="name">الطول</label><br>
                <input value="<?php
                if(!empty($hight)){
                  echo"$hight";
                }
                ?>" class=" rtl-input"  type="text"name="hight" oninput="validateNumericInput(this); "


                >
                </div>
                    <div class="col-6">
                  <label class="form-label" for="name">الاسم</label><br>
                <input value="<?php
                if(!empty($name)){
                  echo"$name";
                }
                ?>" class=" rtl-input"  class="m-auto"  type="text" name="name" 
                    pattern="[ء-ي\s]+" title="يجب أن يحتوي هذا الحقل على نص باللغة العربية فقط"
    oninvalid="this.setCustomValidity('يجب أن يحتوي هذا الحقل على نص باللغة العربية فقط')"
oninput="validateArabicInput(this);"    value="">
                
                </div>
             
                 <div class="col-6">
                   <label class="form-label" for="name">لون الشعر</label><br>
                <input value="<?php
                if(!empty($hair)){
                  echo"$hair";
                }
                ?>" class=" rtl-input"  type="text"name="hair"
                    pattern="[ء-ي\s]+" title="يجب أن يحتوي هذا الحقل على نص باللغة العربية فقط"
    oninvalid="this.setCustomValidity('يجب أن يحتوي هذا الحقل على نص باللغة العربية فقط')"
oninput="validateArabicInput(this);"    value="">
                
                </div>
                <div class="col-6">
                   <label class="form-label" for="name">العمر</label><br>
                <input value="<?php
                if(!empty($age)){
                  echo"$age";
                }
                ?>" class=" rtl-input"  type="text"name="age" oninput="validateNumericInput(this);"
                pattern="[0-9]{2}"
                       >
                </div>
                 <div class="col-6">
                   <label class="form-label" for="name">العنوان</label><br>
                <input value="<?php
                if(!empty($add)){
                  echo"$add";
                }
                ?>" class=" rtl-input"  type="text"name="address">
                </div>
                   
                 <div class="col-6">
                   <label class="form-label" for="name">رقم الهوية</label><br>
                <input value="<?php
                if(!empty($id)){
                  echo"$id";
                }
                ?>" class=" rtl-input"   type="text"name="id"
                 pattern="[0-9]{11}" 
                 title="يجب أن يكون الرقم مكون من 11 خانة" 
                oninput="validateNumericInput(this);"
>
                </div>
                

 

<div class="col-3">
    <label class="form-label" for="min_height">الطول الأدنى</label><br>
    <input class="rtl-input" type="number" name="min"
                oninput="validateNumericInput(this);"

    >
</div>

<div class="col-3">
    <label class="form-label" for="max_height">الطول الأعلى</label><br>
    <input class="rtl-input" type="number" name="max"
                oninput="validateNumericInput(this);"
                       value="";
    >
</div>

<div class="col-3">
    <label class="form-label" for="min_height">العمر الأدنى</label><br>
    <input class="rtl-input" type="number" name="agemin"
                oninput="validateNumericInput(this);"

    >
</div>

<div class="col-3">
    <label class="form-label" for="max_height">العمر الأعلى</label><br>
    <input class="rtl-input" type="number" name="agemax"
                oninput="validateNumericInput(this);"
                       value="";
    >
</div>
<div class="col-9"></div>
<div class="col-2 justify-content-end ">
            <div class="col-12">
            <input class="btn btn-outline-primary m-4 text-end" type="submit" name="sub" value="بحث">
              </div>
            </div>
  

        </div>
        <div id="ageError" class="text-danger"></div>
<div id="heightError" class="text-danger"></div>

        <?php
          if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<h1 class='text-danger erormsg'>$error</h1>";
            }
            exit;
        }
        ?>
      </div>
      
                    
          
           
        

      </div>
       </div>

     




   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
   integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
   crossorigin="anonymous"></script>
       <script>
        window.onscroll = function () { stickyForm() };

        var form = document.getElementById("stickyForm");
        var sticky = form.offsetTop;

        function stickyForm() {
            if (window.pageYOffset >= sticky) {
                form.classList.add("sticky");
            } else {
                form.classList.remove("sticky");
            }
        }
        function validateNumericInput(input) {
    input.value = input.value.replace(/[^0-9]/g, '');
}
function validateArabicInput(input) {
    input.value = input.value.replace(/[^ء-ي\s]/g, '');
}
    </script>




</body>
</html>