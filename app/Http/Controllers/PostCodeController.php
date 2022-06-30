<?php

namespace App\Http\Controllers;

use App\Models\PostCode;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PostCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dataPostCode = PostCode::all();

        $response = [
            'message' => 'List post code :',
            'data' => $dataPostCode
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'post_code' => ['numeric','required'],
            'urban_village' => ['required'],
            'sub_district' => ['required'],
            'city' => ['required'],
            'province' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $data = PostCode::create($request->all());

            $response = [
                'message' => 'Success',
                'data' => $data
            ];

            return response()->json($response, Response::HTTP_CREATED);

        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed ".$e->errorInfo
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = PostCode::findOrFail($id);
        $response = [
            'message' => 'Data yang anda cari :',
            'data' => $data
        ];

        return response()-> json($response, Response::HTTP_OK);
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
        $data = PostCode::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'post_code' => ['numeric','required'],
            'urban_village' => ['required'],
            'sub_district' => ['required'],
            'city' => ['required'],
            'province' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $data->update($request->all());
            $response = [
                'message' => 'Data has been update',
                'data' => $request->all()
            ];

            return response()->json($response, Response::HTTP_OK);

        } catch (QueryException $e) {
            return response()->json($e->errorInfo, Response::HTTP_NOT_MODIFIED);
        }




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $dataDelete = PostCode::findOrFail($id);

        try {
            PostCode::destroy($dataDelete->id);

            return response()->json("Deleted Success", Response::HTTP_OK);

        } catch (QueryException $e) {
            return response()->json(
               $e, Response::HTTP_NOT_FOUND
            );
        }

    }
}
