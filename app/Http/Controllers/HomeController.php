<?php

namespace App\Http\Controllers;

use App\Services\AdonisApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $response = AdonisApi::get('/trans/getBoard');

        if ($response->successful()) {
            $json = $response->json();

            $data = $json['data'];

            return view('index', compact('data'));
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = decrypt($id);

        $response = AdonisApi::get('/trans/getList', [
            'id' => $id,
        ]);

        if ($response->successful()) {
            $json = $response->json();

            $data = $json['data'] ?? [];

            return view('show')->with([
                'id'    => $id,
                'data'  => $data,
            ]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function storeList(Request $request)
    {

        $request->validate([
            'id'    => 'required',
            'name'  => 'required',
        ]);

        $response = AdonisApi::post('/trans/storeList', [
            'id' => $request->id,
            'name' => $request->name
        ]);

        if ($response->successful()) {
            return response()->json($response->json()['data']);
        }

    }

}
