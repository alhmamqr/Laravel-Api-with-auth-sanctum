<?php

use Filtering\V2\CustomerQuery;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TestController;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('customers2', [TestController::class, 'showR']);



Route::get('showww', [CustomerQuery::class, 'show']); 
Route::get('/setup' ,function(){
    $cerd = [
        'email' => 'admin@admin.com',
        'password' => 'password'
    ];

    if(!Auth::attempt($cerd)){
        $user = new User();
        $user->name = 'Admin';
        $user->email = $cerd['email'];
        $user->password = Hash::make($cerd['password']);
        $user->save();  
        if(Auth::attempt($cerd)){
            $user1 =Auth::user();
            $adminToken = $user1->createToken('admin-token', ['create', 'update', 'delete']);
            $updateToken = $user1->createToken('update-token', ['create', 'update']);
            $basicToken = $user1->createToken('basic-token', ['none']);
            return [
                'admin' => $adminToken->plainTextToken,
                'update' => $updateToken->plainTextToken,
                'basic' => $basicToken->plainTextToken
            ];
        }


    }

});

