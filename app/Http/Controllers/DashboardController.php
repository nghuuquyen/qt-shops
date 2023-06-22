<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->cannot('view dashboard')) {
            return abort(Response::HTTP_FORBIDDEN);
        }

        return view('dashboard.index');
    }
}
