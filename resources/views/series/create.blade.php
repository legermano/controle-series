<x-layout title="New Series">
    <form action="{{ route('series.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-8">
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text"
                           autofocus
                           id="name"
                           name="name"
                           class="form-control"
                           value="{{ old('name') }}"
                    />
                </div>
            </div>
            <div class="col-2">
                <div class="mb-3">
                    <label for="seasonsQty" class="form-label">Seasons Quantity:</label>
                    <input type="text"
                           id="seasonsQty"
                           name="seasonsQty"
                           class="form-control"
                           value="{{ old('seasonsQty') }}"
                    />
                </div>
            </div>
            <div class="col-2">
                <div class="mb-3">
                    <label for="episodesPerSeason" class="form-label">Episodes Per Season:</label>
                    <input type="text"
                           id="episodesPerSeason"
                           name="episodesPerSeason"
                           class="form-control"
                           value="{{ old('episodesPerSeason') }}"
                    />
                </div>
            </div>
        </div>


        <div class="row mb-3">
            <div class="col-12">
                <label for="cover" class="form-label"></label>
                <input type="file" name="cover" id="cover" class="form-control" accept="image/gif, image/jpeg, image/png">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
    </form>

</x-layout>
