<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowMessages extends Component
{
    
    


    // use WithFileUploads;
    use WithPagination;

    public $post, $image, $imageReset;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $number = '10';

    public $readyToLoad = false;

    public $open_edit = false;

    // protected $listeners = ['renderX' => 'render']; // or  just render 
    // protected $listeners = ['render', 'delete']; //listen to 'delete' created in show-posts.blade.php and also need to create delete function
    protected $listeners = ['render']; //listen to 'delete' created in show-posts.blade.php and also need to create delete function

    protected $queryString = [

        'number' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    public function mount()
    {
        $this->imageReset = rand();
        $this->post = new Message();
    }

    public function updatingSearch()
    { // using Lifecycle Hooks - updating function
        $this->resetPage();
    }

    // protected $rules = [
    //     'post.title' => 'required|min:4',
    //     'post.content' => 'required|min:10',
    //     // 'image' => 'required|max:1024',
    // ];


    public function render()
    {

        // $contactMessage = Message::all();

        if ($this->readyToLoad) {
            $contactMessage = Message::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->number);
        } else {
            $contactMessage = [];
        }

        return view('livewire.show-messages', compact('contactMessage'));
    }





    public function loadMessages()
    {
        $this->readyToLoad = true;
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    // public function edit(Message $post)
    // {
    //     $this->post = $post;
    //     $this->open_edit = true;
    // }

    // public function update()
    // {
    //     $this->validate(); //validates rules array variable

    //     if ($this->image) {
    //         Storage::delete($this->post->image);
    //         $this->post->image = $this->image->store('posts');
    //     }

    //     $this->post->save();
    //     $this->reset(['open_edit', 'image']);
    //     $this->imageReset = rand();
    //     $this->emit('alert', 'Post successfully updated ');
    // }

    // public function delete(Message $post)
    // {
    //     Storage::delete($post->image);
    //     $post->delete();
    // }
}
