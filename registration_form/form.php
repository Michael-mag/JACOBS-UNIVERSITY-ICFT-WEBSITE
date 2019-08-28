<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>REGISTRATION FROM</title>
  </head>
  <body>
    <div class="body-content">
      <div class="module">
        <h1>Register to participate</h1>
        <form class="form" action="form_process.php" method="post" enctype="multipart/form-data" autocomplete="off">
          <?php
              session_start();
              if($_SESSION['status'] == 0){
                echo "<div class=\"alert alert-error\">";
                echo $_SESSION['serverout'];
                echo "</div>";
              }else{
                echo $_SESSION['serverout'];
              }
              unset($_SESSION);
              session_destroy();
          ?>
          <b> <br> All fields are require </b>
          <input type="text" placeholder="Name" name="name" required />
          <input type="text" placeholder="Surname" name="surname"  required/>
          <!-- <input type="text" placeholder="Nationality" name="nationality" required/> -->
          <!-- <input type="text" placeholder="Position" name="position" required /> -->
          <?php
          include("countries.html")
          ?>
          <br><br>
          <select name="position" type="text" required>
          <option value="" disabled selected>Position</option>
                <option value="Goal Keeper">Goal Keeper</option>
                <option value="Defender" >Defender</option>
                <option value="Midfielder">Midfielder</option>
                <option value="Forward">Forward</option>
            </select>
          <input type="email" placeholder="Email" name="email" required />
          <input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
        </form>
      </div>
    </div>
  </body>
</html>
