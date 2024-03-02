<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Rab;
use App\Models\Project;
use App\Models\Rab_item;
use Illuminate\Support\Facades\Auth;
use PDF;
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
        
        $items = Rab_item::where('rab_id', $rab_id)->get();

        $data = [
            'title' => 'domPDF in Laravel 10',
            'date' => Carbon::now()->locale('id_ID')->isoFormat('D, MMMM YYYY'),
            'items' => $items,
        ];
        $pdf = PDF::loadView('pdf', $data);

        $pdf->getDomPDF()->set_option('enable_css_float', true);
        $pdf->getDomPDF()->set_option('enable_html5_parser', true);
        $pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);
        $pdf->getDomPDF()->set_option('isPhpEnabled', true);
        $pdf->getDomPDF()->set_option('isRemoteEnabled', true);
        $pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);

        return $pdf->download('document.pdf');
    }

    public function index($rab_id)
    {
        return view('livewire.rab-final')->with('rab_id', $rab_id);
    }
}
