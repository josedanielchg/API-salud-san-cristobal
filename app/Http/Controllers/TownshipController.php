<?php

namespace App\Http\Controllers;

use App\Models\Township;
use Illuminate\Http\Request;

class TownshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $township =  Township::orderBy('name')->get();

        $response = [
            'ok' => true,
            'message' => 'Municipios',
            'data' =>  $township
        ];

        return response($response, 200);
    }
}
