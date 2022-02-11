<x-guest-layout>
    <div class="container">
        <nav class="my-5 mx-5">
            <ul>
                @foreach($categories as $category)
                    <li class="inline-block mx-1">
                        <a href="{{route('category.single', [$category->id, Str::slug($category->title)])}}" class="bg-yellow-500 text-center align-middle rounded p-3 text-xs underline hover:bg-yellow-800">{{$category->title}}</a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="grid flex m-12">
            <h2 class="text-2xl my-2">Latest Posts</h2>
            @foreach($posts as $post)
                <x-post-single :post="$post" />
                <!-- <a href="{{route('post.single', [$post->id, Str::slug($post->title)])}}" class="bg-yellow-500 text-center align-middle rounded p-3 text-xs underline hover:bg-yellow-800">{{$post->title}}</a> -->
            @endforeach

        </div>

    </div>
</x-guest-layout>
