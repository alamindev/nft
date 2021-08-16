<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display Page by slug
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return view('frontend.pages.page.show', compact('page'));
    }

}
