<?php include('includes/header.php');

if(isset($_SESSION['loggedIn'])){
    ?>
    <script>window.location.href = 'index.php'</script>
    <?php
}
?>



<div class="py-5 bg-dark" style="background-image: url('images/sl.jpg'); background-size: cover; background-repeat: no-repeat; height: 100vh;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow rounded-4">

                <?php alertMessage()?>

                    <div class="p-5">
                        <h4 class="text-dark mb-3">Sign into Your POS System</h4>
                        <form action="login-code.php" method="POST">
                            <div class="mb-4">
                                <label class="form-label text-secondary">Enter Your Email</label>
                                <input type="email" name="email" class="form-control" required/>
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-secondary">Enter Your Password</label>
                                <input type="password" name="password" class="form-control" required/>
                            </div>
                            <button type="submit" name="loginBtn" class="btn btn-primary w-100 mt-3">
                                Sign In
                            </button>
                        </form>
                    </div>
                </div>
            </div>      
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>
