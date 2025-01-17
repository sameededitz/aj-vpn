<?php

namespace App\Livewire;

use App\Models\Server;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ServerEdit extends Component
{
    use WithFileUploads;

    public $server;

    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|in:1,0')]
    public $status;

    #[Validate('nullable|image|mimes:jpeg,png,gif,bmp|max:20480')]
    public $image;

    public function mount(Server $server)
    {
        $this->server = $server;

        $this->name = $server->name;
        $this->status = $server->status;
    }

    public function update()
    {
        $this->server->update([
            'name' => $this->name,
            'status' => $this->status,
        ]);

        if ($this->image) {
            $this->server->clearMediaCollection('server_logo');
            $this->server->addMedia($this->image->getRealPath())
                ->usingFileName($this->image->getClientOriginalName())
                ->toMediaCollection('server_logo');
        }

        return redirect()->route('all-servers')->with([
            'status' => 'success',
            'message' => 'Server Updated Successfully',
        ]);
    }

    public function render()
    {
        return view('livewire.server-edit');
    }
}
