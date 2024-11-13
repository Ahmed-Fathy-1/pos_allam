@extends('dashboard.layouts.master')

@section('title', 'Show Contact Entry')

@section('main')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                Show Contact Entry
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

                    @can('contactUs-list')
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                            href="{{ route('contact-us.index') }}">Contact Us Entries</a>
                    @endcan

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li>Show Contact Entry</li>
            </ul>
        </div>

        <div class="grid grid-cols-12 lg:gap-6">
            <div class="col-span-12 pt-6 lg:col-span-12 lg:pb-6">
                <div class="card p-4 lg:p-6">
                    <div class="col-xs-12 mb-3">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <label class="badge badge-secondary text-dark">{{ $contact->name }}</label>
                        </div>
                    </div>

                    <div class="col-xs-12 mb-3">
                        <div class="form-group">
                            <strong>Email:</strong>
                            <label class="badge badge-secondary text-dark">{{ $contact->email }}</label>
                        </div>
                    </div>

                    <div class="col-xs-12 mb-3">
                        <div class="form-group">
                            <strong>Phone:</strong>
                            <label class="badge badge-secondary text-dark">{{ $contact->phone ?? 'N/A' }}</label>
                        </div>
                    </div>

                    <div class="col-xs-12 mb-3">
                        <div class="form-group">
                            <strong>Subject:</strong>
                            <label class="badge badge-secondary text-dark">{{ $contact->subject }}</label>
                        </div>
                    </div>

                    <div class="col-xs-12 mb-3">
                        <div class="form-group">
                            <strong>Message:</strong>
                            <label class="badge badge-secondary text-dark">{{ $contact->message }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
