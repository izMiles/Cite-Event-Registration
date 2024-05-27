<?php
session_start();
include "../database/db_conn.php";

if (isset($_POST['event_title'], $_POST['user_id'], $_POST['user_name'], $_POST['section'], $_POST['department'])) {
    $event_title = $_POST['event_title'];
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $section = $_POST['section'];
    $department = $_POST['department'];

    // Validate input data
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $event_title = validate($event_title);
    $section = validate($section);
    $department = validate($department);

    // Insert registration details into the database 
    $sql = "INSERT INTO registrations (event_title, user_id, user_name, section, department) VALUES ('$event_title', '$user_id', '$user_name', '$section', '$department')";
    if (mysqli_query($conn, $sql)) {
        header("Location: home.php?success=Registered successfully for $event_title");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    header("Location: home.php?error=Invalid form submission");
    exit();
}
?>
