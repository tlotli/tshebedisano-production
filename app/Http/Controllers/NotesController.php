<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NotesController extends Controller
{
    public function store_notes(Request $request , $id) {
        $this->validate($request , [
           'notes' => 'required',
        ],
        [
            'notes.required' => 'Please provide notes',
        ]);

        $note = new Note();
        $note->notes = $request->notes;
        $note->user_id = Auth::id();
        $note->repository_id = $id ;
        $note->save();

        Session::flash('success' , 'Notes created');
        return redirect(route('repository_files' , ['id' => $id]));

    }
}
