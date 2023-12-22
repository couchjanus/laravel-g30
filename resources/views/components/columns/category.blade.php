@props([
    'value'
])

<div>
    {{ App\Models\Category::find($value)->name }}
</div>
