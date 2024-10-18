<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Http\Requests\StoreTestRequest;
use App\Http\Requests\UpdateTestRequest;
use App\Models\Category;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = Test::latest()->get();
        $categories = Category::with(['childCategories.childCategories','test'])->where('parent_id', null)
        ->orderBy('name')->get();
        return view('test.index', compact('tests', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category, Test $test = null)
    {
        if (!$test) {
            $test = new Test();
        }
        $tests = $category
            ->test()
            ->with(['childTests.childTests'])
            ->where('parent_id', null)
            ->orderBy('name')
            ->get();
        return view('test.create', compact('category', 'tests', 'test'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestRequest $request, Category $category)
    {
        //Test::create($request->validated());
        $category->test()->create($request->validated());
        return redirect()->back()->with('success', 'Test Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, Test $test)
    {
        return $this->create($category, $test);
        // return view('test.edit', compact('test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTestRequest  $request
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestRequest $request, Test $test)
    {
        $test = $test->update($request->validated());
        if ($test) {
            return redirect()->route('tests.index')->with('success', 'Test updated');
        } else {
            return redirect()->back()->with('error', 'Test updated failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        $test->delete();
        return redirect()->back()->with('success', 'Test Deleted');
    }
}
