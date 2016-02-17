/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//function takeHearthrateFromDevice(){
//
//    $.ajax({
//        type: 'GET',
//        url: "testDevice.php",
//        dataType: 'json',
//        success: function (data) {
//            console.log(data);
//            //window.location.replace(uri + redirectPage);
//            //console.log(data);
//
//        },
//        error:function(data){
//            console.log('error');
//            //window.location.replace(uri + redirectPage);
//        }
//    });
//
//}
//

function deviceDataCall(){
     var uri = "http://appointment.dev/site/view/selectDate.php?msg=UspeshnoZapazeniCasove";
    userId = $("#userId").val();
    console.log(userId);
    $.ajax({
        type: 'POST',
        url: "testDevice.php",
        data: {userId : userId },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            alert("Data inserted correctly");
            //console.log(data.point[0].value[0].intVal);
        },
        error: function () {
            alert('Vruzkata s ustroistvoto e neuspeshna molq opitaite pak');
            console.log('error');
        }
    });

}

$(document).ready(function () {

    $("#takeHearthrate").click(function (event) {

        event.preventDefault();
        deviceDataCall();

    });
});

//function takeHearthrateFromDevice() {
//    var userId = $("#userId").val();
//    //TODO MAKE IT WORK
//    var heartrate = $("#heartrate").val();
//
//    $.ajax({
//        type: 'POST',
//        url: "http://appointment.dev/REST.php/insertDataSetInGoogleFit",
//        data: {heartrate: heartrate, userId: userId},
//        dataType: 'json',
//        success: function (data) {
//            console.log(data);
//            //console.log(data.point[0].value[0].intVal);
//        },
//        error: function () {
//            console.log('errorInserting');
//        }
//    });
//}