<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DeleteModal extends Modal
{
    // public $model;

    // protected $listeners = ['delete'];

    public function delete()
    {
        // dd($this->model);
        // $this->deleteId = $id;
        // $this->model = $model->find($id);
        if($this->model->images)
        {
            $path = public_path('/photos/');
            foreach($this->model->images as $image)
            {
                if(file_exists($path.$image))
                {
                    // File::delete($path.$image);
                    @unlink($path.$image);
                }
            }
        }
        $this->model->delete();
        session()->flash('deleted', 'Comment deleted successfully!');
        $this->emit('refresh');
        $this->emit('hide');
        // $this->comments = $this->comments->where('id', '!=', $id);
        // $this->comments = $this->comments->except($id);
    }

    public function render()
    {
        return view('livewire.delete-modal');
    }
}
