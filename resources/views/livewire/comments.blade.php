<div class="w-full">

    <h1 class="text-3xl mb-4">Comments</h1>

    <div class="mb-2 mt-5">
        @if ($image)
        <img src="{{ $image }}" alt="image" class="w-24 border-2 shadow border-gray-200 rounded mb-2">
        @endif
        <input type="file" id="image" wire:change="$emit('fileChoosen')">
    </div>

    <form wire:submit.prevent="addComment" class="flex items-center gap-2 w-full mb-2">
        <input type="text" class="py-2 px-3 border border-gray-300 flex-1" wire:model.defer="newComment" />
        <button class="bg-blue-400 py-2 px-3 text-white">Send</button>
    </form>
    @error('newComment')
    <span class="text-red-500 font-semibold">{{ $message }}</span>
    @enderror

    @if (session()->has('message'))
    <div class="rounded border border-green-200 text-green-600 bg-green-50 p-2 px-3">{{ session('message') }}</div>
    @endif

    <div class="w-full mt-10">
        <div class="space-y-2 mb-5">
            @foreach ($comments as $comment)
            <div class="shadow-md shadow-slate-100 bg-white p-3">
                <div class="flex items-center mb-2 justify-between">
                    <div>
                        <span class="font-bold text-lg mr-2">{{ $comment->author->name }}</span>
                        <span class="text-gray-300 font-semibold">{{ $comment->created_at }}</span>
                    </div>
                    <div>
                        <button class="rounded bg-red-500 text-sm text-white font-bold py-1 px-2"
                            wire:click="remove({{ $comment->id }})">Delete</button>
                    </div>
                </div>
                <div class="text-base">{{ $comment->body }}</div>
                <div class="mb-2 mt-5">
                    @if ($comment->image)
                    <img src="{{ asset($comment->imagePath) }}" alt="image"
                        class="w-24 border-2 shadow border-gray-200 rounded mb-2">
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <div>
            {{ $comments->links('vendor.livewire.simple-tailwind') }}
        </div>
    </div>

    <script>
        window.livewire.on('fileChoosen', () => {
            const inputFile = document.getElementById('image');
            const file = inputFile.files[0];
            const reader = new FileReader();
            reader.onloadend = () => {
                window.livewire.emit('fileUpload', reader.result);
            }
            reader.readAsDataURL(file);
        })
    </script>
</div>