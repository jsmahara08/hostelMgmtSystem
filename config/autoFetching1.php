<?php 
require('Database.php');
//$db = Database::getInstance();
//$mysqli = $db->getConnection();

class AutoLoad{
    public function load_studentName_rent(){
      $db     = Database::getInstance();
     $mysqli = $db->getConnection();
      // Fetch data based on the type (roomNumbers, roomDetails)
$type = $_GET['type'];

// Initialize response array
$response = array();
if ($type === 'student') {
    // Fetch provinces from the database
    $query = "SELECT * FROM users WHERE status='active'";
    $stmt = $mysqli->query($query);

    // Fetch and format results
    while ($row = $stmt->fetch_assoc()) {
        $response[] = array(
            'id' => $row['id'],
            'firstName' => $row['firstName'],
            'middleName' => $row['middleName'],
            'lastName' => $row['lastName'],
            'image'=>$row['image']
        );
    }
}

 elseif ($type === 'image') {
    // Fetch room details based on the selected room number
    $studentId = $_GET['studentId'];
    $query = "SELECT image from users WHERE id = $studentId";
    $stmt = $mysqli->query($query);

    // Fetch and format results
    if ($stmt->num_rows > 0) {
        $row = $stmt->fetch_assoc();
        $response = array(
          'image' => $row['image'],
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
$load->load_studentName_rent();

 ?>
 