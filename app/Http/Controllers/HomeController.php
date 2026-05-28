<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\ViewModels\HomePageViewModel;
use Illuminate\Contracts\View\View;

final class HomeController extends Controller
{
    public function index(): View
    {
        return view('pages.home', [
            'vm' => HomePageViewModel::make(),
        ]);
    }
}
