<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class MicropostFavoriteController extends Controller
{
    public function store(Request $request, $id)
    {
        \Auth::user()->favorite($id);
        return redirect()->back();
    }
    
    public function destroy($id)
    {
        \Auth::user()->unfavorite($id);
        return redirect()->back();
    }
    
    public function favorites($id)
    {
        
        $user=User::find($id);
        $favorites=$user->favorites()->paginate(10);
        
        $data=[
            'user'=>$user,
            'microposts'=>$favorites,
            ];
            
        $data += $this->counts($user);
        
        return view('users.favorites', $data);
    }
}
