<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::select(['id', 'name', 'logo', 'color']);


        foreach ($types as $type) {
            if (!str_starts_with($type->logo, 'https')) {

                $type->logo = !empty($type->logo)
                    ? $type->getImage()
                    : null;
            }
        }

        return response()->json($types);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     
     */
    public function show($id)
    {

    }

}