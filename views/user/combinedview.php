<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combined View</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Add custom CSS link -->
    <link rel="stylesheet" href="">
    <style>
        .condition-row {
        display: flex;
        align-items: center;
    }

    .condition-row select[name='andOr[]'] {
        margin-right: 10px; /* Adjust this value to control the space between "andOr" and "tableHeader[]" dropdowns */
    }
        .header {
            padding-top: 10px; /* Adjust the top padding as needed */
            padding-bottom: 10px; /* Adjust the bottom padding as needed */
        }
        .header h1 {
            margin-bottom: 0; /* Remove margin from the h1 element */
        }
        .header .container {
            padding-right: 0; /* Remove right padding from the container */
        }
        .horizontal-form {
            display: flex;
            align-items: center;
        }
        .horizontal-form .form-group {
            margin-right: 1px;
            flex-grow: 1;
        }
        .add-condition {
            margin-top: 10px;
        }

        .delete-row {
        color: #343a40; /* Change the color to a darker shade, such as #333 */
        }
        /* Add this CSS to position the Filter button at the top-right corner */
        .top-right-button {
            position: absolute;
            top: 10px; /* Adjust the top spacing as needed */
            right: 10px; /* Adjust the right spacing as needed */
        }
    </style>
</head>
<body>
    <header class="text-black py-3 header">
    <div class="container">
            <h1 class="display-4">Combining Views & Filters</h1>
        </div>
    </header>

        <!-- Applying the IF condtition for the views --> 

            <?php print_r($xyz);
            if ($xyz == 'skk') 
        { 
            ?>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Address</th>
                <th>City</th>
                <th>Country</th>
                <th>Position</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user as $frow) { ?>
                <tr>
                    <td><?php echo $frow['Name']; ?></td>
                    <td><?php echo $frow['Email']; ?></td>
                    <td><?php echo $frow['Age']; ?></td>
                    <td><?php echo $frow['Address']; ?></td>
                    <td><?php echo $frow['City']; ?></td>
                    <td><?php echo $frow['Country']; ?></td>
                    <td><?php echo $frow['Position']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php
} else {
    //print_r('monika');
}
?>


<?php if(!empty($filterViewData['view_name']) && $xyz == 'first') {?> 
        
<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Form Starts Here -->
            <form id="filterForm" action="<?php echo base_url('combined'); ?>" method="post">
                <div class="modal-body">
                    <!-- Add Condition Button -->
                    <div class="row">
                        <div class="col-6">
                            <button type="button" id="addCondition" class="add-condition">+ Add Condition</button>
                        </div>
                        <div class="col-5 text-right">
                            <button type="submit">Apply Filter</button>
                        </div>
                    </div>
                    <!-- Horizontal Form for Three Input Elements -->
                    <div class="horizontal-form">
                        <!-- 'Where' Label -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="tableHeaders">Where</label>
                            </div>
                        </div>
                        <!-- Dropdown for Table Headers -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <select class="form-control" name="tableHeader[]" style="width:80px;padding: 0;">
                                    <?php foreach ($tbheader as $view) { ?>
                                        <option value="<?php echo $view; ?>"><?php echo $view; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- Dropdown for Text Operators -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <select class="form-control" name="textOperator[]" style="padding: 0;">
                                    <option value="contains">contains</option>
                                    <option value="does not contain">does not contain</option>
                                    <option value="is">is</option>
                                    <option value="is not">is not</option>
                                    <option value="is empty">is empty</option>
                                    <option value="is not empty">is not empty</option>
                                    <option value=">">  >   </option>
                                    <option value="<">  <   </option>
                                    <option value="<="> <=  </option>
                                    <option value=">="> >=  </option>
                                </select>
                            </div>
                        </div>
                        <!-- Input for User Input --> 
                        <div class="col-lg-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="userInput[]" placeholder="Enter value">
                            </div>
                        </div>
                    </div>
                </div>
            </form><!-- Form ends Here-->
        </div>
    </div>
</div>

<!-- Filter Button -->

    <button class="btn btn-secondary" data-toggle="modal" data-target="#filterModal">
        Filter
    </button>

        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#createViewModal">Create a View</button>
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
        <!-- Create View Modal -->
    
        <!-- Add Create View modal content here -->
        <div id="createViewModal" class="modal fade" style="width: 500px;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title text-center">Create Your View</h2>
                </div>
              <form action="<?php echo base_url('combined'); ?>" method="post">
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
    </div>
        </div>
        <?php }
        
        else{ ?>

    <div class="container mt-10">
        <div class="row">
            <!-- Dropdown for View Names -->
            <div class="col-md-3">
                <div class="form-group">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#createViewModal">Create a View</button>
        <select name="viewName" class="form-control" id="selectView">
            <option value="">Select View</option>
            <?php foreach ($view as $views) { ?>
                <option <?php  if ($views == ['view']) echo 'selected'; ?> value="<?php if (!empty($views)) echo $views; ?>"> <?php if (!empty($views)) echo $views; ?> </option>
            <?php } ?>
        </select>
               </div>
            </div>
<!-- Filter Button -->
<div class="col-md-6 text-right">
    <button class="btn btn-secondary" data-toggle="modal" data-target="#filterModal">
        Filter
    </button>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Form Starts Here -->
            <form id="filterForm" action="<?php echo base_url('combined'); ?>" method="post">
                <div class="modal-body">
                    <!-- Add Condition Button -->
                    <div class="row">
                        <div class="col-6">
                            <button type="button" id="addCondition" class="add-condition">+ Add Condition</button>
                        </div>
                        <div class="col-5 text-right">
                            <button type="submit">Apply Filter</button>
                        </div>
                    </div>
                    <!-- Horizontal Form for Three Input Elements -->
                    <div class="horizontal-form">
                        <!-- 'Where' Label -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="tableHeaders">Where</label>
                            </div>
                        </div>
                        <!-- Dropdown for Table Headers -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <select class="form-control" name="tableHeader[]" style="width:80px;padding: 0;">
                                    <?php foreach ($selectedHeader as $view) { ?>
                                        <option value="<?php echo $view; ?>"><?php echo $view; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- Dropdown for Text Operators -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <select class="form-control" name="textOperator[]" style="padding: 0;">
                                    <option value="contains">contains</option>
                                    <option value="does not contain">does not contain</option>
                                    <option value="is">is</option>
                                    <option value="is not">is not</option>
                                    <option value="is empty">is empty</option>
                                    <option value="is not empty">is not empty</option>
                                    <option value=">">  >   </option>
                                    <option value="<">  <   </option>
                                    <option value="<="> <=  </option>
                                    <option value=">="> >=  </option>
                                </select>
                            </div>
                        </div>
                        <!-- Input for User Input --> 
                        <div class="col-lg-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="userInput[]" placeholder="Enter value">
                            </div>
                        </div>
                    </div>
                </div>
            </form><!-- Form ends Here-->
        </div>
    </div>
</div>
            
        </div>
    </div>
    






    <!-- Separator and Border -->
    <div class="container border-top my-4"></div>

    <div class="container mt-4">
        <!-- Table for Displaying Data -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                   
                        <!-- Populate table headers dynamically from your PHP code -->
                        <tr>
                    <?php ?> <th>Name</th> 
                    <?php ?> <th>Email</th> 
                    <?php ?> <th>Age</th> 
                    <?php ?> <th>Address</Address></th> 
                    <?php ?> <th>City</th> 
                    <?php ?> <th>Country</th> 
                    <?php ?> <th>Position</th>
                </tr>
                    
                </thead>
                <tbody>
                    <!-- Populate table rows with data from your PHP code -->
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
    </div>

    
    <!-- Create View Modal -->
    
        <!-- Add Create View modal content here -->
        <div id="createViewModal" class="modal fade" style="width: 500px;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title text-center">Create Your View</h2>
                </div>
              <form action="<?php echo base_url('combined'); ?>" method="post">
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
    </div>
        </div>
       
       
    <!-- Add Bootstrap JS and jQuery scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- JavaScript to add new rows with the "and/or" dropdown and Delete icon when the "+ Add Condition" button is clicked -->

    <!-- Adjusted "andOr" and "tableHeader[]" dropdown placement -->
    <script>
    $(document).ready(function() {
        $("#addCondition").click(function() {
            var newRow = $(".horizontal-form:first").clone(); // Clone the first row

            // Remove the "Where" label
            $(newRow).find("label").remove();
            
            // Add "and/or" dropdown at the extreme left of the row
            newRow.find("select[name='tableHeader[]']").before('<select class="form-control" name="andOr[]"><option value="and">and</option><option value="or">or</option></select>');

            // Add Delete icon (dustbin) to the row
            newRow.append('<button type="button" class="btn btn-link btn-sm delete-row"><i class="fa fa-trash" style="color: #333; font-size: 20px;"></i></button>');

            // Append the new row to the form
            $("#filterForm").append(newRow);
        });

        // Handle click events for the Delete icons
        $(document).on('click', '.delete-row', function() {
            $(this).closest('.horizontal-form').remove(); // Remove the closest row when the delete icon is clicked
        });
    });
</script>
<script>
        $('#selectView').on('change', function() {
        var skd = this.value;
        $('#filterName').val( this.value );
        $('#submitButton').trigger('click');
    });
    </script>



</body>
</html>
