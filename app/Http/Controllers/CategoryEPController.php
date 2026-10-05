<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryEPController extends Controller
{
    /**
     * Store a newly created equipment category.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'category' => [
                    'required',
                    'string',
                    'max:255',
                    'unique:category__e_p_s,category',
                ],
            ],
            [
                'category.required' => 'Please enter a category name.',
                'category.unique' => 'This category already exists.',
                'category.max' => 'Category name must not exceed 255 characters.',
            ]
        );

        Category::create([
            'category' => $validated['category'],
        ]);

        return redirect()
            ->route('equipment.index')
            ->with('success', 'Category added successfully.');
    }

    /**
     * Remove the specified equipment category.
     */
    public function destroy(Category $category)
    {
        // Check whether this category is being used by equipment.
        if ($category->equipment()->exists()) {
            return redirect()
                ->route('equipment.index')
                ->with(
                    'error',
                    'This category cannot be deleted because it is currently assigned to equipment.'
                );
        }

        $category->delete();

        return redirect()
            ->route('equipment.index')
            ->with('success', 'Category deleted successfully.');
    }
}