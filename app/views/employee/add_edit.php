<div class="row  employee-form">
    <div class="col-md-8 col-md-offset-2">
        <h2><?php echo "Employee $type Form"?> </h2>
        <form id="add_edit" action="<?php generate_url($action)?>" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="name"> Name</label>
                <input type="text" name="name" class="form-control" id="name" value="<?php getFieldValue($arrEmployee['name']); ?>"/>
            </div>
            <div class="form-group">
                <label for="address"> Address</label>
                <input type="text" name="address" class="form-control" id="address" value="<?php getFieldValue($arrEmployee['address']); ?>"/>
            </div>
            <div class="form-group">
                <label for="mobile"> Contact Number</label>
                <input type="text" name="mobile" class="form-control" id="mobile" value="<?php getFieldValue($arrEmployee['contact_number']); ?>"/>
            </div>
            <div class="form-group">
                <label for="zip"> Zip</label>
                <input type="text" name="zip" class="form-control" id="zip" value="<?php getFieldValue($arrEmployee['zip']); ?>"/>
            </div>
            <div class="form-group">
                <label for="salary"> Salary</label>
                <input type="text" name="salary" class="form-control" id="salary" value="<?php getFieldValue($arrEmployee['salary']); ?>"/>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-success btn-lg" value="Add Employee"/>
            </div>
        </form>
    </div>
</div>
