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


if (!isset($_POST['post_survey_values'])) {

    echo "error";
    exit(0);
}

    include 'connect.php';

    unset($_SESSION['error']);
    $survey_values = $_POST['post_survey_values'];
    $user_id =  strval($_SESSION['user']);

    $query= array();
    $count = 17;

    foreach( $survey_values as $survey_value ) {

        $query[] = '("'.$survey_value.'", "'.$user_id.'",'.$count. ')';
        $count = $count + 1;
    }
    if(mysqli_query($conn,'INSERT INTO survey_response (question_response, user_id, question_id) VALUES '.implode(',', $query)))
    {

        echo "success";

    }
    else
    {
        echo mysqli_error($conn);
        echo "error";
    }
    mysqli_close($conn);
?>