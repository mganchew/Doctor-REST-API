/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function createDataSource(data) {
    var body = {
      "dataStreamName": "MyDataSource2",
      "type": "derived",
      "application": {
        "detailsUrl": "http://http://appointment.dev",
        "name": "Foo Example App 2",
        "version": "2"
      },
      "dataType": {
        "field": [
          {
            "name": "steps",
            "format": "integer"
          }
        ],
        "name": "com.google.step_count.delta"
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
            "Authorization" : "Bearer " + token,
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
    //console.log(token);
    $.ajax({
        type: 'GET',
        url: "https://www.googleapis.com/fitness/v1/users/me/dataSources",
        data: data,
        headers: {
            "Authorization" : "Bearer " + token,
            "Content-Type": "application/json;encoding=utf-8"
        },
        dataType: 'json',
        success: function (data) {
            
            if(jQuery.isEmptyObject(data)) { 

              console.log("empty");
              createDataSource();
            }

            console.log(data);
        },
        error: function () {
            console.log('error');
        }
    });
}

$(document).ready(function () {

    getUserDataSource();

});