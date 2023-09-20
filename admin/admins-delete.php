<?php
require '../config/function.php';

$paraResultId = checkParamId('id');

if (is_numeric($paraResultId)) {
    $adminId = validate($paraResultId);
    $admin = getById('admins', $adminId);

    // Check if the admin exists
    if ($admin['status'] == 200) {
        redirect('admins.php', 'Admin not found!');
    }

    // Delete the admin
    $adminDeleteRes = deleteRecord('admins', $adminId);
    
    if ($adminDeleteRes) {
        redirect('admins.php', 'Admin Deleted Successfully!');
    } else {
        redirect('admins.php', 'Failed to delete admin.');
    }
} else {
    redirect('admins.php', 'Invalid admin ID.');
}
?>
