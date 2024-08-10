<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
    .adbt{
        background-color: #000;
    }
    .adbt:hover{
        background-color: #000;
    }
</style>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- Form with border and spacing -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-10"><h3 class="mb-0">View Users</h3></div>
                                        <div class="col-2" text-right">
                                            <a href="<?php echo base_url('form')?>" class="adbt btn btn-primary">Create</a>
                                        </div></div><hr></div></div></div>
                

                    
                    <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Message</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Hobbies</th>
                                <th>Job Profile</th>
                                <th width="60">Edit</th>
                                <th width="60">Delete</th>
                            </tr>
                            <?php if(!empty($forms))  {foreach ($forms as $form){?>
                            <tr>
                                <td><?php echo $form['id']?></td>
                                <td><?php echo $form['name']?></td>
                                <td><?php echo $form['message']?></td>
                                <td><?php echo $form['gender']?></td>
                                <td><?php echo $form['email']?></td>
                                <td><?php echo $form['password']?></td>
                                <td><?php echo $form['hobbies']?></td>
                                <td><?php echo $form['job_profile']?></td>
                            <td>
                                <a href="<?php echo base_url('edit')?>" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <a href="<?php echo base_url('delete').$form['id']?>" class="btn btn-danger">Delete</a>
                            </td>
                            </tr>
                            <?php
                            } 
                        }
                        else{}?>
                            </table>
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
