<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\View\View;

class PipelineController extends Controller
{
    public function index(): View
    {
        $stages = ['new', 'contacted', 'qualified', 'proposal', 'closed_won', 'closed_lost'];

        $query = Lead::with('organization');

        if (auth()->user()->hasRole('organization')) {
            $query->where('organization_id', auth()->user()->organization_id);
        }

        $byStage = [];
        foreach ($stages as $stage) {
            $byStage[$stage] = (clone $query)->where('stage', $stage)->orderBy('updated_at', 'desc')->get();
        }

        return view('pipeline.index', compact('stages', 'byStage'));
    }
}
