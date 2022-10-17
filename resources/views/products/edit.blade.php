<x-master>
    <x-slot:title>
        Product Edit
    </x-slot:title>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Product Edit</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Export PDF</button>
            </div>
            <a href="{{ route('categories.index') }}">
                <button type="button" class="btn btn-sm btn-outline-primary">
                    <span data-feather="list"></span>
                    List
                </button>
            </a>
        </div>
    </div>

    <x-forms.errors />

    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <x-forms.select name="category_id" label="Category" :options="$categories" :selected="old('category_id', $product->category_id)" required/>
        <x-forms.input type="text" name="title" label="Title" :value="old('title', $product->title)" required placeholder="Enter name" />
        <x-forms.input type="number" name="price" label="Price" :value="old('price', $product->price)" required placeholder="Enter name" />
        <x-forms.select name="brand_id" label="Brand" :options="$brands" :selected="old('brand_id', $product->brand_id)" required/>
        <img src="{{ asset('storage/products/'.$product->image) }}" height="250" />

        <x-forms.input type="file" name="image" label="Image"/>
        <x-forms.textarea name="description" label="Description" :value="old('description', $product->description)"/>
        <x-forms.checkbox name="colors[]" :checklist="$colors" :checkedItems="$selectedColors" label="Colors"/>
        <x-forms.checkbox name="size[]" :checklist="$sizes" :checkedItems="$selectedSize" label="Size"/>


        <div class="mb-3 form-check">
            <input 
            name="is_active" 
            type="checkbox" 
            class="form-check-input" 
            id="isActiveInput"
            @if($product->is_active) checked @endif
            >
            <label class="form-check-label" for="isActiveInput">Is Active ?</label>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</x-master>