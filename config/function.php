<?php
session_start();

require 'dbcon.php';
//input field validation
function validate($inputData){

    global $conn;
    $validateData = mysqli_real_escape_string($conn, $inputData);
    return trim($validateData);
}
//Redirect from a page to another page
function redirect($url, $status){

    $_SESSION['status'] = $status;
    header('Location:'.$url);
    exit(0);
}


//========Status Notifications=======

function alertMessage(){
    if (isset($_SESSION['status'])){
         $_SESSION['status'];
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <h6>'.$_SESSION['status'].'</h6>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        unset($_SESSION['status']);
    }
}

//=========inserting records=========
//=========inserting records=========
function insert($tableName, $data){
    global $conn;

    $table = validate($tableName);
    
    $columns = array_keys($data);
    $values = array_map(function ($value) use ($conn) {
        return "'" . mysqli_real_escape_string($conn, $value) . "'";
    }, array_values($data));

    $finalColumn = implode(', ', $columns);
    $finalValues = implode(', ', $values);

    $query = "INSERT INTO $table ($finalColumn) VALUES ($finalValues)";
    $result = mysqli_query($conn, $query);
    
    return $result;
}


function update($tableName, $id, $data)
{

    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $updateDataString = "";

    foreach ($data as $column => $value) {
        $updateDataString .= $column . '=' . "'$value',";
    }

    $finalUpdateData = substr(trim($updateDataString), 0, -1);

    // Use a placeholder for the item ID in the WHERE clause
    $query = "UPDATE $table SET $finalUpdateData WHERE id = ?";

    // Create a prepared statement
    $stmt = mysqli_prepare($conn, $query);

    // Bind the item ID value to the prepared statement
    mysqli_stmt_bind_param($stmt, "s", $id);

    // Execute the prepared statement
    $result = mysqli_stmt_execute($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    return $result;
}

//======= get all data from table =====

function getAll($tableName, $status = NULL){

    global $conn;

    if ($status == 'status'){
        $query = "SELECT * FROM $tableName WHERE $status = '0'";
    }
    else{
        $query = "SELECT * FROM $tableName";
    }
    return mysqli_query($conn, $query);
}

//=========getting each record=======

function getById($tableName, $id){

    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "SELECT * FROM $table WHERE id ='$id'LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result){
        if (mysqli_num_rows($result) == 1){

            $row = mysqli_fetch_assoc($result);

            $response = [
                'status' =>200,
                'data' => $row,
                'message' =>'Record found'
            ];
            return $response;

        }else{
            $response = [
                'status' =>404,
                'message' =>'No record found'
            ];
            return $response;
        }

    }else{
        $response = [
            'status' =>500,
            'message' =>'Error occurred!!'
        ];
        return $response;
    }
}

//=======detting records========

function deleteRecord($tableName, $id){

    global $conn;

    $table = validate($tableName);
    $id = validate($id);
    
    $query = "DELETE FROM $table WHERE id = '$id' LIMIT 1";
    $result = $conn->query($conn, $query);
    return $result;
}

function checkParamId($type){
    if(isset($_GET[$type])){
        if($_GET[$type] != ''){

            return $_GET[$type];

        }else{
            return '<h5>No Id Found</h5>';
        }
    }else{
        return '<h5>No Id Given</h5>';
    }
}

/**
 * Summary of logoutSession
 * @return void
 */
function logoutSession(){
    unset($_SESSION['loggedIn']);
    unset($_SESSION['loggedInUser']);
}
?>