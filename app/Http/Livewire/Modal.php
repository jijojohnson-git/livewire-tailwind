<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public $show = false;
    public $deleteId;
    public $model;

    protected $listeners = [
        'show','hide'
    ];

    public function hide()
    {
        $this->show = false;
    }
    public function show($id, $model)
    {
        // $this->show = !$this->show;
        $this->show = true;
        // $this->deleteId = $id;
        $this->model = $model::findOrFail($id);
        // dd($this->model);
    }

}
