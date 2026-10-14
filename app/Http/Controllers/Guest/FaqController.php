<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::aktif()->orderBy('urutan');

        if ($request->filled('q')) {
            $keyword = $request->input('q');
            $query->where(function ($q) use ($keyword) {
                $q->where('pertanyaan', 'like', "%{$keyword}%")
                  ->orWhere('jawaban', 'like', "%{$keyword}%");
            });
        }

        $faqs = $query->get();

        return view('guest.faq.index', compact('faqs'));
    }
}
