task = new Task();
let resources = new Resources();

task.getAndFormat('/api/tasks?user_id=' + resources.getCookie("tasktoc"), "content");




