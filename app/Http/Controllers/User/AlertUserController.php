<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alert;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\AlertResource;


class AlertUserController extends Controller
{
    //
    public function index(Request $request)
{
    $query = Alert::with('address')->latest();

    // Filter severity
    if ($request->filled('severity')) {
        $query->where('severity', $request->severity);
    }

    // Filter type
    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    // Filter status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter date range
    if ($request->filled('from_date')) {
        $query->whereDate('issued_at', '>=', $request->from_date);
    }
    if ($request->filled('to_date')) {
        $query->whereDate('issued_at', '<=', $request->to_date);
    }

    // Search keyword
    if ($request->filled('q')) {
        $query->where(function($q) use ($request) {
            $q->where('title', 'like', '%'.$request->q.'%')
              ->orWhere('description', 'like', '%'.$request->q.'%');
        });
    }

    $alerts = $query->get();
    $alerts = AlertResource::collection($alerts);

    return view('user.alerts.index', ['alerts'=> $alerts]);
}

}
