@extends('dashboard.layouts.master')

@section('title', 'Feedbacks')

@section('main')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                Feedbacks
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
                    <a>
                    Feedbacks
                </a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                    Feedback List
                </h4>
                @can('feedbacks-delete')
                    <a class="btn bg-error text-white hover:bg-error-focus focus:bg-error-focus dark:bg-error dark:hover:bg-error-focus dark:focus:bg-error-focus"
                    href="{{ route('feedbacks.trashedFeedbacks') }}"> View Deleted Feedbacks</a>
                @endcan
            </div>

            <div class="p-4 sm:p-5">
                <table class="min-w-full divide-y divide-slate-200 dark:divide-navy-500">
                    <thead class="bg-slate-50 dark:bg-navy-600">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider dark:text-navy-200">
                                ID</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider dark:text-navy-200">
                                Name</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider dark:text-navy-200">
                                Email</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider dark:text-navy-200">
                                Feedback</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider dark:text-navy-200">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200 dark:bg-navy-700 dark:divide-navy-600">
                        @foreach ($feedbacks as $feedback)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-slate-900 dark:text-navy-50">
                                    {{ $feedback->id }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100">{{ $feedback->name }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100">{{ $feedback->email }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100">{{ $feedback->content }}
                                </td>

                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100">
                                    @can('feedbacks-delete')
                                        <form action="{{ route('feedbacks.destroy', $feedback->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                            class="mx-2 btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90 btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                                <i class="fa fa-trash-alt"></i></button>

                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
