<?php
session_start();

// Check if session variable 'fidx' is set and not empty
if (empty($_SESSION["fidx"])) {
    header('Location: facultylogin.php');
    exit(); // Ensure no further code execution after redirection
}

$userid = $_SESSION["fidx"];
$fname = $_SESSION["fname"];

include('fhead.php');  
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">

            <h3>Welcome Faculty: <a href="welcomefaculty.php"><span style="color:#FF0004"><?php echo htmlspecialchars($fname); ?></span></a></h3>

            <?php
            include('database.php'); // Make sure this file correctly sets up the $connect variable

            // Use prepared statements to prevent SQL injection
            if (isset($_GET['makeid'])) {
                $make = intval($_GET['makeid']); // Ensure $make is an integer

                // Prepare and execute the query to select data for the specific exam
                $stmt = $connect->prepare("SELECT * FROM examans WHERE ExamID = ?");
                $stmt->bind_param('i', $make);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if there is a result
                if ($row = $result->fetch_assoc()) {
                    $eno = htmlspecialchars($row['Senrl']);
                    $ExamID = htmlspecialchars($row['ExamID']);
            ?>
            <fieldset>
                <legend>Make Result</legend>
                <form action="" method="POST" name="makeresult">
                    <table class="table table-hover">
                        <tr>
                            <td><strong>Enrollment Number</strong></td>
                            <td><?php echo $eno; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Exam ID:</strong></td>
                            <td><?php echo $ExamID; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Marks</strong></td>
                            <td>
                                <select class="form-control" name="marks" required>
                                    <option value="">---Select---</option>
                                    <option value="Pass">Pass</option>
                                    <option value="Fail">Fail</option>
                                    <option value="Under Progress">Under Progress</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><button type="submit" name="make" class="btn btn-primary">Make</button></td>
                        </tr>
                    </table>
                </form>
            </fieldset>
            <?php
                } else {
                    echo "<p>No exam record found with the specified ID.</p>";
                }
                $stmt->close();
            } else {
                echo "<p>No exam ID provided.</p>";
            }
            ?>

            <?php
            if (isset($_POST['make'])) {
                $mark = $_POST['marks'];

                // Use prepared statements to prevent SQL injection
                $stmt = $connect->prepare("INSERT INTO `result` (`Eno`, `ExamID`, `Marks`) VALUES (?, ?, ?)");
                $stmt->bind_param('iss', $eno, $ExamID, $mark);

                if ($stmt->execute()) {
                    echo "
                    <br><br>
                    <div class='alert alert-success fade in'>
                        <a href='ResultDetails.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Success!</strong> Result Updated.
                    </div>
                    ";
                } else {
                    // Error message if SQL query fails
                    echo "<br><strong>Result Updation Failure. Try Again</strong><br>Error Details: " . $stmt->error;
                }
                $stmt->close();
            }
            mysqli_close($connect); // Close the connection
            ?>
        </div>
    </div>
</div>
