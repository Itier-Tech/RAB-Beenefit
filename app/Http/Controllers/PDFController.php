<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Rab;
use App\Models\Project;
use App\Models\RabItem;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PDFController extends Controller
{
    public function generatePDF($rab_id)
    {
        $rab = Rab::findOrFail($rab_id);

        // Retrieve the project associated with this RAB
        $project = Project::where('project_id', $rab->project_id)->first();

        // Check if the logged in user has access to the project
        if ($project->user_id != Auth::user()->user_id) {
            abort(403, 'Forbidden access');
        }

        $items = RabItem::where('rab_id', $rab_id)->get();

        $data = [
            'rab' => $rab,
            'rab_name' => $project->project_name,
            'date' => Carbon::now()->locale('id_ID')->isoFormat('dddd, D MMMM YYYY'),
            'items' => $items,
        ];
        Pdf::setOption(['isHtml5ParserEnabled' => true, 'debugCss' => true, 'isPhpEnabled' => true]);
        $pdf = Pdf::loadView('pdf', $data);

        return $pdf->download('document.pdf');
    }

    public function index($rab_id)
    {
        return view('livewire.rab-final')->with('rab_id', $rab_id);
    }
}
