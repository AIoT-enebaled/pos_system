<?php include('includes/header.php') ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header"> <!-- Corrected class name -->
            <h4 class="mb-0">Add Admin
                <a href="admins.php" class="btn btn-primary float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="code.php" method="POST">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="name">Name *</label> <!-- Added "for" attribute and corrected name attribute -->
                        <input type="text" name="name" required class="form-control" id="name"/> <!-- Added "id" attribute -->
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Email *</label> <!-- Added "for" attribute and corrected name attribute -->
                        <input type="email" name="email" required class="form-control" id="email"/> <!-- Added "id" attribute -->
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password">Password *</label> <!-- Added "for" attribute and corrected name attribute -->
                        <input type="password" name="password" required class="form-control" id="password"/> <!-- Added "id" attribute -->
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone">Phone Number *</label> <!-- Added "for" attribute and corrected name attribute -->
                        <input type="number" name="phone" required class="form-control" id="phone"/> <!-- Added "id" attribute -->
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="is_ban">Is Ban</label><br/> <!-- Added "for" attribute -->
                        <input type="checkbox" name="is_ban" style="width:30px; height:30px;" id="is_ban"/> <!-- Added "id" attribute -->
                    </div>
                    <div class="col-md-3 mb-3">
                        <button type="submit" name="saveAdmin" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>
