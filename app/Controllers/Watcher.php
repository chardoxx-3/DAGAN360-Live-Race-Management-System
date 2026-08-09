<?php

namespace App\Controllers;

use App\Models\RunnerModel;
use App\Models\RaceLogModel;
use App\Models\CheckpointModel;
use CodeIgniter\Controller;

class Watcher extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != 'watcher') {
            header('Location: ' . base_url('/auth'));
            exit;
        }
    }

    public function index()
    {
        $data = [
            'checkpoint_id' => session()->get('checkpoint_id'),
            'title' => 'Checkpoint Entry'
        ];
        return view('watcher/scan', $data);
    }

public function submitEntry()
{
    $bib = $this->request->getPost('bib_number');
    $checkpoint_id = session()->get('checkpoint_id');

    $runnerModel = new RunnerModel();
    $runner = $runnerModel->where('bib_number', $bib)->first();

    if (!$runner) {
        return redirect()->back()->with('error', "Error: Bib #$bib not found in database.");
    }

    $logModel = new RaceLogModel();
    
    // Check if runner already passed this specific checkpoint to prevent double entry
    $exists = $logModel->where([
        'runner_id' => $runner['id'],
        'checkpoint_id' => $checkpoint_id
    ])->first();

    if ($exists) {
        return redirect()->back()->with('error', "Runner $bib already recorded at this checkpoint.");
    }

    // ADD THE WATCHER_ID HERE
    $logModel->save([
        'runner_id'     => $runner['id'],
        'checkpoint_id' => $checkpoint_id,
        'recorded_at'   => date('Y-m-d H:i:s'),
        'watcher_id'    => session()->get('id')  // ← ADD THIS LINE
    ]);

    return redirect()->back()->with('success', "Runner $bib (" . $runner['name'] . ") recorded successfully.");
}

    /**
     * View all entries recorded at this watcher's checkpoint
     */
    public function viewEntries()
    {
        $checkpoint_id = session()->get('checkpoint_id');
        
        $logModel = new RaceLogModel();
        $runnerModel = new RunnerModel();
        
        // Get all entries for this checkpoint
        $entries = $logModel->select('race_logs.*, runners.name, runners.bib_number')
                           ->join('runners', 'runners.id = race_logs.runner_id')
                           ->where('checkpoint_id', $checkpoint_id)
                           ->orderBy('recorded_at', 'DESC')
                           ->findAll();
        
        $data = [
            'title' => 'My Entries',
            'entries' => $entries,
            'checkpoint_id' => $checkpoint_id
        ];
        
        return view('watcher/entries', $data);
    }

    /**
     * Edit a specific entry
     */
    public function editEntry($entryId)
    {
        $checkpoint_id = session()->get('checkpoint_id');
        
        $logModel = new RaceLogModel();
        $runnerModel = new RunnerModel();
        
        // Get the entry
        $entry = $logModel->select('race_logs.*, runners.name, runners.bib_number')
                         ->join('runners', 'runners.id = race_logs.runner_id')
                         ->where('race_logs.id', $entryId)
                         ->first();
        
        // Verify this entry belongs to the watcher's checkpoint
        if (!$entry || $entry['checkpoint_id'] != $checkpoint_id) {
            return redirect()->to('/watcher/entries')->with('error', 'Entry not found or access denied.');
        }
        
        // Get all runners for dropdown (optional)
        $runners = $runnerModel->orderBy('bib_number', 'ASC')->findAll();
        
        $data = [
            'title' => 'Edit Entry',
            'entry' => $entry,
            'runners' => $runners
        ];
        
        return view('watcher/edit_entry', $data);
    }

    /**
     * Update a specific entry
     */
    public function updateEntry($entryId)
    {
        $checkpoint_id = session()->get('checkpoint_id');
        
        $logModel = new RaceLogModel();
        
        // Get the entry
        $entry = $logModel->find($entryId);
        
        // Verify this entry belongs to the watcher's checkpoint
        if (!$entry || $entry['checkpoint_id'] != $checkpoint_id) {
            return redirect()->to('/watcher/entries')->with('error', 'Entry not found or access denied.');
        }
        
        // Get new data
        $newRunnerId = $this->request->getPost('runner_id');
        $recordedAt = $this->request->getPost('recorded_at');
        
        // If changing runner, check for duplicate at this checkpoint
        if ($newRunnerId != $entry['runner_id']) {
            $exists = $logModel->where([
                'runner_id' => $newRunnerId,
                'checkpoint_id' => $checkpoint_id
            ])->where('id !=', $entryId)->first();
            
            if ($exists) {
                return redirect()->back()->with('error', 'This runner already has an entry at this checkpoint. Cannot duplicate.');
            }
        }
        
        // Update the entry
        $updateData = [];
        
        if ($newRunnerId) {
            $updateData['runner_id'] = $newRunnerId;
        }
        
        if ($recordedAt) {
            $updateData['recorded_at'] = $recordedAt;
        }
        
        if (!empty($updateData)) {
            $logModel->update($entryId, $updateData);
            return redirect()->to('/watcher/entries')->with('success', 'Entry updated successfully.');
        }
        
        return redirect()->back()->with('error', 'No changes made.');
    }

    /**
     * Delete a specific entry
     */
    public function deleteEntry($entryId)
    {
        $checkpoint_id = session()->get('checkpoint_id');
        
        $logModel = new RaceLogModel();
        
        // Get the entry
        $entry = $logModel->find($entryId);
        
        // Verify this entry belongs to the watcher's checkpoint
        if (!$entry || $entry['checkpoint_id'] != $checkpoint_id) {
            return redirect()->to('/watcher/entries')->with('error', 'Entry not found or access denied.');
        }
        
        // Get runner details for confirmation message
        $runnerModel = new RunnerModel();
        $runner = $runnerModel->find($entry['runner_id']);
        
        // Delete the entry
        $logModel->delete($entryId);
        
        $message = "Entry for Runner #" . ($runner ? $runner['bib_number'] : 'Unknown') . " has been removed.";
        return redirect()->to('/watcher/entries')->with('success', $message);
    }
}