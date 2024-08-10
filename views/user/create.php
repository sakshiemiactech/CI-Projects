<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application - Create User</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Form with border and spacing -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">CRUD Application - Create User</h3>
                    </div>
                    <div class="card-body">
                        <form action = "<?php echo base_url('create_new_entry'); ?>" method="post">
                            <!-- Name input field -->
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" name="name" value="" class="form-control" required>
                            </div>

                            <!-- Email input field -->
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" value="" class="form-control" required>
                            </div>

                            <!-- Submit button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
