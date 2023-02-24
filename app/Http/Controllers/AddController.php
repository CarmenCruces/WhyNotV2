<?php

namespace App\Http\Controllers;

use App\Models\Add;
use Illuminate\Http\Request;

/**
 * Class AddController
 * @package App\Http\Controllers
 */
class AddController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adds = Add::paginate();

        return view('add.index', compact('adds'))
            ->with('i', (request()->input('page', 1) - 1) * $adds->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $add = new Add();
        return view('add.create', compact('add'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Add::$rules);

        $add = Add::create($request->all());

        return redirect()->route('adds.index')
            ->with('success', 'Add created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $add = Add::find($id);

        return view('add.show', compact('add'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $add = Add::find($id);

        return view('add.edit', compact('add'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Add $add
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Add $add)
    {
        request()->validate(Add::$rules);

        $add->update($request->all());

        return redirect()->route('adds.index')
            ->with('success', 'Add updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $add = Add::find($id)->delete();

        return redirect()->route('adds.index')
            ->with('success', 'Add deleted successfully');
    }
}
