<!DOCTYPE html>
<html>
<head>
    <title>Table Column Filter</title>
    <style>
        /* Your CSS styles for the table (customize as needed) */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        /* Styles for the modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #ddd;
            width: 50%;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            border-radius: 5px;
        }

        /* Style for checkboxes in the modal */
        .checkbox-container {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .checkbox-label {
            margin-right: 10px;
        }

        /* Style for the Apply Filter button */
        #applyFilter {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        #applyFilter:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Table Column Filter</h1>
    <button id="filterButton">Filter</button>

    <!-- Modal -->
    <form action="<?php echo base_url('cpct'); ?>" method="post">
    <div id="filterModal" class="modal">
        <div class="modal-content">
            <h2 style="color: #4CAF50;">Filter Columns</h2>
            <div class="checkbox-container">
            <label class="checkbox-label">
                    <input name="view_name" type="text" id="filterName" placeholder="View Name" > View
                </label
                <label class="checkbox-label">
                    <input name="Name" type="checkbox" id="filterName" <?php if(isset($postData['Name'])) echo 'checked'?> > Name
                </label
                <label class="checkbox-label">
                    <input name="Email" type="checkbox" id="filterName" <?php if(isset($postData['Email'])) echo 'checked'?>> Email
                </label>
                <label class="checkbox-label">
                    <input name="Age" type="checkbox" id="filterName" <?php if(isset($postData['Age'])) echo 'checked'?>> Age
                </label>
                <label class="checkbox-label">
                    <input name="Address" type="checkbox" id="filterName" <?php if(isset($postData['Address'])) echo 'checked'?>> Address
                </label>
                <label class="checkbox-label">
                    <input name="City" type="checkbox" id="filterName" <?php if(isset($postData['City'])) echo 'checked'?>> City
                </label>
                <label class="checkbox-label">
                    <input name="Country" type="checkbox" id="filterName" <?php if(isset($postData['Country'])) echo 'checked'?>> Country
                </label>
                <label class="checkbox-label">
                    <input name="Position" type="checkbox" id="filterName" <?php if(isset($postData['Position'])) echo 'checked'?>> Position
                </label>
                
            </div>
            <button id="applyFilter">Apply Filter</button>
        </div>
    </div>
</form>

    <table>
        <thead>
            <tr>
                
            <?php if(isset($postData['Name'])){?> <th>Name</th> <?php }?> 
            <?php if(isset($postData['Email'])){?> <th>Email</th> <?php }?> 
            <?php if(isset($postData['Age'])){?> <th>Age</th> <?php }?> 
            <?php if(isset($postData['Address'])){?> <th>Address</Address></th> <?php }?>    
            <?php if(isset($postData['City'])){?> <th>City</th> <?php }?> 
            <?php if(isset($postData['Country'])){?> <th>Country</th> <?php }?> 
            <?php if(isset($postData['Position'])){?> <th>Position</th> <?php }?> 
            </tr>
        </thead>
        <tbody>
        <?php foreach ($employees as $employee): ?>
                <tr>
                <?php if(isset($postData['Name'])){?>  <td><?= $employee['Name']; ?></td> <?php }?> 
                <?php if(isset($postData['Email'])){?> <td><?= $employee['Email']; ?></td><?php }?> 
                <?php if(isset($postData['Age'])){?> <td><?= $employee['Age']; ?></td> <?php }?> 
                <?php if(isset($postData['Address'])){?> <td><?= $employee['Address'];?></td> <?php }?>    
                <?php if(isset($postData['City'])){?> <td><?= $employee['City']; ?></td> <?php }?> 
                <?php if(isset($postData['Country'])){?> <td><?= $employee['Country']; ?></td><?php }?> 
                <?php if(isset($postData['Position'])){?> <td><?= $employee['Position']; ?></td><?php }?> 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        // Get the modal and filter button elements
        const modal = document.getElementById('filterModal');
        const filterButton = document.getElementById('filterButton');
        const applyFilterButton = document.getElementById('applyFilter');

        // Function to toggle the modal's display
        function toggleModal() {
            modal.style.display = modal.style.display === 'block' ? 'none' : 'block';
        }

        // Event listener for the filter button
        filterButton.addEventListener('click', toggleModal);

        // Event listener for the apply filter button (you can modify this part)
        applyFilterButton.addEventListener('click', function() {
            // Close the modal when the "Apply Filter" button is clicked
            toggleModal();

            // Implement your filtering logic here based on the selected checkboxes
        });
    </script>

    <script>
        // Event listener for the apply filter button
        applyFilterButton.addEventListener('click', function() {
            // Close the modal when the "Apply Filter" button is clicked
            toggleModal();

            // Create an array to store the selected column names
            const selectedColumns = [];
            const checkboxes = document.querySelectorAll('.checkbox-label input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedColumns.push(checkbox.getAttribute('data-column'));
                }
            });
        });
       
    </script>
</body>
</html>

