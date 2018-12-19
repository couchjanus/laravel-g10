<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Session;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::latest()->paginate(5);
        return view('admin.tags.index',compact('tags'))   ->with('i', (request()->input('page', 1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator = Validator::make(
        //     $request->all(),
        //     [
        //         'name' => 'required|unique:tags|max:255|min:3',
        //     ]
        // );

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator->messages()->all());
        // }

        // if ($validator->fails()) {
        //     Session::flash('errors', $validator->messages()->first());
        //     return redirect()->back()->withInput();
        // }


        $this->validate(
            $request,
            [
                'name' => 'required|unique:tags|max:255|min:3',
            ]
        );

        // $request->validate(['name' => 'required|unique:tags|max:255|min:3',]);

        // $tag = new Tag;

        // if ($request->has('description') && $request->description != '') {
        //     $tag->description = $request->description;
        // } else {
        //     $tag->description = 'Default Value';
        // }
       
        // $tag->name = $request->name;
        // $tag->description = $request->input('description', 'Default Value');
        
        // $tag->fill(['name' => $request->name]);
        // $tag->fill(['description' => $request->description]);
        
        // $tag->save();
        
        Tag::create($request->all());
        
        // Tag::create(['name' => $request->name, 'description' => $request->description != '' ?$request->get('description') : 'Default Value']);

        return redirect()->route('tags.index')->with('success','Tag created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Tag $tag)
    {
        // Указать значение по умолчанию...
        // $value = session('key', 'default');

        // Сохранить значение данных в сессию...
        // session(['key' => 'Secret of me value']);

        // Получить значение данных из сессии...
        // $value = $request->session()->get('key');

        // $value = session('key');

        // $value = $request->session()->get('key', 'default');

        // $value = $request->session()->get(
        //     'key',
        //     function () {
        //         return 'default secter';
        //     }
        // );

        // получить все данные из сессии:
        // $value = $request->session()->all();

        // Через экземпляр запроса...
        // $request->session()->put('key', 'value');

        // Через глобальный вспомогательный метод...
        // session(['key' => 'value']);

        $request->session()->push('users.teams', 'developers');

        // $value = $request->session()->pull('key', 'default');

        // $request->session()->flash('status', 'Задание выполнено успешно!');

        // $request->session()->reflash();

        // $request->session()->keep(['username', 'email']);


        if ($request->session()->has('users')) {
            dd($request->session()->all());
        }

        if ($request->session()->exists('users')) {
            dd($request->session()->all());
        }

        // $request->session()->forget('key');

        // $request->session()->flush();

        // $request->session()->regenerate();

        // dd($value);

        // return view('admin.tags.show',compact('tag'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit')->withTag($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|unique:tags|max:255',
        ]);
        $tag->update($request->all());

        // $tag->update(['name' => $request->name, 'description' => $request->input('description', 'Default Value')]);
       

        return redirect()->route('tags.index')
            ->with('success','Tag updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')
            ->with('success','Tag deleted successfully');
    }
}
