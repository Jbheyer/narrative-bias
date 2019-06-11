<?php
	session_start();
	
	/*
	if (!isset($_GET['cond'])) {
		echo "Error: no condition set.";
		exit(1);
	}
	$_SESSION['condition'] = $_GET['cond'];
	*/


	if (isset($_GET['conditionOrder']))
	{
		$_SESSION['condition'] = $_GET['conditionOrder'];
	}
    #$_SESSION['condition'] ="predict_graph_only";
    unset($_SESSION['user']);
    unset($_SESSION['status']);
    unset($_SESSION['error']);
    unset($_SESSION['key']);
	include 'checkmobile.php';

?><!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="../jnd/lib/d3.min.js"></script>

    <title>Experiment</title>
    <style>

        .center-div {
            margin: 0 auto;
            margin-top: 100px;
        }

        .instructions {
            font-family: Arial, sans-serif;
            font-size: 16px;
        }

        .navlinks {
            font-family: Arial, sans-serif;
            font-size: 18px;
        }

        .title {
            font-size: 20px;
            font-weight: bold
        }
        .title-cell
        {
            width: 100%;
            padding-bottom: 20px;
            padding-top: 20px;
            text-align: center;
            background-color: #dddddd;

        }

        .varNameText {
            font-family: Arial, sans-serif;
            font-size: 15px;
        }

        li, p {
            font-family: Arial, sans-serif;
        }

    </style>
</head>
<body>

<div style="width: 700px" class="center-div">

    <div class="instructions title-cell">
			<span class="title">
				<br><div style="padding-right: 20px; font-size: 14px; font-family: monospace; font-weight: normal; text-align: right">IRB# 1811412310</div><br>
				Indiana University Study Information Sheet
				<p><span style="font-size: 16px">Evaluation of the Impact of Narrative Visualizations on Bias</span>
			</span>
    </div>





    <script type="text/javascript">
        function getParameterByName(name, url)
        {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }

        function reDirect()
        {
            var target = getParameterByName('cond');
            window.location.replace('user.php');
        }

        function detectWebGLContext () {
            // Create canvas element. The canvas is not added to the
            // document itself, so it is never displayed in the
            // browser window.
            var canvas = document.createElement("canvas");

            // Get WebGLRenderingContext from canvas element.
            var gl = canvas.getContext("webgl");

            // Report the result
            if (gl && gl instanceof WebGLRenderingContext) {
                return true;
            }
            else
            {
                return false;
            }
        }

        $(document).ready(function() {
            var webgl = detectWebGLContext();
            if (!webgl) {
                d3.select("#warning")
                    .style("visibility", "visible");
                d3.select("#acceptButton")
                    .style("background-color", "#cccccc")
                d3.select("#acceptButton").node().disabled = true;
                d3.selectAll('.terms')
                    .style("color", "#eeeeee");
            }
        });

    </script>


    <p><div class="instructions" style="margin-top: 30px">

    <p><span id="warning" style="visibility: hidden; font-size: 20px; color: red">
				Unfortunately your browser doesn't support WebGL. You cannot participate in the study using this browser. You may, however, try using a different web browser. We recommend <A target="newWindow" href="https://www.google.com/chrome/browser/"><i>Chrome</i></A>.</div>
</span>



<p class="terms">You are invited to participate in a study on the effects of narrative visualization on bias and decision making.  You were selected as a possible subject because you expressed interest in this study.

<p class="terms">To be eligible for the study you must be at least 18 years of age and over.  The entire study will take approximately 30 minutes to complete.  For your participation, we will compensate you with $3.  The payment will be routed and approved through Amazon Mechanical Turk.

<p class="terms">

<p class="terms">This study is being conducted by Jeremy Heyer, MPH, MHI and Khairi Reda, PhD from the School of Informatics and Computing, Indiana University, Indianapolis.  Please read through this form and ask any questions you may have before agreeing to participate in the study.

<p class="terms"><b>STUDY PURPOSE</b>

<p class="terms">The purpose of this study is to explore and understand how narrative visualizations impact peoples bias and decision making.  Your participation will assist us in designing new types of techniques and methods for developing narrative visualizations.

<p class="terms"><b>PROCEDURES FOR THE STUDY</b>

<p class="terms">This study can be completed in one 30-minute session.  First, there will be a brief tutorial to introduce you to the interface.  You will then complete a pre-survey asking you general knowledge questions about a specific topic.  You will then see and interact with a narrative visualization to learn more about the topic. Throughout, you will see a number of data charts and you will be prompted to answer questions about the data presented.

<p class="terms">

<p class="terms">You will enter your answers in a text box, or prompted to sketch your answers into the visualization using the mouse. At the end of the session, there will be a post survey with questions about the topic you learned about, followed by a brief demographic exit survey.

<p class="terms">We are interested in how you interact with the visualization and data charts, and how you answer the questions.

<p class="terms">The entire study should take 30 minutes to complete. You may take a break at any point during the study. However, you will need to complete all questions in order to receive the compensation.

<p class="terms"><b>RISKS AND BENEFITS</b>

<p class="terms">The risks or discomforts in this study are:
<ul>
    <li class="terms">The stress associated with using a computer for elongated periods of time.</li>
    <li class="terms">A risk of possible loss of confidentiality.</li>
    <li class="terms">A risk of exposure if potentially sensitive answers you provide are released. </li>
</ul>

<p class="terms">To avoid loss of confidentiality, your identifiable information will not be shared with anyone outside the research team.

<p class="terms">You are not expected to benefit individually from participating in this research.  The broader benefits from your participation are allowing us to design new data visualization techniques to maximize impact and minimize the effects of biases.


<p class="terms"><b>CONFIDENTIALITY</b>

<p class="terms">Efforts will be made to keep your personal information confidential. However, we cannot guarantee absolute confidentiality. Your personal information may be disclosed if required by law.  Your identity will be held in confidence in reports in which the study may be published and databases in which results may be stored.

<p class="terms">Organizations that may inspect and/or copy your research records for quality assurance and data analysis include groups such as the study investigator and his/her research associates, the Indiana University Institutional Review Board or its designees and (as allowed by law) state or federal agencies, specifically the Office for Human Research Protections (OHRP), etc., who may need to access your research records.

<p class="terms">
<p class="terms">


<p class="terms"><b>PAYMENT</b>

<p class="terms">If you complete this study, you will be paid $3. The payment will be routed and approved through Amazon Mechanical Turk.

<p class="terms"><b>CONTACTS FOR QUESTIONS OR PROBLEMS</b><br>

    For questions about the study or a research-related injury, contact the researcher, Jeremy Heyer, MPH, MHI by emailing jbheyer@iu.edu or Prof. Khairi Reda, at (317) 274-5788 or by emailing redak@iu.edu. If you cannot reach the researchers during regular business hours (i.e., 8 a.m.  to 5 p.m.), please call the IU Human Subjects Office at 317-278-3458.

<p class="terms"><b>VOLUNTARY NATURE OF THIS STUDY</b>

<p class="terms">Taking part in this study is voluntary.  You may choose not to take part or may leave the study at any time.  Leaving the study will not result in any penalty or loss of benefits to which you are entitled.  Your decision whether or not to participate in this study will not affect your current or future relations with Indiana University.


<p class="terms"><b>Thank you for agreeing to participate in our research.  Before you begin, please note that the data you provide may be collected and used by Amazon as per its privacy agreement.  Additionally, this research is for residents of the United States over the age of 18*; if you are not a resident of the United States and/or under the age of 18, please do not complete the study.</b>

    </div>

    <div class="navlinks" style="text-align: center">
<p>&nbsp;<p>
    <button id="acceptButton" onClick="reDirect();" style="font-size: 17px; background-color: #98e698">Agree and enter study</button>
    </div>

    </div>
<p>&nbsp;<p>&nbsp;
</body>
</html>
