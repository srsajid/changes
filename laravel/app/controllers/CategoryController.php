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
        $id = Input::get("id");
        $name = Input::get("name");
        $category = $id ? Category::find(intval($id)) : new Category();
        $category->name = $name;
        $category->save();
        return array('status' => 'success', 'message' => 'Category has been Successfully saved');
	}

	public function create() {
       return View::make("category.edit");
	}

	public function edit() {
        $id = Input::has("id") ? intval(Input::get("id")) : null;
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
}
