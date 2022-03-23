<div>
    {{-- <div x-data="{show: @entangle('show')}">
        <div x-show="show" x-cloak></div>
    </div> --}}

    @if ($show)
        <div
            class='backdrop-blur-3xl absolute top-0 bottom-0 left-0 right-0 bg-black/90 flex justify-center items-center'>
            <div class="w-1/3  bg-white p-4 text-center ">
                <div class="flex justify-between py-4">
                    <h4>
                        You sure you want to delete this?
                    </h4>
                    <button class="text-lg"
                    x-on:click="window.livewire.emitTo('delete-modal','hide')">&times;</button>
                </div>
                <div class="flex justify-around py-4">
                    <button class="w-1/2 shadow-lg hover:bg-red-500"
                    wire:click="delete">Yes</button>
                    <button class="w-1/2 shadow-lg hover:bg-green-500"
                    x-on:click="window.livewire.emitTo('delete-modal','hide')">No</button>
                </div>
            </div>
        </div>
    @endif

</div>
