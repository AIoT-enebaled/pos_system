<?php 
include('../config/function.php');

if (isset($_POST['saveAdmin'])){
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);	
    $is_ban = isset($_POST['is_ban']) == true ? 1:0;

    if($name != '' && $email != '' && $password != ''){

        $emailCheck = mysqli_query($conn, "SELECT * FROM admins WHERE email = '$email'");
        if($emailCheck){
            if(mysqli_num_rows($emailCheck)> 0){
                redirect('admins-create.php', 'Email Already is used by another User!');
            }
        }

        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

        $data =[
        'name' =>$name,
        'email' =>$email,
        'password' =>$bcrypt_password,
        'phone' =>$phone,
        'is_ban' =>$is_ban
            				
        ];

        $result = insert('admins',$data);
        if ($result){
            redirect('admins.php', 'Admin Created Successfully');

        }else{
            redirect('admins-create.php', 'Something Went Wrong!');
        }

    }else {
        redirect('admins-create.php', 'Please fill the required fields!');
    }

}

if (isset($_POST['updateAdmin'])){

    $adminId = validate($_POST['adminId']);

    $adminData = getById('admins', $adminId);
    if($adminData['status'] != 200){
        redirect('admins-edit.php?id='.$adminId, 'Please fill the Required fields!');

    }

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);	
    $is_ban = isset($_POST['is_ban']) == true ? 1:0;

    $EmailCheckQuery = "SELECT * FROM admins WHERE email='$email' AND id!='$adminId'";
    $checkResult = mysqli_query($conn, $EmailCheckQuery);
    if ($checkResult){
        if(mysqli_num_rows($checkResult)>0){
            redirect('admins-edit.php?id='.$adminId, 'Email Already used by another user');
        }
    }

    if ($password != ''){
        $hashedPassword = password_hash($password,PASSWORD_BCRYPT);
    }
    else{
        $hashedPassword = $adminData['data']['password'];
    }

    if($name != '' && $email != '')
    {
        $data =[
            'name' =>$name,
            'email' =>$email,
            'password' =>$hashed_password,
            'phone' =>$phone,
            'is_ban' =>$is_ban
                                
            ];

            $result = update('admins', $adminId, $data);
            if ($result){
            redirect('admins-edit.php?id='.$adminId, 'Admin Updated Successfully');

            }else{
            redirect('admins-edit.php?id='.$adminId, 'Something Went Wrong!');
            }
        }
    else
    {
        redirect('admins-create.php', 'Please fill the Required fields!');
    }

}
?>