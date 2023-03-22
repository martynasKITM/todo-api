<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\TaskCollection;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function  __construct(){
        $this->middleware('auth:sanctum',['except'=>['tasks']]);
    }

    public function tasks()
    {
        return TaskCollection::collection(Todo::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addTask(Request $request)
    {
        $validator = Validator::make($request->all(),[
         'title'=>'required|max:255',
         'description'=>'required',
    ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()]);
        }

        Todo::create([
            'title'=>request('title'),
            'description'=>request('description'),
            'status'=>0
        ]);

        return response()
            ->json(['ok'=>'Task created successfully']);

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Todo::find($id);
        $task->update($request->all());
        return response()
            ->json(['message'=>'Task updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $task = Todo::find($id);
        $task->delete();
        return response()->json(['message'=>'Task deleted']);
    }

    public function setComplete(){

    }
}
