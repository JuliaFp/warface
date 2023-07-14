<?php
    
$showAlert = false; 
$showError = false; 
$exists=false;
    

      
    // Include file which makes the
    // Database Connection.
    include 'bd.php';   


    
    $email = $_POST["email"]; 
    $password = $_POST["psw"]; 
    $cpassword = $_POST["psw-repeat"];
            
    
    $sql = "Select * from reg where email='$email'";
    $sql = "Select * from reg where pass='$password'";
    $sql = "Select * from reg where repass='$cpassword'";
    
    $result = mysqli_query($conn, $sql);
    
    $num = mysqli_num_rows($result); 
    
    // This sql query is use to check if
    // the username is already present 
    // or not in our Database
    if($num == 0) {
        if(($password == $cpassword) && $exists==false) {
    

                
            // Password Hashing is used here. 
            $sql = "INSERT INTO `reg` ( `email`, 
                `pass`, `repass`) VALUES ('$email', 
                '$password', $cpassword)";
    
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
                $showAlert = true; 
            }
        } 
        else { 
            $showError = "Passwords do not match"; 
        }      
    }// end if 
    
   if($num>0) 
   {
      $exists="Username not available"; 
   } 
   //end if   
    
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
        crossorigin="anonymous">
    <link rel="stylesheet" href="logo.css">
    <link rel="stylesheet" href="card.css">
    <link rel="stylesheet" href="regist.css">

   
    <title>Warface</title>
</head>
    
<body>
    
<?php
    
    if($showAlert) {
        header('Refresh:5; url=../index.html');


    
        echo ' <div class="alert alert-success 
            alert-dismissible fade show" role="alert">
    
            <strong>Success!</strong> Your account is 
            now created and you can login. 
            Регистрация успешно завершена. Через 5 секунд вернёшься на главную...

            '; exit;
    }
    
    if($showError) {
    
        echo ' <div class="alert alert-danger 
            alert-dismissible fade show" role="alert"> 
        <strong>Error!</strong> '. $showError.'
    
         '; 
   }
        
    if($exists) {
        echo ' <div class="alert alert-danger 
            alert-dismissible fade show" role="alert">
    
        <strong>Error!</strong> '. $exists.'
  '; 
     }
?>
  </body>
</html>