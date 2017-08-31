<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Http\Request;
use Session;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories=Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        //
        $input = $request->all();
        Category::create($input);
        Session::flash('o_category_created','دسته جدید نظر با موفقیت ایجاد شد!');
        return redirect('/admin/categories');
    }

    /**
     * Display the specified resource.
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
        //
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCategoryRequest $request, $id)
    {
        //
        $category = Category::findOrFail($id);
        $input = $request->all();
        $category->update($input);
        Session::flash('o_category_updated','عنوان دسته مورد نظر با موفقیت بروزرسانی شد!');
        return redirect('/admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         $category = Category::findOrFail($id);


        if($category->posts()->count()==0) {
            $category->delete();
            Session::flash('o_category_deleted','عنوان دسته مورد نظر با موفقیت حذف شد!');
        }elseif($category->posts()->count()>0){
            $default = Category::findOrFail(1);
            $category->posts()->update(['category_id'=>$default->id]);
            $category->delete();
            Session::flash('o_category_deleted','عنوان دسته مورد نظر با موفقیت حذف شد و با پست های مربوط به دسته پیش فرض انتقال داده شده اند!');

        }
        return redirect('/admin/categories');

    }
}
