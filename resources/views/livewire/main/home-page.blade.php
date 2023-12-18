<div>
    <x-slot name="header">
        <div class="w-full text-center">
            <h1 class="text-2xl md:text-3xl font-bold text-center lg:text-5xl text-gray-700">
                Welcome to <span class="text-yellow-500">Shopaholic</span> <span class="text-gray-900"> News</span>
            </h1>
            <p class="text-gray-500 text-lg mt-1">Best Blog in the universe</p>

        </div>

   </x-slot>

   <main class="container mx-auto px-5 flex flex-grow">
   <div class="mb-10">
       <h2 class="mt-16 mb-5 text-3xl text-yellow-500 font-bold">Latest Posts</h2>
       <div class="w-full mb-5">
           <div class="grid grid-cols-3 gap-10 gap-y-32 w-full">
            @forelse ($posts as $post)


               <div class="md:col-span-1 col-span-3">
                   <a href="#">
                        <div>
                            <img class="w-full rounded-xl" src="{{ asset(Storage::url($post->cover)) }}">
                        </div>
                    </a>
                   <div class="mt-3">
                       <div class="flex flex-wrap items-center mb-2">
                            @foreach ($post->tags as $tag)
                                <a href="#" class="bg-red-600 text-white rounded-xl px-3 py-1 text-sm mr-3">{{ $tag->name }}</a>
                            @endforeach

                            <p class="text-gray-500 text-sm">{{ \Carbon\Carbon::make($post->created_at)->diffForHumans() }}</p>
                        </div>
                       <h3 class="text-xl font-bold text-gray-900">{{ $post->title }}</h3>
                   </div>
               </div>

            @empty
            Ho posts yet
            @endforelse
           </div>
       </div>
       <a class="mt-10 block text-center text-lg text-yellow-500 font-semibold" href="/blog">More Posts</a>
   </div>
</main>

    <x-slot name="footer">
        <x-main.footer></x-main.footer>
    </x-slot>
</div>
