<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use Illuminate\Http\Request;

class DatasetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Dataset::all();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dataset_maker.feed');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Dataset::Create([
            "data" => $request->data,
        ]);

        return redirect(route('dataset.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataset = Dataset::all();

        foreach ($dataset as $key) {
            // if (str_contains($key->data, $id)) {
            //     $data[] = $key;
            // }

            if (in_array($id, explode(",", $key->data))) {
                $data[] = $key;
            }
        }

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $dataset = Dataset::all();

        $ids = explode(",", $id);

        foreach ($dataset as $key) {
            if (in_array($ids[0], explode(",", $key->data))) {
                $data1[] = $key;
            }
        }

        foreach ($data1 as $key) {
            if (in_array($ids[1], explode(",", $key->data))) {
                $data2[] = $key;
            }
        }


        return response()->json($data2);
    }
}
