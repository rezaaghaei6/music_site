@extends('layouts.admin')

@section('title', 'مدیریت کاربران')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">مدیریت کاربران</h1>
        <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">افزودن کاربر جدید</a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="py-3 px-4 text-right">#</th>
                    <th class="py-3 px-4 text-right">نام</th>
                    <th class="py-3 px-4 text-right">ایمیل</th>
                    <th class="py-3 px-4 text-right">نقش</th>
                    <th class="py-3 px-4 text-right">تاریخ عضویت</th>
                    <th class="py-3 px-4 text-right">عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-t hover:bg-gray-50">
                    <td class="py-3 px-4">{{ $user->id }}</td>
                    <td class="py-3 px-4">{{ $user->name }}</td>
                    <td class="py-3 px-4">{{ $user->email }}</td>
                    <td class="py-3 px-4">
                        @if($user->is_admin)
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">مدیر</span>
                        @else
                            <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs">کاربر عادی</span>
                        @endif
                    </td>
                    <td class="py-3 px-4">{{ $user->created_at->format('Y/m/d') }}</td>
                    <td class="py-3 px-4">
                        <div class="flex space-x-2 space-x-reverse">
                            <a href="#" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="#" method="POST" onsubmit="return confirm('آیا از حذف این کاربر اطمینان دارید؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
