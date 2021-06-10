<?php 
require 'includes/snippet.php';
	require 'includes/db-inc.php';
include "includes/header.php"; 

if(isset($_POST['search']))

{

    $valueToSearch = $_POST['valueToSearch'];

    // search in all table columns

    // using concat mysql function

    $query = "SELECT id, username, matricnumber, gender, email, fingerprint_id FROM users WHERE CONCAT(id, fname, mname, lname, matricnumber, gender, email, fingerprint_id) LIKE '%".$valueToSearch."%'";

    $search_result = filterTable($query);

    


}

 else {

    $query = "SELECT id, username, matricnumber, gender, email, fingerprint_id FROM users";

    $search_result = filterTable($query);

}


// function to connect and execute the query

function filterTable($query)

{

    $connect = mysqli_connect("localhost", "root", "", "biometricattendance");

    $filter_Result = mysqli_query($connect, $query);

    return $filter_Result;

}






if (isset($_POST['delete'])) {
$id = sanitize(trim($_POST['del_btn']));
    $sql = "SELECT fingerprint_select FROM users WHERE fingerprint_select=1";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select";
        exit();
    }
    else{
        mysqli_stmt_execute($result);
        
            $sql="DELETE from users where fingerprint_id = '$id' ";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo "<script> alert('Could not delete user');
                location.href ='users.php'; </script>";
                exit();
            }
            else{
                mysqli_stmt_execute($result);
                echo "<script> alert('User Fingerprint has been deleted');
                location.href ='users.php';
                 </script>";
                exit();
            }
       }
  }

?>


<div class="container">
    <?php include "includes/nav.php"; ?>
	<!-- navbar ends -->
	<!-- info alert -->
	<div class="alert alert-warning col-lg-7 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-0 col-sm-offset-1 col-xs-offset-0" style="margin-top:70px">

		<span class="glyphicon glyphicon-book"></span>
	    <strong>Student</strong> Table
	</div>
	
<div style="width: 30%; margin: 10px auto; float: right; padding: 10px;">

	<form action="users.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Value To Search" id="inputs"><br>

            <input type="submit" name="search" value="Filter" id="submits">
            </div>
	</div>
	<div class="container">


            

            <table>
            <div class="panel panel-default">
	
		  <table class="table table-bordered">
		  <thead>

                <tr>

                  <th>ID</th> 
                  <th>Student Name</th>
                  <th>Fingerprint ID</th>
                  <th>Matric No</th>
                  <th>Email</th>
                  <th>Gender</th>
                  <th>Action1</th>
                </tr>
</thead>

      <!-- populate table from mysql database -->

                <?php
$counter = 1;
                 while($row = mysqli_fetch_array($search_result)):?>
<tbody>
      <tr>

                    <td><?php echo $counter++; ?></td>
		             <td><?php echo $row['username']; ?></td>
		             <td><?php echo $row['fingerprint_id']; ?></td>
		             <td><?php echo $row['matricnumber']; ?></td>
		             <td><?php echo $row['gender']; ?></td>
		             <td><?php echo $row['email']; ?></td>
		             <td>
		             	<form action="users.php" method="post">
		             	<input type="hidden" value="<?php echo $row['fingerprint_id']; ?>" name="del_btn">
		             <button name="delete" class="btn btn-warning">DELETE</button>
		             </form> 
		         </td>


                </tr>
                </tbody>

                <?php endwhile;?>

            </table>

        </form>
		
		
	  </div>
	</div>
	
		




<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>	
<script type="text/javascript">
function hey(){
	alert("Hello");
}
</script>
</body>
</html>






        
