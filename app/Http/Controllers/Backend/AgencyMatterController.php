<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgencyMatterController extends Controller
{
    public function index()
    {
        return view('agency_matter.index');
    }
}
