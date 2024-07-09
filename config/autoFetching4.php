<?php 
require('Database.php');
//$db = Database::getInstance();
//$mysqli = $db->getConnection();

class AutoLoad{
    public function paymentDetails(){
      $db     = Database::getInstance();
     $mysqli = $db->getConnection();
      // Fetch data based on the type (payment id)
$type = $_GET['type'];


// Initialize response array
$response = array();
if ($type === 'paymentId') {
    $userId = $_GET['userId'];
    // Fetch provinces from the database
    $query = "SELECT payment_id, CONCAT(`year`, '/', month) AS year_month_result FROM payment WHERE user_id = $userId AND status !='Paid';";
    $stmt = $mysqli->query($query);

    // Fetch and format results
    while ($row = $stmt->fetch_assoc()) {
        $response[] = array(
            'payment_id' => $row['payment_id'],
            'year_month' => $row['year_month_result']
        );
    }
}
 elseif ($type === 'paymentDetail') {
    // Fetch room details based on the selected room number
    $paymentId = $_GET['paymentId'];
    $query = "SELECT rent, additionalCharge,remarks,paidAmount FROM payment WHERE payment_id = '$paymentId'";
    $stmt = $mysqli->query($query);

    // Fetch and format results
    if ($stmt->num_rows > 0) {
        $row = $stmt->fetch_assoc();
        $response = array(
            'rent' => $row['rent'],
            'extraAmount' => $row['additionalCharge'],
            'remarks' => $row['remarks'],
            'totalAmount'=>$row['rent']+$row['additionalCharge']-$row['paidAmount']
        );
    }
}

// Close database connection
$mysqli->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
   }

}
$load=new AutoLoad();
$load->paymentDetails();

 ?>
 