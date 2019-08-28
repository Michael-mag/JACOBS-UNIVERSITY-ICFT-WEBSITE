<?php
//define variables to set empty values
$nameErr = $emailErr = $surnameErr = $positionErr = $nationalityErr = "";
$name = $surname = $position = $nationality = $email = "";

$output = "";
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



if($_SERVER["REQUEST_METHOD"] == "POST"){
  //name check

  if(empty($_POST["name"])){
    $output .= nl2br("Name is required\n");
  }else{
    $name = test_input($_POST["name"]);
    //check if name contains only letters and white spaces
    //if(!preg_match("/^[a-zA-Z ]*$/",$name)){
    //  $nameErr = "Only letters and white spaces allowed";
    //}
  }

  echo $nameErr ;

  //email check
  if(empty($_POST["email"])){
      $output .= nl2br("Email address is required\n");
  }else{
    $email = test_input($_POST["email"]);
    //check if email address is a proper email address
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      $output .= nl2br("Email address is invalid\n");
    }
  }

  //surname
  if(empty($_POST["surname"])){
    $output .= nl2br("Surname is required\n");
  }else{
    $surname = test_input($_POST["surname"]);
    //check if name contains only letters and white spaces
    // if(!preg_match("/^[a-zA-Z]*$/",$surname)){
    //   $surnameErr = "Only letters and white spaces allowed";
    // }
  }

  //nationality
  if(empty($_POST["nationality"])){
    $output .= nl2br("Nationality is required\n");
  }else{
    $nationality = test_input($_POST["nationality"]);
    //check if name contains only letters and white spaces
    // if(!preg_match("/^[a-zA-Z]*$/",$nationality)){
    //   $nationalityErr = "Only letters and white spaces allowed";
    // }
  }

  //position
  if(empty($_POST["position"])){
    $output .= nl2br("Position is required\n");
  }else{
    $position = test_input($_POST["position"]);
  }
//checks complete
}

//print the data on the page
session_start();
$_SESSION['status'] = 0;
if(!$output){
    //insert the data into the database

    //establish a connection to the database
    require("config.php");
    $result = $conn->query("SELECT * FROM Players P WHERE P.Email = '$email'");
    if ($result->num_rows == 0){
      $sql = "INSERT INTO Players (Name,Surname,Email,Nationality,Position) VALUES ('$name','$surname','$email','$nationality','$position');";
      if ($conn->query($sql) === TRUE){
        $output .= nl2br("\n Welcome <b> $name $surname </b>, to ICFT 2019.\n\n YOUR REGISTRATION WAS SUCCESSIFULL ");
        $_SESSION['status'] = 1;
      
      }else{
        $output .= nl2br("Error registering: Please try again later or contact us \n ");
      }
    }else{
      $output .= nl2br("Email address <b>$email</b> Already in use");
    }
    $conn->close();
}

$_SESSION['serverout'] = $output;
header('Location: form.php'); 

