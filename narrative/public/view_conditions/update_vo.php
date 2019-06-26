<?php
session_start();
if (!isset($_SESSION['user']))
{
    echo "user_error";
    exit(0);
}

if (!isset($_SESSION['status']))
{
    echo "status_error";
    exit(0);
}


include '../php/connect.php';


if( $_POST['type'] == 'interactionText' || $_POST['type'] == 'synText' || $_POST['type'] == 'brain_interactionText'|| $_POST['type'] == 'bottle_interactionText' || $_POST['type'] == 'hiv_interactionText' || $_POST['type'] == 'disposed_interactionText') {
    $sql = "SELECT user_id from narrative_response where user_id=" . $_SESSION['user'] . " and narrative_condition='" . $_SESSION['status'] . "' and theme='" . $_POST['theme'] . "' ";
    $result = mysqli_query($conn,$sql);
    $rowcount=mysqli_num_rows($result);

    mysqli_free_result($result);

    $array_tasks = $_SESSION['tasks'];

    if($_POST['theme']=='ARREST')
    {
        array_push($array_tasks,ARREST);
    }

    if($_POST['theme']=='OUD')
    {
        array_push($array_tasks,OUD);
    }

    if($_POST['theme']=='SSP')
    {
        array_push($array_tasks,SSP);
    }


    echo $rowcount,$_POST['theme'];

    if ($rowcount == 0) {


        $interactionText = mysqli_real_escape_string($conn, $_POST['interactionText']);
        if($_POST['type'] == 'interactionText')
        {
            if (isset($_POST['predictValue1']) && isset($_POST['predictValue2']))
            {
                $sql = "INSERT INTO narrative_response (user_id, narrative_condition,theme, e1, p1, p2) VALUES (" . $_SESSION['user'] . ", '" . $_SESSION['status'] . "',  '" . $_POST['theme'] . "', '" . $interactionText . "', " . $_POST['predictValue1'] . ", " . $_POST['predictValue2'] . ")";

            }
            else{
                $sql = "INSERT INTO narrative_response (user_id, narrative_condition,theme, e1) VALUES (" . $_SESSION['user'] . ", '" . $_SESSION['status'] . "',  '" . $_POST['theme'] . "', '" . $interactionText . "')";

            }


        }
        if($_POST['type'] == 'brain_interactionText' || $_POST['type'] == 'hiv_interactionText')
        {
            if (isset($_POST['predictValue1']))
            {
                $sql = "INSERT INTO narrative_response (user_id, narrative_condition,theme, e1, p1) VALUES (" . $_SESSION['user'] . ", '" . $_SESSION['status'] . "',  '" . $_POST['theme'] . "', '" . $interactionText . "', " . $_POST['predictValue1'] . ")";

            }
            else{
                $sql = "INSERT INTO narrative_response (user_id, narrative_condition,theme, e1) VALUES (" . $_SESSION['user'] . ", '" . $_SESSION['status'] . "',  '" . $_POST['theme'] . "', '" . $interactionText . "')";

            }

        }
        if($_POST['type'] == 'bottle_interactionText' || $_POST['type'] == 'disposed_interactionText')
        {

            if (isset($_POST['predictValue2']))
            {
                $sql = "INSERT INTO narrative_response (user_id, narrative_condition,theme, e2, p2) VALUES (" . $_SESSION['user'] . ", '" . $_SESSION['status'] . "',  '" . $_POST['theme'] . "', '" . $interactionText . "', " . $_POST['predictValue2'] . ")";
            }
            else
            {
                $sql = "INSERT INTO narrative_response (user_id, narrative_condition,theme, e2) VALUES (" . $_SESSION['user'] . ", '" . $_SESSION['status'] . "',  '" . $_POST['theme'] . "', '" . $interactionText . "')";

            }

        }
        if($_POST['type'] == 'synText')
        {
            $sql = "INSERT INTO narrative_response (user_id, narrative_condition,theme, syn) VALUES (" . $_SESSION['user'] . ", '" . $_SESSION['status'] . "',  '" . $_POST['theme'] . "', '" . $interactionText . "')";

        }
        echo $sql;
        if (mysqli_query($conn, $sql))
        {
            $last_id = mysqli_insert_id($conn);
            if($_POST['type'] == 'synText')
            {
                $_SESSION['tasks'] = $array_tasks;
            }
            echo "success";
        }
        else
        {
            echo mysqli_error($conn);

            echo "insert error";
        }

    } else {
        $interactionText = mysqli_real_escape_string($conn, $_POST['interactionText']);
        if($_POST['type'] == 'interactionText') {


            if (isset($_POST['predictValue1']) && isset($_POST['predictValue2']))
            {
                $sql = "Update  narrative_response set e1='" . $interactionText . "', p1=" . $_POST['predictValue1'] . ", p2=" . $_POST['predictValue2'] . " where user_id=" . $_SESSION['user'] . " and narrative_condition='" . $_SESSION['status'] . "' and  theme='" . $_POST['theme'] . "' ";

            }
            else
            {
                $sql = "Update  narrative_response set e1='" . $interactionText . "' where user_id=" . $_SESSION['user'] . " and narrative_condition='" . $_SESSION['status'] . "' and  theme='" . $_POST['theme'] . "' ";
            }
        }

        if($_POST['type'] == 'brain_interactionText' || $_POST['type'] == 'hiv_interactionText') {
            if (isset($_POST['predictValue1']))
            {
                $sql = "Update  narrative_response set e1='" . $interactionText . "', p1=" . $_POST['predictValue1'] . " where user_id=" . $_SESSION['user'] . " and narrative_condition='" . $_SESSION['status'] . "' and  theme='" . $_POST['theme'] . "' ";

            }
            else
            {
                $sql = "Update  narrative_response set e1='" . $interactionText . "' where user_id=" . $_SESSION['user'] . " and narrative_condition='" . $_SESSION['status'] . "' and  theme='" . $_POST['theme'] . "' ";

            }
        }
        if($_POST['type'] == 'bottle_interactionText' || $_POST['type'] == 'disposed_interactionText') {
            if (isset($_POST['predictValue2']))
            {
                $sql = "Update  narrative_response set e2='" . $interactionText . "', p2=" . $_POST['predictValue2'] . "  where user_id=" . $_SESSION['user'] . " and narrative_condition='" . $_SESSION['status'] . "' and  theme='" . $_POST['theme'] . "' ";

            }
            else
            {
                $sql = "Update  narrative_response set e2='" . $interactionText . "' where user_id=" . $_SESSION['user'] . " and narrative_condition='" . $_SESSION['status'] . "' and  theme='" . $_POST['theme'] . "' ";

            }
        }
        if($_POST['type'] == 'synText')
        {
            $sql = "Update  narrative_response set syn='" . $interactionText . "' where user_id=" . $_SESSION['user'] . " and narrative_condition='" . $_SESSION['status'] . "' and  theme='" . $_POST['theme'] . "' ";

        }
        echo $sql;
        if (mysqli_query($conn, $sql)) {
            if($_POST['type'] == 'synText')
            {
                $_SESSION['tasks'] = $array_tasks;
            }
            echo "success";
        } else {
            echo mysqli_error($conn);

            echo "update error";
        }
    }

    mysqli_close($conn);
}



?>