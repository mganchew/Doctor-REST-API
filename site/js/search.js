function submitSearchForm(values) {

    var uri = "http://appointment.dev/site/view/";

    $.ajax({
        type: 'POST',
        url: "http://appointment.dev/REST.php/search",
        data: {searchField: values['searchField']},
        dataType: 'json',
        success: function (data) {
            console.log(data);
            var table = $("#doctorsFromSearch tbody");
             $("#doctorsFromSearch").show();
            $.each(data, function (idx, elem) {
                table.append("<tr><td>" + elem.fName + "</td><td>" 
                        + elem.lName + "</td>   <td>" + elem.email +
                        "</td> <td>" + elem.workAddress + 
                        "</td> <td>" + elem.specId + 
                        "</td> <td><a href='profile.php?user="+elem.email+"&type=2 '>View Profile"+
                        "</a></td></tr>");
            });

            //window.location.replace(uri + data.redirectPage + "?msg=" + data.msg );
        },
        error: function () {
            //window.location.replace(uri + data.redirectPage + "?msg=" + data.msg );
        },
    });

}

$(document).ready(function () {
    $("#doctorsFromSearch").hide();
    $("#searchBtn").click(function (event) {

        event.preventDefault(); // cancel default behavior    

        var $inputs = $('#search :input');

        // get an associative array of just the values.
        var values = {};

        $inputs.each(function () {
            values[this.name] = $(this).val();
        });

        //console.log(values);

        submitSearchForm(values);


    });
});