/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function createDataSource(data) {
    token = $("#accessToken").val();
    //console.log(token);
    $.ajax({
        type: 'POST',
        url: "https://www.googleapis.com/fitness/v1/users/me/dataSources",
        data: data,
        headers: {
            "Content-Type": "application/json",

            "Authorization": "Bearer " + token
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

$(document).ready(function () {


    body = {
  "dataStreamName": "MyDataSource",
  "type": "derived",
  "application": {
    "detailsUrl": "http://appointment.dev/site",
    "name": "Foo Example App",
    "version": "1"
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
    "uid": "1000001",
    "version": "1.0"
  }
};

    createDataSource(body);
});