<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AddColumn extends BaseController
{
    public function index()
    {
        try {
            $db = \Config\Database::connect();
            
            // Check if column already exists
            $query = $db->query("SHOW COLUMNS FROM user_logs LIKE 'user_name'");
            $result = $query->getResultArray();
            
            if (empty($result)) {
                // Column doesn't exist, add it
                $sql = "ALTER TABLE user_logs ADD COLUMN user_name VARCHAR(255) NULL AFTER email";
                $db->query($sql);
                echo "✅ Column 'user_name' added successfully to user_logs table!<br>";
            } else {
                echo "ℹ️ Column 'user_name' already exists in user_logs table.<br>";
            }
            
            // Show current table structure
            echo "<br><h3>Current user_logs table structure:</h3>";
            $columns = $db->query("SHOW COLUMNS FROM user_logs")->getResultArray();
            
            echo "<table border='1'>";
            echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
            foreach ($columns as $column) {
                echo "<tr>";
                echo "<td>" . $column['Field'] . "</td>";
                echo "<td>" . $column['Type'] . "</td>";
                echo "<td>" . $column['Null'] . "</td>";
                echo "<td>" . $column['Key'] . "</td>";
                echo "<td>" . ($column['Default'] ?? 'NULL') . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            
            echo "<br><a href='/testlog'>Test Logging</a> | <a href='/userlogs'>View Logs</a>";
            
        } catch (\Exception $e) {
            echo "❌ Error: " . $e->getMessage();
        }
    }
}