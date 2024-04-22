<?php

session_start();
if($_SESSION['login']!=true){
  header("location: index.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
      <link rel="stylesheet" href="styles/test.css">
     
    <title>الصفحة الرئيسية</title>
    <style>
      .active{
            background-color: #000b2e;

      }
      .post{
        margin-bottom:400px;
      }
      .in{
        float:right;
      }
      .out{
         float: left;
      }
      .nav{
        width:1000px
      }
   
    </style>
</head>
<body class="bg-dark text-light ">


    <div class="topnav">
  <a class="active" href="#home">الصفحة الرئيسية</a>
  <a class="in" href="serch.php">بحث مجرم</a>
  <a class="
                 <?php
                  if($_SESSION["role"]!="admin"){
                   echo "hide";
                  
                    }
                 
                   ?>
   in" href="addOrDeleteS.php">الضابط</a>
  <a class="
  <?php
  if($_SESSION["role"]!="supervisor"){
    echo "hide";
  }
  ?>
   in" href="crime.php">اضافة مجرم</a>
       <a class="
  <?php
  if($_SESSION["role"]!="supervisor"){
    echo "hide";
  }
  ?>
   in" href="edit.php">تعديل المجرم</a>
    <a class="
  <?php
  if($_SESSION["role"]!="supervisor"){
    echo "hide";
  }
  ?>
   in" href="car.php">اضافة سيارة</a>
    <a class="
  <?php
  if($_SESSION["role"]!="supervisor"){
    echo "hide";
  }
  ?>
   in" href="delete.php">حذف سيارة</a>

    <a class="
  <?php
  if($_SESSION["role"]!="supervisor"){
    echo "hide";
  }
  ?>
   in" href="deletecrime.php">حذف مجرم</a>
   
  <a class="
                                      <?php
                  if($_SESSION["role"]=="admin"){
                  
                    }
                    else{
                       echo "hide";
                    }
                   ?>
                    in" href="post.php">منشور</a>

<a class="in" href="carserch.php"> بحث سيارة</a>

  <a class="out bg-danger" href="logout.php">تسجيل الخروج</a>
</div>
  <div class="main">
    <div class="container">
      <div class="row">
        <div class="col col-12 top">
          <div class="typewriter">
           <h1>Welcome to police website <br>
            اهلا وسهلا بكم في موقعنا البحث الجنائي
           </h1>
            
        </div>
        </div>

        <div class="col col-3 end">
            <!-- <h2>Empowering Safety:[ <span class="text-primary">City</span>] Police Official Website  </h2> -->
            
        </div>
        <div class="col-md-9 end">
         

        <div class="nav">
             <a class="btn btn-outline-primary m-3
  <?php
  if($_SESSION["role"]!="supervisor"){
    echo " hide";
  }
  ?>
  " href="car.php">اضافة سيارة</a>
               <a class="btn btn-outline-primary m-3
  <?php
  if($_SESSION["role"]!="supervisor"){
    echo " hide";
  }
  ?>
  " href="car.php">تعديل المجرم</a>

      <a class="btn btn-outline-primary m-3 
  <?php
  if($_SESSION["role"]!="supervisor"){
    echo " hide";
  }
  ?>
  " href="delete.php">حذف سيارة</a>
        <a class="btn btn-outline-primary m-3 
  <?php
  if($_SESSION["role"]!="supervisor"){
    echo " hide";
  }
  ?>
  " href="deletecrime.php">حذف مجرم</a>
          <a class="btn btn-outline-primary m-3" href="carserch.php"> بحث سيارة</a>
           <a class="btn btn-outline-primary m-3" href="serch.php">بحث مجرم</a>
           <a class="
                                                 <?php
                  if($_SESSION["role"]=="admin"){
                    echo "btn btn-outline-primary m-3";
                  
                    }
                    else{
                       echo "hide";
                    }
                   ?>
          " href="addOrDeleteS.php">الضابط و شرطي</a>
           <a class="
                  <?php
                  if($_SESSION["role"]=="supervisor"){
                    echo " btn btn-outline-primary m-3";
                  
                    }
                    else{
                       echo "hide";
                    }
                   ?>
                    " href="crime.php">اضافة مجرم</a>

                    <a class="
                                      <?php
                  if($_SESSION["role"]=="admin"){
                    echo " btn btn-outline-primary m-3";
                  
                    }
                    else{
                       echo "hide";
                    }
                   ?>
                    " href="post.php">منشور</a>

                    <P class="text-danger">:المهام</P>
          </div>
        </div>
        
      </div>
    </div>


  </div>

  <div class="container">
   



   

      
       
       
   
    <div class="post">
      

      
     
      <?php
       $conn=new mysqli("localhost","root","","ssedb");
       //SELECT * FROM post ORDER BY id DESC LIMIT 1 "

      
       $stmt=$conn->prepare("SELECT * FROM post  ORDER BY id DESC  LIMIT 2");
        $stmt->execute();
       $res=$stmt->get_result();
       $i=0;
       while($row=$res->fetch_assoc()){
        echo "<div class='postitem'>";
         echo  "<h3 class='text-center m-3'>يقول المدير</h3>";
          echo  "<h5 class=' m-3'>".$row["post_text"]."</h5>";
          echo  "<image src='".$row["imagee"]." ' width='400px'></h5>";
           echo  "<p class=' m-3'>التاريخ ".$row["post_date"]."</p>";
          echo  "<p class=' m-3'>الوقت ".$row["post_time"]."</p>";
          echo "</div>";
       }
      ?>
      
      

    </div>

</div>
    </div>
     <div class="space">

       </div>
 
    <div class="contact">
      <div class="col-12">
        <div class=" header">
        
        
        </div>
      </div>
      </div>
     

      <div class="footer">
  <div class="container">
            <div class="row justify-content-center">
              <div class="col col-md-3">
                <h5 class="word text-end">عن الموقع</h5>
                <ul class="det">
                  <li >سهل التعلم</li>
                  <li>يوفر الكثير من الوقت</li>
                  <li>يحقق الامان في الوطن</li>
                </ul>

              </div>
              <div class="col col-md-3">
                <h5 class="word text-end">الخدمات التي نقدمها</h5>
                <ul class="det">
                  <li>اضافة مجرم</li>
                  <li>بحث عن مجرم</li>
                  <li>بحث عن لوحة سيارة</li>
                  
                </ul>
              </div>
              <div class="col col-md-3">
                <h5 class="word text-end">موقعنا</h5>
                <p class="smary">موقع لإدارة وتسهيل العمليات الشرطية في محاولة القبض على المجرم والبحث عن سيارة معينة والتعرف على المجرم</p>
            
              
              </div>
            </div>
          </div>
        </div>
     

      

 
     
    
     <script>
   // gsap.to()... infinity and beyond!
// For more check out greensock.com
let device_width = window.innerWidth;
if (device_width > 576) {
  let char_come = gsap.utils.toArray(".title-anim");

  char_come.forEach((char_come) => {
    let split_char = new SplitText(char_come, {
      type: "chars, words",
      lineThreshold: 0.5
    });
    const tl2 = gsap.timeline({
      scrollTrigger: {
        trigger: char_come,
        start: "top 90%",
        end: "bottom 60%",
        scrub: false,
        markers: false,
        toggleActions: "play none none none"
      }
    });
    tl2.from(split_char.chars, {
      duration: 0.8,
      x: 70,
      autoAlpha: 0,
      stagger: 0.03
    });
  });
}
     </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
        
        
       
</body>
</html>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
   <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="test.css">
    <title>Test Page</title>
</head>
</head>
<body>
<div class="main">Hello, World!</div>
</body>
</html> -->