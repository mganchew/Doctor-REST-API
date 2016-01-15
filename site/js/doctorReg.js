/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function populateSpecs(data) {

    var options = $("#specName");

    $.each(data, function () {

        options.append($("<option />").val(this.id).text(this.name));
    });
}

$.ajax({
    type: 'GET',
    url: "http://appointment.dev/REST.php/specs",
    dataType: 'json',
    success: function (data) {
        populateSpecs(data);
    },
    error: function (data) {
        console.log(data);
        console.log('error');
    }
});

function submitDoctorReg(values) {

    var uri = "http://appointment.dev/site/view/startPage.php";
    console.log(values);

    $.ajax({
        type: 'POST',
        url: "http://appointment.dev/REST.php/Registration",
        data: {fName: values['docfName'], lName: values['doclName'], email: values['docEmail'],
            password: values['docPass'], specId: values['specId']},
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

    $("#submitDoctorReg").click(function (event) {

        var spec = $("#specName").val();

        if (spec == null) {
            event.preventDefault(); // cancel default behavior    
            alert("Моля, първо изберете направление!");
        }

        else {

            event.preventDefault(); // cancel default behavior    

            var $inputs = $('#doctorRegister :input');

            // get an associative array of just the values.
            var values = {};

            $inputs.each(function () {
                values[this.name] = $(this).val();
            });

            if (values['docPass'] !== values['docCPass']) {
                event.preventDefault(); // cancel default behavior    
                alert("Двете пароли трябва да бъдат еднакви!");
            } else {
                submitDoctorReg(values);
            }

            console.log(values);


        }

    });
});
