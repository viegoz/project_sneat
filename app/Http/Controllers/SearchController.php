<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        // Logika pencarian sederhana
        $results = [];

        if (stripos('entry', $query) !== false) {
            $results[] = [
                'name' => 'Entry',
                'url' => url('/home/entry'),
            ];
        }

        if (stripos('update', $query) !== false) {
            $results[] = [
                'name' => 'Update',
                'url' => url('/home/update'),
            ];
        }

        if (stripos('monitoring', $query) !== false) {
            $results[] = [
                'name' => 'Monitoring',
                'url' => url('/home/monitoring'),
            ];
        }

        return view('search.result', ['results' => $results]);
    }
}
