<?php

namespace App\Models;

use CodeIgniter\Model;

class RaceLogModel extends Model
{
    protected $table            = 'race_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
protected $allowedFields = ['runner_id', 'checkpoint_id', 'recorded_at', 'watcher_id'];

    protected $useTimestamps = false; // We use 'recorded_at' manually for precision

public function getLeaderboard()
{
    $db = \Config\Database::connect();
    
    // This query finds the latest checkpoint reached by each runner
    $subQuery = $db->table('race_logs')
        ->select('runner_id, MAX(checkpoint_id) as max_cp')
        ->groupBy('runner_id')
        ->getCompiledSelect();

    // Now we join that with runners and users (watchers) to get the checkpoint name
    $builder = $this->db->table('race_logs rl');
    $builder->select('r.name, r.bib_number, u.checkpoint_name, rl.recorded_at, c.sequence_order');
    $builder->join('runners r', 'r.id = rl.runner_id');
    $builder->join('users u', 'u.checkpoint_id = rl.checkpoint_id', 'left');
    $builder->join('checkpoints c', 'c.id = rl.checkpoint_id');
    
    // Join with the subquery to ensure we are only looking at the "furthest" point for each runner
    $builder->join("($subQuery) latest", 'latest.runner_id = rl.runner_id AND latest.max_cp = rl.checkpoint_id');

    // Order by furthest checkpoint first, then by the time they got there
    $builder->orderBy('c.sequence_order', 'DESC');
    $builder->orderBy('rl.recorded_at', 'ASC');

    return $builder->get()->getResultArray();
}

    /**
     * Get all logs for a specific runner to show their history.
     */
    public function getRunnerHistory($runner_id)
    {
        return $this->select('race_logs.*, checkpoints.location_name')
                    ->join('checkpoints', 'checkpoints.id = race_logs.checkpoint_id')
                    ->where('runner_id', $runner_id)
                    ->orderBy('recorded_at', 'ASC')
                    ->findAll();
    }
}