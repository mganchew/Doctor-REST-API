$.urlParam = function (name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results[1] || 0;
}
dataToSend = {user: $.urlParam('user'), doctorFlag: $.urlParam('type')};


// RATING

$.ajax({
    type: 'POST',
    url: "http://appointment.dev/REST.php/getRating",
    data: dataToSend,
    dataType: 'json',
    success: function (data) {
        populateRating(data);
    },
    error: function (data) {
        console.log('error');
    }
});

function populateRating(data) {

    $.each(data, function () {
        $("#rating").append(this.average);
    });    
}

function popupVote() {
    
    var voteValue = prompt('Please enter your rating from 1 to 5', 5);

    if (voteValue != null && voteValue != "" && voteValue > 0 && voteValue < 6) {
        
        setRating(voteValue);

    } else {
        alert("Invalid vote!");
        popupVote()    
    }
    
}

function setRating (voteValue) {
    
    userId = $('#userId').val();

    $.ajax({
        type: 'POST',
        url: "http://appointment.dev/REST.php/setRating",
        data: {email: dataToSend.user, rating: voteValue, userId: userId},
        dataType: 'json',
        success: function (data) {
            
            location.reload();
        },
        error: function (data) {
            console.log('error');
        }
    });
}


// PROFILE

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
        console.log('error');
    }
});

function populateProfile(frm, data) {
    $.each(data.data, function (key, value) {
        $('[name=' + key + ']', frm).val(value);
        if (key === 'userInfo') {
            $('#userInfo > p').text(value);
        }
    });

}

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

function submitProfileForm(values) {

    var uri = "http://appointment.dev/site/view/profile.php";

    userData = {
        email: values['email'], fName: values['fName'],
        lName: values['lName'], userInfo: values['userInfo'],
        specId: values['specId'], workAddress: values['workAddress'],
        doctorFlag: 1
    };

    if ($.urlParam('type') === "1") {

        userData = {email: values['email'], fName: values['fName'],
            lName: values['lName'], userInfo: values['userInfo']};

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


    $("#vote").click(function (event) {

        popupVote();
    });

    $("#submitProfile").click(function (event) {

        event.preventDefault(); // cancel default behavior    

        var $inputs = $('#profileEdit :input');

        // get an associative array of just the values.
        var values = {};

        $inputs.each(function () {
            values[this.name] = $(this).val();
        });

        submitProfileForm(values);


    });
});