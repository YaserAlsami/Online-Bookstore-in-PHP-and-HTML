<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; 
   charset=UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="">
   <meta name="author" content="">
   <title>Book Template</title>

   <link rel="shortcut icon" href="../../assets/ico/favicon.png">

   <!-- Google fonts used in this theme  -->
<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic,700italic' rel='stylesheet' type='text/css'>  

   <!-- Bootstrap core CSS -->
   <link href="bootstrap3_bookTheme/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap theme CSS -->
   <link href="bootstrap3_bookTheme/theme.css" rel="stylesheet">


   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!--[if lt IE 9]>
   <script src="bootstrap3_bookTheme/assets/js/html5shiv.js"></script>
   <script src="bootstrap3_bookTheme/assets/js/respond.min.js"></script>
   <![endif]-->
</head>

<body>

<?php include 'book-header.inc.php'; ?>
   
<div class="container">
   <div class="row">  <!-- start main content row -->

      <div class="col-md-2">  <!-- start left navigation rail column -->
         <?php include 'book-left-nav.inc.php'; ?>
      </div>  <!-- end left navigation rail --> 

      <div class="col-md-10">  <!-- start main content column -->
        
         <!-- Customer panel  -->
         <div class="panel panel-danger spaceabove">           
           <div class="panel-heading"><h4>My Customers</h4></div>
           <table class="table">
             <tr>
               <th>Name</th>
               <th>Email</th>
               <th>University</th>
               <th>City</th>
             </tr>
            <tbody>
            <?php
$file = "customers.txt";
$lines = file($file);

foreach ($lines as $line) {
    $lineInfo = explode(",", $line);
    $id = $lineInfo[0];
    $firstName = $lineInfo[1];
    $lastName = $lineInfo[2];
    $email = $lineInfo[3];
    $university = $lineInfo[4];
    $city = $lineInfo[5];
    $fullName = $firstName . ' ' . $lastName;

    if (empty($_GET['orderID']) || $_GET['orderID'] == $id) {
        echo "<tr>";
        echo "<td></td>";
        echo "<td><a href='?id=$id'>$fullName</a></td>";
        echo "<td>$email</td>";
        echo "<td>$university</td>";
        echo "<td>$city</td>";
        echo "</tr>";
    }
}
?>
<?php
if (!empty($_GET['id'])) {
    $file = "orders.txt";
    $lines = file($file);

    $ordersFound = false;

    echo '<div class="panel panel-danger spaceabove">';
    echo '<div class="panel-heading"><h4>My Orders</h4></div>';
    echo '<table class="table">';
    echo '<tr>';
    echo '<th></th>';
    echo '<th>book ISBN</th>';
    echo '<th>book title</th>';
    echo '<th>book category</th>';
    echo '</tr>';

    foreach ($lines as $line) {
        $lineInfo = explode(",", $line);
        $orderId = $lineInfo[0];
        $custID = $lineInfo[1] ? $lineInfo[1] : 0;
        $bookISBN = $lineInfo[2];
        $bookTitle = $lineInfo[3];
        $bookCategory = $lineInfo[4];

        if (!empty($custID) && $custID == $_GET['id']) {
            echo '<tr>';
            echo '<td></td>';
            echo '<td><a href="?orderID=' . $custID . '">' . $bookISBN . '</a></td>';
            echo '<td>' . $bookTitle . '</td>';
            echo '<td>' . $bookCategory . '</td>';
            echo '</tr>';
            $ordersFound = true;
        }
    }

    if (!$ordersFound) {
        echo '<tr><td>No Record Found</td></tr>';
    }

    echo '</table>';
    echo '</div>';
}
?>


                
             </tbody>
           </table>
         </div>
   


      </div>  <!-- end main content column -->
   </div>  <!-- end main content row -->
</div>   <!-- end container -->
   


   
   
 <!-- Bootstrap core JavaScript
 ================================================== -->
 <!-- Placed at the end of the document so the pages load faster -->
 <script src="bootstrap3_bookTheme/assets/js/jquery.js"></script>
 <script src="bootstrap3_bookTheme/dist/js/bootstrap.min.js"></script>
 <script src="bootstrap3_bookTheme/assets/js/holder.js"></script>
</body>
</html>