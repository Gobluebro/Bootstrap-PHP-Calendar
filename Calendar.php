<?php
$servername = "localhost";
$username = "fake";
$password = "fakepassword";
$dbname = "faketest";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// select the events, make sure the date is always in the same format, eventdata, image url, title, from the test table where they are starting 3 days from the current time and beyeond
$sql = "SELECT event, DATE_FORMAT(dateofevent,'%Y-%m-%d') AS formatted_date, eventdata, image, title FROM test_table WHERE dateofevent >= NOW() - INTERVAL 3 DAY ORDER BY dateofevent ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    // need variable for class and ids
    $test = 0;
    ?>
    <div id="accordion" role="tablist"> 
    <?php while($row = $result->fetch_assoc()) { 
        ?>
            <div class="card">
                <div class="card-header" role="tab" id="heading_<?php echo $test; ?>">
                    <h5 class="mb-0">
                        <a data-toggle="collapse" href="#collapse_<?php echo $test; ?>" aria-expanded="false" aria-controls="collapse_<?php echo $test; ?>">
                            <?php echo $row["event"]. " - " . $row["title"]. " - " . $row["formatted_date"] ?>
                        </a>
                    </h5>
                </div>
                <div id="collapse_<?php echo $test; ?>" class="collapse" role="tabpanel" aria-labelledby="heading_<?php echo $test; ?>" data-parent="#accordion">
                    <div class="card-body">
                        <?php echo $row["eventdata"]; ?>
                        <img src="<?php echo $row["image"]; ?>" />
                    </div>
                </div>
            </div>
        <?php 
        $test++;
    }
} else {
    echo "0 results";
}
$conn->close();
?>