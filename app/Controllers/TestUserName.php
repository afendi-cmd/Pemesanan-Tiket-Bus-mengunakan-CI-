<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TestUserName extends BaseController
{
    public function index()
    {
        try {
            // Test 1: Manual insert dengan user_name
            $db = \Config\Database::connect();
            
            $data = [
                'user_id' => 1,
                'email' => 'test@example.com',
                'user_name' => 'Test User Manual',
                'activity' => 'TEST_MANUAL',
                'description' => 'Manual test with user_name',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Test Browser',
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $result1 = $db->table('user_logs')->insert($data);
            echo "Test 1 - Manual insert: " . ($result1 ? "✅ SUCCESS" : "❌ FAILED") . "<br>";
            
            // Test 2: Using helper function
            $result2 = save_log('TEST_HELPER', 'Test using helper function', 1, 'helper@test.com', 'Helper Test User');
            echo "Test 2 - Helper function: " . ($result2 ? "✅ SUCCESS" : "❌ FAILED") . "<br>";
            
            // Test 3: Using CRUD helpers
            session()->set([
                'userId' => 1,
                'userSource' => 'karyawan',
                'userData' => [
                    'email' => 'crud@test.com',
                    'nama_karyawan' => 'CRUD Test User'
                ]
            ]);
            
            $result3 = log_create('Test Module', 123);
            echo "Test 3 - CRUD helper: " . ($result3 ? "✅ SUCCESS" : "❌ FAILED") . "<br>";
            
            // Show recent logs with user_name
            echo "<br><h3>Recent Logs with User Name:</h3>";
            $logs = $db->table('user_logs')
                      ->orderBy('created_at', 'DESC')
                      ->limit(5)
                      ->get()
                      ->getResultArray();
            
            if (!empty($logs)) {
                echo "<table border='1'>";
                echo "<tr><th>ID</th><th>User ID</th><th>Email</th><th>User Name</th><th>Activity</th><th>Description</th><th>Created At</th></tr>";
                foreach ($logs as $log) {
                    echo "<tr>";
                    echo "<td>" . $log['id'] . "</td>";
                    echo "<td>" . $log['user_id'] . "</td>";
                    echo "<td>" . ($log['email'] ?? '-') . "</td>";
                    echo "<td><strong>" . ($log['user_name'] ?? '-') . "</strong></td>";
                    echo "<td>" . $log['activity'] . "</td>";
                    echo "<td>" . $log['description'] . "</td>";
                    echo "<td>" . $log['created_at'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No logs found.";
            }
            
            echo "<br><a href='/userlogs'>View All Logs</a> | <a href='/addcolumn'>Check Table Structure</a>";
            
        } catch (\Exception $e) {
            echo "❌ Error: " . $e->getMessage();
        }
    }
}