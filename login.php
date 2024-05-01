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
    <title>Document</title>
</head>
<body>
    <form action = "" id="form" method="POST">
    
            <input id="email" type="text" name="eml" placeholder="Username" required> <br>
            
            <input id="password" type="password" name="pass" placeholder="Password" required> <br>
    
            <button id="bttn" type="submit" name="submit">Log in</button>
    </form>
    <a href="index.php" ><button id="bttn" type="submit" name="btn"> Sign up </button></a>   
</body>
</html>
<?php

include('db.php');

if (isset($_POST['submit'])) {

    $user = $_POST['eml'];
    $pass = $_POST['pass'];

    $login = mysqli_query($conn, "SELECT * FROM accounts WHERE Username='$user' AND Password ='$pass'");

    $data = mysqli_fetch_array($login);

    if($data) {
        $_SESSION['ID'] = $data['ID'];
        
        header('location: view.php');

    } else {
        echo"
        <script>
        alert('Wrong username or password');
        document.location.href='login.php';
        </script>       
        ";
        
    }
}

?>

