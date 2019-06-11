<html>
<head>
  <!--JQuery-->
  <script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style>
    </style>
    <script type="text/javascript">
    $( "#exit" ).click(function( event ) {
    console.log("end");
    window.close();
    });

    </script>
</head>
<body>
  <?php session_start();

  ?>
  <div class="well row">
      <span class="col-lg-10" id="qspan"><h2>Study is complete. Thank you!</h2>
      <p> <ul><li><h3>
        <?php
        if($_SESSION['status'] == 'success'){
        ?>
          Please enter this code into Amazon MTruk to receive your pay: <?php echo "<b>" . json_encode($_SESSION['key']) . "</b>"; 
        }
        else if ($_SESSION['status'] == 'incompatible') {
          ?>You can only use a desktop or a laptop computer in this study.
      <?php  }
        else if ($_SESSION['status'] == 'incompatible_ie') {
          ?>Internet Explorer is not supported. Please use Firefox, Chrome, or Safari.
      <?php  }
        else 
        {
          $_SESSION['status'] = 'failed';
          ?>Sorry you are not eligible
      <?php } ?>
    </h3></li></ul>
      </p></span>
  </div>


</body>
</html>
