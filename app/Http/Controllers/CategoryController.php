<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getJobsByCategory($categoryId, $name)
    {
        // Get category name
        $categoryName = $name;

        // Get jobs filtered by category ID
        $jobs = Job::where('category_id', $categoryId)->paginate(5);

        return view('/categories.singleCategory', compact('jobs', 'categoryName'));
    }
}
