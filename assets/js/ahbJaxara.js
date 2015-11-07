$(function() {
    // Numeric only control handler
    jQuery.fn.ForceNumericOnly =
        function()
        {
            return this.each(function()
            {
                $(this).keydown(function(e)
                {
                    var key = e.charCode || e.keyCode || 0;
                    // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
                    // home, end, period, and numpad decimal
                    return (
                    key == 8 ||
                    key == 9 ||
                    key == 13 ||
                    key == 46 ||
                    key == 110 ||
                    key == 190 ||
                    (key >= 35 && key <= 40) ||
                    (key >= 48 && key <= 57) ||
                    (key >= 96 && key <= 105));
                });
            });
        };
    $('#salary, #basic_salary').ForceNumericOnly();
    $('form#add_edit').on('submit', function() {
        var validation = true;
        var name = $('#name').val();
        var zip = $('#zip').val();
        var zip_pattern = /^[0-9]\d+-?$/
        if(name == '') {
            alert('Name field is required');
            validation = false;
        }
        else if(name > 150) {
            alert('Name field should less than 150 char');
            validation = false;
        }

        if(zip != '') {
            if(!zip_pattern.test($.trim(zip))) {
                alert('its not a correct zip');
                validation = false;
            }
        }
        return validation;
    })

    $('#basic_salary').on('keyup', function() {
        var basic_salary = $(this).val();
        var house_rent = parseInt(basic_salary * 0.4);
        var allowance = parseInt(basic_salary * 0.2);
        var income_tax = parseInt(basic_salary * 0.1);
        var total = parseInt(basic_salary) + house_rent + allowance;
        var net_salary = parseInt(total - income_tax);
        $('#house_rent').val(house_rent);
        $('#allowance').val(allowance);
        $('#income_tax').val(income_tax);
        $('#net_salary').val(net_salary);

    })

});