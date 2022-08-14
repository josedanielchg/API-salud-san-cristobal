<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news =  News::orderBy('created_at', 'DESC')->get();

        $response = [
            'ok' => true,
            'message' => 'Noticias',
            'data' =>  $news
        ];

        return response($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation
        $fields = $request->validate([
            'title' => 'string',
            'body' => 'string',
        ]);

        $abstract = substr($fields['body'], 0, 100) . "...";

        $new =News::create([
            'title' => $fields['title'],
            'body' => $fields['body'],
            'abstract' => $abstract,
        ]);

        $response = [
            'ok' => true,
            'message' => 'Noticia creada exitosamente',
            'data' => [
                'new' => $new,
            ]
        ];

        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $new =  News::find($id);

        $response = [
            'ok' => true,
            'message' => "Noticia - $id",
            'data' =>  $new
        ];

        return response($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validation
        $fields = $request->validate([
            'title' => 'nullable|string',
            'body' => 'string',
        ]);

        $new = News::find($id);

        // Check if new exists user
        if(!$new) {
            return response([
                'message' => 'Error. Noticia no encontrada',
            ], 400);
        }

        $abstract = substr($fields['body'], 0, 100) . "...";

        $new->update([
            'title' => $fields['title'],
            'body' => $fields['body'],
            'abstract' => $abstract,
        ]);

        $response = [
            'ok' => true,
            'message' => 'Noticia creada exitosamente',
            'data' => [
                'new' => $new,
            ]
        ];

        return response($response, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $new = News::find($id);
        $new->delete();

        $response = [
            'ok' => true,
            'message' => 'Noticia eliminada exitosamente',
        ];

        return response($response, 201);
    }
}
