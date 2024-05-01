<?php

session_start();

if (isset($_SESSION['ID'])) {
    header('location: view.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
</head>
<body>
    <form action="" method="POST">

                <input id="firstval" type="text" name="name" value="" placeholder="Name"><br>

                <input id= "secondval" type = "date" name ="birth" placeholder="Birthdate"><br>

                <input id="thirdval" type="text" name="eml" value="" placeholder="Username"><br>

                <input id="fourthval" type="password" name="pass" value="" placeholder="Password"><br>

        <button id="bttn" type="submit" name="btn"> SUBMIT </button>
        <br>
        
</form>
<a href="login.php" ><button id="bttn" type="submit" name="btn"> LOG IN </button></a>   
</body>
</html>

<?php

include ('db.php');

    if (isset($_POST['btn'])) {

        $name = $_POST['name'];
        $birth = $_POST['birth'];
        $user = $_POST['eml'];
        $pass = $_POST['pass'];

        $match = mysqli_query($conn, "SELECT * FROM accounts WHERE id = '$user'");

        if ($name != null && $birth != null && $user != null && $pass != null) {
            if ($user != $match) {
            echo "
            <script>
            alert ('Success');
            document.location.href='login.php';
            </script>";

            mysqli_query($conn, "INSERT INTO accounts(Name, Birthdate, Username, Password)  VALUES('$name', '$birth', '$user', '$pass')"); 
            }
        } else {
            echo "
            <script>
            alert ('You need to complete the form');
            document.location.href='index.php';
            </script> ";
        }
    }

?>
