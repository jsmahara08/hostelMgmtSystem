<?php 
require('Database.php');
//$db = Database::getInstance();
//$mysqli = $db->getConnection();

class AutoLoad{
   

   public function load_address(){
     $db     = Database::getInstance();
     $mysqli = $db->getConnection();
     
      // Fetch data based on the type (provinces, districts, municipalities)
$type = $_GET['type'];

// Initialize response array
$response = array();

if ($type === 'provinces') {
    // Fetch provinces from the database
    $query = "SELECT * FROM provinces";
    $stmt = $mysqli->query($query);

    // Fetch and format results
    while ($row = $stmt->fetch_assoc()) {
        $response[] = array(
            'id' => $row['id'],
            'name' => $row['name']
        );
    }
} 
elseif ($type === 'districts') {
    // Fetch districts based on the selected province
    $provinceId = $_GET['province_id'];
    $query = "SELECT * FROM districts WHERE province_id = $provinceId";
    $stmt = $mysqli->query($query);

    // Fetch and format results
    while ($row = $stmt->fetch_assoc()) {
        $response[] = array(
            'id' => $row['id'],
            'name' => $row['name']
        );
    }
} elseif ($type === 'municipalities') {
    // Fetch municipalities based on the selected district
    $districtId = $_GET['district_id'];
    $query = "SELECT * FROM municipalities WHERE district_id = $districtId";
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
$load->load_address();


 ?>
