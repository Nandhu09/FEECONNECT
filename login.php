<!DOCTYPE html>
<html>
<head>
  <title>Slide Navbar</title>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      display: flex;
	  justify-content: center;
      align-items: center;
      min-height: 100vh;
      font-family: 'Jost', sans-serif;
      background: linear-gradient(
        -90deg,
        #c7c4c4 0%,
        #e0dfdf 50%,
        rgb(119, 179, 109) 30%,
        rgb(38, 76, 16) 80%
      );
    }

    .left-section {
      width: 45%; /* Reduced width for the image section */
	  height: 90vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: url('https://www.mkce.ac.in/img/whymkce2.jpg') no-repeat center center;
      background-size: cover;
      border-radius: 10px;
	  margin-right: 14%;
	  margin-left: 2.5%;
    }

    .main {
      flex: 1;
      max-width: 450px;
      height: 500px;
      overflow: hidden;
      background-color: rgb(92, 157, 80);
      border-radius: 10px;
      box-shadow: 5px 20px 50px #000;
      margin-right: 12%;
    }

    #chk {
      display: none;
    }

    .signup {
      position: relative;
      width: 100%;
      height: 100%;
    }

    label {
      color: #fff;
      font-size: 2.0em;
      justify-content: center;
      display: flex;
      margin: 50px;
      font-weight: bold;
      cursor: pointer;
      transition: .5s ease-in-out;
    }

    input {
      width: 60%;
      height: 10px;
      background: #e0dede;
      justify-content: center;
      display: flex;
      margin: 30px auto;
      padding: 12px;
      border: none;
      outline: none;
      border-radius: 5px;
    }

    button {
      width: 66%;
      height: 40px;
      margin: 10px auto;
      justify-content: center;
      display: block;
      color: #fff;
      background: #b2d0a9;
      font-size: 1em;
      font-weight: bold;
      margin-top: 38px;
      outline: none;
      border: none;
      border-radius: 5px;
      transition: .2s ease-in;
      cursor: pointer;
    }

    button:hover {
      background: linear-gradient(
        60deg,
        #c7c4c4 0%,
        #e0dfdf 20%,
        rgb(119, 179, 109) 30%,
        rgb(38, 76, 16) 100%
      );
    }

    .login {
      height: 460px;
      background: #eee;
      border-radius: 60% / 10%;
      transform: translateY(-180px);
      transition: .8s ease-in-out;
    }

    .login label {
      color: rgb(85, 130, 77);
      transform: scale(.6);
    }

    #chk:checked ~ .login {
      transform: translateY(-500px);
    }

    #chk:checked ~ .login label {
      transform: scale(1);
    }

    #chk:checked ~ .signup label {
      transform: scale(.6);
    }
  </style>
</head>
<body>
  <div class="left-section"></div>

  <div class="main">  	
    <input type="checkbox" id="chk" aria-hidden="true">

    <div class="signup">
      <form>
        <label for="chk" aria-hidden="true">Faculty</label>
        <input type="username" name="username" placeholder="Username" required="">
        <input type="password" name="pswd" placeholder="Password" required="">
        <button>Submit</button>
      </form>
    </div>

    <div class="login">
      <form>
        <label for="chk" aria-hidden="true">Student</label>
        <input type="registerno" name="registerno" placeholder="Register No" required="">
        <input type="password" name="pswd" placeholder="Password" required="">
        <button>Submit</button>
      </form>
    </div>
  </div>
</body>
</html>

<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
</html>
<?php
include("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_type = $_POST['login_type'];
    $myusername = mysqli_real_escape_string($db, $_POST['regno']);
    $mypassword = mysqli_real_escape_string($db, $_POST['pass']);

    // Determine the table and redirect page based on login type
    if ($login_type == "student") {
        $sql = "SELECT * FROM stu_data WHERE regno = '$myusername' and password = '$mypassword'";
        $redirect_page = "home.php";
    } elseif ($login_type == "staff") {
        $sql = "SELECT * FROM staff WHERE regno = '$myusername' and password = '$mypassword'";
        $redirect_page = "staff_home.php";
    } else {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Failure',
                text: 'Invalid login type!'
            }).then(function () {
                window.location = "index.php";
            });
        </script>
        <?php
        exit;
    }

    $result = mysqli_query($db, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['login_user'] = $myusername;
        ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Login Successful'
            }).then(function () {
                window.location = "<?php echo $redirect_page; ?>";
            });
        </script>
        <?php
    } else {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Failure',
                text: 'Check login credentials'
            }).then(function () {
                window.location = "index.php";
            });
        </script>
        <?php
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FeeConnect</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <section id="login">
        <h2>Student Login</h2>
        <form id="studentloginform" action="index.php" method="post">
            <input type="hidden" name="login_type" value="student">
            <input type="text" name="regno" id="regno_student" placeholder="Register Number" required>
            <input type="password" name="pass" id="pass_student" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <br>
    </section>
    <section id="login">
        <h2>Staff Login</h2>
        <form id="staffloginform" action="index.php" method="post">
            <input type="hidden" name="login_type" value="staff">
            <input type="text" name="regno" id="regno_staff" placeholder="Register Number" required>
            <input type="password" name="pass" id="pass_staff" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </section>
    <script src="scripts.js"></script>
</body>
</html>
