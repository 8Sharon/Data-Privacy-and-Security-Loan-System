<?php
// Include the database connection file
include('db_connect.php');

// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Get the form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $national_id = $_POST['national_id'];
    $dob = $_POST['date_of_birth'];
    $address = $_POST['address'];

    $g_first_name = $_POST['g_first_name'];
    $g_last_name = $_POST['g_last_name'];
    $g_email = $_POST['g_email'];
    $g_national_id = $_POST['g_national_id'];
    $g_address = $_POST['g_address'];
    $g_relationship = $_POST['g_relationship'];

    $loan_amount = $_POST['loan_amount'];
    $loan_type = $_POST['loan_type'];
    $interest_rate = $_POST['interest_rate'];
    $repayment_period = $_POST['repayment_period'];
    $start_date = $_POST['start_date'];
    $due_date = $_POST['due_date'];

    // Insert client details into the database
    $sql = "INSERT INTO clients (first_name, last_name, phone_number, national_id, date_of_birth, address)
            VALUES ('$first_name', '$last_name', '$phone_number', '$national_id', '$dob', '$address')";
    
    if ($conn->query($sql) === TRUE) {
        // Get the last inserted client ID
        $client_id = $conn->insert_id;

        // Insert guarantor details into the database
        $sql_guarantor = "INSERT INTO guarantors ( g_first_name, g_last_name, g_email, g_national_id, g_address, g_relationship)
                          VALUES ( '$g_first_name', '$g_last_name', '$g_email', '$g_national_id', '$g_address', '$g_relationship')";
        
        if ($conn->query($sql_guarantor) === TRUE) {
            // Get the last inserted guarantor ID
            $guarantor_id = $conn->insert_id;

            // Insert loan details into the database
            $sql_loan = "INSERT INTO loan (client_id, guarantor_id, loan_amount, loan_type, interest_rate, repayment_period, start_date, due_date)
                         VALUES ('$client_id', '$guarantor_id', '$loan_amount', '$loan_type', '$interest_rate', '$repayment_period', '$start_date', '$due_date')";

            if ($conn->query($sql_loan) === TRUE) {
                echo "Loan details submitted successfully!";
            } else {
                echo "Error inserting loan details: " . $conn->error;
            }
        } else {
            echo "Error inserting guarantor details: " . $conn->error;
        }
    } else {
        echo "Error inserting client details: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
