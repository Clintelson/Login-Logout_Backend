<?php
session_start();

if (!isset($_SESSION['ID'])) {
    header('location: login.php');
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
</head>
<body>

<?php

include ("db.php");

$view = mysqli_query($conn, "SELECT * FROM accounts");

// if ($_SESSION['ID'] != 91) {
//     header('location: main.php');
// }

?>

<center>

<table style = " text-align: center;" width="50%" height="80px" border="1">
    <tr>
    <th> Select All <input type="checkbox" id="selectAll"></th>
    <th> Name </th>
    <th> Birthdate </th>
    <th> Username </th>
    <th> Password </th>
    <th colspan="3"> Action </th>
</tr>
<?php

while($row = mysqli_fetch_array($view)) {

        $id = $row['ID'];
        $name = $row ['Name'];
        $birth = $row ['Birthdate'];
        $user = $row ['Username'];
        $pass = $row ['Password'];
?>

<tr style = "border: 1px solid;">

    <td><input type="checkbox" name="check[]" value="<?php echo $id ?>"></td>
    <td><?php echo $name ?></td>
    <td><?php echo $birth ?></td>
    <td><?php echo $user ?></td>
    <td><?php echo $pass ?></td> 

    <td>
        <a href="update.php?update=<?php echo $id ?>"><button name = "Update"> Update </button></a>
    </td>

    <td>
    <form action = " " method = "POST">
        <input type ="hidden" name = "del" value = "<?php echo $id ?>">    
        <button type = "submit" name = "Delete"> Delete </button>
    </form>
    </td>

</tr>


<?php
}
?>

</table>
<br><br>

<form action="" method="POST">
    <button type="submit" name="dltAll"> Delete </button>
</form>

<br>

<a href = "logout.php"><button name="logout">logout</button></a>

</center>

<script>
document.querySelector('#selectAll').addEventListener('click', function () {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = this.checked;
    }
});
</script>

<?php 

    //Delete function

    if(isset($_POST['Delete'])) {

        $id = $_POST['del'];
  
        $del = mysqli_query($conn,"DELETE FROM accounts WHERE id ='$id'");

        if($del) {
            echo "<script>
            alert ('Success');
            document.location.href='view.php';
            </script>"; 

        } else {
           echo"<script>
            alert ('failed');
            document.location.href ='view.php';
            </script>";         

        }
    } 
        // Delete marked

        if (isset($_POST['dltAll'])) {
            $id = $_POST['check'];
        
            if (is_array($id)) {
                foreach ($id as $del_id) {
                    $check = mysqli_query($conn, "DELETE FROM accounts WHERE id = '$del_id'");
        
                    if ($check) {
                        echo "<script>
                        alert('Success');
                        document.location.href='view.php';
                        </script>";
        
                    } else {
                        echo "<script>
                        alert('failed');
                        document.location.href ='view.php';
                        </script>";
                    }
                }
            } else {
                echo "<script>
                alert('No rows selected');
                document.location.href='view.php';
                </script>";
            }
        }
        

?>

</body>
</html>