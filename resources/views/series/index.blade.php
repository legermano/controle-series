<x-layout title="Serie" :success-message="$successMessage">
    @auth
        <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Add new serie</a>
    @endauth

    <ul class="list-group">
        @foreach ($series as $s)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                @auth <a href="{{ route('seasons.index', $s->id) }}"> @endauth
                    {{ $s->name }}
                @auth </a> @endauth
                @auth
                <span class="d-flex">
                    <a href="{{ route('series.edit', $s->id)}}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('series.destroy', $s->id) }}" method="post" class="ms-2">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            X
                        </button>
                    </form>
                </span>
                @endauth
            </li>

        @endforeach
    </ul>
</x-layout>
