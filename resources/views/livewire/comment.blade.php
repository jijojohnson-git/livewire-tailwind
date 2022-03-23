<div class="mt-4 p-3 bg-gray-200 rounded shadow-inner shadow-blue-400"
x-data="{isUploading: false, progress: 5}">
    <div class="m-4">
        <h2 class="text-left uppercase text-4xl text-gray-900 tracking-wider">comments</h2>
        <input class="rounded shadow my-2" type="text" wire:model='search'>
    </div>
    <div>

        <div class="h-3 shadow relative max-w-xl rounded-full overflow-hidden"

            x-show.transition="isUploading"
            x-on:livewire-upload-start.window="isUploading = true"
            x-on:livewire-upload-finish.window="isUploading = false, progress:5"
            x-on:livewire-upload-error.window="isUploading = false, progress:5"
            x-on:livewire-upload-progress.window="progress = $event.detail.progress">
            <div class="w-full h-full bg-gray-100 shadow-lg" >
                <div class="h-full bg-gradient-to-r from-cyan-500 to-blue-500 " id="progress" x-bind:style="`width: ${progress}%`"></div>
                <progress max="100" x-bind:value="progress"></progress>
            </div>
        </div>

        @if (session()->has('deleted'))
            <div class="bg-red-600 text-lg text-white text-center">
                {{ session('deleted') }}
            </div>
        @endif
        @if (session()->has('message'))
            <div class="bg-green-600 text-lg text-white text-center">
                {{ session('message') }}
            </div>
        @endif

        {{-- <form wire:submit.prevent="save"> --}}
            @error('images.*') <span class="error">{{ $message }}</span> @enderror
        @if ($images)
            Photo Preview:
            {{-- @if (count($image) > 1)) --}}
            @foreach ($images as $image)
                <div class="relative" wire:key='{{ $loop->index }}'>
                    <i wire:click='remove({{ $loop->index }})'
                        class="fas fa-times text-red-400 hover:text-red-600 cursor-pointer rounded-full absolute text-lg font-bold top-0 right-1"></i>
                    <img src="{{ $image->temporaryUrl() }}" class="h-1/3 object-cover">
                </div>
            @endforeach
            {{-- @else
                    <img src="{{ $image[0]->temporaryUrl() }}">
                @endif --}}
        @endif

        @if (count($errors) > 0)
            <div class="text-white bg-red-600">
                {{-- <strong>Whoops!</strong> There were some problems with your input.<br><br> --}}
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        @error('images')
            <span class="error">{{ $message }}</span>
        @enderror
        {{-- <button wire:loading.remove type="submit" class="rounded bg-green-600 text-white px-3 py-2" id="submit">Save Image</button> --}}
        {{-- </form> --}}
    </div>
    <form wire:submit.prevent='addComment()' class="flex justify-between mb-4 mt-3 flex-wrap">
        <div class="w-full">
            <input type="file" wire:model="images" id="photo" multiple>
            <div wire:loading wire:target="addComment()" class="rounded bg-green-600 text-white px-3 py-2"><i
                    class="fa-solid fa-spinner"></i></div>
        </div>
        <div class="flex justify-between w-full">
            <input wire:model='newComment' type="text" class="w-2/3 rounded-full p-2 mr-2 my-2"
                placeholder="Whats on your mind?">
            <button type='submit' id="submit"
                class="w-1/3  px-3 bg-blue-600 text-white rounded-full hover:bg-blue-500 transition duration-75">Post</button>
        </div>
    </form>
    @error('newComment')
        <span class="text-red-500 texl-sm">{{ $message }}</span>
    @enderror
    @if (session()->has('created'))
        <div class="p-3 bg-green-300 text-green-800 rounded shadow">
            {{ session('created') }}
        </div>
    @endif
    @if (session()->has('deleted'))
        <div class="p-3 bg-red-300 text-red-800 rounded shadow">
            {{ session('deleted') }}
        </div>
    @endif
    @if (session()->has('ticket'))
        <div class="p-3 bg-red-300 text-red-800 rounded shadow">
            {{ session('ticket') }}
        </div>
    @endif
    {{-- wire:click='delete({{ $comment->id }})' --}}
    @foreach ($comments as $comment)
        <div class="px-3 py-4 my-2 shadow-md bg-white rounded relative">
            <div class="flex justify-start no-wrap items-center">
                <h3 class="font-bold text-lg mr-3">{{ $comment->user->name }}</h3>
                <span class="text-gray-600">{{ $comment->created_at->diffForHumans() }}</span>
                <button
                    class="absolute right-2 top-2 border-solid border-2 border-red-200 hover:border-red-600 rounded-full flex items-center justify-center h-4 w-4 p-2"
                    x-on:click="window.livewire.emitTo('delete-modal', 'show', {{ $comment->id }}, 'App\\Models\\Comment')">
                    <i class="fas fa-times text-sm text-red-200 hover:text-red-600 cursor-pointer"></i></button>
            </div>
            <div class="py-3">
                <p>{{ $comment->body }}</p>
            </div>
            @if ($comment->images)
                <div class="flex">
                    @foreach ($comment->images as $image)
                        <div class="py-3 w-1/3 flex">
                            <img src='{{ asset('photos/' . $image) }}' class="p-1" />
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach
    {{ $comments->links('page-two') }}


</div>
@section('scripts')
    <script>
        Livewire.on('MissingTicket', () => {

            alert('Choose a Ticket');

        })
        // window.addEventListener('livewire-upload-start', event => {
        //     document.getElementById("progress").style.width = `0%`;
        //     // console.log('upload started');
        // });
        // window.addEventListener('livewire-upload-finished', event => {
        //     document.getElementById("progress").style.width = `100%`;
        //     // console.log('upload finished');
        // });
        // window.addEventListener('livewire-upload-error', event => {
        //     document.getElementById("progress").style.width = `50%`;
        //     document.getElementById("progress").style.backgroundColor = 'red';
        //     // console.log('upload error');
        // });
        // window.addEventListener('livewire-upload-progress', event => {
        //     document.getElementById("progress").style.width = `${event.detail.progress}%`;
        //     // console.log(`${event.detail.progress}%`);
        // });
        // document.getElementById('submit').addEventListener('click', function() {
        //     document.getElementById("photo").value = "";
        // });
        // Get a reference to the file input element
        // const inputElement = document.querySelector('input[id="photo"]');

        // Create a FilePond instance
        // const pond = FilePond.create(inputElement);


        // FilePond.setOptions({
        //     server: {
        //         url: '/filepond/api',
        //         process: '/process',
        //         revert: '/process',
        //         headers: {
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //         }
        //     }
        // });
    </script>
@endsection
