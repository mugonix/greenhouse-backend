<?php

namespace App\Http\Controllers;

use App\Models\Greenhouse;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->id();
        $greenhouses = Greenhouse::with(["greenhouse_metrics" => function ($q) {
            return $q->orderByDesc("created_at")->take(1);
        }])->where("owner_id", $user_id)->get();

        return view('home', compact("greenhouses"));
    }

    public function changePassword()
    {
        $this->validate(request(), [
            "current_password" => "required",
            "new_password" => "required|min:6|confirmed",
        ]);

        $curr_user_email = \Auth::user()->email;
        if (\Auth::attempt(["email" => $curr_user_email, "password" => request("current_password")])) {
            User::whereEmail($curr_user_email)->update(["password" => \Hash::make(request("new_password"))]);
            return back()->withStatus("You have successfully updated your password!");
        }
        return back()->withErrors("Failed to change the user password.");
    }
}
