@extends('dashboard.layouts.master')

@section('title', 'Deleted Users')

@section('main')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">Deleted Users</h2>
            @can('User-list')
                <a href="{{ route('users.index') }}" class="ml-auto btn bg-primary text-white">Return to Users</a>
            @endcan
        </div>

        <div class="card">
            <div class="p-4 sm:p-5">
                @if($users->count() > 0)
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-navy-500">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Email</th>
                                <!-- Optional placeholder image column -->
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Image</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-4">{{ $user->id }}</td>
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        <img src="{{ asset('images/default-user.png') }}" alt="Default Image" class="w-10 h-10 rounded-full">
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <!-- Restore Button -->
                                            @can('User-restore')
                                                <form action="{{ route('users.restore', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to restore this user?');">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                    class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                                                    <i class="fa fa-refresh"></i></button>
                                                 </form>
                                            @endcan

                                            <!-- Permanent Delete Button -->
                                            @can('User-forceDelete')
                                                <form action="{{ route('users.forceDelete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this user?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                    class="mx-2 btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90 btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                                        <i class="fa fa-trash-alt"></i></button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $users->links('vendor.pagination.mados-ui') }}
                    </div>
                @else
                    <p class="text-center text-slate-600 dark:text-navy-200">No deleted users found.</p>
                @endif
            </div>
        </div>
    </main>
@endsection
