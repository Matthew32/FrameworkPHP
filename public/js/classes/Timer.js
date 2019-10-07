class Timer {

    element;

    constructor(element) {
        this.element = element;
        this.t = 0;
    }

    timer(seconds, minutes, hours) {
        this.element.textContent = (
                hours ? (hours > 9 ? hours : "0" + hours) : "00")
            + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00")
            + ":" + (seconds > 9 ? seconds : "0" + seconds);

        this.t = setTimeout(this.add, 1000, this, seconds, minutes, hours);
    };


    add(instance, seconds, minutes, hours) {
        seconds++;
        if (seconds >= 60) {
            seconds = 0;
            minutes++;
            if (minutes >= 60) {
                minutes = 0;
                hours++;
            }
        }
        instance.timer(seconds,minutes,hours);
    };
}