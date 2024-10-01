<<<<<<< HEAD
<?php
include 'db_connect.php';  // Include the database connection
session_start();

// Ensure that the therapist is logged in (based on session check)
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'therapist') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $patient_id = $_POST['patient_id']; // Patient ID to be flagged

        // Update the 'flagged_for_followup' field to TRUE for the given patient
        $sql = "UPDATE patient_records SET flagged_for_followup = TRUE WHERE patient_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $patient_id);

        if ($stmt->execute()) {
            echo "Patient flagged for follow-up successfully!";
            // Redirect or give further instructions here if needed
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid request method";
    }
} else {
    echo "Unauthorized access. Only therapists can flag patients for follow-up.";
}

$conn->close();
?>
=======
<?php
include 'db_connect.php';  // Include the database connection
session_start();

// Ensure that the therapist is logged in (based on session check)
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'therapist') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $patient_id = $_POST['patient_id']; // Patient ID to be flagged

        // Update the 'flagged_for_followup' field to TRUE for the given patient
        $sql = "UPDATE patient_records SET flagged_for_followup = TRUE WHERE patient_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $patient_id);

        if ($stmt->execute()) {
            echo "Patient flagged for follow-up successfully!";
            // Redirect or give further instructions here if needed
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid request method";
    }
} else {
    echo "Unauthorized access. Only therapists can flag patients for follow-up.";
}

$conn->close();
?>
>>>>>>> b2db3ce9d23495275279a0be62d5ef26432e0d18
