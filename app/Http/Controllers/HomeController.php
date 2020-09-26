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

    public function settings()
    {
        $user = User::find(auth()->id());

        return view("settings", compact("user"));
    }

    public function storeSettings()
    {
        $this->validate(request(), [
            'first_names' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email," . auth()->id() . ",id"],
            'current_password' => ['nullable', 'string', 'min:8'],
            'new_password' => ['nullable', 'string', 'min:8', "confirmed"],
        ]);

        $data = request()->only('first_names', 'surname', "email");

        if (!is_null(request("current_password")) && !is_null(request("new_password"))) {
            if (!\Auth::attempt(["username" => auth()->user()->username, "password" => \request("current_password")])) {
                return back()->withErrors("Incorrect password, please try again!");
            }

            $data["password"] = \Hash::make(request("new_password"));
        }

        auth()->user()->update($data);

        return back()->withStatus("Your account settings have been updated!");

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
