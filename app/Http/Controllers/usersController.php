<?php


namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class usersController extends Controller
{

    public function destroy($user_id){
        $user = User::findOrFail($user_id);
        $user->delete();
        return redirect('/manageUsers');
    }

}
