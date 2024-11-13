@extends('dashboard.layouts.master')

@section('title', 'Users')

@push('style')
    <script src="{{ asset('SuperAdmin/assets/js/pages/components-modal.js') }}" defer=""></script>
@endpush

@section('main')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                AiTech
            </h2>
            <div class="hidden h-full py-1 sm:flex">
                <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
            </div>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li class="flex items-center space-x-2">
                    <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                        href="{{ route('homePage') }}">Home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li>Users List</li>
            </ul>
        </div>

        <div>
            @include('dashboard.partials._session')
        </div>

        <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
            <!-- Table With Filter -->
            <div id="table-filter">
                <div class="ac js-enabled" id="ac-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                            Table of Users
                        </h2>






                    </div>
                    <div class="flex space-x-2">

                        @can('User-create')
                            <a href="{{ route('users.create') }}"
                                class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                        @endcan

                            <i class="fa-solid fa-plus"></i>
                            <span>Add User</span>
                        </a>

                        <!-- View Deleted Users Button -->
                        @can('User-forceDelete')
                            <a href="{{ route('users.trashed') }}"
                                class="btn space-x-2 bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90 dark:bg-error dark:hover:bg-error-focus dark:focus:bg-error-focus dark:active:bg-error/90">
                                <i class="fa-solid fa-trash"></i>
                                <span>View Deleted Users</span>
                            </a>
                        @endcan

                    </div>
                    <!-- User Table -->
                    <div class="card mt-3">
                        <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                            <table class="is-hoverable w-full text-left">
                                <!-- Table Headers -->
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">#</th>
                                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Name</th>
                                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Email</th>
                                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Image</th>
                                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Roles</th>
                                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $loop->iteration }}</td>
                                            <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">{{ $user->name }}</td>
                                            <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">{{ $user->email }}</td>
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                <div class="avatar flex h-10 w-10">
                                                    <img class="w-20 h-20" src="{{ asset('storage/uploads/images/users/'.$user->image) }}" alt="img">
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                                @if (!empty($user->getRoleNames()))
                                                    @foreach ($user->getRoleNames() as $role)
                                                        <label class="badge badge-secondary text-dark">{{ $role }}</label>
                                                    @endforeach

                                                @endif
                                            </td>
                                            <td data-column-id="actions" class="gridjs-td">
                                                <span>
                                                    <div class="flex space-x-2">
                                                        @can('User-list')
                                                            <a href="{{ route('users.show', $user->id) }}"
                                                                class="btn h-8 w-8 p-0 text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25">
                                                                <i class="fa-regular fa-eye"></i>
                                                            </a>
                                                        @endcan

                                                        @can('User-edit')
                                                            <a href="{{ route('users.edit', $user->id) }}"
                                                                class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        @endcan



                                                        @can('User-delete')
                                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                class="mx-2 btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90 btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                                                    <i class="fa fa-trash-alt"></i></button>
                                                            </form>
                                                        @endcan

                                                    </div>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="flex flex-col justify-between space-y-4 px-4 py-4 sm:items-center sm:space-y-0 sm:px-5">
                            {{ $users->links('vendor.pagination.mados-ui') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
