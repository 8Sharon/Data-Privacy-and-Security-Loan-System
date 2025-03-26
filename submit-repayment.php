<?php
// Include the database connection file
include('db_connect.php');

// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Get the form data
    $loan_type = $_POST['loan_type'];
    $payment_method = $_POST['payment_method'];
    $amount_paid = $_POST['amount_paid'];

    // Assuming you have a way to get the loan_id based on loan_type
    // This is a sample, you may need to adapt this part to match your actual logic
    $sql_get_loan_id = "SELECT loan_id FROM loan WHERE loan_type = '$loan_type' LIMIT 1";
    $result = $conn->query($sql_get_loan_id);

    if ($result->num_rows > 0) {
        // Fetch the loan_id
        $row = $result->fetch_assoc();
        $loan_id = $row['loan_id'];

        // Now insert the repayment into the repayments table
        $sql = "INSERT INTO repayments (loan_id, loan_type, payment_method, amount_paid)
                VALUES ('$loan_id', '$loan_type', '$payment_method', '$amount_paid')";

        if ($conn->query($sql) === TRUE) {
            echo "Repayment details submitted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: No loan found for this loan type!";
    }

    // Close connection
    $conn->close();
}
?>
