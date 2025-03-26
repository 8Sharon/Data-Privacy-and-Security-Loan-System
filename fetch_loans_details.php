<?php
include('db_connect.php');

if (isset($_POST['minute'])) {
    $minute = $_POST['minute'];

    // Query to get loan details for the selected minute
    $query = "SELECT first_name, last_name, loan_amount, loan_type, start_date, due_date 
              FROM loan 
              WHERE DATE_FORMAT(start_date, '%Y-%m-%d %H:%i') = '$minute'";

    $result = $conn->query($query);

    $loanDetails = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $loanDetails[] = $row;
        }
    }

    // Return the results as JSON
    echo json_encode($loanDetails);
}
?>
