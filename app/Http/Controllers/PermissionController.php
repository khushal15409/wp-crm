<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(): View
    {
        $permissions = Permission::withCount('roles')->get()->groupBy(function ($p) {
            return explode('.', $p->name)[0] ?? 'other';
        });
        return view('permissions.index', compact('permissions'));
    }
}
