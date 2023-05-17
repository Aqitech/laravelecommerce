<x-app-layout>
    @section('title')
    {{ $title }}
    @endsection
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 mb-4 p-6">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="product_name">
                        Product Name
                    </label>
                    <input class="bg-gray-50 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="product_name" name="product_name" type="text" placeholder="Product Name" value="{{ $product->name }}">
                    @if ($errors->has('product_name'))
                        <div class="text-red-500">{{ $errors->first('product_name') }}</div>
                    @endif
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="product_image">
                        Product Image
                    </label>
                    <input class="bg-gray-50 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="product_image" name="product_image" type="file" placeholder="Product Image" value="{{ $product->image }}">
                    <img src="{{ url('uploads/products/'.$product->image) }}" alt="{{ $product->name }}" width="70" height="70">
                    @if ($errors->has('product_image'))
                        <div class="text-red-500">{{ $errors->first('product_image') }}</div>
                    @endif
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="product_price">
                        Product Price
                    </label>
                    <input class="bg-gray-50 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="product_price" name="product_price" type="text" placeholder="Product Price" value="{{ $product->price }}">
                    @if ($errors->has('product_price'))
                        <div class="text-red-500">{{ $errors->first('product_price') }}</div>
                    @endif
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="product_discription">
                        Product Discription
                    </label>
                    <textarea id="product_discription" name="product_discription" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Product Discription">{{ $product->discription }}</textarea>
                    @if ($errors->has('product_discription'))
                        <div class="text-red-500">{{ $errors->first('product_discription') }}</div>
                    @endif
                </div>
                <div class="flex items-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Edit Product
                    </button>
                    <a href="{{ route('products.index') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2">Cancle</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>