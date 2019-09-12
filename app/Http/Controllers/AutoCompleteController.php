<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;

class AutoCompleteController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }


    public function search(Request $request)
    {
        $search = $request->input('term');
        $result = File::select('policy_number as name')
                        ->where('policy_number', 'LIKE', '%'. $search. '%')
                        ->get();

        return response()->json($result);

    }


}
