<?php
// require_once('../Ctrl/Register.php');
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
//   $controller = new RegistrationController();
//   $controller->loginUser(
//     $_POST['username'],
//     $_POST['password'],
//   );
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>حُر</title>
  <link href="../assets/css/signinup.css" rel="stylesheet" />

</head>
<style>
  body,
  html {
    height: 100%;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: var(--bg-color);
    /* Set the background color */
  }

  .logo-container {
    position: absolute;
    top: 30px;
    /* Adjust the top position as needed */
    text-align: center;
    width: 30%;
  }

  .logo {
    width: 100px;
    /* Adjust the size as needed */
  }

  .wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    width: 100%;
    max-width: 350px;
    margin-top: 90px;
    font-family: "Cairo", sans-serif;
  }

  body,
  html {
    font-family: "Cairo", sans-serif;

    height: 100%;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #e3e3e3
      /* Added a background color */
  }

  a {
    text-decoration: none;
    /* Remove underline */
    color: black;
    /* Set text color to black */
    font-weight: bolder;
  }

  /* Style for the link when hovered over */
  a:hover {
    text-decoration: none;
    /* Remove underline on hover */
    color: red;
    /* Set text color to red on hover */
    font-weight: bolder;

  }

  /* Style for the visited link */
  a:visited {
    color: rgb(192, 106, 0);
    /* Set text color to purple for visited links */
    font-weight: bolder;


  }
</style>

<body>
  <div class="logo-container">
    <img class="logo" src="../assets/Freedom 1080.png" alt="Freedom" style="width: 30%; fill:bisque;">
  </div>
  <form class="form" action="../Ctrl/Login.php" method="post">
    <div class="title">Welcome,<br><span>sign up to continue</span></div>
    <input class="input" name="username" placeholder="username" type="text">
    <input class="input" name="password" placeholder="Password" type="password">
    <a href="register.php"><span>Don't Have an Account ?<span>
          <br>
          <input type="submit" name="submit" value="Let`s go →" class="button-confirm"></input>
  </form>
</body>

</html>