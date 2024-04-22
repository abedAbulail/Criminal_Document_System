<?php
session_start();
if ($_SESSION['login'] != "true") {
    header("location: index.php");
}

?>

<?php
if (isset($_POST["sub"])) {
    $number = $_POST["number"];
    $empty=false;
    if(empty($number)){
        $empty=true;
    }
    else{

   

    $conn = new mysqli("localhost", "root", "", "ssedb");



    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create an array to store conditions
    $conditions = array();

    // Create an array to store bind types
    $bindTypes = '';

    // Check each field and add conditions for non-empty fields
 if (!empty($number)) {
    $conditions[] = "car_number=?";
    $bindTypes .= 's';
}

 
  

    // Build the WHERE clause
 // Build the WHERE clause
$whereClause = '';
if (!empty($conditions)) {
    $whereClause = "WHERE " . implode(" AND ", $conditions);
}

// Prepare the SQL query
$stmt = $conn->prepare("SELECT * FROM car " . $whereClause);

    // Check for prepare errors
    if ($stmt === false) {
        die("Error in prepare statement: " . $conn->error);
    }

   // Bind parameters based on bind types
// Bind parameters based on bind types
if (!empty($bindTypes)) {
    $bindParams = [];
    $bindParams[] = $bindTypes;

    // Dynamically bind variables based on the non-empty fields
    if (!empty($number)) {
        $bindParams[] = &$number;
    }

  

    // Call bind_param with the dynamically created array of parameters
    call_user_func_array([$stmt, 'bind_param'], $bindParams);
}


    // Execute the statement
    $stmt->execute();

    // Check for execute errors
    if ($stmt->errno) {
        die("Error in execute statement: " . $stmt->error);
    }

    // Get the result
    $result = $stmt->get_result();
    
}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
    <meta charset="UTF-8">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
      <link rel="stylesheet" href="styles/carserch.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <style>
        .form-label {
            text-align: right;
            width: 100%;
            display: block;
            padding: 3px;
            margin-bottom:-25px;
            
            
        }

        .rtl-input {
            direction: rtl;
            
        }

        .card {
  position: relative;
  width: 500px;
  height: 450px;
  color: #2e2d31;
        background-color: #000216;
  overflow: hidden;
  border-radius: 20px;
  

  
}

.temporary_text {
  font-weight: bold;
  font-size: 30px;
  padding: 6px 12px;
  color: #f8f8f8;
  
}

.card_title {
  font-weight: bold;
  
}

.card_content {
  position: absolute;
  
  left: 0;
  bottom: 0;
    /* edit the width to fit card */
  width: 100%;
  padding: 20px;
background-color: #05002f;
  color:white;
  border-top-left-radius: 20px;
    /* edit here to change the height of the content box */
  transform: translateY(80px);
  transition: transform .5s;
}

.card_content::before {

  content: '';
  position: absolute;
  
  top: -47px;
  right: -45px;
  width: 100px;
  height: 100px;
  transform: rotate(-175deg);
  border-radius: 50%;
  box-shadow: inset 48px 48px  #05000000;
;
}

.card_title {
  color: white;
  line-height: 15px;
}

.card_subtitle {
 text-align:end;
  display: block;
  font-size: 15px;
  
  
  margin-bottom: 10px;
  
}

.card_description {

  font-size: 14px;
  opacity: 0;
  
  transition: opacity .5s;
}

.card:hover .card_content {

  transform: translateY(10);
  
}

.card:hover .card_description {

  opacity: 1;
  transition-delay: .25s;
  
}
img{
    margin-right:50px;
}
    </style>
    <title>بحث عن سيارة</title>
    
    
</head>
<body class="bg-dark text-light">
  <div class="topnav">
   <a href="main.php">الصفحة الرئيسية</a>
 
  <a href="logout.php">تسجيل الخروج</a>
    </div>
    <div class="container">
     
      <div class="row justify-content-between ">
        <div class="col m-5 col-md-3">
              <form class="" action="carserch.php" method="POST">
              <div class="row ">
                <div class="col-12">
                  <label class="form-label" for="name">رقم السيارة</label><br>
                  
                <input class=" rtl-input"  type="text" name="number"  >
                
                </div>

               
                <div class="col-12"></div>
              <div class="col-4">
                                <input class="btn btn-outline-primary sub " type="submit" name="sub" value="ابحث">

            </div>
            </form>
        </div>
      </div>
      
                    <!-- <div class="container">
                        <div class="row justify-conent-center">
                            <div class="col-4"></div>
                        </div>
                    </div> -->
          
           
        

    
        <div class="col m-5 col-md-5  car">
    <?php
     if (isset($_POST["sub"])) {
        if(!$empty){
     if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
     echo "
       
            <div class='col-4 '>
<article class='card text-end' >
    <div class='temporary_text'>
        رقم السيارة: ".$row["car_number"]."
    </div>
<div class='card_content'>
    <span class='card_title text-end'> نوع السيارة:".$row["type_of_car"]."</span>
        <span class='card_subtitle text-end'>لون السيارة ".$row["color"].",  الموديل ".$row["model"] . " هل يوجد مخالفات:".$row["Violated"]."</span>
        <p class='card_description text-end'";
        
      
      $connCriminal = new mysqli("localhost", "root", "", "ssedb");
   $stmtCriminal = $connCriminal->prepare("SELECT namec, age, Identification_number,img FROM criminal WHERE Identification_number = ?");
   $stmtCriminal->bind_param("i", $row["awner"]);
   $stmtCriminal->execute();
   $resultCriminal = $stmtCriminal->get_result();
   if($resultCriminal->num_rows==0){
    echo "<p>لا يوجد معلومات عن صاحب السيارة</p><br>";
   }
   else{

// Display criminal information
while ($rowCriminal = $resultCriminal->fetch_assoc()) {
    
    echo "Age: " . $rowCriminal["age"] . "<br>";
    echo "  <span class='card_title'>معلومات المالك</span> <br>";
    echo "رقو الهوية: " . $rowCriminal["Identification_number"] . "<br>";
    echo "اسم صاحب السيارة: " . $rowCriminal["namec"] . "<br>";
    echo "العمر: " . $rowCriminal["age"] . "<br>";
    echo "صورة المالك:  <img class='text-start ml-4 d-inline-block' src='" . $rowCriminal["img"] . " 'height='100'><br>";
    
}
   }
        }




        echo "</p>
    
</div>
</article>

 </div>
       

     
     
     ";
    
    
      }

 else {
    echo"<br><br><br>";
    echo "<h1 class='text-danger m-3 text-center'>لا توجد نتيجة</h1>";
}
}
else{
        echo"<br><br><br>";

        echo "<h1 class='text-danger m-3 text-center'>الرجاء ادخال رقم السيارة</h1>";

}
}
        
    ?>
 </div>
    </div>


</body>
</html>