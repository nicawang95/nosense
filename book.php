<?php
$mysqli = new mysqli('localhost','root','','dentalclinic');
if(isset($_GET['date'])){
    $date = $_GET['date'];
    $stmt = $mysqli->prepare("SELECT * FROM appointment WHERE date = ?");
    $stmt->bind_param('s', $date);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $bookings []= $row['timeslot'];
            }
            
            $stmt->close();
        }
    }
}

if(isset($_POST['submit'])){

    $name =$_POST['name'];
    $email =$_POST['email'];
    $timeslot =$_POST['timeslot'];
    $stmt = $mysqli->prepare("SELECT * FROM appointment WHERE date = ? AND timeslot = ?");
    $stmt->bind_param('ss', $date, $timeslot);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            $msg =  "<div class='alert alert-danger'>Already Booked</div>";
        }else{
            $mobileno =$_POST['mobileno'];
            $stmt = $mysqli->prepare("INSERT INTO patient (patientname, email, mobileno) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $mobileno);
            $stmt->execute();
            
            // Get the ID of the last inserted row
            $id = $mysqli->insert_id;
            
            // Insert data into the second table
            $stmt = $mysqli->prepare("INSERT INTO appointment (timeslot, date , patientid) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $timeslot, $date, $id);
            $stmt->execute();
            $msg =  "<div class='alert alert-success'>Booking Successfull</div>";
            $bookings[]=$timeslot;
            $stmt->close();
            $mysqli->close();
        }
    }

}   


$duration = 30;
$cleanup = 0;


$dayOfTheWeek = date('D', strtotime($_GET['date']));
//echo $dayOfTheWeek; debugger ko lang.

if ($dayOfTheWeek === 'Sun') {
    $start = "11:00";
    $end = "14:00";
} else {
    $start = "9:00";
    $end = "16:00";
}


function timeslots($duration, $cleanup, $start, $end){
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT".$duration."M");
    $cleanupInterval = new DateInterval("PT".$cleanup."M");
    $slots = array();

   for($intStart = $start; $intStart<$end; $intStart -> add($interval)->add($cleanupInterval)){
    $endPeriod = clone $intStart;
    $endPeriod ->add($interval);
    if($endPeriod>$end){
        break;
    } else if ($intStart->format("h:i A") == "12:00 PM" || $endPeriod->format("h:i A") == "01:00 PM") {
        continue;
    } else { 
    
        $slots[] = $intStart->format("h:i:s A")." - ".$endPeriod->format("h:i:s A");
    }
}

    return $slots;
}
?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Booking System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/main.css">
  </head>

  <body>
    <div class="container">
        <h1 class="text-center"> Book for Date: <?php echo date('m/d/Y', strtotime($date)); ?></h1>
        <div class="row">
            <div class="col-md-12">
                <?php echo isset($msg)?$msg:"";?>
            </div>
            <?php $timeslot = timeslots($duration, $cleanup, $start, $end); 
            foreach($timeslot as $ts){
            ?>
            <div class="col-md-2">
                <div class="form-group">
                    <?php  if(in_array($ts, $bookings)){ ?>
                        <button class="btn btn-danger"> <?php echo $ts; ?></button>
                    <?php }else{ ?>
                        <button class="btn btn-success book" data-timeslot="<?php echo $ts; ?>"><?php echo   $ts  ; ?></button>
                    <?php } ?>
                
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Booking: <span id="slot"></span></h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <form action=""method="post">
                    <div class="form-group">
                    <label for="">Timeslot</label>
                    <input required type="text" readonly name="timeslot" id="timeslot" class="form-control">
                    </div>

                    <div class="form-group">
                    <label for="">Name</label>
                    <input required type="text" name="name" class="form-control" placeholder="Enter Full Name">
                    </div>

                    <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="optional">
                    </div>

                    <div class="form-group">
                    <label for="">Mobile No.</label>
                    <input required type="text" onkeydown="return isNumeric(event.keyCode);" name="mobileno" id="mobileno" class="form-control" placeholder="Enter mobile number">
                    </div>

                    <div class ="form-group pull-right">
                        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                    </div>

                </form>
            </div>
        </div>
      </div>
      
    </div>

  </div>
</div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
        $(".book").click(function(){
            var timeslot = $(this).attr('data-timeslot');
            $("#slot").html(timeslot);
            $("#timeslot").val(timeslot);
            $("#myModal").modal("show");
        })
    </script>
  </body>
</html>
