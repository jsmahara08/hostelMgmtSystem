
<?php
@session_start();
require "Database.php";
//$db = Database::getInstance();
//$mysqli = $db->getConnection();

class DbFunction
{
    
    function defaultAdmin($email, $passwoard)
    {
        $db= Database::getInstance();
        $mysqli= $db->getConnection();
        password_hash($passwoard, PASSWORD_DEFAULT);
        $query = "insert into admin(email,password)values(?,?)";
        $stmt  = $mysqli->prepare($query);
        $fetch_query = "SELECT * FROM admin ";
        $fetch_stmt  = $mysqli->query($fetch_query);
        if ($fetch_stmt->num_rows <= 0) {
            if (false === $stmt) {
                trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
            } else {
                $stmt->bind_param("ss", $email, $passwoard);
                $stmt->execute();
            }
        }
    }
    // Function to perform login
    function login($username, $password)
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        password_hash($password, PASSWORD_DEFAULT);
        // Prepare SQL statementusername
        $stmt = $mysqli->prepare("SELECT id, email, password FROM admin WHERE email = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            // User exists, fetch the hashed password
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $row["password"])) {
                // Password is correct, set session variables
                $_SESSION["user_id"]= $row['id'];
                $_SESSION["username"]= $row['email'];
                // $_SESSION["name"]= $row->name;
                // $_SESSION["image"]= $row->image;
                return true; // Login successful
            }
        }
        $_SESSION["error"] = "Invalid User or Password";
        return false; // Login failed
    }
  function resetPassRequest($email){
    $db     = Database::getInstance();
    $mysqli = $db->getConnection();
    $fetch_stmt = $mysqli->prepare("SELECT email FROM admin WHERE email = ?");
    $fetch_stmt->bind_param("s", $email);
    $fetch_stmt->execute();
    $result = $fetch_stmt->get_result();
     if ($result->num_rows == 1) {
        // Generate a unique token
        $token = bin2hex(random_bytes(16));
        // Calculate expiration time (1 hour from now)
       $expiration_time = time() + (60 * 60); // 1 hour = 60 minutes * 60 seconds
       $query = "INSERT INTO password_reset (email, token, expiration_time) VALUES (?,?,?)";
       $stmt  = $mysqli->prepare($query);
        if (false === $stmt) {
                trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
            } else {
                  // Send reset email
                $reset_link = "http://localhost/hostel/auth/reset_password.php?token=$token";
                $to = $email;
                $subject = "Password Reset TMH";
                $message = "To reset your password, click on the following link: $reset_link";
                $headers = "From: your_email@example.com";
             $sentMail= mail($to, $subject, $message, $headers);
             if($sentMail===true){
                $stmt->bind_param("sss", $email, $token,$expiration_time);
                $stmt->execute();
               $_SESSION["success"] = "Password reset link has been sent to your email:".$email;
               echo "<script>window.location.href = './forgot.php'</script>";
                return true;
             }
             else{
              $_SESSION["error"] = "Email not send.";
               echo "<script>window.location.href = './forgot.php'</script>";
               return false; // email doesnt match

             }
            }
          
        }
        $_SESSION["success"] = "Email not registered.";
        echo "<script>window.location.href = './forgot.php'</script>";
        return false; // email doesnt match

  }
  function resetPassword($password,$confirmPassword,$token){
    $db     = Database::getInstance();
    $mysqli = $db->getConnection();
    $fetch_stmt = $mysqli->prepare("SELECT * FROM password_reset WHERE token = ?");
    $fetch_stmt->bind_param("s", $token);
    $fetch_stmt->execute();
    $result = $fetch_stmt->get_result();
    if ($result->num_rows == 1) {
    $row=$result->fetch_assoc();
    $current_time = time();
      if ($current_time > $row['expiration_time']) {
        $_SESSION['error']="Password reset link has expired. Please request a new one.";
        return false;
    }
    else{
        if($password==$confirmPassword){
           $hashed_password = password_hash($password, PASSWORD_DEFAULT);
           $query="UPDATE admin SET password = '$hashed_password' WHERE email = (SELECT email FROM password_reset WHERE token = ?)";
            $stmt  = $mysqli->prepare($query);
            if (false === $stmt) {
                trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
            } else {
                $stmt->bind_param("s",$token);
                $stmt->execute();
                echo "<script>window.location.href = '../index.php'</script>";
                // $_SESSION['success'] = "Congratulations! Your password has been changed successfully";
                return true;
            }

        }
    }
    }
    else{
        $_SESSION['error']="Token not valid. Leave this page";
        return false;
    }

  }
    function showAdmin($admId)
    {
        $db= Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "SELECT * FROM admin WHERE id='" . $admId . "';";
        $stmt   = $mysqli->query($query);
        return $stmt;
    }
    
    function adminImage($img_name, $img_tmpName, $userId)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $img_ext = explode(".", $img_name);
        $img_act_ext= strtolower(end($img_ext));
        $time       = date("d-m-Y") . "-" . time();
        $file_name  = "img-" . $time . "." . $img_act_ext;
        $img_destination = "../public/user/" . $file_name;
        
        $query = "UPDATE admin SET image=? WHERE id=?;";
        $stmt  = $mysqli->prepare($query);
        if (false === $stmt) {
            trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
        } else {
            if ($img_tmpName != "") {
                $stmt->bind_param("si", $file_name, $userId);
                $stmt->execute();
                move_uploaded_file($img_tmpName, $img_destination);
                $_SESSION['success'] = "Image Change successfully";
                return true;
            }
        }
    }
    
    function changePassword($oldPassword, $password, $userName)
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        password_hash($oldPassword, PASSWORD_DEFAULT);
        // Prepare SQL statement
        $stmt = $mysqli->prepare("SELECT * FROM admin WHERE email = ?");
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $result = $stmt->get_result();
        // User exists, fetch the hashed password
        $row    = $result->fetch_assoc();
        // Verify the password
        if (password_verify($oldPassword, $row["password"])) {
            // update process
            $query = "UPDATE admin SET password=? WHERE email=?;";
            $stmt  = $mysqli->prepare($query);
            if (false === $stmt) {
                trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
            } else {
                $stmt->bind_param("ss", $password, $userName);
                $stmt->execute();
                $_SESSION['success'] = "Congratulations! Your password has been changed successfully";
                return true;
            }
        } else {
            $_SESSION['error'] = "Old password does not match";
            return false;
        }
    }
    
    function updateAdmin($name, $phone, $email, $userId)
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "UPDATE admin SET name=?,phone=?,email=? WHERE id=?;";
        $stmt   = $mysqli->prepare($query);
        if (false === $stmt) {
            trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
        } else {
            $stmt->bind_param("sssi", $name, $phone, $email, $userId);
            $stmt->execute();
            $_SESSION['success'] = "User details update successfully";
            return true;
        }
    }
    
    
    function addRoom($rNumber, $nBed, $rBed, $fId)
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        
        $query       = "insert into `rooms`(`roomNumber`, `bedPerRoom`, `rentPerBed`, `floor_id`)values(?,?,?,?)";
        $stmt        = $mysqli->prepare($query);
        $fetch_query = "SELECT roomNumber FROM rooms WHERE roomNumber=? ";
        $fetch_stmt  = $mysqli->prepare($fetch_query);
        if (false === $fetch_stmt) {
            trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
        } else {
            $fetch_stmt->bind_param("i", $rNumber);
            $fetch_stmt->execute();
            $fetch_stmt->bind_result($rNumber);
            $rs = $fetch_stmt->fetch();
            if ($rs) {
                $_SESSION['error'] = "Room number already exist";
                return false;
            } else {
                if (false === $stmt) {
                    trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
                } else {
                    // header('location:add-course.php');
                    $stmt->bind_param("iiii", $rNumber, $nBed, $rBed, $fId);
                    $stmt->execute();
                    $_SESSION['success'] = "Room has been added successfully";
                    return true;
                }
            }
        }
    }
    
    function showRoom()
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "SELECT floors.name AS floorname,rooms.id, rooms.roomNumber, rooms.bedPerRoom, rooms.rentPerBed FROM rooms INNER JOIN floors ON rooms.floor_id = floors.id;";
        $stmt   = $mysqli->query($query);
        return $stmt;
    }
    
    function editRoom($rNumber, $nBed, $rBed, $fId, $rId)
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        
        $query = "UPDATE `rooms` SET `roomNumber`=?,`bedPerRoom`=?,`rentPerBed`=?,`floor_id`=? WHERE id=?;";
        $stmt  = $mysqli->prepare($query);
        
        if (false === $stmt) {
            trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
        } else {
            // header('location:add-course.php');
            $stmt->bind_param("iiiii", $rNumber, $nBed, $rBed, $fId, $rId);
            $stmt->execute();
            $_SESSION['success'] = "Room has been Updated";
            return true;
        }
    }
    
    function showRoom1($rid)
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "SELECT floors.name AS floorname, floors.id AS floorid, rooms.id, rooms.roomNumber, rooms.bedPerRoom, rooms.rentPerBed FROM rooms INNER JOIN floors ON rooms.floor_id = floors.id WHERE rooms.id = '" . $rid . "';";
        $stmt   = $mysqli->query($query);
        return $stmt;
    }
    
    function deleteRoom($id)
    {
        //  echo $id;exit;
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "delete from rooms where id=?";
        $stmt   = $mysqli->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $_SESSION['success'] = "Room has been deleted";
    }
   function addUser($firstName, $middleName, $lastName, $dateOfBirth, $gender, $caste, $religion, $nationality, $bloodGroup, $fatherName, $fatherMobile, $fatherEducation, $fatherProfession, $motherName, $motherMobile, $motherEducation, $motherProfession, $profession, $organization, $userPost, $hostelJoinDate, $room_id, $guardianName, $guardianPhone, $relationWithGuardian, $phone, $email,$district_id, $municipality, $wardNumber, $tole)
{
    $db = Database::getInstance();
    $mysqli = $db->getConnection();
    $query = "INSERT INTO users (firstName, middleName, lastName, dateOfBirth, gender, caste, religion, nationality, bloodGroup, fatherName, fatherMobile, fatherEducation, fatherProfession, motherName, motherMobile, motherEducation, motherProfession, profession, organization, userPost, hostelJoinDate, room_id, guardianName, guardianPhone, relationWithGuardian, phone, email,district_id, municipality, wardNumber, tole) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    if ($stmt === false) {
        $_SESSION['error'] = "Error in query: " . $mysqli->error;
        echo $_SESSION['error'];
        return false; // Return false to indicate failure
    }

    // Define parameter types based on the data types of your columns
    $paramTypes = "sssssssssssssssssssssssssssssss";
    // Bind parameters
    $stmt->bind_param($paramTypes, $firstName, $middleName, $lastName, $dateOfBirth, $gender, $caste, $religion, $nationality, $bloodGroup, $fatherName, $fatherMobile, $fatherEducation, $fatherProfession, $motherName, $motherMobile, $motherEducation, $motherProfession, $profession, $organization, $userPost, $hostelJoinDate, $room_id, $guardianName, $guardianPhone, $relationWithGuardian, $phone, $email,$district_id, $municipality, $wardNumber, $tole);

    // Execute the statement
    $result = $stmt->execute();
    if ($result === false) {
        // Handle execution error
        $_SESSION['error'] = "Error executing query: " . $stmt->error;
         echo $_SESSION['error'];
        return false; // Return false to indicate failure
    }

    // Set success message
    $_SESSION['success'] = "New student has been added";
    echo  $_SESSION['success'];
    return true; // Return true to indicate success
}

    
    function showUser()
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "SELECT * from users";
        $stmt   = $mysqli->query($query);
        return $stmt;
    }
    function showUser1($userId)
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "SELECT users.*,floors.name AS floorname, rooms.roomNumber, rooms.bedPerRoom AS bedPerRoom, rooms.rentPerBed AS rentPerBed,districts.name AS district,provinces.name AS province from users inner join rooms on users.room_id=rooms.id inner join floors on rooms.floor_id=floors.id inner join districts on users.district_id=districts.id inner join provinces on districts.province_id=provinces.id WHERE users.id = '$userId'; ";
        $stmt   = $mysqli->query($query);
        return $stmt;
    }
    
    function editUser($firstName, $middleName, $lastName, $dateOfBirth, $gender, $caste, $religion, $nationality, $bloodGroup, $fatherName, $fatherMobile, $fatherEducation, $fatherProfession, $motherName, $motherMobile, $motherEducation, $motherProfession, $profession, $organization, $userPost, $hostelJoinDate, $room_id, $guardianName, $guardianPhone, $relationWithGuardian, $phone, $email,$district_id, $municipality, $wardNumber, $tole, $userId)
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        
        $query = "UPDATE `users` SET firstName=?, middleName=?, lastName=?, dateOfBirth=?, gender=?, caste=?, religion=?, nationality=?, bloodGroup=?,fatherName=?, fatherMobile=?, fatherEducation=?, fatherProfession=?,motherName=?, motherMobile=?, motherEducation=?, motherProfession=?,profession=?, organization=?, userPost=?, hostelJoinDate=?, room_id=?,guardianName=?, guardianPhone=?, relationWithGuardian=?,phone=?, email=?,district_id=?,municipality=?, wardNumber=?, tole=? WHERE id=?;";
        $stmt  = $mysqli->prepare($query);
        
        if (false === $stmt) {
            trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
        } else {
            // header('location:add-course.php');
            $stmt->bind_param("sssssssssssssssssssssssssssssssi", $firstName, $middleName, $lastName, $dateOfBirth, $gender, $caste, $religion, $nationality, $bloodGroup, $fatherName, $fatherMobile, $fatherEducation, $fatherProfession, $motherName, $motherMobile, $motherEducation, $motherProfession, $profession, $organization, $userPost, $hostelJoinDate, $room_id, $guardianName, $guardianPhone, $relationWithGuardian, $phone, $email,$district_id, $municipality, $wardNumber, $tole, $userId);
            $stmt->execute();
            $_SESSION['success'] = "Student details has been Updated";
            return true;
        }
    }
    function deleteUser($userId)
    {
        //  echo $id;exit;
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "delete from users where id=?";
        $stmt   = $mysqli->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $_SESSION['success'] = "Student has been deleted";
        return true;
    }
    function deactiveUser($leaveId)
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        
      $query = "UPDATE `users` SET status='Leave', leaveDate='" . date('Y-m-d') . "' WHERE id=?;";
        $stmt  = $mysqli->prepare($query);
        
        if (false === $stmt) {
            trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
        } else {
            $stmt->bind_param("i", $leaveId);
            $stmt->execute();
            $_SESSION['success'] = "Leave status update successfully";
            return true;
        }
        
    }
    function userImage($img_name, $img_tmpName, $userId)
    {
        $db              = Database::getInstance();
        $mysqli          = $db->getConnection();
        $img_ext         = explode(".", $img_name);
        $img_act_ext     = strtolower(end($img_ext));
        $time            = date("d-m-Y") . "-" . time();
        $file_name       = "img-" . $time . "." . $img_act_ext;
        $img_destination = "../public/user/" . $file_name;
        $query           = "UPDATE users SET image=? WHERE id=?;";
        $stmt            = $mysqli->prepare($query);
        if (false === $stmt) {
            trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
        } else {
            if ($img_tmpName != "") {
                $stmt->bind_param("si", $file_name, $userId);
                $stmt->execute();
                move_uploaded_file($img_tmpName, $img_destination);
                $_SESSION['success'] = "Image Change successfully";
                return false;
            }
        }
    }
    
    function addPayment($year, $month)
    {
        $db          = Database::getInstance();
        $mysqli      = $db->getConnection();
        // Check if a payment already exists for the specified year and month
        $fetch_query = "SELECT * FROM payment WHERE year = ? AND month = ?";
        $fetch_stmt  = $mysqli->prepare($fetch_query);
        // Bind the parameters with the actual values
        $fetch_stmt->bind_param("ss", $year, $month);
        // Execute the query
        $fetch_stmt->execute();
        // Get the result
        $result = $fetch_stmt->get_result();
        
        if ($result->num_rows == 0) { // No existing payment found
            $query = "INSERT INTO payment (user_id, rent, dueAmount, status,additionalCharge,remarks,year, month, billGeneratedDate)
                  SELECT users.id, rooms.rentPerBed, rooms.rentPerBed, 'Unpaid',0,'', ?, ?, CURDATE()
                  FROM users
                  INNER JOIN rooms ON users.room_id = rooms.id
                  WHERE users.status = 'active'"; // Changed status='active' to users.status='active'
            
            $stmt = $mysqli->prepare($query);
            if (false === $stmt) {
                // Handle the case where preparing the query failed
                trigger_error("Error in query: " . mysqli_error($mysqli), E_USER_ERROR);
            } else {
                $stmt->bind_param("ss", $year, $month);
                $stmt->execute();
                $_SESSION['success'] = "Bill generated successfully";
                return false;
            }
        } else {
            // Payment already exists for the specified year and month
            $_SESSION['error'] = "Payment already exists for the specified year and month.";
        }
    }
    
    function showPayment()
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "SELECT users.image, CONCAT(users.firstName, ' ', users.middleName, ' ', users.lastName) AS fullName, payment.*
              FROM payment
              INNER JOIN users ON payment.user_id = users.id WHERE payment.status !='Paid' AND payment.status !='Advance Payment'
              ORDER BY payment.payment_id DESC;";
        $stmt   = $mysqli->query($query);
        return $stmt;
    }
    function showPayment1($userId)
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "SELECT * FROM payment WHERE user_id = $userId ORDER By payment_id DESC;";
        $stmt   = $mysqli->query($query);
        return $stmt;
    }
    
    function deletePaymentList($deleteYear, $deleteMonth)
    {
        //  echo $id;exit;
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "DELETE FROM payment WHERE year = ? AND month = ? AND status='Unpaid';";
        $stmt   = $mysqli->prepare($query);
        if ($stmt === false) {
            // Handle error here, such as echoing or logging an error message
            // Example: echo "Error: " . $mysqli->error;
            exit;
        }
        $stmt->bind_param("ss", $deleteYear, $deleteMonth);
        $stmt->execute();
        
        // Check if the deletion was successful
        if ($stmt->affected_rows > 0) {
            $_SESSION['success'] = "The bill has been deleted";
            return true;
        } else {
            // Handle case where no rows were affected (i.e., no matching records found)
            $_SESSION['error'] = "No bills were deleted.";
            return false;
        }
        
        $stmt->close();
    }
    
    function addExtraCharge($userId, $year, $month, $additionalCharge, $remarks)
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        
        // Select conditional data from the payment table
        $query = "SELECT * FROM payment WHERE user_id = ? AND year = ? AND month = ? AND additionalCharge <= 0";
        $stmt  = $mysqli->prepare($query);
        $stmt->bind_param("iss", $userId, $year, $month);
        $stmt->execute();
        $result = $stmt->get_result();
        
        
        // Check if the condition is met
        if ($result->num_rows == 1) {
            
            // Condition met, start the update process
            $updateQuery = "UPDATE payment SET additionalCharge = ?,dueAmount=dueAmount+$additionalCharge, remarks = ? WHERE user_id = ? AND year = ? AND month = ?";
            $updateStmt  = $mysqli->prepare($updateQuery);
            $updateStmt->bind_param("dsiss", $additionalCharge, $remarks, $userId, $year, $month);
            $updateStmt->execute();
            $_SESSION['success'] = "Additional charge updated successfully";
            return true;
        } else {
            $_SESSION['error'] = "No additional charge were updated";
            return false;
        }
    }
    
    function addVendor($vendorName, $vendorContactPerson, $vendorContact, $vendorGmail, $vendorAddress)
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "INSERT INTO vendors (vendorName, vendorContactPerson, vendorContact, vendorGmail, vendorAddress) VALUES (?, ?, ?, ?, ?)";
        $stmt   = $mysqli->prepare($query);
        if (false === $stmt) {
            trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
        } else {
            $stmt->bind_param("sssss", $vendorName, $vendorContactPerson, $vendorContact, $vendorGmail, $vendorAddress);
            $stmt->execute();
            $_SESSION['success'] = "New vendor has been added successfully";
            return true;
        }
    }
    
    function showVendor()
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "SELECT * FROM vendors";
        $stmt   = $mysqli->query($query);
        return $stmt;
    }
    
    function addPurchase($vendor_id, $item, $billNumber, $quantity, $unit, $rate, $totalAmount, $paidAmount, $dueAmount, $purchaseDate, $status)
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "INSERT INTO purchases (vendor_id, item,billNumber, quantity, unit, rate, totalAmount, paidAmount, dueAmount, purchaseDate, status) VALUES (?, ?, ?, ?, ?,?,?,?,?,?,?)";
        $stmt   = $mysqli->prepare($query);
        if (false === $stmt) {
            trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
        } else {
            $stmt->bind_param("issssssssss", $vendor_id, $item, $billNumber, $quantity, $unit, $rate, $totalAmount, $paidAmount, $dueAmount, $purchaseDate, $status);
            $stmt->execute();
            $_SESSION['success'] = "Purchase has been added successfully";
            return true;
        }
    }
    function showPurchase()
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "SELECT * FROM purchases;";
        $stmt   = $mysqli->query($query);
        return $stmt;
    }
    function deletePurchase($id)
    {
        //  echo $id;exit;
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "delete from purchases where id=?";
        $stmt   = $mysqli->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $_SESSION['success'] = "Purchase has been deleted successfully";
        return true;
    }
    function editPurchase($vendor_id, $item, $billNumber, $quantity, $unit, $rate, $totalAmount, $paidAmount, $dueAmount, $purchaseDate, $status, $pId)
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        
        $query = "UPDATE `purchases` SET vendor_id=?, item=?,billNumber=?, quantity=?, unit=?, rate=?, totalAmount=?, paidAmount=?, dueAmount=?, purchaseDate=?, status=? WHERE purchase_id=?;";
        $stmt  = $mysqli->prepare($query);
        
        if (false === $stmt) {
            trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
        } else {
            $stmt->bind_param("issssssssssi", $vendor_id, $item, $billNumber, $quantity, $unit, $rate, $totalAmount, $paidAmount, $dueAmount, $purchaseDate, $status, $pId);
            $stmt->execute();
            $_SESSION['success'] = "Purchase has been updated successfully.";
            return true;
        }
    }
    
    function showPurchase1($pid)
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "SELECT purchases.*, vendors.* FROM purchases INNER JOIN vendors ON purchases.vendor_id = vendors.vendor_id WHERE purchase_id = '" . $pid . "';";
        $stmt   = $mysqli->query($query);
        return $stmt;
    }
    
    function showPurchaseWithVendor($vid)
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "SELECT * FROM purchases WHERE vendor_id = '" . $vid . "';";
        $stmt   = $mysqli->query($query);
        return $stmt;
    }
    
    function payPurchaseDueAmount($amount, $status, $payId, $vendorId, $purchaseId, $paymentDate)
    {
        $db        = Database::getInstance();
        $mysqli    = $db->getConnection();
        $stmtFetch = $mysqli->prepare("SELECT * FROM purchases where purchase_id = ?");
        $stmtFetch->bind_param("i", $payId);
        $stmtFetch->execute();
        $result = $stmtFetch->get_result();
        if ($result->num_rows == 1) {
            // User exists, fetch the hashed password
            $row        = $result->fetch_assoc();
            $dueAmount  = $row["dueAmount"];
            $paidAmount = $row["paidAmount"];
            
            if ($dueAmount == $paidAmount) {
                $_SESSION['error'] = "Invalid Payment";
                return false;
            } else {
                $query = "UPDATE `purchases` SET paidAmount=$paidAmount+?,dueAmount=$dueAmount-?,paymentDate=?,status=? WHERE purchase_id=?;";
                $stmt  = $mysqli->prepare($query);
                if (false === $stmt) {
                    trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
                } else {
                    $stmt->bind_param("ddssi", $amount, $amount, $paymentDate, $status, $payId);
                    $stmt->execute();
                    $_SESSION['success'] = "Payment paid successfully";
                }
            }
        }
    }
    
    
    function paymentProcess($amountPay, $paymentMethod, $status, $paidDate, $paymentId, $userId)
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        
        //start the update process payment
        $paymentQuery = "UPDATE payment SET paidAmount=?,dueAmount=dueAmount-?,status=?,paymentMethod=?,paymentDate=? WHERE payment_id = ?;";
        $paymentStmt  = $mysqli->prepare($paymentQuery);
        $paymentStmt->bind_param("ddsssi", $amountPay, $amountPay, $status, $paymentMethod, $paidDate, $paymentId);
        $paymentStmt->execute();
        $_SESSION['success'] = "Student payment retrieved successfully";
        
    }
    function countUser()
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "SELECT COUNT(*) AS total_users FROM users;";
        $stmt   = $mysqli->query($query);
        return $stmt;
    }
    function countPurchaseAmount()
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "SELECT SUM(totalAmount) AS total_purchase,SUM(paidAmount) AS total_paid,SUM(dueAmount) AS total_due FROM purchases;";
        $stmt   = $mysqli->query($query);
        return $stmt;
    }
    function userPayment()
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "SELECT SUM(rent) AS total_rent,SUM(dueAmount) AS total_due,SUM(paidAmount) AS total_paid FROM payment;";
        $stmt   = $mysqli->query($query);
        return $stmt;
    }
    function showUnpaidStatus1()
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "SELECT payment.user_id,
       GROUP_CONCAT(CONCAT(month, '-', year) ORDER BY year, month) AS months_years,
       GROUP_CONCAT(payment.status ORDER BY payment.status) AS status,
       SUM(payment.dueAmount) AS total_due,
       CONCAT(users.firstName, ' ', users.middleName, ' ', users.lastName) AS fullName,
       users.image,users.guardianName,users.guardianPhone 
FROM payment
INNER JOIN users ON payment.user_id = users.id
WHERE payment.status = 'Unpaid' OR payment.status = 'Partial Payment'
GROUP BY payment.user_id;";
        $stmt   = $mysqli->query($query);
        return $stmt;
    }
    function showPurchaseDashboard()
    {
        $db     = Database::getInstance();
        $mysqli = $db->getConnection();
        $query  = "
SELECT 
p.status,
    p.billNumber, 
    MAX(p.paymentDate) AS paymentDate, 
    SUM(p.totalAmount) AS totalAmountSum, 
    SUM(p.paidAmount) AS paidAmountSum, 
    SUM(p.dueAmount) AS dueAmountSum, 
    DATE_FORMAT(MAX(p.purchaseDate), '%d') AS pdate, 
    DATE_FORMAT(MAX(p.purchaseDate), '%M') AS pmonth, 
    v.vendorName 
FROM 
    (SELECT 
         status,
         billNumber, 
         totalAmount, 
         paidAmount, 
         dueAmount, 
         purchaseDate, 
         paymentDate, 
         vendor_id 
     FROM 
         purchases) AS p 
JOIN 
    vendors v ON p.vendor_id = v.vendor_id 
GROUP BY 
    p.billNumber 
ORDER BY 
    p.purchaseDate DESC;
;";
        $stmt   = $mysqli->query($query);
        return $stmt;
    }
}


?>

