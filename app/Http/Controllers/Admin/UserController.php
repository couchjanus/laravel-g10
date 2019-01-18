<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UserStoreFormRequest;
use Hash; 
use App\Profile;
use Illuminate\Foundation\Auth\VerifiesEmails;

use App\Http\Requests\UpdateUserRequestForm;

class UserController extends Controller
{
    use VerifiesEmails;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(env('LIST_PAGINATION_SIZE'));
        return view('admin.users.index',compact('users'));
    }

    public function trashed()
    {
        $users = User::onlyTrashed()->paginate(env('LIST_PAGINATION_SIZE'));
        return view('admin.users.trashed', compact('users'));
    }

    public function restore($id)
    {
        User::withTrashed()
            ->where('id', $id)
            ->restore();

        return redirect(route('users.trashed'))->with('success', 'User has been restored successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = \App\Role::get()->pluck('name', 'id');
        return view('admin.users.create')->withRoles($roles);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        if ($request['is_admin']) {
            $is_admin->$request['is_admin'];
        }

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'is_admin' => $is_admin,
        ]);

        $user->roles()->sync($request->input('role_list'), false);
        
        if ($request['verify']) {
            $user->markEmailAsVerified();
        }
        

        $profile = new Profile();
        $user->profile()->save($profile);
        return redirect()->route('users.index')->with('success','User created successfully.');
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
        public function edit(User $user)
        {
            $verify = $user->email_verified_at ? true : false;
            $roles = \App\Role::get()->pluck('name', 'id');
            return view('admin.users.edit')->withUser($user)->withRoles($roles)->withVerify($verify);
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        $this->validate(
            $request,
            [
                'name' => 'required|min:3|max:20',
                'password' => 'required|min:6|max:20',
                'email' => 'required|email|max:255|unique:users,email,'.$user->id . ',id'
            ]
        );

        $user->update([
            'name' => $request['name'],
            'email' => $user->email,
            'password' => Hash::make($request['password']),
        ]);

        if ($request['verify']) {
            $user->markEmailAsVerified();
        }
        
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->roles()->sync($request->roles);

        return redirect(route('users.index'))->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
                ->with('success','User deleted successfully');

    }

    public function userdestroy($id)
    {
       
        $user = User::withTrashed()
                ->findOrFail($id);
        // dd($user);

        $user->forceDelete();
        return redirect()->route('users.index')
                ->with('success','User deleted successfully');

    }
}
