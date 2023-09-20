<?php 
require 'config/function.php';

if (isset($_POST['loginBtn'])){
    $email = validate($_POST['email']);
    $password = validate($_POST['password']); // Retrieve and validate the password field.

    if ($email != '' && $password != '') { // Check if both email and password are not empty.
        // Use prepared statements to prevent SQL injection.
        $query = "SELECT * FROM admins WHERE email = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $hashedPassword = $row['password'];

                // Use password_verify to compare the user-entered password with the hashed password.
                if (password_verify($password, $hashedPassword)) {
                    // Passwords match, user is authenticated. You can proceed with login.

                    if ($row['is_ban'] == 1) {
                        redirect('login.php', 'Your account has been banned, contact Admin for help!');
                    }

                    // Start a session and store user information.
                    session_start();
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['loggedInUser'] = [
                        'user_id' => $row['id'],
                        'name' => $row['name'],
                        'email' => $row['email'],
                        'phone' => $row['phone'],
                    ];
                    
                    redirect('admin/index.php', 'Logged In Successfully!');
                } else {
                    redirect('login.php', 'Wrong Password!');
                }
            } else {
                redirect('login.php', 'Invalid Email Address!');
            }
        } else {
            redirect('login.php', 'Oops! Something went wrong!');
        }
    } else {
        redirect('login.php', 'All fields MUST be entered');
    }
}
?>
