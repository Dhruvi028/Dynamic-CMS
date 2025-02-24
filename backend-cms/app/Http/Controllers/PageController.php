<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return response()->json(Page::with('children')->whereNull('parent_id')->get());
    }

    public function store(Request $request)
    {
        $page = Page::create($request->all());
        return response()->json($page, 201);
    }

    public function resolvePage($path)
    {
        $slugs = explode('/', $path);
        $parent = null;

        foreach ($slugs as $slug) {
            $query = Page::where('slug', $slug)->with('children');
            if ($parent) {
                $query->where('parent_id', $parent->id);
            } else {
                $query->whereNull('parent_id');
            }
            $parent = $query->first();

            if (!$parent) {
                return response()->json(['error' => 'Page not found'], 404);
            }
        }

        return response()->json($parent);
    }

    public function update(Request $request, Page $page)
    {
        $page->update($request->all());
        return response()->json($page);
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return response()->json(null, 204);
    }
}