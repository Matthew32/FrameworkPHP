class Timer {
    seconds;
    minutes;
    hours;
    t;

    constructor() {
        this.seconds = 0;
        this.minutes = 0;
        this.hours = 0;
        this.t = 0;


    }

    timer = function (element) {
        timer.t = setTimeout(this.add, 1000, [element]);
    };


    add = function (element) {

        timer.seconds++;
        if (timer.seconds >= 60) {
            timer.seconds = 0;
            timer.minutes++;
            if (timer.minutes >= 60) {
                timer.minutes = 0;
                timer.hours++;
            }
        }
        timerTxt.textContent = (
            timer.hours ? (timer.hours > 9 ? timer.hours : "0" + timer.hours) : "00") + ":" + (timer.minutes ? (timer.minutes > 9 ? timer.minutes : "0" + timer.minutes) : "00") + ":" + (timer.seconds > 9 ? timer.seconds : "0" + timer.seconds);
        timer.timer(element);

    };
}