<?php

if (!function_exists('save_log')) {
    /**
     * Save log activity to user_logs table
     * 
     * @param string $activity Activity type
     * @param string $description Activity description
     * @param int|null $userId User ID (optional, will get from session if not provided)
     * @param string|null $email User email (optional)
     * @param string|null $userName User name (optional)
     * @return bool
     */
    function save_log($activity, $description, $userId = null, $email = null, $userName = null)
    {
        try {
            // Mengambil instance database secara manual dalam helper
            $db = \Config\Database::connect();
            $session = \Config\Services::session();
            $request = \Config\Services::request();
            
            // Get user ID from session if not provided
            if ($userId === null) {
                $userId = $session->get('userId');
            }
            
            // If still no user ID, try to get from different session keys
            if (!$userId) {
                $userId = $session->get('user_id') ?? $session->get('idkaryawan') ?? 0;
            }
            
            // Prepare data
            $data = [
                'user_id'     => $userId,
                'email'       => $email,
                'user_name'   => $userName,
                'activity'    => strtoupper($activity),
                'description' => $description,
                'ip_address'  => $request->getIPAddress(),
                'user_agent'  => $request->getUserAgent()->getAgentString(),
                'created_at'  => date('Y-m-d H:i:s')
            ];
            
            // Gunakan query builder sederhana agar ringan
            return $db->table('user_logs')->insert($data);
            
        } catch (\Exception $e) {
            // Log error to CodeIgniter log
            log_message('error', 'Failed to save user log: ' . $e->getMessage());
            return false;
        }
    }
}

if (!function_exists('log_activity')) {
    /**
     * Alias for save_log function
     * 
     * @param string $activity Activity type
     * @param string $description Activity description
     * @param int|null $userId User ID (optional)
     * @param string|null $email User email (optional)
     * @return bool
     */
    function log_activity($activity, $description, $userId = null, $email = null)
    {
        return save_log($activity, $description, $userId, $email);
    }
}

if (!function_exists('log_login')) {
    /**
     * Log user login activity
     * 
     * @param int $userId User ID
     * @param string $email User email/identifier
     * @return bool
     */
    function log_login($userId, $email = null)
    {
        $description = $email ? "User logged in with email: {$email}" : "User logged in";
        return save_log('LOGIN', $description, $userId);
    }
}

if (!function_exists('log_logout')) {
    /**
     * Log user logout activity
     * 
     * @param int $userId User ID
     * @return bool
     */
    function log_logout($userId)
    {
        return save_log('LOGOUT', 'User logged out', $userId);
    }
}

if (!function_exists('log_create')) {
    /**
     * Log data creation activity
     * 
     * @param string $module Module/table name
     * @param int|null $recordId Record ID
     * @param int|null $userId User ID
     * @return bool
     */
    function log_create($module, $recordId = null, $userId = null)
    {
        $description = "Created new record in {$module}";
        if ($recordId) {
            $description .= " (ID: {$recordId})";
        }
        
        // Auto-detect email and user name
        $email = get_user_email($userId);
        $userName = get_user_name($userId);
        
        return save_log('CREATE', $description, $userId, $email, $userName);
    }
}

if (!function_exists('log_update')) {
    /**
     * Log data update activity
     * 
     * @param string $module Module/table name
     * @param int|null $recordId Record ID
     * @param int|null $userId User ID
     * @return bool
     */
    function log_update($module, $recordId = null, $userId = null)
    {
        $description = "Updated record in {$module}";
        if ($recordId) {
            $description .= " (ID: {$recordId})";
        }
        
        // Auto-detect email and user name
        $email = get_user_email($userId);
        $userName = get_user_name($userId);
        
        return save_log('UPDATE', $description, $userId, $email, $userName);
    }
}

if (!function_exists('log_delete')) {
    /**
     * Log data deletion activity
     * 
     * @param string $module Module/table name
     * @param int|null $recordId Record ID
     * @param int|null $userId User ID
     * @return bool
     */
    function log_delete($module, $recordId = null, $userId = null)
    {
        $description = "Deleted record from {$module}";
        if ($recordId) {
            $description .= " (ID: {$recordId})";
        }
        
        // Auto-detect email and user name
        $email = get_user_email($userId);
        $userName = get_user_name($userId);
        
        return save_log('DELETE', $description, $userId, $email, $userName);
    }
}

if (!function_exists('get_user_logs')) {
    /**
     * Get user activity logs
     * 
     * @param int $userId User ID
     * @param int $limit Number of records to retrieve
     * @return array
     */
    function get_user_logs($userId, $limit = 50)
    {
        try {
            $db = \Config\Database::connect();
            return $db->table('user_logs')
                     ->where('user_id', $userId)
                     ->orderBy('created_at', 'DESC')
                     ->limit($limit)
                     ->get()
                     ->getResultArray();
        } catch (\Exception $e) {
            log_message('error', 'Failed to get user logs: ' . $e->getMessage());
            return [];
        }
    }
}

if (!function_exists('get_recent_logs')) {
    /**
     * Get recent system logs
     * 
     * @param int $limit Number of records to retrieve
     * @return array
     */
    function get_recent_logs($limit = 100)
    {
        try {
            $db = \Config\Database::connect();
            return $db->table('user_logs')
                     ->orderBy('created_at', 'DESC')
                     ->limit($limit)
                     ->get()
                     ->getResultArray();
        } catch (\Exception $e) {
            log_message('error', 'Failed to get recent logs: ' . $e->getMessage());
            return [];
        }
    }
}