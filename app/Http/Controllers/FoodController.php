<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodController extends Controller
{
    private $foods = [
        [
            'id' => 1,
            'name' => 'Phở',
            'price' => 30
        ],
        [
            'id' => 2,
            'name' => 'Cơm',
            'price' => 25
        ],
        [
            'id' => 3,
            'name' => 'Bún bò',
            'price' => 20
        ]
    ];

    public function index()
    {
        return response()->json($this->foods);
    }

    public function show($id)
    {
        foreach ($this->foods as $food) {
            if ($food['id'] == $id) {
                return response()->json($food);
            }
        }

        return response()->json([
            'message' => 'Không tìm thấy món ăn'
        ], 404);
    }

    public function update(Request $request, $id)
    {
        foreach ($this->foods as $key => $food) {
            if ($food['id'] == $id) {

                $this->foods[$key]['name'] = $request->name;
                $this->foods[$key]['price'] = $request->price;

                return response()->json([
                    'message' => 'Cập nhật món ăn thành công',
                    'data' => $this->foods[$key]
                ]);
            }
        }

        return response()->json([
            'message' => 'Không tìm thấy món ăn'
        ], 404);
    }

public function destroy($id)
{
    foreach ($this->foods as $key => $food) {
        if ($food['id'] == $id) {
            unset($this->foods[$key]);

            return response()->json([
                'message' => 'Xóa món ăn thành công',
                'id' => $id
            ]);
        }
    }

    return response()->json([
        'message' => 'Không tìm thấy món ăn'
    ], 404);
}
}
