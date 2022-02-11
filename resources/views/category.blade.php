<x-guest-layout>
    <div class="container">
        <div class="grid flex m-12">
            <h2 class="text-2xl my-2">Posts in {{$category->title}}</h2>
            @forelse($posts as $post)
                <x-post-single :post="$post" />
            @empty
                <article class="text-left">No posts found</article>

            @endforelse

            {{$posts->links()}}
        </div>

    </div>
</x-guest-layout>
