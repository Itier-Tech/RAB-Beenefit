<?php

namespace App\Livewire;

use App\Models\Rab;
use App\Models\Project;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class RabPage extends Component
{
    use WithPagination;

    public $project_id, $project_name;
    public $count = 1;
    private $page_length = 5;

    public function mount ($project_id) {
        // Check if the logged in user has access to the project
        if (Project::where('project_id', $project_id)->first()->user_id != Auth::user()->user_id) {
            abort(403, 'Forbidden access');
        }
        $this->project_id = $project_id;
        $this->project_name = Project::find($project_id)->project_name;
        $this->count = ($this->getPage()-1) * $this->page_length + 1;
    }

    public function updatingPage($page)
    {
        $this->count = ($page-1) * $this->page_length + 1;
    }

    public function askPrevPage()
    {
        $this->previousPage();
    }

    public function rabDetails($rab_id)
    {
    }

    public function redirectToAddRab()
    {
        return redirect('/addRab' . '/' . $this->project_id);
    }

    public function deleteRab($rab_id)
    {
        $deletedRab = Rab::find($rab_id)->first();
        // Cek apakah id rab masih ada dalam proyek yang sedang dibuka
        if ($deletedRab->project_id != $this->project_id) {
            abort(403, 'Forbidden access');
        }
        Rab::where('rab_id', $rab_id)->delete();
        return redirect(request()->header('Referer'));
    }

    public function addRab() 
    {
        $rab = new Rab();

        $rab->project_id = $this->project_id;
        $rab->status = 0;

        $rab->save();
    }

    public function render()
    {
        return view('livewire.rab-page', ['rabList' => Rab::where('project_id', $this->project_id)->latest()->paginate($this->page_length),
                                        'project_name' => $this->project_name])
        ->extends('components.layouts.app')->section('content');
    }
}
