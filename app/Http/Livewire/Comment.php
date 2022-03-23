<?php

namespace App\Http\Livewire;

use App\Models\Comment as Initial;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Intervention\Image\ImageManagerStatic as Image;

class Comment extends Component
{
    use WithPagination;
    use WithFileUploads;

    // public $comments;
    public $search;
    public $images = [];
    public $newComment;
    public $ticketId;

    // protected $paginationTheme = 'tailwind';

    // public function mount($initialComments)
    // {

    //     $this->comments = $initialComments;
    // }
    // protected $rules = [
    //     'newComment' => 'required|max:200'
    // ];

    // public function mount()
    // {
    //     $this->comments = Initial::with('user')->latest()->paginate(3);
    // }

    protected $listeners = ['TicketSelected', 'MissingTicket', 'delete', 'refresh' => '$refresh'];

    public function TicketSelected($ticket)
    {
        $this->ticketId = $ticket;
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'newComment' => 'required|max:200'
        ]);
    }

    public function addComment()
    {
        // if ($this->newComment == '') {
        //     return;
        // }
        // array_unshift($this->comments, [
        //     'body' => $this->newComment,
        //     'created_at' => Carbon::now()->diffForHumans(),
        //     'creator' => 'Mike'
        // ]);
        // $request->validate([
        //     'newComment' => 'required'
        // ]);

        if($this->ticketId)
        {
            $this->validate(
                [
                    'newComment' => 'required|max:200',
                    'images.*' => 'required'
                ],
                ['newComment.required' => 'Comment is required!!']
            );
            $images = $this->storeImage();
            // Image::configure(['driver' => 'gd']);
            $created = Initial::create([
                                            'body' => $this->newComment, 'user_id' => rand(1, 10),
                                            'images' => $images,
                                            'ticket_id' => $this->ticketId,
                                        ]);
            // $this->comments->prepend($created);
            $this->newComment = '';
            $this->images = [];
            session()->flash('created', 'Comment added successfully!');
        }
        else
        {
            session()->flash('ticket', 'Choose a Ticket To comment!');
            $this->emitSelf('MissingTicket');
        }
    }
    public function MissingTicket()
    {
        return false;
    }

    public function storeImage()
    {
        if(!$this->images) {return null;}
        $this->validate([
            'images.*' => 'required|max:2048'
        ]);
        // Image::configure(['driver' => 'gd']);
        foreach ($this->images as $image) {

            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image);
            $image = $img->save(public_path().'/photos/' . $image_name, 90, 'jpg');
            $data[] = $image_name;
        }
        return $data; // mutated
    }

    public function delete($id)
    {
        $comment = Initial::find($id);
        if($comment->images)
        {
            $path = public_path('/photos/');
            foreach($comment->images as $image)
            {
                if(file_exists($path.$image))
                {
                    // File::delete($path.$image);
                    @unlink($path.$image);
                }
            }
        }
        $comment->delete();
        // $this->comments = $this->comments->where('id', '!=', $id);
        // $this->comments = $this->comments->except($id);

        session()->flash('deleted', 'Comment deleted successfully!');
    }

    public function updatedImages()
    {

            dd($this->validate([
                'images.*' => 'required|max:2048'
            ],
        [
            'images.*.max' => 'Image size should be less than 2MB!'
        ]));

    }

    public function save()
    {

        $this->validate([
            'images.*' => 'required|max:2048'
        ]);
        // if (count($this->image) > 1) {
            foreach ($this->images as $image) {
                $image->storePublicly('images');
            }
            $this->images = [];
        // } else {
        //     $this->image[0]->store('photos');
        //     $this->image = '';
        // }
        session()->flash('message', 'File Uploaded Successfully!');
    }

    public function remove($index)
    {
        array_splice($this->images, $index, 1);
    }

    public function render()
    {
        return view('livewire.comment', ['comments' => Initial::where('ticket_id', $this->ticketId)->whereHas(
            'user',
            function ($query) {
                $query->where('users.name', 'like', '%' . $this->search . '%');
            }
        )->latest()->paginate(5)]);
    }
}
