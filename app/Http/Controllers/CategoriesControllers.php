<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoriesControllers extends Controller
{
    public function index(Request $request)
    {
         $categories = Categories::paginate();

    return [
        'success' => true,
        'message' => 'Lay danh sach thanh cong',
        'data' => $categories->items(),
        'meta' => [
            'total' => $categories->total(),
            'per_page' => $categories->perPage(),
            'current_page' => $categories->currentPage(),
            'last_page' => $categories->lastPage()
        ]
    ];
    }

    public function create(Request $request): array
    {
        $data = $request->all();

        $category = Categories::create([
            'origin' => $data['origin'],
            'describe' => $data['describe']
        ]);

        return [
            'message' => 'create',
            'data' => $category
        ];
    }

    public function show($id, Request $request): array
    {
        $category = Categories::find($id);

        if (!$category) {
        return [
            'success' => false,
            'message' => 'Khong tim thay tai nguyen',
            'errors' => null
        ];
    }

    return [
        'success' => true,
        'message' => 'Lay chi tiet thanh cong',
        'data' => $category
    ];
    }

    public function update($id, Request $request): array
    {
        $category = Categories::find($id);

         if (!$category) {
        return [
            'success' => false,
            'message' => 'Khong tim thay tai nguyen',
            'errors' => null
        ];
    }

        $data = $request->all();

        $category->update([
            'origin' => $data['origin'],
            'describe' => $data['describe']
        ]);

        return [
            'message' => 'update',
            'data' => $category
        ];
    }

    public function delete($id): array
    {
        $category = Categories::find($id);

        if (!$category) {
        return [
            'success' => false,
            'message' => 'Khong tim thay tai nguyen',
            'errors' => null
        ];
    }

        $category->delete();

        return [
            'message' => 'delete'
        ];
    }
}
