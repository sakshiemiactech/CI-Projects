<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application - Edit User</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Form with border and spacing -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">CRUD Application - Edit User</h3>
                    </div>
                    <div class="card-body">
                    <form action = "<?php echo base_url('update').$user['user_id']?>" method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php if(isset($user['name'])){ echo  $user['name'] ; }?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php if(isset($user['email'])){ echo  $user['email'] ; }?>" required>
                            </div>
                            <!-- Add more form fields as needed -->

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="<?php echo base_url('viewusers'); ?>" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery (for optional functionality) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
