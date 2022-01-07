<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\User;

class SearchController extends Controller
{
//    public function scopeSearch($q)
//    {
//        return empty(request()->search) ? $q : $q->where('title', 'like', '%'.request()->search.'%');
//    }

    public function show(Request $request)
    {
        $search = $request->input('search');
        if (!$search)
            return redirect()->route('home');

//        $questions = Question::query()
//            ->where('title', 'ilike', '%' . $search . '%')->get();

        $questions = Question::query()->whereRaw('ts_vectors @@ to_tsquery(\'english\', ?)', [$search])
            ->orderByRaw('ts_rank(ts_vectors, to_tsquery(\'english\', ?)) DESC', [$search])
            ->paginate(10, ['*'], 'questions');

        $users = User::query()
            ->where('username', 'ilike', '%' . $search . '%')
            ->paginate(10, ['*'], 'users');

        return view('pages.search-result')
            ->with(compact('questions'))
            ->with(compact('users'));
    }
}
