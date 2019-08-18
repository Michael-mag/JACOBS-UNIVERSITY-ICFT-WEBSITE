<?php
//define variables to set empty values
$nameErr = $emailErr = $surnameErr = $positionErr = $nationalityErr = "";
$name = $surname = $position = $nationality = $email = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  //name check
  if(empty($_POST["name"])){
    $nameErr = "Name is required";
  }else{
    $name = test_input($_POST["name"]);
    //check if name contains only letters and white spaces
    if(!preg_match("/^[a-zA-Z]*$/",$name)){
      $nameErr = "Only letters and white spaces allowed";
    }
  }

  //email check
  if(empty($_POST["email"])){
      $emailErr = "Email is required.";
  }else{
    $email = test_input($_POST["email"]);
    //check if email address is a proper email address
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      $emailErr = "Invalid email address";
    }
  }

  //surname
  if(empty($_POST["surname"])){
    $surnameErr = "Name is required";
  }else{
    $surname = test_input($_POST["surname"]);
    //check if name contains only letters and white spaces
    if(!preg_match("/^[a-zA-Z]*$/",$surname)){
      $surnameErr = "Only letters and white spaces allowed";
    }
  }

  //nationality
  if(empty($_POST["nationality"])){
    $nationalityErr = "Nationality is required";
  }else{
    $nationality = test_input($_POST["nationality"]);
    //check if name contains only letters and white spaces
    if(!preg_match("/^[a-zA-Z]*$/",$nationality)){
      $nationalityErr = "Only letters and white spaces allowed";
    }
  }

  //position
  if(empty($_POST["position"])){
    $positionErr = "Position is required";
  }else{
    $position = test_input($_POST["position"]);
    //check if name contains only letters and white spaces
    if(!preg_match("/^[a-zA-Z]*$/",$position)){
      $positionErr = "Only letters and white spaces allowed";
    }
  }
//checks complete
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


//print the data on the page

if(!$nameErr){
  if(!$surnameErr){
    if(!$emailErr){
      if(!$nationalityErr){
        if(!$positionErr){
          //insert the data into the database

          //establish a connection to the database
          $host = "localhost";
          $dbusername = "ICFT2019";
          $dbpassword = "wePlay";
          $dbname = "JUB_ICFT";

          //create the connection
          $conn = new mysqli ($host,$dbusername,$dbpassword,$dbname);
          if(mysqli_connect_error()){
            die('Connect Error ('.mysqli_connect_errno() .')' . mysqli_connect_error());
          }else{
            echo nl2br("\n");
            $sql = "INSERT INTO Players (Name,Surname,Email,Nationality,Position)
            values('$name','$surname','$email','$nationality','$position')";
            if ($conn->query($sql) === TRUE){
              echo nl2br("\n Welcome $name $surname , to ICFT 2019.\n\n YOUR REGISTRATION WAS SUCCESSIFULL ");
            }else{
              echo "Error: ".$sql ."<br>".$conn->error;
            }
            $conn->close();
          }

          //data insertion finished
        }else{
          echo "No position";
        }
      }else{
        echo "No country";
      }
    }else{
      echo "No email";
    }
  }else{
    echo "No surname";
  }
}else{
  echo "No name";
}
