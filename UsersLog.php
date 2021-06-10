<?php
require 'includes/snippet.php';
  require 'includes/db-inc.php';
include "includes/header.php"; 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Users Logs</title>
<link rel="stylesheet" type="text/css" href="css/userslog.css">
<script>
  $(window).on("load resize ", function() {
    var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
    $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();
</script>
<script src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous">
</script>
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/user_log.js"></script>
<script>
  $(document).ready(function(){
      $.ajax({
        url: "user_log_up.php",
        type: 'POST',
        data: {
            'select_date': 1,
        }
      });
    setInterval(function(){
      $.ajax({
        url: "user_log_up.php",
        type: 'POST',
        data: {
            'select_date': 0,
        }
        }).done(function(data) {
          $('#userslog').html(data);
        });
    },5000);
  });
</script>
</head>
<body>
<div class="container">
    <?php include "includes/nav.php"; ?>
  <!-- navbar ends -->
  <!-- info alert -->
  <div class="alert alert-warning col-lg-7 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-0 col-sm-offset-1 col-xs-offset-0" style="margin-top:70px">

    <span class="glyphicon glyphicon-book"></span>
      <strong>Attendance</strong> Table
  </div>
  	<div class="form-style-5 slideInDown animated">
  		<form method="POST" action="Export_Excel.php">
<!--       <select>
        <option>ECE 503</option>
        <option>ECE 541</option>
        <option>ECE 545</option>
      </select> -->
        <select name="course" id="date_sel" required=""><input type="name" name="course" id="date_sel">
        <?php
      require "course.php"
      ?>
      </select>
  			<input type="date" name="date_sel" id="date_sel">
        <button type="button" name="user_log" id="user_log">Select Date</button>
  			<input type="submit" name="To_Excel" value="Export to Excel">
  		</form>
  	</div>
    <div class="container">
            <table>
            <div class="panel panel-default">
  
      <table class="table table-bordered">
      <thead>

                <tr>

                  <th>ID</th>
                  <th>Name</th>
                  <th>Matric Number</th>
                  <th>Fingerprint ID</th>
                  <th>Date</th>
                  <th>Time In</th>
                  <th>Time Out</th>
                  <th>Course</th>
                </tr>
</thead>
    </table>
  </div>
  <div class="tbl-content slideInRight animated">
    <div id="userslog"></div>
  </div>
</section>
</main>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>  
<script type="text/javascript">
function hey(){
  alert("Hello");
}
</script>
</body>
</html>