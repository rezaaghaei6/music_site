@extends('layouts.admin')

@section('title', 'افزودن موزیک جدید')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-gray-700 text-3xl font-medium">افزودن موزیک جدید</h3>
        <a href="{{ route('admin.songs.index') }}" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <i class="fas fa-arrow-right ml-2"></i>
            <span>بازگشت</span>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.songs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block mb-1 font-medium text-gray-700">عنوان موزیک *</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                        class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300 focus:outline-none">
                </div>
                
                <div>
                    <label for="artist_id" class="block mb-1 font-medium text-gray-700">هنرمند *</label>
                    <select id="artist_id" name="artist_id" required
                        class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300 focus:outline-none">
                        <option value="">انتخاب کنید</option>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}" {{ old('artist_id') == $artist->id ? 'selected' : '' }}>
                                {{ $artist->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="album_id" class="block mb-1 font-medium text-gray-700">آلبوم</label>
                    <select id="album_id" name="album_id"
                        class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300 focus:outline-none">
                        <option value="">انتخاب کنید</option>
                        @foreach($albums as $album)
                            <option value="{{ $album->id }}" {{ old('album_id') == $album->id ? 'selected' : '' }}>
                                {{ $album->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="genre_id" class="block mb-1 font-medium text-gray-700">ژانر *</label>
                    <select id="genre_id" name="genre_id" required
                        class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300 focus:outline-none">
                        <option value="">انتخاب کنید</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('genre_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="release_date" class="block mb-1 font-medium text-gray-700">تاریخ انتشار</label>
                    <input type="date" id="release_date" name="release_date" value="{{ old('release_date') }}"
                        class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300 focus:outline-none">
                </div>
                
                <div>
                    <label for="duration" class="block mb-1 font-medium text-gray-700">مدت زمان</label>
                    <input type="text" id="duration" name="duration" value="{{ old('duration') }}"
                        class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300 focus:outline-none"
                        placeholder="مثال: 03:45">
                </div>
            </div>
            
            <div class="mt-6">
                <label class="block mb-1 font-medium text-gray-700">فایل موزیک *</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center" id="upload-area">
                    <input type="file" id="audio_file" name="audio_file" accept="audio/*" class="hidden">
                    <input type="hidden" name="file_path" id="file_path">
                    
                    <div class="space-y-2">
                        <i class="fas fa-music text-4xl text-gray-400"></i>
                        <p class="text-gray-600">فایل موزیک را اینجا بکشید یا کلیک کنید</p>
                        <p class="text-sm text-gray-500">فرمت‌های مجاز: MP3, WAV (حداکثر 10 مگابایت)</p>
                    </div>
                    
                    <div id="upload-progress" class="mt-4 hidden">
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">در حال آپلود... <span class="progress-text">0%</span></p>
                    </div>
                </div>
            </div>
            
            <div class="mt-6">
                <label class="block mb-1 font-medium text-gray-700">تصویر کاور</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center" id="cover-upload-area">
                    <input type="file" id="cover_image" name="cover_image" accept="image/*" class="hidden">
                    <input type="hidden" name="cover_path" id="cover_path">
                    
                    <div class="space-y-2">
                        <i class="fas fa-image text-4xl text-gray-400"></i>
                        <p class="text-gray-600">تصویر کاور را اینجا بکشید یا کلیک کنید</p>
                        <p class="text-sm text-gray-500">فرمت‌های مجاز: JPG, PNG (حداکثر 2 مگابایت)</p>
                    </div>
                    
                    <div id="cover-preview" class="mt-4 hidden">
                        <img src="" alt="Cover Preview" class="mx-auto max-h-40 rounded">
                    </div>
                </div>
            </div>
            
            <div class="mt-6">
                <label for="lyrics" class="block mb-1 font-medium text-gray-700">متن موزیک</label>
                <textarea id="lyrics" name="lyrics" rows="6"
                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300 focus:outline-none">{{ old('lyrics') }}</textarea>
            </div>
            
            <div class="mt-6 space-y-4">
                <div class="flex items-center">
                    <input type="checkbox" id="is_featured" name="is_featured" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" {{ old('is_featured') ? 'checked' : '' }}>
                    <label for="is_featured" class="mr-2 text-gray-700">نمایش در بخش ویژه</label>
                </div>
                
                <div class="flex items-center">
                    <input type="checkbox" id="is_active" name="is_active" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label for="is_active" class="mr-2 text-gray-700">فعال</label>
                </div>
            </div>
            
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <i class="fas fa-save ml-2"></i>
                    <span>ذخیره موزیک</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // اسکریپت‌های مربوط به آپلود فایل
    document.addEventListener('DOMContentLoaded', function() {
        const uploadArea = document.getElementById('upload-area');
        const audioInput = document.getElementById('audio_file');
        const filePathInput = document.getElementById('file_path');
        const progressBar = document.querySelector('#upload-progress .bg-blue-600');
        const progressText = document.querySelector('#upload-progress .progress-text');
        const uploadProgress = document.getElementById('upload-progress');
        
        // تنظیم drag & drop برای فایل موزیک
        uploadArea.addEventListener('click', () => audioInput.click());
        uploadArea.addEventListener('dragover', e => {
            e.preventDefault();
            uploadArea.classList.add('border-blue-500');
        });
        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('border-blue-500');
        });
        uploadArea.addEventListener('drop', e => {
            e.preventDefault();
            uploadArea.classList.remove('border-blue-500');
            if (e.dataTransfer.files.length) {
                audioInput.files = e.dataTransfer.files;
                handleFileUpload(e.dataTransfer.files[0]);
            }
        });
        
        audioInput.addEventListener('change', e => {
            if (e.target.files.length) {
                handleFileUpload(e.target.files[0]);
            }
        });
        
        function handleFileUpload(file) {
            // بررسی نوع و حجم فایل
            if (!file.type.startsWith('audio/')) {
                alert('لطفاً یک فایل صوتی معتبر انتخاب کنید.');
                return;
            }
            
            if (file.size > 10 * 1024 * 1024) {
                alert('حجم فایل نباید بیشتر از 10 مگابایت باشد.');
                return;
            }
            
            // نمایش پیشرفت آپلود
            uploadProgress.classList.remove('hidden');
            
            const formData = new FormData();
            formData.append('audio', file);
            
            // ارسال درخواست آپلود
            fetch('/admin/songs/upload-audio', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    filePathInput.value = data.path;
                    uploadArea.querySelector('p').textContent = 'فایل با موفقیت آپلود شد: ' + file.name;
                    // دریافت مدت زمان موزیک
                    fetch('/admin/songs/get-audio-info', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ file_path: data.path })
                    })
                    .then(response => response.json())
                    .then(info => {
                        if (info.success) {
                            document.getElementById('duration').value = info.duration;
                        }
                    });
                } else {
                    alert('خطا در آپلود فایل: ' + data.error);
                }
            })
            .catch(error => {
                alert('خطا در آپلود فایل');
                console.error(error);
            })
            .finally(() => {
                uploadProgress.classList.add('hidden');
            });
        }
        
        // تنظیمات آپلود تصویر کاور
        const coverUploadArea = document.getElementById('cover-upload-area');
        const coverInput = document.getElementById('cover_image');
        const coverPathInput = document.getElementById('cover_path');
        const coverPreview = document.getElementById('cover-preview');
        const coverPreviewImg = coverPreview.querySelector('img');
        
        coverUploadArea.addEventListener('click', () => coverInput.click());
        coverUploadArea.addEventListener('dragover', e => {
            e.preventDefault();
            coverUploadArea.classList.add('border-blue-500');
        });
        coverUploadArea.addEventListener('dragleave', () => {
            coverUploadArea.classList.remove('border-blue-500');
        });
        coverUploadArea.addEventListener('drop', e => {
            e.preventDefault();
            coverUploadArea.classList.remove('border-blue-500');
            if (e.dataTransfer.files.length) {
                coverInput.files = e.dataTransfer.files;
                handleCoverUpload(e.dataTransfer.files[0]);
            }
        });
        
        coverInput.addEventListener('change', e => {
            if (e.target.files.length) {
                handleCoverUpload(e.target.files[0]);
            }
        });
        
        function handleCoverUpload(file) {
            // بررسی نوع و حجم فایل
            if (!file.type.startsWith('image/')) {
                alert('لطفاً یک تصویر معتبر انتخاب کنید.');
                return;
            }
            
            if (file.size > 2 * 1024 * 1024) {
                alert('حجم تصویر نباید بیشتر از 2 مگابایت باشد.');
                return;
            }
            
            const formData = new FormData();
            formData.append('cover', file);
            
            // ارسال درخواست آپلود
            fetch('/admin/songs/upload-cover', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    coverPathInput.value = data.path;
                    coverPreviewImg.src = data.url;
                    coverPreview.classList.remove('hidden');
                } else {
                    alert('خطا در آپلود تصویر: ' + data.error);
                }
            })
            .catch(error => {
                alert('خطا در آپلود تصویر');
                console.error(error);
            });
        }
    });
</script>
@endsection