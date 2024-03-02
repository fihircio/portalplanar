<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Content;
use App\Models\Data;
use App\Models\User;
use App\Models\AuditTrail;


class DashboardController extends Controller
{
    public function index()
    {
        $contentCount = Content::count();
        $dataCount = Data::count();
        $userCount = User::count();     

    /*    $chart = Charts::create('bar', 'highcharts')
            ->title('Content Count')
            ->elementLabel('Total')
            ->labels(['Content'])
            ->values([$contentCount])
            ->responsive(true);*/

            $auditTrails = AuditTrail::with('user')->latest()->limit(10)->get();

    return view('dashboard.index', compact('contentCount', 'dataCount', 'userCount', 'auditTrails'/* 'chart'*/));
    }

       
        
}
