<?php

namespace App\Http\Controllers;

use App\Note;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NoteController extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return Notes list
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $Notes = Note::all();

        return $this->successResponse($Notes);
    }

    /**
     * Return notes of item as list
     * @return Illuminate\Http\Response
     */
    public function notesItem($item){
        $Notes = Note::where('item_id',$item)->get();
        return $this->successResponse($Notes);
    }

    /**
     * Create an instance of Note
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'description' => 'required|max:1000',
            'item_id' => 'required|integer',
        ];

        $this->validate($request, $rules);

        $Note = Note::create($request->all());

        return $this->successResponse($Note, Response::HTTP_CREATED);
    }

    /**
     * Return an specific Note
     * @return Illuminate\Http\Response
     */
    public function show($note)
    {
        $Note = Note::findOrFail($note);

        return $this->successResponse($Note);
    }

    /**
     * Update the information of an existing Note
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $note)
    {
        $rules = [
            'name' => 'max:255',
            'description' => 'max:1000',
            'item_id' => 'required|integer|min:1',
        ];

        $this->validate($request, $rules);

        $Note = Note::findOrFail($note);

        $Note->fill($request->all());

        if ($Note->isClean()) {
            return $this->errorResponse('Al menos un valor debe ser distinto', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $Note->save();

        return $this->successResponse($Note);
    }

    /**
     * Removes an existing Note
     * @return Illuminate\Http\Response
     */
    public function destroy($note)
    {
        $Note = Note::findOrFail($note);

        $Note->delete();

        return $this->successResponse($Note);
    }
}
