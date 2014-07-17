<?php

class CategoryController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function loadTable() {
        $max = Input::has("max") ? Input::get("max") : "10";
        $offset = Input::has("offset") ? Input::get("offset") : "0";
        $categories = Category::all();
        $total = Category::count();
        return View::make("category.tableView", array('categories' => $categories, 'total' => $total, 'max' => $max, 'offset' => $offset));
    }


	public function save()
	{
        $name = Input::get("name");
        $category = new Category();
        $category->name = $name;
        $category->save();
        return array('status' => 'success', 'message' => 'Category has been Successfully saved');
	}
	public function create()
	{
       return View::make("category.edit");
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        //$id = Input::has("id") ? intval(Input::get("id")) : null;
        $category = null;
        if($id) {
            $category = Category::find($id);
        } else {
            $category = new Category();
        }
        return View::make("category.update", array(
            'category' => $category,
        ));
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
