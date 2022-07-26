<?php

namespace App\Http\Controllers;

use App\Models\Worklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListController extends Controller
{
    public function index()
    {
        $lists = Worklist::latest()->paginate(5);

        return view('home', compact('lists'));
    }

    public function search(Request $request)
    {
        $results = Worklist::where('title','=', $request->search);
        // return redirect('/', compact('results'));
        print_r($results);
    }

    public function store(Request $request)
    {
        if (isset($request->id)) {
            $update = DB::update('update worklists set title=?, details=?, time=? where id=?', [$request->title, $request->details, $request->time, $request->id]);
            if ($update) {
                return redirect('/')->with('message', 'Successfully updated!');
            } else {
                return redirect('/')->with('message', 'Failed to update!');
            }
        } else {

            $worklist = new Worklist;
            $worklist->title = $request->title;
            $worklist->details = $request->details;
            $worklist->time = $request->time;

            $insert = $worklist->save();
            if ($insert) {
                return redirect('/')->with('message', 'Successfully Added!');
            } else {
                return redirect('/')->with('message', 'Failed to Add!');
            }
        }
    }

    public function statusDone($id)
    {
        $update = DB::update('update worklists set status=? where id=?', [1, $id]);

        if ($update) {
            return redirect('/')->with('message', 'Successfully Updated!');
        } else {
            return redirect('/')->with('message', 'Failed to Updated!');
        }
    }

    public function statusPending($id)
    {
        $update = DB::update('update worklists set status=? where id=?', [0, $id]);

        if ($update) {
            return redirect('/')->with('message', 'Successfully Updated!');
        } else {
            return redirect('/')->with('message', 'Failed to Updated!');
        }
    }

    public function deleteList($id)
    {
        $delete = DB::delete('delete from worklists where id=?', [$id]);

        if ($delete) {
            return redirect('/')->with('message', 'Successfully deleted!');
        } else {
            return redirect('/')->with('message', 'Failed to delete!');
        }
    }
}
