<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeskRequest;
use App\Http\Resources\TeskResource;
use App\Models\Tesk;
use Illuminate\Support\Facades\Auth;

class TeskController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TeskResource::collection(
            Tesk::where('user_id', Auth::user()->id)->get()
        );
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
    public function store(StoreTeskRequest $request)
    {
        $request->validated($request->all());

        $tesk= Tesk::create([
            'user_id'       =>Auth::user()->id,
            'name'          =>$request->name,
            'description'   =>$request->description,
            'priority'      =>$request->priority
        ]);

        return new TeskResource($tesk);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tesk= Tesk::findOrFail($id);

        if (Auth::user()->id !==$tesk->user_id) {
            return $this->error('', 'You are not authorize to this request', 403);
        }
        return new TeskResource($tesk);
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
        $tesk= Tesk::findOrFail($id);
        if (Auth::user()->id !==$tesk->user_id) {
            return $this->error('', 'You are not authorize to this request', 403);
        }
        $tesk->update($request->all());
        return new TeskResource($tesk);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tesk= Tesk::findOrFail($id);


        if (Auth::user()->id !==$tesk->user_id) {
            return $this->error('', 'You are not authorize to this request', 403);
        }
        $tesk->delete();

        return response()->json([
            'success'   => 'Data is deleted',
        ]);
        
    }

    /**
     * method for not authorizes
     */
    private function isNotAuthorized($tesk){
        if (Auth::user()->id !==$tesk->user_id) {
            return $this->error('', 'You are not authorize to this request', 403);
        }
    }




}
