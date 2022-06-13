<div class="w-full">
    <h1 class="text-3xl mb-4">Support Tickets</h1>

    <div class="w-full mt-10">
        <div class="space-y-2 mb-5">
            @foreach ($tickets as $ticket)
            <div class="shadow-md shadow-slate-100 bg-white p-3 border border-slate-200 {{ $active === $ticket->id ? 'bg-blue-100' : ''}}"
                wire:click="$emit('ticketSelected', {{ $ticket->id }})">
                <div class="text-base">{{ $ticket->question }}</div>
            </div>
            @endforeach
        </div>

        <div>
            {{ $tickets->links('vendor.livewire.simple-tailwind') }}
        </div>
    </div>
</div>