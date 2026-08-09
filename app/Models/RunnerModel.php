<?php

namespace App\Models;

use CodeIgniter\Model;

class RunnerModel extends Model
{
    protected $table            = 'runners';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['bib_number', 'name'];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation for unique Bib Numbers
    protected $validationRules = [
        'bib_number' => 'required|is_unique[runners.bib_number,id,{id}]',
        'name'       => 'required|min_length[3]'
    ];
}