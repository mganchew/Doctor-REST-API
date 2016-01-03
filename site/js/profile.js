
function populateSpecs (data) {
        
    var options = $("#specName");
    
    $.each(data, function() {

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
    error: function(data) {
        console.log(data);
        console.log('error');
    },    
});

function populateProfile(frm, data) {
    $.each(data.data, function (key, value) {
        $('[name=' + key + ']', frm).val(value);
        if(key === 'userInfo'){
            $('#userInfo > p').text(value);
        }
    });    

}

$.urlParam = function (name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results[1] || 0;
}
dataToSend = {user: $.urlParam('user'), doctorFlag: $.urlParam('type')};
console.log(dataToSend);
$.ajax({
    type: 'POST',
    url: "http://appointment.dev/REST.php/loadProfileInfo",
    data: dataToSend,
    dataType: 'json',
    success: function (data) {
        
        populateProfile('#profileEdit', data);
    },
    error: function () {
        console.log('error');
    }
});

function submitForm(values) {

    var uri = "http://appointment.dev/site/view/profile.php";
    
    userData = {
        email: values['email'], fName: values['fName'],
        lName: values['lName'],userInfo: values['userInfo'],
        specId: values['specId'],workAddress: values['workAddress'],
        doctorFlag: 1
    };

    if ($.urlParam('type') === "1") {
        
        userData = {email: values['email'], fName: values['fName'],
            lName: values['lName'],userInfo: values['userInfo']};
        
    }
   
    $.ajax({
        type: 'POST',
        url: "http://appointment.dev/REST.php/updateProfile",
        data: userData,
        dataType: 'json',
        success: function (data) {
            //console.log(userData);
            //console.log(data);
            window.location.replace(uri + "?user=" + $.urlParam('user') + "&type=" + $.urlParam('type') + "&msg=" + data.msg);
        },
        error: function (data) {
            //console.log('error');
           window.location.replace(uri + "?user=" + $.urlParam('user') + "&type=" + $.urlParam('type') + "&msg=" + data.msg);
        }
    });

}

$(document).ready(function () {


    $("#submit").click(function (event) {

        event.preventDefault(); // cancel default behavior    

        var $inputs = $('#profileEdit :input');

        // get an associative array of just the values.
        var values = {};

        $inputs.each(function () {
            values[this.name] = $(this).val();
        });

        submitForm(values);


    });
});