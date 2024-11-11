<?php
session_start();

// Check if session variable 'sidx' is set and not empty
if (empty($_SESSION["sidx"])) {
    header('Location: studentlogin.php');
    exit();
}

$userid = $_SESSION["sidx"];
$userfname = $_SESSION["fname"];
$userlname = $_SESSION["lname"];
?>

<?php include('studenthead.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h3> Welcome <a href="welcomestudent.php" <?php echo "<span style='color:red'>".$userfname." ".$userlname."</span>";?> </a></h3>
            <?php
            include('database.php');

            // Check if 'seno' is set in the GET request
            if (isset($_GET['seno'])) {
                $seno = $_GET['seno'];

                // Prepare and execute the SQL query using a prepared statement
                $stmt = $connect->prepare("SELECT * FROM result WHERE Eno = ?");
                $stmt->bind_param("s", $seno);
                $stmt->execute();
                $result = $stmt->get_result();

                echo "<h2 class='page-header'>Result View</h2>";
                echo "<table class='table table-striped' style='width:100%'>
                <tr>
                    <th>Result ID</th>
                    <th>Enrolment Number</th>
                    <th>Marks</th>
                </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row['RsID']) . "</td>
                        <td>" . htmlspecialchars($row['Eno']) . "</td>
                        <td>" . htmlspecialchars($row['Marks']) . "</td>
                    </tr>";
                }

                echo "</table>";

                $stmt->close();
            } else {
                echo "<p>No enrolment number provided.</p>";
            }

            $connect->close();
            ?>
        </div>
    </div>
</div>
