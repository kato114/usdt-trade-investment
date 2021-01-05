<?php

namespace App\Http\Controllers\Reports;

use App\Client;
use App\User;
use Illuminate\Http\Request;

trait AdminReports
{
    private function adminListing(Request $request, $report)
    {
        $load = ['report' => $report, 'from' => $request->from];
        $query = User::query()
            ->orderBy('name');
        $load['users'] = $query;
        return view('reports.users', $load);
    }

    private function clientListing(Request $request, $report)
    {
        $load = ['report' => $report];
        $query = Client::query()
            ->orderBy('name');
        $load['clients'] = $query;
        return view('reports.clients', $load);
    }
}