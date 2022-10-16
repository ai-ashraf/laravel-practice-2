<x-master>
    <x-slot:title>
        Brand Edit
    </x-slot:title>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Brand Edit</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Export PDF</button>
            </div>
            <a href="{{ route('brands.index') }}">
                <button type="button" class="btn btn-sm btn-outline-primary">
                    <span data-feather="list"></span>
                    List
                </button>
            </a>
        </div>
    </div>

    <x-forms.errors />

    <form action="{{ route('brands.update', $brand->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <x-forms.input type="text" name="brand" label="Color" :value="old('brand', $brand->brand)" required placeholder="Enter name" />





        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</x-master>
