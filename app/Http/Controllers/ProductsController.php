<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $products = [
        [
            'id' => 1,
            'name' => 'Nguyen Van Loc',
            'Phone' => 'Iphone',
            'price' => '2000$'
        ],
        [
            'id' => 2,
            'name' => 'Nguyen Van Loc',
            'Phone' => 'SamSung',
            'price' => '2000$'
        ],
        [
            'id' => 3,
            'name' => 'Nguyen Van Loc',
            'Phone' => 'Vmax',
            'price' => '3000$'
        ]
    ];

    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Lay danh sach thanh cong',
            'data' => $this->products,
            'meta' => [
                'total' => count($this->products),
                'per_page' => 10,
                'current_page' => 1,
                'last_page' => 1
            ]
        ]);
    }


    public function show($id)
    {
        foreach ($this->products as $product) {
            if ($product['id'] == $id) {
                return response()->json([
                    'success' => true,
                    'message' => 'Lay chi tiet thanh cong',
                    'data' => $product
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Khong tim thay tai nguyen',
            'errors' => null
        ], 404);
    }


    public function store(Request $request)
    {
        $product = [
            'id' => count($this->products) + 1,
            'name' => $request->name,
            'Phone' => $request->Phone,
            'price' => $request->price
        ];

        $this->products[] = $product;

        return response()->json([
            'success' => true,
            'message' => 'Them san pham thanh cong',
            'data' => $product
        ], 201);
    }

    public function update(Request $request, $id)
    {
        foreach ($this->products as $key => $product) {

            if ($product['id'] == $id) {

                $this->products[$key]['name'] =
                    $request->name ?? $product['name'];

                $this->products[$key]['Phone'] =
                    $request->Phone ?? $product['Phone'];

                $this->products[$key]['price'] =
                    $request->price ?? $product['price'];

                return response()->json([
                    'success' => true,
                    'message' => 'Cap nhat thanh cong',
                    'data' => $this->products[$key]
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Khong tim thay tai nguyen',
            'errors' => null
        ], 404);
    }

    public function destroy($id)
    {
        foreach ($this->products as $key => $product) {

            if ($product['id'] == $id) {

                unset($this->products[$key]);

                return response()->json([
                    'success' => true,
                    'message' => 'Xoa san pham thanh cong',
                    'data' => $product
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Khong tim thay tai nguyen',
            'errors' => null
        ], 404);
    }
}
