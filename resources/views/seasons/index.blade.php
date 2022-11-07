<x-layout title="Seasons from {!! $series->name !!}">
    <div class="d-flex justify-content-center">
        <img
            src="{{ asset('storage/'.$series->cover_path) }}"
            alt="Series Cover"
            class="img-fluid"
            style="height: 400px">
    </div>

    <ul class="list-group">
        @foreach ($seasons as $season)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('episodes.index', $season->id) }}">
                    Season {{ $season->number }}
                </a>
                <span class="badge bg-secondary">
                    {{ $season->numberOfWatchedEpisodes() }} / {{ $season->episodes->count()}}
                </span>
            </li>

        @endforeach
    </ul>
</x-layout>
