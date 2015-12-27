// Appointments logic 

function getAllDoctors(specId) {
    $.ajax({
        type: 'POST',
        url: "http://appointment.dev/REST.php/selectDoctorsBySpec",
        data: {specId : specId},
        dataType: 'json',
        success: function (data) {
            populateDoctors(data);
        },
        error: function() {
            console.log('error');
        },    
    });        
}

function populateDoctors (data) {

    var options = $("#doctorName");
    
    $("#doctorName").prop("disabled", false);

    $("#doctorName").empty();

    $.each(data, function() {

        options.append($("<option />").val(this.email).text(this.lName));
    });
}

$.ajax({
    type: 'GET',
    url: "http://appointment.dev/REST.php/getSpecsWithDoctors",
    dataType: 'json',
    success: function (data) {
        populateSpecs(data);
    },
    error: function() {
        console.log('error');
    },    
});

function submitForm(values) {
    
    var uri = "http://appointment.dev/site/view/";

    $.ajax({
        type: 'POST',
        url: "http://appointment.dev/REST.php/appointment",
        data: {address: values['address'], day: values['day'], doctor: values['doctor'], file: values['file'], hour: values['hour'], 
        month: values['month'], userId: values['userId'], year: values['year']},
        dataType: 'json',
        success: function (data) {
            window.location.replace(uri + data.redirectPage + "?msg=" + data.msg );
        },
        error: function() {
            window.location.replace(uri + data.redirectPage + "?msg=" + data.msg );
        },    
    });

}

function populateSpecs (data) {
        
    var options = $("#specName");
    
    $.each(data, function() {

        options.append($("<option />").val(this.id).text(this.name));
    });
}

$( document ).ready(function() {
    
    $( "#specName" ).change(function() {

        var specId = $(this).val();

        getAllDoctors(specId);
    });

    $( "#saveBtn" ).click(function(event) {
        
        var spec = $( "#specName" ).val();

        if(spec == null) {
            event.preventDefault(); // cancel default behavior    
            alert("Моля, първо изберете направление!");
        }

        else {

            event.preventDefault(); // cancel default behavior    

            var $inputs = $('#myForm :input');

            // get an associative array of just the values.
            var values = {};
         
            $inputs.each(function() {
                values[this.name] = $(this).val();
            });

            console.log(values);

            submitForm(values);
        }
    
    });
});
