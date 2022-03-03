<?php

namespace App\Http\Controllers\Admin\course;

use App\Http\Controllers\Controller;
use App\Model\user\course\language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * desclay a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = language::all();
        return view('admin/course/language/language', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = language::all();
        return view('admin/course/language/language', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'desc' => 'required',
            'img' => 'required',
        ]);

        if($request->hasFile('img'))
        {
            $img = $request -> img -> store('public');
        }

        $slug =  strtolower(str_replace(' ', '_', $request -> name));

        if(language::all()->where('slug',$slug)->count() < 1)
        {
            $language = new language();
            $language -> name = $request -> name;
            $language -> slug = $slug;
            $language -> desc = $request -> desc;
            $language -> img = $img;
            $language -> save();
            return redirect()->route('language.index')->with('success','Language created successfully!');
        }
        return redirect()->route('language.index')->with('danger','Language already exists');
    }

    /**
     * desclay the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $languages = language::all();
        $language = language::where('id', $id)->first();

        return view('admin/course/language/edit', compact('language', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this -> validate($request, [
            'name' => 'required',
            'desc' => 'required',
            'img' => 'required',
        ]);

        if($request->hasFile('img'))
        {
            $img = $request -> img -> store('public');
        }

        $slug =  strtolower(str_replace(' ', '_', $request -> name));

        if(language::all()->where('slug',$slug)->count() < 1)
        {
            $language = language::find($id);
            $language -> name = $request -> name;
            $language -> slug = $slug;
            $language -> desc = $request -> desc;
            $language -> img = $img;
            $language -> save();
            return redirect()->route('language.index')->with('success','Language updated successfully!');
        }
        return redirect()->route('language.index')->with('danger','Language already exists');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        language::where('id', $id)->delete();
        return redirect()->back()->with('success','Language deleted successfully!');
    }
}
