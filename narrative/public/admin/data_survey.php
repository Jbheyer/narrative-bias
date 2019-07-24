<?php
session_start();


header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=result_file.csv");
header("Pragma: no-cache");
header("Expires: 0");

array_to_csv_download();
function array_to_csv_download($filename = "export.csv", $delimiter=";") {

        $servername = "localhost";

        $username = "nirmal";

        $password = "nirmal1989";

        $dbname = "narrative_bias";

    // Create connection
        $conn = mysqli_connect($servername, $username, $password,$dbname);

    // Check connection
        if (!$conn) {

            die("Connection failed: " . mysqli_connect_error());

        }
    $sql1 = "SELECT mturkid, userid, signuptime, totaltime, expcondition, ((survey_questions.question_id-1)%18+1) as surveyQuestion, type, question_response, responseValue from user, survey_questions, survey_response where user.userid=survey_response.user_id AND type='PRE' AND survey_response.question_id=survey_questions.question_id AND user.keyid is not null AND user.exclude is null order by userid, type, surveyQuestion";

    $sql2 = "SELECT mturkid, userid, signuptime, totaltime, expcondition, ((survey_questions.question_id-1)%18+1) as surveyQuestion, type, question_response, responseValue from user, survey_questions, survey_response where user.userid=survey_response.user_id AND type='POST' AND survey_response.question_id=survey_questions.question_id AND user.keyid is not null AND user.exclude is null order by userid, type, surveyQuestion";


    $result1 = mysqli_query($conn,$sql1);
    $result2 = mysqli_query($conn,$sql2);

    $json1 = mysqli_fetch_all ($result1, MYSQLI_ASSOC);
    $json2 = mysqli_fetch_all ($result2, MYSQLI_ASSOC);

    $jsonresult = array();
    foreach ($json1 as $value1) {

        foreach ($json2 as $value2) {
            if($value1['mturkid'] == $value2['mturkid'] && $value1['userid'] == $value2['userid'] &&  $value1['surveyQuestion'] ==  $value2['surveyQuestion'] && $value1['type'] ==  'PRE' && $value2['type'] == 'POST')
            {
                $difference = 0;
                if($value1['surveyQuestion'] == 9 || $value1['surveyQuestion'] == 14)
                {
                    $difference = 0;

                }
                else{
                    $difference = $value1['responseValue'] - $value2['responseValue'];
                }


                $temp = array(
                    'mturkid' => $value1['mturkid'],
                    'userid' => $value1['userid'],
                    'expCondition' => $value1['expcondition'],

                    'surveyQuestion' => $value1['surveyQuestion'],

                    'surveyQuestionType1' => $value1['type'],
                    'preResponse' => $value1['question_response'],
                    'preResponseValue' => $value1['responseValue'],

                    'surveyQuestionType2' => $value2['type'],
                    'postResponse' => $value2['question_response'],
                    'postResponseValue' => $value2['responseValue'],
                    'difference' => $difference
                );
                array_push($jsonresult,$temp);


            }
        }
    }

    $output = fopen("php://output", "w");
    foreach ($jsonresult as $row) {
        fputcsv($output, $row, $delimiter);
    }
    fclose($output);


}

mysqli_close($conn);

?>