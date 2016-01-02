/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
