<div class="row  employee-form">
    <div class="col-md-8 col-md-offset-2">
        <form action="<?php generate_url($action)?>" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="basic_salary"> Basic Salary</label>
                <input type="text" name="basic_salary" class="form-control" id="basic_salary" value="<?= getFieldValue($arrSalary, 'basic_salary')?>"/>
            </div>
            <div class="form-group">
                <input type="hidden" name="employee_id" class="form-control" id="employee_id" value="<?php echo $id; ?>"/>
            </div>
            <div class="form-group">
                <label for="house_rent"> House Rent</label>
                <input type="text" name="house_rent" class="form-control" id="house_rent" readonly value="<?= getFieldValue($arrSalary, 'house_rent')?>"/>
            </div>
            <div class="form-group">
                <label for="allowance"> Allowance</label>
                <input type="text" name="allowance" class="form-control" id="allowance" readonly value="<?= getFieldValue($arrSalary, 'allowance')?>"/>
            </div>
            <div class="form-group">
                <label for="income_tax"> Income Tax</label>
                <input type="text" name="income_tax" class="form-control" id="income_tax" readonly value="<?= getFieldValue($arrSalary, 'income_tax')?>"/>
            </div>

            <div class="form-group">
                <label for="net_salary"> Net Salary</label>
                <input type="text" name="net_salary" class="form-control" id="net_salary" readonly value="<?= getFieldValue($arrSalary, 'net_salary')?>"/>
            </div>
            <div class="form-group">
                <label for="grade">Grade</label>
                <input type="text" name="grade" class="form-control" id="grade" value="<?= getFieldValue($arrSalary, 'grade')?>"/>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-success btn-lg" value="<?php getButtonText($type, 'salary');?>"/>
                <a href="/salaries" class="btn  btn-danger btn-lg"> Cancel </a>
            </div>
        </form>
    </div>
</div>
