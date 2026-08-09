<?php

namespace App\Controllers;

use App\Models\RunnerModel;
use App\Models\RaceLogModel;
use CodeIgniter\Controller;

class Admin extends BaseController
{
    public function __construct()
    {
        // Simple middleware check
        if (session()->get('role') != 'admin') {
            header('Location: ' . base_url('/auth'));
            exit;
        }
    }

public function index()
{
    $runnerModel = new RunnerModel();
    $logModel = new RaceLogModel();
    
    // Fix: Join with runners and users to get watcher info
    $recent_logs = $logModel->select('race_logs.*, runners.name, runners.bib_number, users.username as watcher_name')
                            ->join('runners', 'runners.id = race_logs.runner_id')
                            ->join('users', 'users.id = race_logs.watcher_id', 'left') // Assuming watcher_id exists
                            ->orderBy('recorded_at', 'DESC')
                            ->limit(10) // Show more logs on dashboard
                            ->findAll();
    
    $data = [
        'total_runners' => $runnerModel->countAll(),
        'recent_logs'   => $recent_logs,
        'title'         => 'Admin Dashboard'
    ];
    return view('admin/dashboard', $data);
}

    // Runner Management (CRUD)
    public function runners()
    {
        $model = new RunnerModel();
        $data['runners'] = $model->findAll();
        return view('admin/runners', $data);
    }

    public function saveRunner()
    {
        $model = new RunnerModel();
        $id = $this->request->getVar('id');
        
        $data = [
            'bib_number' => $this->request->getVar('bib_number'),
            'name'       => $this->request->getVar('name')
        ];

        if ($id) {
            $model->update($id, $data);
        } else {
            $model->save($data);
        }
        return redirect()->to('/admin/runners')->with('success', 'Runner saved successfully');
    }

    public function deleteRunner($id)
    {
        $model = new RunnerModel();
        $model->delete($id);
        return redirect()->to('/admin/runners')->with('success', 'Runner deleted');
    }

    // Monitoring and Reports
    public function logs()
    {
        $logModel = new RaceLogModel();
        // Join with runners and checkpoints for a detailed view
        $data['logs'] = $logModel->select('race_logs.*, runners.name, runners.bib_number')
                                ->join('runners', 'runners.id = race_logs.runner_id')
                                ->orderBy('recorded_at', 'DESC')
                                ->findAll();
        return view('admin/logs', $data);
    }

    public function reports()
    {
        $logModel = new RaceLogModel();
        // This uses the custom logic to determine current standings
        $data['rankings'] = $logModel->getLeaderboard(); 
        return view('admin/reports', $data);
    }

    public function resetSystem()
    {
        $logModel = new RaceLogModel();
        $logModel->truncate(); // Clears all race logs for a fresh start
        return redirect()->to('/admin')->with('success', 'Race logs have been reset.');
    }

    // Add these methods to your existing Admin.php controller

public function profile()
{
    $userModel = new \App\Models\UserModel();
    
    // Get current admin info
    $admin = $userModel->find(session()->get('id'));
    
    $data = [
        'title' => 'My Profile',
        'admin' => $admin
    ];
    
    return view('admin/profile', $data);
}

public function watchers()
{
    $userModel = new \App\Models\UserModel();
    $checkpointModel = new \App\Models\CheckpointModel(); // Add this line
    
    // Get all watchers with complete information
    $watchers = $userModel->getAllWatchers();
    
    // Get all checkpoints for dropdown
    $checkpoints = $checkpointModel->findAll(); // Add this line
    
    $data = [
        'title' => 'Watcher Management',
        'watchers' => $watchers,
        'checkpoints' => $checkpoints // Add this line
    ];
    
    return view('admin/watchers', $data);
}

public function updateProfile()
{
    $userModel = new \App\Models\UserModel();
    $id = session()->get('id');
    
    $rules = [
        'email' => 'required|valid_email',
        'first_name' => 'required|min_length[2]|max_length[50]',
        'last_name' => 'required|min_length[2]|max_length[50]',
        'middle_name' => 'permit_empty|max_length[50]',
        'phone_number' => 'permit_empty|max_length[20]'
    ];
    
    // Validation for profile image
    if ($this->request->getFile('profile_image') && $this->request->getFile('profile_image')->isValid()) {
        $rules['profile_image'] = [
            'uploaded[profile_image]',
            'mime_in[profile_image,image/jpg,image/jpeg,image/png,image/gif]',
            'max_size[profile_image,2048]', // 2MB max
        ];
    }
    
    // Only validate password if it's provided
    $current_password = $this->request->getVar('current_password');
    $new_password = $this->request->getVar('new_password');
    
    if (!empty($current_password) || !empty($new_password)) {
        $rules['current_password'] = 'required';
        $rules['new_password'] = 'required|min_length[6]';
        $rules['confirm_password'] = 'required|matches[new_password]';
    }
    
    if ($this->validate($rules)) {
        // Get current user data
        $user = $userModel->find($id);
        
        // Update basic info
        $data = [
            'email' => $this->request->getVar('email'),
            'first_name' => $this->request->getVar('first_name'),
            'middle_name' => $this->request->getVar('middle_name'),
            'last_name' => $this->request->getVar('last_name'),
            'phone_number' => $this->request->getVar('phone_number')
        ];
        
        // Handle profile image upload
        $file = $this->request->getFile('profile_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Generate random name
            $newName = $file->getRandomName();
            
            // Upload to public/uploads/profiles/
            $file->move(FCPATH . 'uploads/profiles', $newName);
            
            // Delete old profile image if exists
            if (!empty($user['profile_image']) && file_exists(FCPATH . 'uploads/profiles/' . $user['profile_image'])) {
                unlink(FCPATH . 'uploads/profiles/' . $user['profile_image']);
            }
            
            $data['profile_image'] = $newName;
        }
        
        // Handle remove image checkbox
        if ($this->request->getVar('remove_image') == '1') {
            if (!empty($user['profile_image']) && file_exists(FCPATH . 'uploads/profiles/' . $user['profile_image'])) {
                unlink(FCPATH . 'uploads/profiles/' . $user['profile_image']);
            }
            $data['profile_image'] = null;
        }
        
        // Update password if provided
        if (!empty($new_password)) {
            if (password_verify($current_password, $user['password'])) {
                $data['password'] = password_hash($new_password, PASSWORD_DEFAULT);
            } else {
                return redirect()->back()->with('error', 'Current password is incorrect');
            }
        }
        
        $userModel->update($id, $data);
        return redirect()->to('/admin/profile')->with('success', 'Profile updated successfully');
    } else {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
}

public function addWatcher()
{
    $userModel = new \App\Models\UserModel();
    
    $rules = [
        'username' => 'required|is_unique[users.username]|min_length[3]|max_length[50]',
        'email' => 'permit_empty|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'checkpoint_id' => 'required|numeric|in_list[1,2,3,4,5,6,7,8,9,10]',
        'first_name' => 'permit_empty|min_length[2]|max_length[50]',
        'middle_name' => 'permit_empty|max_length[50]',
        'last_name' => 'permit_empty|min_length[2]|max_length[50]',
        'phone_number' => 'permit_empty|max_length[20]',
        'address' => 'permit_empty|max_length[500]',
        'latitude' => 'permit_empty|numeric',
        'longitude' => 'permit_empty|numeric'
    ];
    
    if ($this->validate($rules)) {
        $checkpointId = $this->request->getVar('checkpoint_id');
        
        $data = [
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role' => 'watcher',
            'checkpoint_id' => $checkpointId,
            'checkpoint_name' => "Checkpoint {$checkpointId}", // Auto-generate checkpoint name
            'first_name' => $this->request->getVar('first_name'),
            'middle_name' => $this->request->getVar('middle_name'),
            'last_name' => $this->request->getVar('last_name'),
            'phone_number' => $this->request->getVar('phone_number'),
            'address' => $this->request->getVar('address'),
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude')
        ];
        
        // Handle profile image upload if provided
        $file = $this->request->getFile('profile_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/profiles', $newName);
            $data['profile_image'] = $newName;
        }
        
        $userModel->save($data);
        
        return redirect()->to('/admin/watchers')->with('success', 'Watcher account created successfully');
    } else {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
}

public function updateWatcher($id)
{
    $userModel = new \App\Models\UserModel();
    
    $rules = [
        'username' => "required|min_length[3]|max_length[50]|is_unique[users.username,id,{$id}]",
        'email' => "permit_empty|valid_email|is_unique[users.email,id,{$id}]",
        'checkpoint_id' => 'required|numeric|in_list[1,2,3,4,5,6,7,8,9,10]',
        'first_name' => 'permit_empty|min_length[2]|max_length[50]',
        'middle_name' => 'permit_empty|max_length[50]',
        'last_name' => 'permit_empty|min_length[2]|max_length[50]',
        'phone_number' => 'permit_empty|max_length[20]',
        'address' => 'permit_empty|max_length[500]',
        'latitude' => 'permit_empty|numeric',
        'longitude' => 'permit_empty|numeric'
    ];
    
    $checkpointId = $this->request->getVar('checkpoint_id');
    
    $data = [
        'username' => $this->request->getVar('username'),
        'email' => $this->request->getVar('email'),
        'checkpoint_id' => $checkpointId,
        'checkpoint_name' => "Checkpoint {$checkpointId}", // Auto-generate checkpoint name
        'first_name' => $this->request->getVar('first_name'),
        'middle_name' => $this->request->getVar('middle_name'),
        'last_name' => $this->request->getVar('last_name'),
        'phone_number' => $this->request->getVar('phone_number'),
        'address' => $this->request->getVar('address'),
        'latitude' => $this->request->getVar('latitude'),
        'longitude' => $this->request->getVar('longitude')
    ];
    
    // Only update password if provided
    $password = $this->request->getVar('password');
    if (!empty($password)) {
        $rules['password'] = 'min_length[6]';
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    }
    
    // Handle profile image upload if provided
    $file = $this->request->getFile('profile_image');
    if ($file && $file->isValid() && !$file->hasMoved()) {
        // Get current user to delete old image
        $currentUser = $userModel->find($id);
        if (!empty($currentUser['profile_image']) && file_exists(FCPATH . 'uploads/profiles/' . $currentUser['profile_image'])) {
            unlink(FCPATH . 'uploads/profiles/' . $currentUser['profile_image']);
        }
        
        $newName = $file->getRandomName();
        $file->move(FCPATH . 'uploads/profiles', $newName);
        $data['profile_image'] = $newName;
    }
    
    // Handle remove image checkbox
    if ($this->request->getVar('remove_image') == '1') {
        $currentUser = $userModel->find($id);
        if (!empty($currentUser['profile_image']) && file_exists(FCPATH . 'uploads/profiles/' . $currentUser['profile_image'])) {
            unlink(FCPATH . 'uploads/profiles/' . $currentUser['profile_image']);
        }
        $data['profile_image'] = null;
    }
    
    if ($this->validate($rules)) {
        $userModel->update($id, $data);
        return redirect()->to('/admin/watchers')->with('success', 'Watcher account updated successfully');
    } else {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
}

/**
 * Delete watcher account
 */
public function deleteWatcher($id)
{
    // Prevent deleting yourself
    if ($id == session()->get('id')) {
        return redirect()->to('/admin/profile')->with('error', 'You cannot delete your own account');
    }
    
    $userModel = new \App\Models\UserModel();
    $user = $userModel->find($id);
    
    if ($user && $user['role'] == 'watcher') {
        $userModel->delete($id);
        return redirect()->to('/admin/profile')->with('success', 'Watcher account deleted successfully');
    }
    
    return redirect()->to('/admin/profile')->with('error', 'Watcher not found');
}

// Add this method to your Admin.php controller (after the index() method)

/**
 * Get watcher details for modal
 */
public function getWatcherDetails($id)
{
    $userModel = new \App\Models\UserModel();
    $watcher = $userModel->find($id);
    
    if (!$watcher) {
        return $this->response->setJSON(['error' => 'Watcher not found'])->setStatusCode(404);
    }
    
    // Format the data for modal display
    $data = [
        'id' => $watcher['id'],
        'username' => $watcher['username'],
        'email' => $watcher['email'],
        'role' => $watcher['role'],
        'checkpoint_id' => $watcher['checkpoint_id'],
        'checkpoint_name' => $watcher['checkpoint_name'] ?? 'Checkpoint ' . ($watcher['checkpoint_id'] ?? 'N/A'),
        'first_name' => $watcher['first_name'] ?? '',
        'middle_name' => $watcher['middle_name'] ?? '',
        'last_name' => $watcher['last_name'] ?? '',
        'phone_number' => $watcher['phone_number'] ?? '',
        'address' => $watcher['address'] ?? '',
        'latitude' => $watcher['latitude'] ?? '',
        'longitude' => $watcher['longitude'] ?? '',
        'profile_image' => $userModel->getProfileImage($watcher),
        'full_name' => $userModel->getFullName($watcher),
        'created_at' => $watcher['created_at'],
        'last_login' => $watcher['last_login'] ?? null
    ];
    
    return $this->response->setJSON($data);
}
}