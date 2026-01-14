<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

// 2. إضافة implements HasMiddleware
class CategoryController extends Controller implements HasMiddleware
{
    // 3. استبدال __construct بهذه الدالة الثابتة
    public static function middleware(): array
    {
        return [ new Middleware('can:sessions.view', only: ['index', 'show']),
            new Middleware('can:sessions.create', only: ['create', 'store']),
            new Middleware('can:sessions.update', only: ['edit', 'update']),
            new Middleware('can:sessions.delete', only: ['destroy']),
        ];
    }



    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }
    /**
     * Summary of store
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:categories|max:255']);
        Category::create($request->all());
        return back()->with('success', 'تم إضافة القسم بنجاح');
    }
    /**
     * Summary of edit
     * @param \App\Models\Category $category
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }
    /**
     * Summary of update
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|unique:categories,name,' . $category->id]);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'تم التحديث بنجاح');
    }
    /**
     * Summary of destroy
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'تم حذف القسم');
    }
}
