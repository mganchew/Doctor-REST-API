
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

$.ajax({
    type: 'POST',
    url: "http://appointment.dev/REST.php/loadProfileInfo",
    data: {user: $.urlParam('user')},
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
    
    if ($.urlParam('type') !== 'Доктор') {
        
        userData = {email: values['email'], fName: values['fName'],
            lName: values['lName'],userInfo: values['userInfo']};
        
    }
   
    $.ajax({
        type: 'POST',
        url: "http://appointment.dev/REST.php/updateProfile",
        data: userData,
        dataType: 'json',
        success: function (data) {
            
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