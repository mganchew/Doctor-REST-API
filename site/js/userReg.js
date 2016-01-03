/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function submitUserReg(values) {

    var uri = "http://appointment.dev/site/view/startPage.php";
    //console.log(values);

    $.ajax({
        type: 'POST',
        url: "http://appointment.dev/REST.php/Registration",
        data: {fName: values['userfName'], lName: values['userlName'], email: values['userEmail'],
            password: values['userPassword']},
        dataType: 'json',
        success: function (data) {
            //console.log(data);
            window.location.replace(uri + "?msg=" + data.msg);
        },
        error: function () {
            console.log('error');
            //window.location.replace(uri + data.redirectPage + "?msg=" + data.msg );
        },
    });

}

$(document).ready(function () {

    $("#submitUserReg").click(function (event) {

            event.preventDefault(); // cancel default behavior    

            var $inputs = $('#userRegister :input');

            // get an associative array of just the values.
            var values = {};

            $inputs.each(function () {
                values[this.name] = $(this).val();
            });

            if (values['userPassword'] !== values['userCPassword']) {
                event.preventDefault(); // cancel default behavior    
                alert("Двете пароли трябва да бъдат еднакви!");
            } else {
                //console.log(values);
                submitUserReg(values);
            }

    });
});
