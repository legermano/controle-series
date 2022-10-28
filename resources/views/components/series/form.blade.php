<form action="{{ $action }}" method="post" >
    @csrf
    @if($update)
        @method('PUT')
    @endif
    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text"
               id="name"
               name="name"
               class="form-control"
               @isset($name) value="{{ $name }}" @endisset
        />
    </div>
    <button type="submit" class="btn btn-primary">Add</button>
</form>
