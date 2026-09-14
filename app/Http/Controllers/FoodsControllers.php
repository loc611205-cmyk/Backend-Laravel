<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodsControllers extends Controller
{
    public function index(Request $request)
    {
        $foods = Food::paginate();

        return [
            'success' => true,
            'message' => 'Lay danh sach thanh cong',
            'data' => $foods->items(),
            'meta' => [
                'total' => $foods->total(),
                'per_page' => $foods->perPage(),
                'current_page' => $foods->currentPage(),
                'last_page' => $foods->lastPage()
            ]
        ];
    }

    public function create(Request $request)
    {
        $data = $request->all();

        $food = Food::create([
            'food' => $data['food'],
            'price' => $data['price'],
            'status' => $data['status'],
            'category_id' => $data['category_id']
        ]);

        return [
            'success' => true,
            'message' => 'Tao thanh cong',
            'data' => $food
        ];
    }

    public function show($id)
    {
        $food = Food::find($id);

        if (!$food) {
            return [
                'success' => false,
                'message' => 'Khong tim thay tai nguyen',
                'errors' => null
            ];
        }

        return [
            'success' => true,
            'message' => 'Lay chi tiet thanh cong',
            'data' => $food
        ];
    }

    public function update($id, Request $request)
    {
        $food = Food::find($id);

        if (!$food) {
            return [
                'success' => false,
                'message' => 'Khong tim thay tai nguyen',
                'errors' => null
            ];
        }

        $data = $request->all();

        $food->update([
            'food' => $data['food'],
            'price' => $data['price'],
            'status' => $data['status'],
            'category_id' => $data['category_id']
        ]);

        return [
            'success' => true,
            'message' => 'Cap nhat thanh cong',
            'data' => $food
        ];
    }

    public function delete($id)
    {
        $food = Food::find($id);

        if (!$food) {
            return [
                'success' => false,
                'message' => 'Khong tim thay tai nguyen',
                'errors' => null
            ];
        }

        $food->delete();

        return [
            'success' => true,
            'message' => 'Xoa thanh cong',
            'data' => null
        ];
    }
}
