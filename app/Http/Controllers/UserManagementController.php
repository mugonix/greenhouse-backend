<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth", "can:manage-users"]);

    }

    public function index()
    {
        $users = User::with("role")->where("id", "<>", auth()->id())->get();
        return view("users.index", compact("users"));
    }

    public function create()
    {
        return view("users.create");
    }

    public function store()
    {
        $this->validate(request(), [
            'first_names' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'min:3', 'max:255', 'unique:users',"regex:/(^([a-zA-Z]+)(\d+)?$)/u"],
            'password' => ['required', 'string', 'min:8', 'confirmed','regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'],
            "role_id" => "required",
        ],[
            "username.regex" => "The username must only contain letters and digits",
            "password.regex" => "The password does not contain characters from at least three of the following five categories:
English uppercase characters (A – Z), English lowercase characters (a – z), Digits (0 – 9), Non-alphanumeric (For example: !, $, #, or %)"
        ]);

        $data = request()->only(["role_id", 'first_names', 'surname', 'username', "email"]);
        $data["password"] = \Hash::make(request("password"));
        $data["is_approved"] = true;

        $user = User::create($data);

        return redirect()->route("user-management.index")->withStatus("User account has been created!");
    }

    public function edit(User $user)
    {
        if ($user->id == auth()->id())
            return redirect()->route("user-management.index")->withErrors("illegal action!");

        return view("users.edit", compact("user"));
    }

    public function update(User $user)
    {

        $this->validate(request(), [
            'first_names' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email," . $user->id . ",id"],
//            'username' => ['required', 'string', 'max:255', "unique:users,username," . $user->id . ",id"],
            'password' => ['nullable', 'string', 'min:8','regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'],
            "role_id" => "required",
        ],[
            "password.regex" => "The password does not contain characters from at least :
1 uppercase characters (A – Z), 1 lowercase characters (a – z), 1 Digits (0 – 9), 1 Non-alphanumeric (For example: !, $, #, or %)"
        ]);

        $data = request()->only("role_id", 'first_names', 'surname', "email");

        if (!is_null(request("password"))) {
            $data["password"] = \Hash::make(request("password"));
        }

        $user->update($data);

        return redirect()->route("user-management.index")->withStatus("Account details have been updated!");
    }

    public function approveAccount()
    {
        $this->validate(request(), [
            "user_id" => "required|exists:users,id"
        ]);

        $user = User::find(request("user_id"));
        $user->update(["is_approved" => true]);

        return back()->withStatus("{$user->name}'s account has been approved.");
    }

    public function delete(User $user)
    {
    }
}
