<div class="row  employee-form">
    <div class="col-md-12">
        <h2>Employee List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Contact Number</th>
                    <th>Zip</th>
                    <th>Salary</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $strEmployee):?>
                    <tr>
                        <td><?php echo $strEmployee->name; ?></td>
                        <td><?php echo $strEmployee->address; ?></td>
                        <td><?php echo $strEmployee->contact_number; ?></td>
                        <td><?php echo $strEmployee->zip; ?></td>
                        <td><?php echo $strEmployee->salary; ?></td>
                        <td>
                            <a href="<?php generate_url('employee/edit/'. $strEmployee->id)?>">Edit</a>
                            <a href="<?php generate_url('employee/delete/'. $strEmployee->id)?>">Delete</a>
                            <a href="<?php generate_url('salary/add/'. $strEmployee->id)?>">Add Salary</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>