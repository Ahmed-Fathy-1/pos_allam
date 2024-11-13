@extends('dashboard.layouts.master')

@section('title', 'Edit Technology')

@section('main')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                Edit Technology
            </h2>
            <div class="hidden h-full py-1 sm:flex">
                <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
            </div>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li>
                    @can('technologies-list')
                        <a href="{{ route('technologies.index') }}"
                            class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent">
                            Technologies
                        </a>
                    @endcan
                </li>
            </ul>
        </div>
        <div>
            @include('dashboard.partials._session')
        </div>
        <div class="card">
            <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                    Edit Technology
                </h4>
            </div>

            <div class="p-4 sm:p-5">
                @can('technologies-edit')
                    <form action="{{ route('technologies.update', $tech->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-slate-700 dark:text-navy-100">Technology Name</label>
                        <input type="text" name="name" id="name" value="{{ $tech->name }}" class="mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" required placeholder="Enter technology name">
                        @error('name')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                    @enderror
                    </div>


                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-slate-700 dark:text-navy-100">Technology Image</label>
                        <input type="file" name="image" id="image" class="mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                        <small class="text-slate-500 dark:text-navy-100">Leave empty if you do not want to change the image.</small>
                        @if($tech->image)
                            <div class="mt-2">
                                <img src="{{ $tech->imageWithFullPath }}" alt="Technology Image" class="h-32 w-32 object-cover">
                            </div>
                        @endif
                    </div>
                    @error('image')
                    <span class="text-tiny+ text-error">{{ $message }}</span>
                @enderror

                    <div class="flex items-center justify-end">
                        <a href="{{ route('technologies.index') }}" class="btn bg-gray-500 text-white hover:bg-gray-600 focus:bg-gray-600 dark:bg-gray-700 dark:hover:bg-gray-800 dark:focus:bg-gray-800 mr-2">Cancel</a>
                        <button type="submit" class="btn bg-primary text-white hover:bg-primary-focus focus:bg-primary-focus dark:bg-primary dark:hover:bg-primary-focus dark:focus:bg-primary-focus">Update Technology</button>
                    </div>
                </form>
                @endcan
            </div>
        </div>
    </main>
@endsection
