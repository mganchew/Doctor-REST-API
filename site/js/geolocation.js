// GEOLOCATION JS

var x = document.getElementById("demo");
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
            navigator.geolocation.getCurrentPosition(redirectToPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }
    /**
     * showing the position on the web browser.
     * Probably we dont need this function.
     * @param {type} position
     * @returns {undefined}
     */
    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
                "<br>Longitude: " + position.coords.longitude;
    }
    /**
     * passing the latitude and longitude via GET method so we can assing them as variables later.
     * @param {type} position
     * @returns {undefined}
     */
    function redirectToPosition(position) {
        window.location = 'selectDate.php?lat=' + position.coords.latitude + '&long=' + position.coords.longitude;
    }