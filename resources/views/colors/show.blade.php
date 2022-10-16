<x-master>
    <x-slot:title>
        Color Details
    </x-slot:title>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Color Details</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Export PDF</button>
            </div>
            <a href="{{ route('colors.index') }}">
                <button type="button" class="btn btn-sm btn-outline-primary">
                    <span data-feather="list"></span>
                    List
                </button>
            </a>
        </div>
    </div>

    <h1>Title: {{ $color->color }}</h1>
    <!-- <h1>Price: {{ $color->price }}</h1>
    <p>Description: {!! $color->description !!}</p>
    <p>Is Active?: {{ $color->is_active ? 'Yes' : 'No' }} </p> -->
    <img src="{{ asset('storage/colors/'.$color->image) }}" height="250" />


</x-master>
