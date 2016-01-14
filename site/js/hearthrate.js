/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function takeHearthrateFromDevice(){
    
    $.ajax({
        type: 'GET',
        url: "testDevice.php",
        dataType: 'json',
        success: function (data) {
            console.log(data);
            //window.location.replace(uri + redirectPage);
            //console.log(data);
            
        },
        error:function(data){
            console.log('error');
            //window.location.replace(uri + redirectPage);
        }
    });
    
}

$(document).ready(function () {

    $("#takeHearthrate").click(function (event) {

            event.preventDefault();
            takeHearthrateFromDevice();
        
    });
});