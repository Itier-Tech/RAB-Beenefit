<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rab;

class AddRab extends Component
{
    public $projectId;

    public function mount ($projectId) {
        $this->projectId = $projectId;
    }
    public function create()
    {
        $rab = new Rab();

        $rab->project_id = $this->projectId;
        $rab->status = 0;

        $rab->save();
        response()->json(['message' => 'Rab created successfully', 'data' => $rab], 201);
        return redirect('/rab' . '/' . $this->projectId);
    }

    public function render()
    {
        return view('livewire.add-rab')->extends('components.layouts.app')->section('content');
    }
}
