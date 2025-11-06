<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alert;
use Illuminate\Support\Facades\Http;


class AlertUserController extends Controller
{
    //
    public function index(Request $request)
    {
        $alerts = Alert::latest()->paginate(10);
        if ($request->ajax()) {
            return view('alerts._list', compact('alerts'))->render();
        }
        return view('user.alerts.index', ['alerts'=> $alerts]);
    }
}
