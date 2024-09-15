<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    function category(Request $request) : JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
        ]);

        if ($validator->fails()) { //validation fails message
            return response()->json([
                'status'    => 0,
                'message'   => $validator->errors()->messages(),
            ], 200);
        }

        $category = new Category();

        $category->name         = $request->name;
        $category->parent_id    = $request->parent_id;
        $category->save();


        // $send = Send_type::all()->toArray();

        return response()->json([
            'status'        => 1,
            'category'     => $category,
        ], 200);
    }

    function category_view()
    {
        $category_view = Category::all();
        return response()->json([
            'status'            => 1,
            'category_view'     => $category_view,
        ], 200);
    }


    function category_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
        ]);

        if ($validator->fails()) { //validation fails message
            return response()->json([
                'status'    => 0,
                'message'   => $validator->errors()->messages(),
            ], 200);
        }

        $category = Category::find($id);

        $category->name          = $request->name;
        $category->parent_id     = $request->parent_id;

        $category->save();

        return response()->json([
            'status'     => 1,
            'category'   => $category,
        ], 200);
    }


    function category_delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json([
            'status'        => 1,
            'category'     => $category,
        ], 200);
    }
}
