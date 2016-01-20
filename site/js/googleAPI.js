/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function createDataSource(data) {
    var body = {
        "dataStreamName": "hearthbeat123",
        "type": "derived",
        "application": {
            "detailsUrl": "http://http://appointment.dev",
            "name": "Foo Example App 2",
            "version": "2"
        },
        "dataType": {
            "field": [
                {
                    "name": "hearthbeat",
                    "format": "integer"
                }
            ],
            "name": "com.example.myapp.mycustomtype"
        },
        "device": {
            "manufacturer": "Example Manufacturer",
            "model": "ExampleTablet",
            "type": "tablet",
            "uid": "1000002",
            "version": "1.0"
        }
    };
    token = $("#accessToken").val();

    $.ajax({
        type: 'POST',
        url: "https://www.googleapis.com/fitness/v1/users/me/dataSources",
        data: JSON.stringify(body),
        headers: {
            "Authorization": "Bearer " + token,
            "Content-Type": "application/json;encoding=utf-8"
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
        },
        error: function () {
            console.log('error');
        }
    });

}

function getUserDataSource(data) {
    token = $("#accessToken").val();
    var heartbeat = false;
    //console.log(token);
    $.ajax({
        type: 'GET',
        url: "https://www.googleapis.com/fitness/v1/users/me/dataSources",
        data: data,
        headers: {
            "Authorization": "Bearer " + token,
            "Content-Type": "application/json;encoding=utf-8"
        },
        dataType: 'json',
        success: function (data) {
            $.each(data, function (key, value) {
                //console.log('data');
                $.each(value, function (key1, value1) {
                    if (value1.dataStreamName == 'hearthbeat123') {
                        heartbeat = true;
                    }
                });
            });
            if (!heartbeat) {
                //console.log("empty");
                createDataSource();
            } else {

                $.each(data, function (key, value) {
                    //console.log('data');
                    $.each(value, function (key1, value1) {
                        console.log(value1);
                        if (value1.dataStreamName == 'hearthbeat123') {
                            console.log(value1);
                            console.log(value1.dataStreamId);
                            populateDataSource(value1.dataStreamId)
                        }
                    });
                });

                //console.log(data);
            }
        },
        error: function () {
            console.log('error');
        }
    });
}

function populateDataSource(dataSourceId) {

    dataTypeName = dataSourceId.split(':')[1];
    console.log(dataTypeName);

    var body = {
        "dataSourceId": dataSourceId,
        "maxEndTimeNs": 1397515179728708316,
        "minStartTimeNs": 1397513334728708316,
        "point": [
            {
                "dataTypeName": dataTypeName,
                "endTimeNanos": 1397513365565713993,
                "originDataSourceId": "",
                "startTimeNanos": 1397513334728708316,
                "value": [
                    {
                        "intVal": 10
                    }
                ]
            }
        ]
    };
    //TODO $nanotime = system('date +%s%N'); in php script
    token = $("#accessToken").val();

    $.ajax({
        type: 'GET',
        url: "https://www.googleapis.com/fitness/v1/users/me/dataSources/" + dataSourceId + "/datasets/1453282751243623925-1453282751243623925",
        data: JSON.stringify(body),
        headers: {
            "Authorization": "Bearer " + token,
            "Content-Type": "application/json;encoding=utf-8"
        },
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

$(document).ready(function () {

    getUserDataSource();

});