@extends('layouts.admin')

@section('title', 'افزودن آلبوم جدید')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-gray-700 text-3xl font-medium">افزودن آلبوم جدید</h3>
        <a href="{{ route('admin.albums.index') }}" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <i class="fas fa-arrow-right ml-2"></i>
            <span>بازگشت</span>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.albums.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-700">
                        عنوان آلبوم *
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="artist_id" class="block mb-2 text-sm font-medium text-gray-700">
                        هنرمند *
                    </label>
                    <select name="artist_id" id="artist_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('artist_id') border-red-500 @enderror">
                        <option value="">انتخاب کنید</option>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}" {{ old('artist_id') == $artist->id ? 'selected' : '' }}>
                                {{ $artist->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('artist_id')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="release_date" class="block mb-2 text-sm font-medium text-gray-700">
                        تاریخ انتشار
                    </label>
                    <input type="date" name="release_date" id="release_date" value="{{ old('release_date') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('release_date') border-red-500 @enderror">
                    @error('release_date')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    تصویر کاور
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md"
                    id="cover-drop-zone">
                    <div class="space-y-1 text-center">
                        <div class="flex text-sm text-gray-600">
                            <label for="cover_image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>آپلود فایل</span>
                                <input id="cover_image" name="cover_image" type="file" class="sr-only" accept="image/*">
                            </label>
                            <p class="pr-1">یا فایل را اینجا بکشید و رها کنید</p>
                        </div>
                        <p class="text-xs text-gray-500">
                            PNG, JPG تا 2MB
                        </p>
                        <div id="cover-preview" class="mt-4 hidden">
                            <img src="" alt="پیش‌نمایش" class="mx-auto h-32 w-32 object-cover rounded-lg">
                        </div>
                    </div>
                </div>
                @error('cover_image')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-700">
                    توضیحات
                </label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 space-y-4">
                <div class="flex items-center">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" 
                        {{ old('is_featured') ? 'checked' : '' }}
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_featured" class="mr-2 block text-sm text-gray-700">
                        نمایش در بخش ویژه
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" id="is_active" value="1" 
                        {{ old('is_active', true) ? 'checked' : '' }}
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_active" class="mr-2 block text-sm text-gray-700">
                        فعال
                    </label>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <i class="fas fa-save ml-2"></i>
                    <span>ذخیره آلبوم</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // پیش‌نمایش تصویر کاور
    const coverInput = document.getElementById('cover_image');
    const coverPreview = document.getElementById('cover-preview');
    const coverDropZone = document.getElementById('cover-drop-zone');
    const previewImage = coverPreview.querySelector('img');

    function handleCoverFile(file) {
        if (!file.type.startsWith('image/')) {
            alert('لطفاً یک فایل تصویر معتبر انتخاب کنید.');
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('حجم فایل نباید بیشتر از 2 مگابایت باشد.');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            coverPreview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }

    coverInput.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            handleCoverFile(this.files[0]);
        }
    });

    // Drag & Drop functionality
    coverDropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.classList.add('border-blue-500');
    });

    coverDropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.classList.remove('border-blue-500');
    });

    coverDropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.classList.remove('border-blue-500');

        const dt = e.dataTransfer;
        const file = dt.files[0];

        if (file) {
            handleCoverFile(file);
            coverInput.files = dt.files;
        }
    });
</script>
@endsection