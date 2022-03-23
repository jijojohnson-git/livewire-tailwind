<div class="mt-4 p-3 bg-gray-200 rounded shadow-inner shadow-blue-400">
    <h2 class="text-center text-3xl font-bold">All Tickets</h2>
    @foreach ($tickets as $ticket )
        <div wire:click="$emit('TicketSelected', {{ $ticket->id }})" class="text-gray-600 {{ $active == $ticket->id ? 'bg-blue-400 text-white' : '' }} rounded shadow border p-3 my-2 bg-white cursor-pointer hover:shadow-xl hover:border-solid hover:border-3 ">
            <p class="">{{ $ticket->query }}</p>
        </div>
    @endforeach

</div>
