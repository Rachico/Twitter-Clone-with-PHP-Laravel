<x-app>
    <div>
        @foreach($users as $user)
            <a href="{{ $user->path() }}" class="flex items-center mb-4">
                <img
                    src="{{ $user->getAvatar() }} "
                    alt="{{$user->name}}"
                    width="50"
                    height="50"
                    class="mr-4 rounded-full"
                >

                <div>
                    <h4 class="font-bold">{{'@' . $user->username }}</h4>
                </div>

            </a>
        @endforeach

        {{ $users->links() }}
    </div>
</x-app>
