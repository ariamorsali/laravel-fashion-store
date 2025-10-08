<option value="{{ $category->id }}" 
    @if (old('category_id', $product->category_id ?? '') == $category->id) selected @endif>
    {{ $prefix . $category->name }}
</option>

@if ($category->children && $category->children->count())
    @foreach ($category->children as $child)
        @include('admin.market.product.partials.category-option', [
            'category' => $child,
            'prefix' => $prefix . '» '
        ])
    @endforeach
@endif
