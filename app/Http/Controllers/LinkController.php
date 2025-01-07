<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;

class LinkController extends Controller
{
    //index
    public function index()
    {
        //$links = ShortUrl::latest()->paginate(10);

        $links = ShortUrl::where('user_id', auth()->user()->id)->latest()->paginate(10);

        return view('home.allLink', compact('links'));
    }


    public function add()
    {
        $title = "Links Add";

        return view('home.add', compact('title'));
    }

    //create
    public function create(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
        ]);

        //link check if exist
        $link = ShortUrl::where('link', $request->link)->first();
        if ($link) {
            return redirect()->back()->with('error', 'Link already exist');
        }


        $link = new ShortUrl;
        $link->title = $request->title;
        $link->link = $request->link;
        $link->user_id = auth()->user()->id;

        if (preg_match('/\bhttps?:\/\//i', $request->shortLink)) {
            return redirect()->back()->with('error', 'Short link should not contain "http" or "https".');
        }

        if (empty($request->shortLink )) {
            $link->shortLink  = short_url();
        }else{
            $link->shortLink  = $request->shortLink ;
        }



        $link->save();

        return redirect()->route('links.edit', $link->id)->with('success', 'Link created successfully');
    }


    //edit
    public function edit($id)
    {
        $link = ShortUrl::find($id);
        return view('home.edit', compact('link'));
    }

    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
        ]);

        //link check if exist
        $link = ShortUrl::where('link', $request->link)->where('id', '!=', $id)->first();
        if ($link) {
            return redirect()->back()->with('error', 'Link already exist');
        }

        $link = ShortUrl::find($id);
        $link->title = $request->title;
        $link->link = $request->link;

        if (preg_match('/\bhttps?:\/\//i', $request->shortLink)) {
            return redirect()->back()->with('error', 'Short link should not contain "http" or "https".');
        }

        if (empty($request->shortLink )) {
            $link->shortLink  = short_url();
        }else{
            $link->shortLink  = $request->shortLink ;
        }
        
        $link->save();

        return redirect()->route('links.edit', $link->id)->with('success', 'Link updated successfully');
    }


    public function shortLink($short_link)
    {
        if (!preg_match('/^[a-zA-Z0-9]+$/', $short_link)) {
            return abort(404, 'Invalid short link');
        }
    
        $link = ShortUrl::where('shortLink', $short_link)->first();
    
        if ($link) {
            return redirect($link->link);
        }
    
        abort(404, 'Short link not found');
    }

    //links.delete
    public function delete($id)
    {
        $link = ShortUrl::find($id);
        $link->delete();

        return redirect()->route('links')->with('success', 'Link deleted successfully');
    }
    


}
