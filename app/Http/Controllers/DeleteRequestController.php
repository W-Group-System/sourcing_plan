<?php

namespace App\Http\Controllers;
use App\DeletionRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class DeleteRequestController extends Controller
{
    public function index()
    {   
        $delete_requests = DeletionRequest::orderByRaw("CASE WHEN status = 'Pending Approval' THEN 0 ELSE 1 END")
        ->orderBy('created_at', 'desc')->get();
        return view('deletion_requests.index', compact('delete_requests'));  
    }
}