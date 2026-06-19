<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\StructuredData;
use App\ViewModels\HomePageViewModel;
use Illuminate\Contracts\View\View;

final class HomeController extends Controller
{
    public function index(): View
    {
        $vm = HomePageViewModel::make();

        return view('pages.home', [
            'vm' => $vm,
            'structuredData' => StructuredData::forHome($vm),
        ]);
    }
}
