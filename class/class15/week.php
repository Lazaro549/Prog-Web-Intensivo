<?php
$schedule = [
    'Monday' => [
        ['time' => '9:00 AM', 'task' => 'Team Meeting'],
        ['time' => '11:00 AM', 'task' => 'Project Review'],
        ['time' => '2:00 PM', 'task' => 'Client Call']
    ],
    'Tuesday' => [
        ['time' => '10:00 AM', 'task' => 'Code Review'],
        ['time' => '1:00 PM', 'task' => 'Lunch Meeting'],
        ['time' => '3:00 PM', 'task' => 'Development']
    ],
    'Wednesday' => [
        ['time' => '9:30 AM', 'task' => 'Planning Session'],
        ['time' => '12:00 PM', 'task' => 'Testing'],
        ['time' => '4:00 PM', 'task' => 'Documentation']
    ],
    'Thursday' => [
        ['time' => '8:00 AM', 'task' => 'Early Meeting'],
        ['time' => '11:30 AM', 'task' => 'Bug Fixes'],
        ['time' => '2:30 PM', 'task' => 'Deployment']
    ],
    'Friday' => [
        ['time' => '10:00 AM', 'task' => 'Weekly Review'],
        ['time' => '1:30 PM', 'task' => 'Team Lunch'],
        ['time' => '3:30 PM', 'task' => 'Planning Next Week']
    ]
];

echo "<h3>Weekly Schedule:</h3>";
foreach ($schedule as $day => $tasks) {
    echo "<h4>$day</h4>";
    foreach ($tasks as $task) {
        echo "{$task['time']} - {$task['task']}<br>";
    }
    echo "<br>";
}
?>