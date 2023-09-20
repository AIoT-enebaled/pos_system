<?php include('includes/header.php') ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header"> <!-- Corrected class name -->
            <h4 class="mb-0">Edit Admin
                <a href="admins.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="code.php" method="POST">

                <?php
                    if(isset($_GET['id'])){
                        if($_GET['id'] != ''){

                            $adminId = $_GET['id'];

                        }else{
                            echo '<h5>Id not Found!</h5>';
                            return false;
                        }
                        
                    }
                    else{
                        echo '<h5>Id is not given!</h5>';
                            return false;
                    }

                    $adminData = getById('admins', $adminId);
                    if($adminData){
                        if($adminData['status'] == 200)
                        {
                            ?>
                            <input type="hidden" name="adminId" value="<?=$adminData['data']['id'];?>">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name">Name *</label> <!-- Added "for" attribute and corrected name attribute -->
                                    <input type="text" name="name" required value="<?=$adminData['data']['name'];?>" class="form-control" id="name"/> <!-- Added "id" attribute -->
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email">Email *</label> <!-- Added "for" attribute and corrected name attribute -->
                                    <input type="email" name="email" required value="<?=$adminData['data']['email'];?>" class="form-control" id="email"/> <!-- Added "id" attribute -->
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password">Password *</label> <!-- Added "for" attribute and corrected name attribute -->
                                    <input type="password" name="password"  class="form-control"/> <!-- Added "id" attribute -->
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone">Phone Number *</label> <!-- Added "for" attribute and corrected name attribute -->
                                    <input type="number" name="phone" value="<?=$adminData['data']['phone'];?>" class="form-control"/> <!-- Added "id" attribute -->
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="is_ban">Is Ban</label><br/> <!-- Added "for" attribute -->
                                    <input type="checkbox" name="is_ban" <?= $adminData['data']['is_ban'] == true ? 'checked':'';?> style="width:30px; height:30px;" id="is_ban"/> <!-- Added "id" attribute -->
                                </div>
                                <div class="col-md-3 mb-3">
                                    <button type="submit" name="updateAdmin" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                            <?php

                        }else
                        {
                            echo '<h5>'.$adminData['message'].'</h5>';
                        }

                    }
                    else{
                        echo '<h5>Something Went Wrong!</h5>';
                            return false;
                    }
                ?>
                
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>
