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

    public function update($user_id){
        
        $user = User::findOrFail($user_id);
        return view('adminpanel.editUser')->with('user',$user);
    }

    public function uredi(Request $request,$id){
        $this->validate($request,[
            'role' => 'required'
        ]);

        
        //uredjivanje korisnika

        $user = User::find($id);
        $user->role = $request->input('role');
        $user->save();
        return redirect('/manageUsers');
    }

    public function editPersonalInfo(){
        return 'to je taj view';
    }

}
