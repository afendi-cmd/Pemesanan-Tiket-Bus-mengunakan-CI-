<?php

if (!function_exists('get_user_email')) {
    /**
     * Get user email from session or database based on user source
     * 
     * @param int|null $userId User ID (optional, will get from session if not provided)
     * @return string|null
     */
    function get_user_email($userId = null)
    {
        try {
            $session = \Config\Services::session();
            $db = \Config\Database::connect();
            
            // Get user ID from session if not provided
            if ($userId === null) {
                $userId = $session->get('userId');
            }
            
            // If still no user ID, try other session keys
            if (!$userId) {
                $userId = $session->get('user_id') ?? $session->get('idkaryawan') ?? 0;
            }
            
            // First try to get email from session userData (fastest)
            $userData = $session->get('userData');
            if (is_array($userData) && isset($userData['email']) && !empty($userData['email'])) {
                return $userData['email'];
            }
            
            // If no email in session, get from database based on user source
            $userSource = $session->get('userSource');
            
            if (!$userId || !$userSource) {
                return null;
            }
            
            // Get email based on user source
            switch ($userSource) {
                case 'karyawan':
                    $result = $db->table('karyawan')
                               ->select('email')
                               ->where('idkaryawan', $userId)
                               ->get()
                               ->getRowArray();
                    return $result['email'] ?? null;
                    
                case 'penyewa':
                    $result = $db->table('penyewa')
                               ->select('email')
                               ->where('id', $userId)
                               ->get()
                               ->getRowArray();
                    return $result['email'] ?? null;
                    
                default:
                    return null;
            }
            
        } catch (\Exception $e) {
            log_message('error', 'Failed to get user email: ' . $e->getMessage());
            return null;
        }
    }
}

if (!function_exists('get_user_name')) {
    /**
     * Get user name from session or database based on user source
     * 
     * @param int|null $userId User ID (optional, will get from session if not provided)
     * @return string|null
     */
    function get_user_name($userId = null)
    {
        try {
            $session = \Config\Services::session();
            $db = \Config\Database::connect();
            
            // Get user ID from session if not provided
            if ($userId === null) {
                $userId = $session->get('userId');
            }
            
            // If still no user ID, try other session keys
            if (!$userId) {
                $userId = $session->get('user_id') ?? $session->get('idkaryawan') ?? 0;
            }
            
            // First try to get name from session userData (fastest)
            $userData = $session->get('userData');
            if (is_array($userData)) {
                // Try different name fields based on user source
                if (isset($userData['nama_karyawan']) && !empty($userData['nama_karyawan'])) {
                    return $userData['nama_karyawan'];
                }
                if (isset($userData['nama_penyewa']) && !empty($userData['nama_penyewa'])) {
                    return $userData['nama_penyewa'];
                }
            }
            
            // If no name in session, get from database based on user source
            $userSource = $session->get('userSource');
            
            if (!$userId || !$userSource) {
                return null;
            }
            
            // Get name based on user source
            switch ($userSource) {
                case 'karyawan':
                    $result = $db->table('karyawan')
                               ->select('nama_karyawan')
                               ->where('idkaryawan', $userId)
                               ->get()
                               ->getRowArray();
                    return $result['nama_karyawan'] ?? null;
                    
                case 'penyewa':
                    $result = $db->table('penyewa')
                               ->select('nama_penyewa')
                               ->where('id', $userId)
                               ->get()
                               ->getRowArray();
                    return $result['nama_penyewa'] ?? null;
                    
                default:
                    return null;
            }
            
        } catch (\Exception $e) {
            log_message('error', 'Failed to get user name: ' . $e->getMessage());
            return null;
        }
    }
}

if (!function_exists('log_with_email')) {
    /**
     * Log activity with automatic email detection
     * 
     * @param string $activity Activity type
     * @param string $description Activity description
     * @param int|null $userId User ID (optional)
     * @param string|null $email User email (optional, will auto-detect if not provided)
     * @param string|null $userName User name (optional, will auto-detect if not provided)
     * @return bool
     */
    function log_with_email($activity, $description, $userId = null, $email = null, $userName = null)
    {
        // Auto-detect email if not provided
        if ($email === null) {
            $email = get_user_email($userId);
        }
        
        // Auto-detect user name if not provided
        if ($userName === null) {
            $userName = get_user_name($userId);
        }
        
        return save_log($activity, $description, $userId, $email, $userName);
    }
}