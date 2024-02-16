<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Api\Controller;   
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryCollection;  
use Illuminate\Http\Response; 

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return (new CategoryCollection(Category::paginate()))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

     /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
