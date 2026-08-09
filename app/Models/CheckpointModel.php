<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckpointModel extends Model
{
    protected $table            = 'checkpoints';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['location_name', 'sequence_order'];

    // Use sequence_order to determine the flow of the race (CP1, CP2, etc.)
    protected $useTimestamps = false;
}