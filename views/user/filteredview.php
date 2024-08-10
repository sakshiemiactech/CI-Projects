<!DOCTYPE html>
<html>
<head>
    <title>Filter Modal Example</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /* Add custom styles here */
        .table {
            background-color: #f8f9fa;
        }
        .table thead {
            background-color: #343a40;
            color: #ffffff;
        }
        .horizontal-form {
            display: flex;
            align-items: center;
        }
        .horizontal-form .form-group {
            margin-right: 1px;
            flex-grow: 1;
        }
        .condition-row {
            display: flex;
            align-items: center;
        }

        .condition-field,
        .condition-operator,
        .condition-value {
            margin-right: 10px;
        }

        .add-condition {
            margin-top: 10px;
        }

        .delete-row {
        color: #343a40; /* Change the color to a darker shade, such as #333 */
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Applying Filters</h1>

     

    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#filterModal">
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
            <form id="filterForm" action="<?php echo base_url('filter2'); ?>" method="post">
    <div class="modal-body">
        <!-- Add Condition Button -->
        <div class="row">
                    <div class="col-6">
                        <button type="button" id="addCondition">+ Add Condition</button>
                    </div>
            <div class="col-6 text-right">
                <button type="submit">Apply Filter</button>
            </div>
        </div>



        <!-- Horizontal Form for Three Input Elements -->
        <div class="horizontal-form">
            <!-- Individual Box: 'Where' Label -->
            <div class="form-group">
                <label for="tableHeaders">Where</label>
            </div>

            <!-- Individual Box: Dropdown for Table Headers -->
            <div class="form-group">
                <select class="form-control" name="tableHeader[]" style="width: 100px;margin-left:5px;">
                    <?php foreach ($selectedHeader as $view) { ?>
                        <option value="<?php echo $view; ?>"><?php echo $view; ?></option>
                    <?php } ?>
                </select>
            </div>

            <!-- Individual Box: Dropdown for Text Operators -->
            <div class="form-group">
                <select class="form-control" name="textOperator[]">
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

            <!-- Individual Box: Input for User Input --> 
            <div class="form-group">
                <input type="text" class="form-control" name="userInput[]" placeholder="Enter value">
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
        
                <!-- Display the table when $data is not empty -->
                <?php if($xyz) {?>  

                <table class="table table-bordered mt-4">
                <thead>
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
            <?php foreach ($user as $sg) {   ?>
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
        <?php } else{ ?>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <?php ?> <th>Name</th> 
                    <?php ?> <th>Email</th> 
                    <?php ?> <th>Age</th> 
                    <?php ?> <th>Address</Address></th> 
                    <?php ?> <th>City</th> 
                    <?php ?> <th>Country</th> 
                    <?php ?> <th>Country</th>
                </tr>
            </thead>
            <tbody>
            
            <?php foreach ($filteredData as $frow) {   ?>
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
            <?php }?>
        <?php ?>
<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- JavaScript to handle form submission -->
<script>
    $(document).ready(function () {
        // Ensure the form with the ID "filterForm" exists
        $('#filterFormn').submit(function (e) {
           // alert('hey');
            e.preventDefault(); // Prevent the default form submission

            // Retrieve form data as an array
            var formData = $(this).serializeArray();

            // Log form data for testing (you can replace this with your filter logic)
            console.log(formData);

            // Close the modal
            $('#filterModal').modal('hide');
        });
    });
</script>
<script>
    $(document).ready(function () {
        // Attach a click event handler to the "+ ADD CONDITION" button
        $(document).on('click', '.add-condition', function () {
            // Clone the current condition row
            var newRow = $(this).closest(".condition-row").clone();

            // Clear the input values in the cloned row
            newRow.find('input').val('');

            // Append the cloned row to the conditions container
            $('#conditions-container').append(newRow);
        });
    });
</script>
<!-- JavaScript to add new rows with the "and/or" dropdown and Delete icon when the "+ Add Condition" button is clicked -->
<script>
    $(document).ready(function() {
        $("#addCondition").click(function() {
            var newRow = $(".horizontal-form:first").clone(); // Clone the first row
            $(newRow).find("select,input").val(""); // Clear input values
            $(newRow).find("label").remove(); // Remove the "Where" label
            
            // Add "and/or" dropdown before the table headers dropdown
            $(newRow).find("select[name='tableHeader[]']").before('<select class="form-control" name="andOr[]"><option value="and">and</option><option value="or">or</option></select>');

            // Add Delete icon (dustbin) to the row
            $(newRow).append('<button type="button" class="btn btn-link btn-sm delete-row"><i class="fa fa-trash" style="color: #333; font-size: 20px;"></i></button>');

            $("#filterForm").append(newRow); // Add the new row to the form
        });

        // Handle click events for the Delete icons
        $(document).on('click', '.delete-row', function() {
            $(this).closest('.horizontal-form').remove(); // Remove the closest row when the delete icon is clicked
        });
    });
</script>


</body>
</html>
