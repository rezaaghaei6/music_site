@extends('layouts.admin')

@section('title', 'ویرایش موزیک')

@section('page-title', 'ویرایش موزیک')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.songs.update', $song) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">عنوان موزیک <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $song->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="artist_id" class="form-label">خواننده <span class="text-danger">*</span></label>
                    <select class="form-select @error('artist_id') is-invalid @enderror" id="artist_id" name="artist_id" required>
                        <option value="">انتخاب کنید</option>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}" {{ old('artist_id', $song->artist_id) == $artist->id ? 'selected' : '' }}>
                                {{ $artist->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('artist_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="album_id" class="form-label">آلبوم</label>
                    <select class="form-select @error('album_id') is-invalid @enderror" id="album_id" name="album_id">
                        <option value="">بدون آلبوم</option>
                        @foreach($albums as $album)
                            <option value="{{ $album->id }}" {{ old('album_id', $song->album_id) == $album->id ? 'selected' : '' }}>
                                {{ $album->title }} ({{ $album->artist->name ?? 'بدون خواننده' }})
                            </option>
                        @endforeach
                    </select>
                    @error('album_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="genre_id" class="form-label">ژانر</label>
                    <select class="form-select @error('genre_id') is-invalid @enderror" id="genre_id" name="genre_id">
                        <option value="">بدون ژانر</option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ old('genre_id', $song->genre_id) == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('genre_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="audio_file" class="form-label">فایل صوتی</label>
                    <input type="file" class="form-control @error('audio_file') is-invalid @enderror" id="audio_file" name="audio_file" accept=".mp3,.wav,.ogg">
                    <small class="form-text text-muted">فرمت‌های مجاز: MP3, WAV, OGG (حداکثر 20 مگابایت)</small>
                    @if($song->file_path)
                        <div class="mt-2">
                            <audio controls class="w-100">
                                <source src="{{ asset('storage/' . $song->file_path) }}" type="audio/mpeg">
                                مرورگر شما از پخش صدا پشتیبانی نمی‌کند.
                            </audio>
                        </div>
                    @endif
                    @error('audio_file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="cover" class="form-label">تصویر کاور</label>
                    <input type="file" class="form-control @error('cover') is-invalid @enderror" id="cover" name="cover" accept="image/*">
                    <small class="form-text text-muted">فرمت‌های مجاز: JPG, PNG, GIF (حداکثر 2 مگابایت)</small>
                    @if($song->cover)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $song->cover) }}" alt="{{ $song->title }}" class="img-thumbnail" style="max-height: 100px;">
                        </div>
                    @endif
                    @error('cover')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="release_date" class="form-label">تاریخ انتشار</label>
                    <input type="date" class="form-control @error('release_date') is-invalid @enderror" id="release_date" name="release_date" value="{{ old('release_date', $song->release_date ? $song->release_date->format('Y-m-d') : '') }}">
                    @error('release_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" {{ old('is_featured', $song->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">
                            نمایش در بخش ویژه
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="lyrics" class="form-label">متن آهنگ</label>
                <textarea class="form-control @error('lyrics') is-invalid @enderror" id="lyrics" name="lyrics" rows="5">{{ old('lyrics', $song->lyrics) }}</textarea>
                @error('lyrics')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">توضیحات</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $song->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">به‌روزرسانی</button>
                <a href="{{ route('admin.songs.index') }}" class="btn btn-secondary">انصراف</a>
            </div>
        </form>
    </div>
</div>
@endsection
