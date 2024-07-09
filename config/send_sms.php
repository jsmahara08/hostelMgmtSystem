<?php
// Check if 'phones' and 'messages' parameters are set in the GET request
if(isset($_GET['phones']) && isset($_GET['messages'])) {
    // Retrieve 'phones' and 'messages' arrays from GET parameters
    $phones = json_decode($_GET['phones']);
    $messages = json_decode($_GET['messages']);

    // Check if the number of phones and messages match
    if(count($phones) !== count($messages)) {
        echo json_encode(array('error' => 'Number of phones and messages do not match'));
        exit; // Stop further execution
    }

    // Loop through each phone number and message
    $responses = [];
    for($i = 0; $i < count($phones); $i++) {
        $phone = $phones[$i];
        $message = $messages[$i];

        // API URL
        $api_url = "http://api" .
                   http_build_query(array(
                       'token' => 'dont provide token',
                       'from'  => 'TheAlert',
                       'to'    => $phone,
                       'text'  => $message
                   ));

        // Send the request to the SparrowSMS API
        $response = file_get_contents($api_url);

        // Store the response for each phone number and message
        $responses[] = $response;
    }

    // Output the responses
    echo json_encode($responses);
} else {
    // If 'phones' or 'messages' parameters are not set, return an error response
    echo json_encode(array('error' => 'Missing required parameters'));
}
?>
