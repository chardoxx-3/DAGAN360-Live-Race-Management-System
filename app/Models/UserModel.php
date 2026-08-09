<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'username', 
        'email',
        'password', 
        'role', 
        'checkpoint_name',
        'checkpoint_id', // Add this line - this is crucial!
        'first_name',
        'middle_name',
        'last_name',
        'phone_number',
        'address',
        'latitude',
        'longitude',
        'profile_image',
        'last_login'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get full name of a user
     */
    public function getFullName($user)
    {
        $nameParts = [];
        if (!empty($user['first_name'])) $nameParts[] = $user['first_name'];
        if (!empty($user['middle_name'])) $nameParts[] = $user['middle_name'];
        if (!empty($user['last_name'])) $nameParts[] = $user['last_name'];
        
        return !empty($nameParts) ? implode(' ', $nameParts) : $user['username'];
    }

    /**
     * Get all watchers (simplified - no checkpoint join needed)
     */
    public function getAllWatchers()
    {
        return $this->where('users.role', 'watcher')
                    ->orderBy('users.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get profile image URL or default avatar
     */
    public function getProfileImage($user)
    {
        if (!empty($user['profile_image']) && file_exists(FCPATH . 'uploads/profiles/' . $user['profile_image'])) {
            return base_url('uploads/profiles/' . $user['profile_image']);
        }
        
        // Return default avatar based on name
        return $this->getDefaultAvatar($user);
    }

    /**
     * Generate default avatar with initials
     */
    private function getDefaultAvatar($user)
    {
        $name = $this->getFullName($user);
        if (empty($name) || $name == $user['username']) {
            $name = $user['username'];
        }
        
        // Get initials (first letter of first name and last name)
        $words = explode(' ', $name);
        $initials = '';
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
            }
        }
        
        // Limit to 2 letters
        $initials = substr($initials, 0, 2);
        
        return "https://ui-avatars.com/api/?name=" . urlencode($initials) . "&background=random&color=fff&size=128";
    }

    /**
     * Update last login timestamp
     */
    public function updateLastLogin($userId)
    {
        return $this->update($userId, ['last_login' => date('Y-m-d H:i:s')]);
    }
}