<!DOCTYPE html>
<html lang="en">
<?php require_once "../includes/header.php" ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php require_once "../includes/topnav.php" ?>
        <?php require_once "../includes/sidenav.php" ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">

                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">User List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Auditrail</h3>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Description</th>
                                                <th>Timelog</th>

                                            </tr>
                                        </thead>
                                        <?php
include "../../db_con/conn.php"; // Assuming you have already included your database connection file
include "../../crud/crud.php";
// Create a new CRUD instance using your existing $conn connection

// Define the SQL query and condition
$sql = "SELECT auditrail.UserID, tbladmin.Username, auditrail.Description, auditrail.Timelog 
        FROM auditrail  
        JOIN tbladmin ON auditrail.UserID = tbladmin.Id";

$condition = ''; // Add your WHERE condition here if needed

try {
    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Loop through the results and display them
    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . $row["UserID"] . "</td>";
        echo "<td>" . $row["Username"] . "</td>";
        echo "<td>" . $row["Description"] . "</td>";
        echo "<td>" . $row["Timelog"] . "</td>";
        echo "</tr>";
    }
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php require_once "../includes/footer.php" ?>
    </div>
    <?php require_once "../includes/script.php" ?>
</body>

</html>