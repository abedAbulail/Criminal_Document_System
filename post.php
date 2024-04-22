<?php
session_start();
if ($_SESSION['login'] != true) {
    header("location: index.php");
}

date_default_timezone_set("Asia/Hebron"); // Set the timezone to Nablus

if (isset($_POST["postsub"])) {
    $date = date("Y-m-d"); // Get the current date
    $time = date("H:i"); // Get the current time
    $text = $_POST["text"];
    $targetFile = "";
    $uploadOk = 1;
     $em=false;
    if(!empty($text)){
         $em=false;

    if (!empty($_FILES["image"]["name"])) {
         $targetDirectory = "uploads/"; // Specify your target directory
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

     

   



        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // echo "Sorry, your file was not uploaded.";
        } else {
            // Try to move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                // echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";

                // Now you can use $targetFile in your database query or other processing
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    
        // Your image validation code here

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // Your image upload code here

            $conn = new mysqli("localhost", "root", "", "ssedb");
            $stmt = $conn->prepare("INSERT INTO post(post_date, post_time, post_text, imagee) VALUES(?, ?, ?, ?)");
            $stmt->bind_param("ssss", $date, $time, $text, $targetFile);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }
    } else {
        $conn = new mysqli("localhost", "root", "", "ssedb");
        $stmt = $conn->prepare("INSERT INTO post(post_date, post_time, post_text) VALUES(?, ?, ?)");
        $stmt->bind_param("sss", $date, $time, $text);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
}
}
else{
    $em=true;
}



if (isset($_POST["deletePost"])) {
    $id = $_POST["postId"];
    // Handle the deletion of the post based on the postId
    $conn = new mysqli("localhost", "root", "", "ssedb");
    $stmt = $conn->prepare("DELETE FROM post WHERE id=?");
    $stmt->bind_param("i", $id); // Bind the parameter correctly
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .topnav {
            overflow: hidden;
            display: flex;
            background-color: #333;
            justify-content:flex-end;
        }

        .topnav a {
            float:none;
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
            background-color: #002e0a;
            color: white;
        }

        .hide {
            display: none;
        }

        .carddd {
            border: 3px rgb(48,82,82) solid;
            border-radius: 100px;
            width: 120%;
            
        }

        .form-label {
            text-align: right;
            width: 100%;
            display: block;
        }

        .rtl-input {
            direction: rtl;
        }

        .postes {
            margin-top: 10px;
            border-radius: 10px;

            background-color:rgb(48,82,82);
        }

        button {
            margin-top: 50px;
        }

        .posttext {
            max-width: 400px;
            min-width: 100px;
            height: 100%;
        }

        .dist {
            width: 100%;
            height: 50px;
        }

        .posttext p {
            padding: 10px;
            margin: 5px;
            word-wrap: break-word;
                        text-align: right;

        }

        .date {
            font-size: 14px;
            margin-top: -10px;
        }
        .area{
            background-color:rgb(48,82,82);
            color:white;
            direction:rtl;
        }
        .fileimg{
            background-color:rgb(48,82,82);
            color:white;
            direction:rtl;



        }
        .h1{
            margin-top:60px ;
        }
    </style>
   <script>
 document.addEventListener('DOMContentLoaded', function () {
    var deleteButtons = document.querySelectorAll('button[name="delete"]');
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var postId = this.closest('.postes').querySelector('h1[name="id"]').innerText;
            if (confirm('Are you sure you want to delete this post?')) {
                console.log('Deleting post with ID:', postId);

                // Create a form element
                var form = document.createElement('form');
                form.method = 'post';
                form.action = 'post.php'; // Replace 'your-action-url' with the actual URL or filename

                // Create an input element for postId
                var inputId = document.createElement('input');
                inputId.type = 'hidden';
                inputId.name = 'postId';
                inputId.value = postId;

                // Create an input element for deletePost
                var inputDelete = document.createElement('input');
                inputDelete.type = 'hidden';
                inputDelete.name = 'deletePost';
                inputDelete.value = '1'; // Set a value to indicate deletion

                // Create a submit button
                var submitButton = document.createElement('input');
                submitButton.type = 'submit';
                submitButton.style.display = 'none';

                // Append elements to the form
                form.appendChild(inputId);
                form.appendChild(inputDelete);
                form.appendChild(submitButton);

                // Append the form to the document body
                document.body.appendChild(form);

                // Submit the form
                form.submit();
            }
        });
    });
});

</script>

    <title>المنشورات</title>
</head>
<body class="bg-dark text-light">
    <div class="topnav">
        <a href="logout.php">تسجيل الخروج</a>
        <a href="main.php">الصفحة الرئيسية</a>
        
    </div>

    <div class="container ">
        <div class="row">
            <div class="col-7">
                <div class="dist">
                    <h1 class="text-center text-danger h1">المنشورات</h1>

                </div>
                <?php
                $conn = new mysqli("localhost", "root", "", "ssedb");
                $stmt = $conn->prepare("SELECT * FROM post  ORDER BY id DESC ");
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        echo "
                        <div class='row postes'>
                            <div class='col text-light'>
                                <div class='row'>
                                 <div class='col-3'>
                                        <button name='delete' class='btn btn-outline-danger'>حذف</button>
                                    </div>
                                  
                                    <div class='col-6'>
                                        <div class='posttext'>
                                            <p>" . $row["post_text"] . "</p>
                                        </div>
                                    </div>
                                    <div class='col-3'>
                                        <div class='post'>
                                            <h1 class='text-end' name='id'>" . $row["id"] . "</h1>
                                            <p class='date text-end'>التاريخ:" . $row["post_date"] . "</p>
                                            <p class='date text-end'>الوقت:" . $row["post_time"] . "</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    }
                }
                ?>
            </div>
            <div class="col-5">
                <div class="container">
                    <div class="text-center mt-5 bg-dark">
                        <h1>اضافة منشور</h1>
                    </div>

                    <div class="row bg-dark">
                        <div class="col-lg-12 mx-auto bg-dark carddd">
                            <div class="card mt-2 mx-auto p-4 bg-dark">
                                <div class="card-body bg-dark text-dark">
                                    <form class="bg-dark text-light" id="contact-form" role="form" action="post.php" method="POST" enctype="multipart/form-data">
                                        <div class="row bg-dark">
                                            <div class="col-12 bg-dark">
                                                <div class="form-group bg-dark">
                                                    <label for="form_lastname" class="form-label">صورة *</label>
                                                    <input id="form_lastname" type="file" name="image" class="form-control fileimg" placeholder="اختر ملف الصورة">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="form_lastname" class="form-label">نص المنشور *</label> <br>
                                                    <textarea class="area" name="text" cols="50%" rows="12"></textarea>
                                                </div>
                                            </div>
                                            <div class="row justify-content-end">
                                                <div class="col-2 bg-dark">
                                                    <input class="btn btn-outline-primary text-end m-3" type="submit" name="postsub" value="نشر">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($_POST["postsub"])) {
                                    if(empty($text)){
                                 echo "<h5 class='text-danger text-center m-1'>تحتاج على الاقل نص للمنشور</h5>";
                                    }
                                }
?>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>
