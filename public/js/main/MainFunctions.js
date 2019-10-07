function postToServerTask() {
    let task = new Task();
    let formatter = new Formatter();
    let resources = new Resources();
    task.post('/api/tasks?user_id=' + resources.getCookie("tasktoc"),
        'text=' + document.getElementById("text").value + '&'
        + 'duration=' + formatter.getMinutes(timer.hours, timer.minutes), "error", text);

}


function startButton() {
    let task = document.getElementById("text").value;
    if (task !== "") {
        text.style.visibility = 'hidden';

        start.style.visibility = 'hidden';

        stop.style.visibility = 'visible';
        taskTxt.innerHTML = "Task On Going:" + task;
        error.innerHTML = "";
        timerTxt.textContent = "00:00:00";
        timer.timer(0, 0, 0)
    } else {
        error.innerHTML = "Please fill the task";

    }
}

function stopButton() {
    stop.style.visibility = 'hidden';

    start.style.visibility = 'visible';
    text.style.visibility = 'visible';
    taskTxt.innerHTML = "";
    clearTimeout(timer.t);

    //post to server
    postToServerTask();
    text.value = "";
    timer.seconds = 0, timer.minutes = 0, timer.hours = 0;

    timerTxt.textContent = "";
}
