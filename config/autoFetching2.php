<?php 
require('Database.php');
//$db = Database::getInstance();
//$mysqli = $db->getConnection();

class AutoLoad{
    public function load_hostail_detail(){
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

elseif ($type === 'roomNumbers') {
   $floorId = $_GET['floor_id'];
    // Fetch roomNumber room numbers from the database
    $query = "SELECT roomNumber,id FROM rooms WHERE floor_id=$floorId";
    $stmt = $mysqli->query($query);

    // Fetch and format results
    while ($row = $stmt->fetch_assoc()) {
        $response[] = array(
            'roomNumber' => $row['roomNumber'],
            'roomId' => $row['id']
        );
    }
} elseif ($type === 'roomDetails') {
    // Fetch room details based on the selected room number
    $roomId = $_GET['roomId'];
    $query = "SELECT bedPerRoom, rentPerBed FROM rooms WHERE id = '$roomId'";
    $stmt = $mysqli->query($query);

    // Fetch and format results
    if ($stmt->num_rows > 0) {
        $row = $stmt->fetch_assoc();
        $response = array(
            'bedPerRoom' => $row['bedPerRoom'],
            'rentPerBed' => $row['rentPerBed']
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
$load->load_hostail_detail();

 ?>
 