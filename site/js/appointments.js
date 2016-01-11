// Appointments logic 

function getDoctorCalendar(doctorEmail) {

    var email = doctorEmail.split('@');
    console.log(email[0]);
    src = "https://www.google.com/calendar/embed?src=" + email[0] + "%40gmail.com&ctz=Europe/Sofia";
    $("#doctorCalendar").attr("src", src);
    $("#doctorCalendar").show();

}

function getAllDoctors(specId) {
    $.ajax({
        type: 'POST',
        url: "http://appointment.dev/REST.php/selectDoctorsBySpec",
        data: {specId: specId},
        dataType: 'json',
        success: function (data) {
            populateDoctors(data);
        },
        error: function () {
            console.log('error');
        },
    });
}

function populateDoctors(data) {

    var options = $("#doctorName");

    $("#doctorName").prop("disabled", false);

    $("#doctorName").empty();

    $.each(data, function () {

        options.append($("<option />").val(this.email).text(this.lName));
    });
    $("#doctorName").change();
}

function submitAppointmentsForm(values) {

    var uri = "http://appointment.dev/site/view/";

    $.ajax({
        type: 'POST',
        url: "http://appointment.dev/REST.php/appointment",
        data: {address: values['address'], day: values['day'], doctor: values['doctor'], file: values['file'], hour: values['hour'],
            month: values['month'], userId: values['userId'], year: values['year']},
        dataType: 'json',
        success: function (data) {
            if (data.status === 'notOk') {
                //event.preventDefault(); // cancel default behavior    
                alert(data.msg);
            }else{
            window.location.replace(uri + data.redirectPage + "?msg=" + data.msg );
        }
        },
        error: function () {
            window.location.replace(uri + data.redirectPage + "?msg=" + data.msg);
        },
    });

}

function populateSpecs(data) {

    var options = $("#specName");

    $.each(data, function () {

        options.append($("<option />").val(this.id).text(this.name));
    });
}

$.ajax({
    type: 'GET',
    url: "http://appointment.dev/REST.php/getSpecsWithDoctors",
    dataType: 'json',
    success: function (data) {
        populateSpecs(data);
    },
    error: function () {
        console.log('error');
    },
});



$(document).ready(function () {


    $("#doctorCalendar").hide();
    $("#specName").change(function () {

        var specId = $(this).val();
        getAllDoctors(specId);
    });

    //TODO make it work
    $("#doctorName").change(function () {

        var doctorEmail = $(this).val();
        getDoctorCalendar(doctorEmail);
    });

    $("#saveBtn").click(function (event) {

        var spec = $("#specName").val();

        if (spec == null) {
            event.preventDefault(); // cancel default behavior    
            alert("Моля, първо изберете направление!");
        }

        else {

            event.preventDefault(); // cancel default behavior    

            var $inputs = $('#myForm :input');

            // get an associative array of just the values.
            var values = {};

            $inputs.each(function () {
                values[this.name] = $(this).val();
            });

            console.log(values);

            submitAppointmentsForm(values);
        }

    });
});
