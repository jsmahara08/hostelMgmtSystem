<?php 
require('Database.php');
//$db = Database::getInstance();
//$mysqli = $db->getConnection();

class AutoLoad{
    public function load_floor_detail(){
      $db     = Database::getInstance();
     $mysqli = $db->getConnection();
      // Fetch data based on the type (roomNumbers, roomDetails)
$type = $_GET['type'];

// Initialize response array
$response = array();
if ($type === 'floor') {
    // Fetch provinces from the database
    $query = "SELECT * FROM floors";
    $stmt = $mysqli->query($query);

    // Fetch and format results
    while ($row = $stmt->fetch_assoc()) {
        $response[] = array(
            'id' => $row['id'],
            'name' => $row['name']
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
$load->load_floor_detail();

 ?>