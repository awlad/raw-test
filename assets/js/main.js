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

    var createErrorMsg =
        function(attr, message)
        {
            return "<p>Error in "+ attr + ", " + message + "</p>";
        };

    //email validation
    var isValidEmailAddress = function (emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    };

    $('#salary, #basic_salary').ForceNumericOnly();
    $('form#add_edit').on('submit', function() {
        var validation = true;
        var name = $('#name').val();
        var zip = $('#zip').val();
        var zip_pattern = /^([0-9]+-?[0-9]+)$/
        var errors_html = "<h3>Following errors occurs:</h3>";
        if(name == '') {
            errors_html += createErrorMsg('Name', 'Name field is required');
            validation = false;
        }
        if(name.length > 150) {
            errors_html += createErrorMsg('Name','Name field should less than 150 char');
            validation = false;
        }

        if(zip == '') {
            errors_html += createErrorMsg("Zip", 'zip field is required');
            validation = false;
        }
        if(zip != '') {
            if(!zip_pattern.test($.trim(zip))) {
                errors_html += createErrorMsg("Zip", 'its not a correct zip');
                validation = false;
            }
        }
        if (!validation) {
            $("#errors").html(errors_html).show();
        }
        else {
            $("#errors").html('').hide();
        }
        return validation;
    })

    $('#basic_salary').on('keyup change', function() {
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
