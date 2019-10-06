class Formatter {

    getHoursAndMinutesFromMinutes = function

        (totalMinutes) {

        var hours = Math.floor(totalMinutes / 60);
        var minutes = totalMinutes % 60;
        if(minutes <10){
            minutes = "0"+minutes;
        }
        return hours + "h " + minutes+" min"
    };
    getMinutes = function (hours, minutes) {
        return parseInt(hours) * 60 + parseInt(minutes);
    }
}