<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Import Class Str
use Illuminate\Support\Str;

// Import DB Quote
use App\Models\Quote;

// Import DB user
use App\Models\User;

// Import Db Tag
use App\Models\Tag;


// Import DB YG Login
use Auth;

class QuotesController extends Controller
{
    //READ
    public function index(Request $request)
    {
        $cari = urlencode($request->input('search'));

        if (!empty($cari )) {
            $quotes = Quote::with('user', 'tags')->where('title', 'like', '%'. $cari.'%')->get();
        } else


        $quotes = Quote::with('user', 'tags')->orderBy('id', 'DESC')->get();
        $tags   = Tag::all();

        return view('quotes/quotes', compact('quotes', 'tags'));

    }

    // URL CREATE
    public function create()
    {
        $tags = Tag::all();
        return view('quotes/quotesCreate', compact('tags'));
    }

    //CREATE
    public function store(Request $request)
    {
        $request->validate([
            'title'       => ['required', 'string', 'min:3' , 'max:50'],
            'description' => ['required', 'string', 'min:3', 'unique:quotes']
        ]);

        $slug = Str::slug($request->title, '-');

        // Slug harus berbeda
        if (Quote::where('slug', $slug)->first() != null) {
            $slug .= time();
        }

        // --------------------Validasi Tags
        $data =  array_unique (array_diff($request->tag, [0]));
        if(empty($data) ){
            return redirect('/quotes/create')->withInput($request->input())->with('msg', 'Tags cannot empty !');
        }
        // --------------------Validasi Tag

        $quote = $request->user()->quotes()->create([
            'title'       => $request->title,
            'slug'        => $slug,
            'description' => $request->description
        ]);

        // --------------------Store Tag
        $quote->tags()->attach($data);

        return redirect('/quotes')->with('msg', 'Quote Successfully Added');
    }

    // SHOW
    public function show($slug)
    {
        $quote = Quote::with('comments.user')->where('slug', $slug)->first();

        return view('quotes.quotesShow', compact('quote'));
    }

    // EDIT
    public function edit($slug)
    {
        $quote = Quote::with('tags')->where('slug', $slug)->first();
        $tags  = Tag::all();

        return view('quotes.quotesEdit', compact('quote', 'tags'));

    }

    //UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => ['required', 'string', 'min:3' , 'max:50'],
            'description' => ['required', 'string', 'min:3']
        ]);

        $slug = Str::slug($request->title);

        // Slug harus berbeda
        if (Quote::where('slug', $slug)->first() != null) {
            $slug .= time();
        }

        $quote = Quote::findOrFail($id);

        // ------------------------Validasi  Tag
        $data = array_unique(array_diff($request->tag, [0]));
        if (empty($data) ) {
            return redirect('/quotes/' . $quote->slug .'/edit')->withInput($request->input())->with('msg', 'Tags cannot empty !');
        }
        // ------------------------End Validasi
        $quote->tags()->sync($data);

        $quote = Quote::findOrFail($id)->update([
            'title'       => $request->title,
            'slug'        => $slug,
            'description' => $request->description
        ]);

        return redirect('/quotes')->with('msg', 'Quote Updated Successfully');

    }

    // DELETE
    public function destroy($id)
    {
        $quote = Quote::destroy($id);

        return redirect('/quotes')->with('msg', 'Quote Successfully Deleted !');
    }

    // RANDOM
    public function random()
    {
        $tags   = Tag::all();
        $quotes = Quote::inRandomOrder()->get();

        return view('quotes.quotes', compact('quotes', 'tags'));
    }

    // PROFILE
    public function profile($id = null)
    {
        if($id == null) {
            $user = User::findOrFail(Auth::user()->id);
        } else  $user = User::fIndOrFail($id);

        return view('quotes.quotesProfile', compact('user'));

    }

    //FILTER
    public function filter($tag)
    {
        $tags = Tag::all();

        $quotes = Quote::with('tags')->whereHas('tags', function($query) use($tag){
            $query->where('tag', $tag);
        })->get();

        return view('quotes.quotes', compact('quotes', 'tags'));
    }

}
