<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TestLog extends BaseController
{
    public function index()
    {
        // Test helper log dengan email dan user name
        $result1 = save_log('TEST', 'Testing log helper function', null, 'test@example.com', 'Test User');
        $result2 = log_create('TestModule', 123);
        $result3 = log_update('TestModule', 123);
        $result4 = log_delete('TestModule', 123);
        
        $message = "Test Log Results:<br>";
        $message .= "save_log: " . ($result1 ? 'SUCCESS' : 'FAILED') . "<br>";
        $message .= "log_create: " . ($result2 ? 'SUCCESS' : 'FAILED') . "<br>";
        $message .= "log_update: " . ($result3 ? 'SUCCESS' : 'FAILED') . "<br>";
        $message .= "log_delete: " . ($result4 ? 'SUCCESS' : 'FAILED') . "<br>";
        
        echo $message;
        
        // Show recent logs
        echo "<br><h3>Recent Logs:</h3>";
        $logs = get_recent_logs(10);
        
        if (!empty($logs)) {
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>User ID</th><th>Email</th><th>User Name</th><th>Activity</th><th>Description</th><th>Created At</th></tr>";
            foreach ($logs as $log) {
                echo "<tr>";
                echo "<td>" . $log['id'] . "</td>";
                echo "<td>" . $log['user_id'] . "</td>";
                echo "<td>" . ($log['email'] ?? '-') . "</td>";
                echo "<td>" . ($log['user_name'] ?? '-') . "</td>";
                echo "<td>" . $log['activity'] . "</td>";
                echo "<td>" . $log['description'] . "</td>";
                echo "<td>" . $log['created_at'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No logs found.";
        }
    }
}