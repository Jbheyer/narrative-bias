<?php
session_start();
if (!isset($_SESSION['user']))
{
    echo "error";
    exit(0);
}

if (!isset($_SESSION['status']))
{
    echo "error";
    exit(0);
}



include 'connect.php';

    unset($_SESSION['error']);

    $comments = mysqli_real_escape_string($conn, $_POST['comments']);
    $sql = "INSERT INTO comment (gender, age, education, freetext, userid) VALUES ('" . $_POST['gender'] . "','" . $_POST['age'] . "','" . $_POST['education'] . "','" . $comments . "', '" . $_SESSION['user'] . "')";

    if (mysqli_query($conn, $sql))
    {
        $last_id = mysqli_insert_id($conn);
	    $_SESSION['status'] = 'success';
        echo "success";

    }
    else
    {
    echo mysqli_error($conn);

    echo "error";
    }
    mysqli_close($conn);
?>