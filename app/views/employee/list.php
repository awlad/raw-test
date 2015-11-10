<div class="row  employee-form">
    <div class="col-md-12">
        <h2 class="title">Employee List</h2>
        <?php if (count($data)> 0) { ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Basic Salary</th>
                        <th>Contact Number</th>
                        <th>Zip</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $objEmployee):?>
                        <tr>
                            <td><?php echo $objEmployee->name; ?></td>
                            <td><?php echo $objEmployee->address; ?></td>
                            <td><?php echo $objEmployee->contact_number; ?></td>
                            <td><?php echo $objEmployee->zip_code; ?></td>
                            <td><?php echo $objEmployee->updated_at; ?></td>
                            <td>
                                <a href="<?php generate_url('employee/edit/'. $objEmployee->id)?>">Edit</a>
                                <a onclick="return confirm('Are you sure you want to delete?');" href="<?php generate_url('employee/remove/'. $objEmployee->id)?>">Delete</a>
                                <a href="<?php generate_url('salary/add/'. $objEmployee->id)?>">Add Salary</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>