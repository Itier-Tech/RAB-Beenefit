<?php

namespace App\Livewire;

use Livewire\Component;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use PDF;

class RabFinal extends Component
{
    public function rules()
    {
        return [
            'rab_id' => 'required',
            'company_name' => 'required',
            'company_address' => 'required',
            'company_phone' => 'required',
            'company_logo_path' => 'required',
            'bank_dest' => 'required',
            'account_number' => 'required',
            'account_name' => 'required',
        ];
    }

    public function render()
    {
        return view('livewire.rab-final')->extends('components.layouts.app')->section('content');
    }
}
