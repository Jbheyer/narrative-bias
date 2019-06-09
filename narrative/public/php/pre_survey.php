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


if (!isset($_POST['pre_survey_values'])) {

    echo "error";
    exit(0);
}

    include 'connect.php';

    unset($_SESSION['error']);
    $survey_values = $_POST['pre_survey_values'];
    $user_id =  strval($_SESSION['user']);

    $query= array();
    $count = 1;

    foreach( $survey_values as $survey_value ) {

        $query[] = '("'.$survey_value.'", "'.$user_id.'",'.$count. ')';
        $count = $count + 1;
    }
    if(mysqli_query($conn,'INSERT INTO survey_response (question_response, user_id, question_id) VALUES '.implode(',', $query)))
    {

        if(($_SESSION['condition']) == "vis_only")
        {
            $_SESSION['status'] = 'VO';
            $_SESSION['tasks'] = array('0');
            echo "vis_only";
        }
        if(($_SESSION['condition']) == "text_only")
        {
            $_SESSION['status'] = 'RO';
            $_SESSION['tasks'] = array('0');
            echo "text_only";
        }

        if(($_SESSION['condition']) == "predict_text_only")
        {
            $_SESSION['status'] = 'PT';
            $_SESSION['tasks'] = array('0');
            echo "predict_text_only";
        }

        if(($_SESSION['condition']) == "predict_graph_only")
        {
            $_SESSION['status'] = 'PG';
            $_SESSION['tasks'] = array('0');
            echo "predict_graph_only";
        }


    }
    else
    {
        echo mysqli_error($conn);
        echo "error";
    }
    mysqli_close($conn);
?>