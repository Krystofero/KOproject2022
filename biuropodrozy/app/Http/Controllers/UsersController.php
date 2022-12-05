<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('users.list', [
            'users' => User::all(),   #lista wszystkich użytkowników zwracana w blade    
            'users_level_list' => array(1 => 'Administrator', 2 => 'Moderator', 3 => 'Klient')  
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return View
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'users_level_list' => array(1 => 'Administrator', 2 => 'Moderator', 3 => 'Klient')  
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserRequest  $request
     * @param  User  $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $new_user_level = $request->all()['user_level'];
        $updatedUser = User::find($user->id);
        $updatedUser->user_level = $new_user_level;
        $updatedUser->save();
        return redirect(route('users.index'))->with('status', __('user.update.success'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user)
    {   
        try {
            $user->delete();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wystąpił błąd!'
            ])->setStatusCode(500);
        }
    }

}
