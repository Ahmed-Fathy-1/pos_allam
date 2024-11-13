@extends('dashboard.layouts.master')

@section('title', 'create role')

@push('style')
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
                <li class="flex items-center space-x-2">
                    @can('Role-list')
                    <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                        href="{{ route('roles.index') }}">Role List</a>
                    @endcan
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li>Store role</li>
            </ul>
        </div>
        <div>
            @include('dashboard.partials._session')
        </div>

        <div class="col-span-12 grid lg:col-span-12">
            <div class="card">
                <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                    <div class="flex items-center space-x-2">
                        <div
                            class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-1 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                            <i class="fa-solid fa-circle-plus"></i>
                        </div>
                        <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                            role
                        </h4>

                    </div>
                </div>
                @can('Role-create')
                    <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="space-y-4 p-4 sm:p-5">



                        <label class="block">
                            <span>role name </span>

                            <input name="name"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter name" type="text">
                        </label>
                        @error('name')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror
                        <br>

                          <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Permission:</strong>
                                <br />
                                @foreach ($permission as $value)
                                    <label>
                                        <input type="checkbox" name="permission[]" value="{{ $value->id }}" class="name">
                                        {{ $value->name }}</label>
                                    <br />
                                @endforeach
                            </div>
                        </div>
                        @error('permission')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                    @enderror

                        <div class="flex justify-end space-x-2">
                            <button type="submit"
                                class="btn space-x-2 bg-success font-medium text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                <span>Store</span>
                            </button>
                        </div>
                    </div>
                </form>
                @endcan
            </div>
        </div>

    </main>
@endsection

@push('scripts')
@endpush
