<?php

namespace App\Controllers;

use App\Models\RaceLogModel;

class Home extends BaseController
{
    public function index()
    {
        // This view will contain the JavaScript for auto-refreshing
        return view('public/leaderboard');
    }

public function getLiveUpdate()
{
    $logModel = new RaceLogModel();
    $standings = $logModel->getLeaderboard();

    // Separate data for the Bar Chart (Top 3) and the List (4-10)
    $data = [
        'top_three' => array_slice($standings, 0, 3),
        'others'    => array_slice($standings, 3, 7)
    ];

    return $this->response->setJSON($data);
}
}