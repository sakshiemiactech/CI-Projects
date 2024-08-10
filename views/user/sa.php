<!-- Displaying data in a table -->
<table border="1">
    <thead>
        <tr>
            <!-- Display table headers from $selectedHeader -->
            <?php foreach ($selectedHeader as $header) { ?>
                <th><?php echo $header; ?></th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <!-- Loop through $user data and display each row in the table -->
        <?php foreach ($user as $employee) { ?>
            <tr>
                <!-- Display individual columns in each row -->
                <?php foreach ($employee as $value) { ?>
                    <td><?php echo $value; ?></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Displaying $views in a list -->
<ul>
    <?php foreach ($views as $view) { ?>
        <li><?php echo $view; ?></li>
    <?php } ?>
</ul>
