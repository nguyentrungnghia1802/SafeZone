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
        $alerts = Alert::with('address')->latest()->where('status', 'active')->get();
        $alerts = AlertResource::collection($alerts);
        return view('user.alerts.index', ['alerts'=> $alerts]);
    }
}
