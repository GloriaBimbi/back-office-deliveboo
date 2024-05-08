<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
        /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
    //  * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->restaurant()
    }
}
