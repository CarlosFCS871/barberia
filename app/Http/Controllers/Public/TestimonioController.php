<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonio;

class TestimonioController extends Controller
{
    public function index()
    {
        $testimonios = Testimonio::with('cliente')
            ->latest()
            ->get();

        return view('publico.testimonios', compact('testimonios'));
    }
}