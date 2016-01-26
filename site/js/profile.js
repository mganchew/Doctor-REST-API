$.urlParam = function (name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results[1] || 0;
};
dataToSend = {user: $.urlParam('user'), doctorFlag: $.urlParam('type')};


// RATING
function getRatings() {
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
}

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

function setRating(voteValue) {

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
            console.log(data);
        }
    });
}

function getUserRatingInfoForDoctor(currentUserInfo) {

    userId = $('#userId').val();

    $.ajax({
        type: 'POST',
        url: "http://appointment.dev/REST.php/getUserRatingInfoForDoctor",
        data: {email: dataToSend.user, userId: userId},
        dataType: 'json',
        success: function (data) {
            if (data.length !== 0) {
                $("#vote").hide();
                console.log(currentUserInfo);
                if (currentUserInfo === "2") {
                    $("#userRating").append("<p>Докторите не могат да гласуват за себе си или други доктори.</p>");
                } else {
                    $("#userRating").append("<p>Вече сте гласували за този доктор.</p>");
                }
            }

        },
        error: function (data) {
            //console.log(data);
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
function getSpecs() {
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
}

function populateProfile(frm, data) {
    $.each(data.data, function (key, value) {
        $('[name=' + key + ']', frm).val(value);
        if (key === 'userInfo') {
            $('#userInfo > p').text(value);
        }
    });

}

function getAllTableData() {
    var rowvalues = [];
    var insertedDates = [];
    $("tbody > tr").each(function () {
        var rowvalue = [];
        $(this).children().each(function () {
            //alert($(this).text());
            rowvalue.push($(this).text());
        });
        rowvalues.push(rowvalue);
    });
    var index = 0;
    $.each(rowvalues, function (key1, val1) {

        //console.log(val1[1]);
        insertedDates[index] = val1[1];
        index++;
    });
    //console.log(insertedDates);
    return insertedDates;
}

function loadProfileInfo() {
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
}

function submitProfileForm(values) {

    var uri = "http://appointment.dev/site/view/profile.php";

    userData = {
        email: values['email'], fName: values['fName'],
        lName: values['lName'], userInfo: values['userInfo'],
        specId: values['specId'], workAddress: values['workAddress'],
        doctorFlag: 1
    };

    if ($.urlParam('type') === "1") {

        userData = {
            email: values['email'], fName: values['fName'],
            lName: values['lName'], userInfo: values['userInfo']
        };

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

function getGoogleFitData() {

    var googleFitDataTableBody = $("#googleFitData").find('tbody');
    months = [
        'Dummy',
        'Януари',
        'Февруари',
        'Март',
        'Април',
        'Май',
        'Юни',
        'Юли',
        'Август',
        'Септември',
        'Октомври',
        'Ноември',
        'Декември'
    ];

    var url = "http://appointment.dev/REST.php/getAllDataSetsForUser";
    if ($("#userInfo").val() == "2") {

        url = "http://appointment.dev/REST.php/getAllDataSetsForUserFromDB";

    }

    $userEmail = $.urlParam('user');

    $.ajax({
        type: 'POST',
        url: url,
        data: {email: $userEmail},
        dataType: 'json',
        success: function (data) {
            console.log('every 5 seconds');
            //console.log(data);
            $.each(data.point, function (key, value) {

                formatedDate = getFormatedDate(value.endTimeNanos, months);
                console.log(formatedDate);
                hearthrate = value.value[0].intVal;
                //console.log(hearthrate);
                tableData = getAllTableData();
                console.log(tableData);

                if (jQuery.inArray(formatedDate, tableData) == -1) {
                    googleFitDataTableBody.append('<tr><th class="text-center">' + hearthrate + '</th>' + '<th class="text-center">' + formatedDate + '</th></tr>');
                }

            });

        },
        error: function (data) {
            //console.log(data);
        }
    });


}

function getFormatedDate(timeNS, months) {
    time = new Date((timeNS / 1000000));
    day = time.getDate();
    month = time.getMonth();
    month += 1;
    year = time.getFullYear();
    hour = time.getHours();
    minutes = time.getMinutes();
    seconds = time.getSeconds();
    formatedDate = day + '-' + months[month] + '-' + year + ', ' + hour + ':' + minutes + ':' + seconds;
    return formatedDate;
}

//function insertGoogleFitData() {
//
//    userId = $("#userId").val();
//
//    console.log(userId);
//    $.ajax({
//        type: 'POST',
//        url: "http://appointment.dev/REST.php/insertDataSetInGoogleFit",
//        data: {userId: userId},
//        dataType: 'json',
//        success: function (data) {
//            //console.log(userData);
//            console.log(data);
//
//        },
//        error: function (data) {
//            console.log(data);
//        }
//    });
//
//}

$(document).ready(function () {
    //insertGoogleFitData();
    setInterval(function () {
        getGoogleFitData();
    }, 10000);
    getGoogleFitData();
    getRatings();
    getSpecs();
    loadProfileInfo();

    //TODO add data from google fit
    //getGoogleFitData();

    if ($.urlParam('type') == 1) {
        $("#userRating").hide();
    }

    if ($.urlParam('type') == 2) {
        $("#StatsTable").hide();
    }

    currentUserInfo = $("#currentUserInfo").val();
    getUserRatingInfoForDoctor(currentUserInfo);

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