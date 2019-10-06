<?php

return [
    [
        'GET',
        '/',
        'TaskWeb\Main\Controller\IndexController',
        'index',
        '/main/index.html'

    ],
    [
        'GET',
        '/task',
        'TaskWeb\Task\Controller\TaskController',
        'index',
        '/list/index.html'

    ],
    [
        'GET',
        '/api/tasks',
        'TaskAPI\Task\Controller\TaskController',
        'index'
    ],
    [
        'GET',
        '/api/tasks/[:id]',
        'TaskAPI\Task\Controller\TaskController',
        'getById'
    ],
    [
        'POST',
        '/api/tasks',
        'TaskAPI\Task\Controller\TaskController',
        'save'
    ]];