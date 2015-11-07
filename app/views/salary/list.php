<div class="row  employee-form">
    <div class="col-md-12">
        <h2>Salary List</h2>

        <?php if (count($data)> 0) { ?>
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Basic Salary</th>
                    <th>house rent</th>
                    <th>allowance</th>
                    <th>income tax</th>
                    <th>net salary</th>
                    <th>Grade</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($data as $objSalary):?>
                    <tr>
                        <td><?php echo $objSalary->name; ?></td>
                        <td><?php echo $objSalary->basic_salary; ?></td>
                        <td><?php echo $objSalary->house_rent; ?></td>
                        <td><?php echo $objSalary->allowance; ?></td>
                        <td><?php echo $objSalary->income_tax; ?></td>
                        <td><?php echo $objSalary->net_salary; ?></td>
                        <td><?php echo $objSalary->grade; ?></td>
                        <td>
                            <a href="<?php generate_url('salary/edit/'. $objSalary->employee_id)?>">Edit</a>
                        </td>

                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>