<!DOCTYPE html>
<html>
<head>
    <title>Testing Table Data</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add custom styles here */
        .container {
            margin-top: 30px;
        }

        .table {
            background-color: #f8f9fa;
        }

        .table th, .table td {
            text-align: center;
        }

        .table thead {
            background-color: #343a40;
            color: #ffffff;
        }

        .table th {
            border-top: none;
        }

        .create-view-button {
            position: absolute;
            top: 10px;
            left: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="btn-group">
        <div class="dropdown-menu">
            <!-- Loop through the view names fetched from the controller -->
        </div>
    </div>

    
        <!-- Display the table when $user is empty -->
      <?php if(!empty($filterViewData['view_name'])) {?> 
        

        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#filterModal">Create a View</button>
        <select name="viewName" class="form-control" id="selectView">
            <option value="">Select View</option>
            <?php foreach ($views as $view) { ?>
                <option <?php  if ($view == $filterViewData['view_name']) echo 'selected'; ?> value="<?php if (!empty($view)) echo $view; ?>"> <?php if (!empty($view)) echo $view; ?> </option>
            <?php } ?>
        </select>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <?php if(isset($postData['Name'])){?> <th>Name</th> <?php }?>  
                    <?php if(isset($postData['Email'])){?> <th>Email</th> <?php }?> 
                    <?php if(isset($postData['Age'])){?> <th>Age</th> <?php }?> 
                    <?php if(isset($postData['Address'])){?> <th>Address</th> <?php }?>    
                    <?php if(isset($postData['City'])){?> <th>City</th> <?php }?>  
                    <?php if(isset($postData['Country'])){?> <th>Country</th> <?php }?>  
                    <?php if(isset($postData['Position'])){?> <th>Position</th> <?php }?> 
                </tr>
            </thead>
            <tbody>
            <?php foreach ($testingTable as $employee) {   ?>
                <tr>
                <?php if(isset($postData['Name'])){?>  <td><?= $employee['Name']; ?></td> <?php }?> 
                <?php if(isset($postData['Email'])){?>  <td><?= $employee['Email']; ?></td> <?php }?>  
                <?php if(isset($postData['Age'])){?>  <td><?= $employee['Age']; ?></td> <?php }?> 
                <?php if(isset($postData['Address'])){?>  <td><?= $employee['Address']; ?></td> <?php }?> 
                <?php if(isset($postData['City'])){?>  <td><?= $employee['City']; ?></td> <?php }?> 
                <?php if(isset($postData['Country'])){?>  <td><?= $employee['Country']; ?></td> <?php }?> 
                <?php if(isset($postData['Position'])){?>  <td><?= $employee['Position']; ?></td> <?php }?> 
                </tr>
            <?php } ?>

            </tbody>
        </table>
        
        
        
        <?php } else{ ?>
        
    
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#filterModal">Create a View</button>
        <select name="viewName" class="form-control" id="selectView">
            <option value="">Select View</option>
            <?php foreach ($view as $views) { ?>
                <option <?php  if ($views == ['view']) echo 'selected'; ?> value="<?php if (!empty($views)) echo $views; ?>"> <?php if (!empty($views)) echo $views; ?> </option>
            <?php } ?>
        </select>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <?php //if (isset($user['Name'])) { ?> <th>Name</th> <?php //} ?> 
                    <?php //if (isset($user['Email'])) { ?> <th>Email</th> <?php //} ?> 
                    <?php //if (isset($user['Age'])) { ?> <th>Age</th> <?php //} ?> 
                    <?php //if (isset($user['Address'])) { ?> <th>Address</Address></th> <?php // } ?>    
                    <?php //if (isset($user['City'])) { ?> <th>City</th> <?php // } ?> 
                    <?php //if (isset($user['Country'])) { ?> <th>Country</th> <?php //} ?> 
                    <?php //if (isset($user['Country'])) { ?> <th>Country</th> <?php //} ?> 
                </tr>
            </thead>
            <tbody>
            <?php /*foreach ($user as $key => $sg) {   ?>
                <tr>
                    <?php if (isset($sg['Name'])) { ?> <td><?= $sg['Name']; ?></td> <?php } ?> 
                    <?php if (isset($user['Email'])) { ?> <td><?= $sg['Email']; ?></td><?php } ?> 
                    <?php if (isset($user['Age'])) { ?> <td><?= $sunny['Age']; ?></td> <?php } ?> 
                    <?php if (isset($user['Address'])) { ?> <td><?= $sunny['Address']; ?></td> <?php } ?>    
                    <?php if (isset($user['City'])) { ?> <td><?= $sunny['City']; ?></td> <?php } ?> 
                    <?php if (isset($user['Country'])) { ?> <td><?= $sunny['Country']; ?></td><?php } ?> 
                    <?php if (isset($user['Position'])) { ?> <td><?= $sunny['Position']; ?></td><?php } ?> 
                </tr>
            <?php }*/ ?>

            <?php foreach ($user as $key => $sg) {   ?>
                <tr>
                      <td><?php echo $sg['Name']; ?></td> 
                      <td><?php echo $sg['Email']; ?></td> 
                      <td><?php echo $sg['Age']; ?></td> 
                      <td><?php echo $sg['Address']; ?></td> 
                      <td><?php echo $sg['City']; ?></td> 
                      <td><?php echo $sg['Country']; ?></td> 
                      <td><?php echo $sg['Position']; ?></td>  
                   
                </tr>
            <?php } ?>

            </tbody>
        </table>
        <?php }?>




  
</div>
<div id="filterModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title text-center">Create Your View</h2>
                </div>
              <form action="<?php echo base_url('testing1'); ?>" method="post">
                    <div class="modal-body">
                        <label for="filterName">View Name:</label>
                        <input name="view_name" type="text" class="form-control" id="filterName" placeholder="View Name" required>
                        <div class="checkbox-container mt-3">
                            <!-- Add your checkbox options here -->
                            <!-- Example checkbox: -->
                            <div class="checkbox-label">
                                <input name="Name" type="checkbox" id="NameCheckbox"> Name
                            </div>
                            <div class="checkbox-label">
                                <input name="Email" type="checkbox" id="NameCheckbox"> Email
                            </div>
                            <div class="checkbox-label">
                                <input name="Age" type="checkbox" id="NameCheckbox"> Age
                            </div>
                            <div class="checkbox-label">
                                <input name="Address" type="checkbox" id="NameCheckbox"> Address
                            </div>
                            <div class="checkbox-label">
                                <input name="City" type="checkbox" id="NameCheckbox"> City
                            </div>
                            <div class="checkbox-label">
                                <input name="Country" type="checkbox" id="NameCheckbox"> Country
                            </div>
                            <div class="checkbox-label">
                                <input name="Position" type="checkbox" id="NameCheckbox"> Position
                            </div>
                            <!-- Repeat for other checkboxes -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="submitButton" class="btn btn-primary">Apply Filter</button>
                    </div>
                </form>
                

    <!-- Create Your View Modal -->
    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $('#selectView').on('change', function() {
        var skd = this.value;
        $('#filterName').val( this.value );
        $('#submitButton').trigger('click');
    });
    </script>
</body>
</html>
