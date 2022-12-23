<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index',compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit',compact('user'));
    }

    public function update(Request $request,User $user )
    {

        $rules = [
                'name' => [ 'string', 'max:255'],
                'email' => ['string', 'email', 'max:255', 'unique:users'],
                'password' => ['string','confirmed',Password::min(8)->mixedCase()->symbols()->nonSequential()]];
        
        $input = array_filter($request->all());
        
        Validator::make($input, $rules)->validated();

        $updateArray = [];
        $updateArray['name'] = $input['name'];
        $updateArray['email'] = $input['email'];
        
        if (isset($input['password']))
        {
            $updateArray['password'] = Hash::make($input['password']);
        }
       
        $resMessage = [];
    
        try {
           $user->update($updateArray);
           $resMessage = ['status' => 'success' , 'message' => 'User updated successfully.'];
        } catch (QueryException $e) {
            $resMessage = ['status' => 'error' , 'message' => 'User not updated successfully.', 'error_details' => $e->getMessage()];
        } catch (\Exception $e) {
            $resMessage = ['status' => 'error' , 'message' => 'User not updated successfully.', 'error_details' => $e->getMessage()];
        }  	
        
        return redirect()->route('home')->with('response', $resMessage['message']);
    }

    public function destroy($id) {
        
        $resMessage = [];
        try {
            $user = User::find($id);
            $user->delete();
            $resMessage = ['status' => 'success' , 'message' => 'User deleted successfully.'];
            if (auth()->user()->id == $id)
            {
                Auth::logout();
                return redirect('/login');
            }
         } catch (QueryException $e) {
             $resMessage = ['status' => 'error' , 'message' => 'User not deleted successfully.', 'error_details' => $e->getMessage()];
         } catch (\Exception $e) {
             $resMessage = ['status' => 'error' , 'message' => 'User not deleted successfully.', 'error_details' => $e->getMessage()];
         }  	 
              
         return redirect()->route('home')->with('response', $resMessage['message']);
    }

}
