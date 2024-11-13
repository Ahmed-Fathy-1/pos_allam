@extends('dashboard.layouts.master')

@section('title', 'Show user')

@push('style')
@endpush

@section('main')

    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                Show user
            </h2>
            <div class="hidden h-full py-1 sm:flex">
                <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
            </div>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li class="flex items-center space-x-2">
                    <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                        href="{{ route('homePage') }}">home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li class="flex items-center space-x-2">
                    @can('User-list')
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                            href="{{ route('users.index') }}">users cards</a>
                    @endcan
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li>Show user</li>
            </ul>
        </div>
        <div class="grid grid-cols-12 lg:gap-6">
            <div class="col-span-12 pt-6 lg:col-span-12 lg:pb-6">
                <div class="card p-4 lg:p-6">

                    <!-- Blog Post -->
                    {{-- <div class="mt-6 font-inter text-base text-slate-600 dark:text-navy-200">
                        <h1 class="text-xl font-medium text-slate-900 dark:text-navy-50 lg:text-2xl">
                        </h1>
                        <img class="mt-5 h-80 w-100 rounded-lg object-cover object-center"
                            src="{{ $users->imageWithFullPath }}" alt="image">
                    </div> --}}

                    <div class="col-xs-12 mb-3">
                        <div class="form-group">
                            <strong>Photo:</strong>
                            <img class="w-20 h-20" src="{{ asset('storage/uploads/images/users/'.$users->image) }}" alt="img">

                        </div>
                    </div>

                    <div class="col-xs-12 mb-3">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <label class="badge badge-secondary text-dark"> {{ $users->name }}</label>
                        </div>
                    </div>

                    <div class="col-xs-12 mb-3">
                        <div class="form-group">
                            <strong>Email:</strong>
                            <label class="badge badge-secondary text-dark"> {{ $users->email }}</label>
                        </div>
                    </div>

                    <div class="col-xs-12 mb-3">
                        <div class="form-group">
                            <strong>Roles:</strong>
                            @if (!empty($users->getRoleNames()))
                                @foreach ($users->getRoleNames() as $v)
                                    <label class="badge badge-secondary text-dark">{{ $v }}</label>
                                @endforeach
                            @endif
                        </div>
                    </div>


                </div>


            </div>

        </div>
    </main>

@endsection
@push('scripts')
@endpush
