@extends('layouts.admin')

@section('title', 'مدیریت آلبوم‌ها')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-gray-700 text-3xl font-medium">مدیریت آلبوم‌ها</h3>
        <a href="{{ route('admin.albums.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <i class="fas fa-plus ml-2"></i>
            <span>افزودن آلبوم</span>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-50 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-right">عنوان</th>
                    <th class="py-3 px-6 text-right">هنرمند</th>
                    <th class="py-3 px-6 text-right">تعداد موزیک‌ها</th>
                    <th class="py-3 px-6 text-center">وضعیت</th>
                    <th class="py-3 px-6 text-center">تاریخ انتشار</th>
                    <th class="py-3 px-6 text-center">عملیات</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                @forelse ($albums as $album)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-4 px-6">
                            <div class="flex items-center">
                                @if($album->cover_image)
                                    <img class="w-10 h-10 rounded object-cover ml-3" src="{{ asset('storage/' . $album->cover_image) }}" alt="{{ $album->title }}">
                                @else
                                    <div class="w-10 h-10 rounded bg-gray-200 flex items-center justify-center ml-3">
                                        <i class="fas fa-compact-disc text-gray-400"></i>
                                    </div>
                                @endif
                                <span>{{ $album->title }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6">{{ $album->artist->name ?? 'نامشخص' }}</td>
                        <td class="py-4 px-6">{{ $album->songs_count ?? 0 }}</td>
                        <td class="py-4 px-6 text-center">
                            @if($album->is_active)
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">فعال</span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">غیرفعال</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-center">
                            {{ $album->release_date ? \Carbon\Carbon::parse($album->release_date)->format('Y/m/d') : 'نامشخص' }}
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex item-center justify-center gap-2">
                                <a href="{{ route('admin.albums.edit', $album) }}" class="text-yellow-600 hover:text-yellow-900">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.albums.destroy', $album) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('آیا از حذف این آلبوم اطمینان دارید؟')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 px-6 text-center text-gray-500">
                            هیچ آلبومی یافت نشد.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $albums->links() }}
    </div>
</div>
@endsection