/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//function createDataSource(data) {
//    var body = {
//        "dataStreamName": "hearthbeat1234",
//        "type": "derived",
//        "application": {
//            "detailsUrl": "http://http://appointment.dev",
//            "name": "Foo Example App 2",
//            "version": "2"
//        },
//        "dataType": {
//            "field": [
//                {
//                    "name": "hearthbeat1234",
//                    "format": "integer"
//                }
//            ],
//            "name": "com.example.myapp.mycustomtype"
//        },
//        "device": {
//            "manufacturer": "Example Manufacturer",
//            "model": "ExampleTablet",
//            "type": "tablet",
//            "uid": "1000002",
//            "version": "1.0"
//        }
//    };
//    token = $("#accessToken").val();
//
//    $.ajax({
//        type: 'POST',
//        url: "https://www.googleapis.com/fitness/v1/users/me/dataSources",
//        data: JSON.stringify(body),
//        headers: {
//            "Authorization": "Bearer " + token,
//            "Content-Type": "application/json;encoding=utf-8"
//        },
//        dataType: 'json',
//        success: function (data) {
//            console.log(data);
//        },
//        error: function () {
//            console.log('error');
//        }
//    });
//
//}
//
//function getUserDataSource(data) {
//    token = $("#accessToken").val();
//    var heartbeat = false;
//    //console.log(token);
//    $.ajax({
//        type: 'POST',
//        url: "https://www.googleapis.com/fitness/v1/users/me/dataSources",
//        data: data,
//        headers: {
//            "Authorization": "Bearer " + token,
//            "Content-Type": "application/json;encoding=utf-8"
//        },
//        dataType: 'json',
//        success: function (data) {
//            $.each(data, function (key, value) {
//                //console.log('data');
//                $.each(value, function (key1, value1) {
//                    if (value1.dataStreamName == 'hearthbeat1234') {
//                        heartbeat = true;
//                    }
//                });
//            });
//            if (!heartbeat) {
//                //console.log("empty");
//                createDataSource();
//            } else {
//
//                $.each(data, function (key, value) {
//                    //console.log('data');
//                    $.each(value, function (key1, value1) {
//                        console.log(value1);
//                        if (value1.dataStreamName == 'hearthbeat1234') {
//                            console.log(value1);
//                            console.log(value1.dataStreamId);
//                            populateDataSource(value1.dataStreamId)
//                        }
//                    });
//                });
//
//                //console.log(data);
//            }
//        },
//        error: function () {
//            console.log('error');
//        }
//    });
//}
//
//function populateDataSource(dataSourceId) {
//
//    dataTypeName = dataSourceId.split(':')[1];
//    console.log(dataTypeName);
//
//    var body = {
//        "dataSourceId": dataSourceId,
//        "maxEndTimeNs": 1453282751243623930,
//        "minStartTimeNs": 1453282751243623910,
//        "point": [
//            {
//                "dataTypeName": dataTypeName,
//                "endTimeNanos": 1453282751243623925,
//                "originDataSourceId": "",
//                "startTimeNanos": 1453282751243623925,
//                "value": [
//                    {
//                        "intVal": 22
//                    }
//                ]
//            }
//        ]
//    };
//    //TODO $nanotime = system('date +%s%N'); in php script
//    token = $("#accessToken").val();
//
//    $.ajax({
//        type: 'GET',
//        url: "https://www.googleapis.com/fitness/v1/users/me/dataSources/" + dataSourceId + "/datasets/1453282751243623910-1453282751243623930",
//        //data: JSON.stringify(body),
//        headers: {
//            "Authorization": "Bearer " + token,
//            "Content-Type": "application/json;encoding=utf-8"
//        },
//        dataType: 'json',
//        success: function (data) {
//            console.log(data);
//            //console.log(data.point[0].value[0].intVal);
//        },
//        error: function () {
//            console.log('error');
//        }
//    });
//
//
//
//}

function checkOrCreate(){
    var tokenId = $("#accessToken").val();

    $.ajax({
        type: 'POST',
        url: "http://appointment.dev/REST.php/checkAndCreateResources",
        data: {token:tokenId},
        dataType: 'json',
        success: function (data) {
            console.log(data);
            //console.log(data.point[0].value[0].intVal);
        },
        error: function () {
            console.log('error');
        }
    });

}

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
            window.location.replace(uri);
            //console.log(data.point[0].value[0].intVal);
        },
        error: function () {
            console.log('error');
        }
    });

}

$(document).ready(function () {

    //getUserDataSource();
    checkOrCreate();

    //$("#takeHearthrate").click(function (event) {
    //
    //    event.preventDefault(); // cancel default behavior
    //
    //    deviceDataCall();
    //
    //
    //});

});