@extends('dashboard.layouts.master')

@section('title', 'Create FAQ')

@section('main')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                Create New FAQ
            </h2>
            <div class="hidden h-full py-1 sm:flex">
                <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
            </div>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li class="flex items-center space-x-2">
                    <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                        href="{{ route('homePage') }}">Home</a>
                </li>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
                <li class="flex items-center space-x-2">

                    @can('faqs-list')
                        <a href="{{ route('faqs.index') }}"
                            class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent">
                            FAQs
                        </a>
                    @endcan
                </li>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
                <li>Create New FAQ</li>
            </ul>
        </div>

        <div class="col-span-12 grid lg:col-span-12">
            <div class="card">
                <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                    <div class="flex items-center space-x-2">
                        <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-1 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                            <i class="fa-solid fa-circle-plus"></i>
                        </div>
                        <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                            FAQ Details
                        </h4>
                    </div>
                </div>
                @can('faqs-create')
                    <form action="{{ route('faqs.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4 p-4 sm:p-5">

                        <label class="block">
                            <span>Question</span>
                            <input type="text" name="question"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter the question" required>
                        </label>
                        @error('question')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>Answer</span>
                            <textarea name="answer" rows="4"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter the answer" required></textarea>
                        </label>
                        @error('answer')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('faqs.index') }}"
                                class="btn bg-gray-500 text-white hover:bg-gray-600 focus:bg-gray-600 dark:bg-gray-700 dark:hover:bg-gray-800 dark:focus:bg-gray-800">
                                Cancel
                            </a>
                            <button type="submit"
                                class="btn bg-primary text-white hover:bg-primary-focus focus:bg-primary-focus dark:bg-primary dark:hover:bg-primary-focus dark:focus:bg-primary-focus">
                                Create FAQ
                            </button>
                        </div>
                    </div>
                </form>
                @endcan
            </div>
        </div>
    </main>
@endsection
