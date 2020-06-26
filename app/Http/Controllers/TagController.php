<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('tag')->paginate(20);
        return view('admin.tags.tags')->with([
            'tags' => $tags,
            'showLinks' => true,

        ]);
    }


    public function search(Request $request)
    {
        $request->validate([
            'tag_search' => 'required'
        ]);

        $searchTerm = $request->input('tag_search');

        $tags = Tag::where(
            'tag', 'like', '%' . $searchTerm . '%'
        )->get();



        if (count($tags) > 0) {
            return view('admin.tags.tags')->with([
                'tags' => $tags ,
                'showLinks' => false,
            ]);
        }
        Session::flash('message', 'Nothing Found');
        return redirect()->back();

    }


    public function store(Request $request)
    {
        $request->validate([
            'tag' => 'required'
        ]);



        $tag = new Tag();
        $tag->tag = $request->input('tag');
        $tag->save();
        Session::flash('message', ' New Tag ' . $tag->tag . ' ADD');
        return redirect()->back();

    }


//             --------CHECK IF TAG || CODE EXISTS_____________
    private function tagNameExists($tag)
    {
        $tag = Tag::where(

            "tag", '=', $tag
        )->first();
        if ($tag) {
            Session::flash('message', 'TAG Name (' . $tag->tag . ') already exists');
            return false;
        }
        return true;
    }

    public function update(Request $request)
    {
        $request->validate([
            'tag_name' => 'required',

        ]);

//             --------CHECK IF NAME || CODE EXISTS_____________
        $tag = $request->input('tag_name');
        if (!$this->tagNameExists($tag)) {
            return redirect()->back();
        }

//             --------CHECK IF NAME || CODE EXISTS_____________

            $tagID = intval($request->input('tag_id'));
            $tag = Tag::find($tagID);

            $tag->tag = $request->input('tag_name');
            $tag->save();
            Session::flash('message', 'Tag ' . $tag->tag . ' Updated');
            return redirect()->back();

        }



    public function delete(Request $request)
    {

        if (is_null($request->input('tag') || empty($request->input('tag')))) {
            Session::flash('message', 'tag is required');
            return redirect()->back();
        }


        $tagName = $request->input('tag_name');

        $id = $request->input('tag_id');
        Tag::destroy($id);
        Session::flash('message', 'TAG   (' .$tagName.') has been deleted');
        return redirect()->back();
    }
}
