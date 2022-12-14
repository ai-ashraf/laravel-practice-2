<x-master>
    <x-slot:title>
        Category Details
    </x-slot:title>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Category Details</h1>
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

    <h1>Title: {{ $category->name }}</h1>
    <p>Is Active?: {{ $category->is_active ? 'Yes' : 'No' }} </p>
    <img src="{{ asset('/app/public/categories/'.$category->image) }}" height="250" />


    {{-- @foreach ($categories as $category)
        {{$category->cname}}
            @foreach ($category->products as $product)
                {{$product->pname}}
            @foreach
    @foreach --}}


    <h3 class="fs-4 mb-3">Products</h3>
    <div class="col">

        <table class="table bg-white rounded shadow-sm  table-hover">
            <thead>
                <tr>
                    <th scope="col" width="50">#</th>
                    <th scope="col">Product Name</th>
                    {{-- <th scope="col">Color</th> --}}
                    <th scope="col">Price</th>
                    {{-- <th scope="col">Action</th> --}}

                </tr>
            </thead>
            <tbody>

                @foreach($category->product as $products)

                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $products->title }}</td>
                    {{-- <td>{{ $product->product_color }}</td> --}}
                    <td>{{ $products->price }} Tk</td>
                    {{-- <td style="display: flex">
                        <a class="btn btn-info mx-2" href="{{ route('productlist.show', $product->id) }}">Details</a>
                        <a class="btn btn-success mx-2" href="{{ route('productlist.edit', $product->id) }}">Edit</a>

                        <form action="{{ route('productlist.delete', $product->id) }}" method="post">
                            @csrf
                            @method('delete')
                        <button class="btn btn-danger mx-2" onclick="return confirm('Are You Sure Want to Delete ?')">Delete</button>

                        </form>

                    </td> --}}
                    <td></td>
                </tr>

                @endforeach

            </tbody>
        </table>


</x-master>
