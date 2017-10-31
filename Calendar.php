<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT event, dateofevent, eventdata, image, title FROM test";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
// need variable for class and ids
$test = 0;
// 3 days before the current date
$expirydate = (new DateTime($expirydate))->sub(new DateInterval('P3D'))->format('Y-m-d');
?>
<div id="accordion" role="tablist"> 
<?php while($row = $result->fetch_assoc()) { 
    // only show the events >= 3 days 
    if ($row["dateofevent"] < $expirydate){
        ?>
        <div class="card">
            <div class="card-header" role="tab" id="heading_<?php echo $test; ?>">
                <h5 class="mb-0">
                    <a data-toggle="collapse" href="#collapse_<?php echo $test; ?>" aria-expanded="false" aria-controls="collapse_<?php echo $test; ?>">
                        <?php echo $row["event"]. " - " . $row["title"]. " - " . $row["dateofevent"]; ?>
                    </a>
                </h5>
            </div>
            <div id="collapse_<?php echo $test; ?>" class="collapse" role="tabpanel" aria-labelledby="heading_<?php echo $test; ?>" data-parent="#accordion">
                <div class="card-body">
                    <?php echo $row["eventdata"]; ?>
                </div>
            </div>
        </div>"
    <?php 
    }
    $test++;
} else {
    echo "0 results";
}
$conn->close();
?>