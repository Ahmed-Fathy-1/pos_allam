@extends('dashboard.layouts.master')

@section('title', 'Create Technology')

@section('main')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                Technologies
            </h2>
            <div class="hidden h-full py-1 sm:flex">
                <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
            </div>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li>
                    <a href="{{ route('homePage') }}"
                        class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent">
                        Home >
                    </a>
                    @can('technologies-list')
                        <a href="{{ route('technologies.index') }}"
                            class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent">
                            Technologies >
                        </a>
                    @endcan
                     <a>
                        Technologies Create
                     </a>
                </li>

            </ul>
        </div>

        <div class="card shadow-lg rounded-lg bg-gradient-to-r from-indigo-100 to-indigo-50 dark:from-navy-700 dark:to-navy-800">


            <div class="p-6 bg-white dark:bg-navy-700 rounded-b-lg">
                @can('technologies-create')
                    <form action="{{ route('technologies.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-semibold text-slate-800 dark:text-navy-50 mb-2">Technology Name</label>
                        <input type="text" name="name" id="name"
                               class="w-full p-3 bg-slate-50 border border-slate-300 rounded-lg shadow-sm dark:bg-navy-800 dark:border-navy-600 dark:text-navy-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition ease-in-out"
                               placeholder="Enter technology name" required>
                    </div>

                    <div class="mt-6 mb-6">
                        <label for="image" class="block text-sm font-semibold text-slate-800 dark:text-navy-50 mb-2">Technology Image</label>
                        <input type="file" name="image" id="image"
                               class="w-full p-3 bg-slate-50 border border-slate-300 rounded-lg shadow-sm dark:bg-navy-800 dark:border-navy-600 dark:text-navy-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition ease-in-out">
                    </div>

                    <!-- Buttons Aligned to the Left -->
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center justify-start space-x-4 mt-6">
                            <button type="submit"
                                    class="px-5 py-2 rounded-lg bg-primary text-white hover:bg-primary-focus focus:bg-primary-focus dark:bg-primary dark:hover:bg-primary-focus dark:focus:bg-primary-focus font-medium transition-all shadow-md ml-auto">
                                Create Technology
                            </button>
                        </div>
                    </div>
                </form>
                @endcan
            </div>
        </div>
    </main>
@endsection

