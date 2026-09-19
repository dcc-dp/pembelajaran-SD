<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request to route users to their respective dashboard based on their role.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        /** @var User|null $user */
        $user = $request->user();

        if ($user && $user->hasRole('Super Admin')) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('guru.dashboard.index');
    }
}
