@extends('layouts.app')

@section('title', 'دسته‌بندی‌ها')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">دسته‌بندی‌های موسیقی</h1>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($categories as $category)
            <a href="{{ route('category.show', $category->slug) }}" class="card-hover block relative overflow-hidden rounded-lg h-48 bg-gradient-to-br from-primary-500 to-secondary-500">
                <div class="absolute inset-0 flex flex-col items-center justify-center text-white p-4">
                    <h3 class="text-2xl font-bold mb-2">{{ $category->name }}</h3>
                    <p class="text-sm opacity-80 text-center">{{ $category->songs_count }} موزیک</p>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection