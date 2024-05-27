<?php
session_start();
include "../database/db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && $_SESSION['user_type'] === 'admin') {
        $event_title = $_POST['event_title'];
        $event_date = $_POST['event_date'];
        $event_deadline = $_POST['event_deadline'];

        // Perform validation if necessary

        // Insert event into the database
        $insert_sql = "INSERT INTO events (title, date, deadline) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insert_sql);
        mysqli_stmt_bind_param($stmt, "sss", $event_title, $event_date, $event_deadline);
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header("Location: admin.php"); // Redirect to admin panel after adding event
            exit();
        } else {
            // Handle error
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Redirect to login page if not logged in as admin
        header("Location: index.php");
        exit();
    }
} else {
    // Redirect to add event form if accessed directly
    header("Location: admin_panel.php");
    exit();
}
?>
