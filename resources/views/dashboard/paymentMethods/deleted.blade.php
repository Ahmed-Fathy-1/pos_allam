@extends('dashboard.layouts.master')

@section('title', 'Deleted paymentMethods')

@section('main')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                Deleted paymentMethods
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

                @can('paymentMethods-list')
                    <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                    href="{{ route('payment-methods.index') }}">paymentMethods List</a>
                @endcan

            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>
                <li>Deleted paymentMethods List</li>
            </ul>
        </div>

        <div class="card">
            <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                    List of paymentMethods
                </h4>
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
                                Name Arabic</th>
                                <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider dark:text-navy-200">
                                Name English</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider dark:text-navy-200">
                                Image</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider dark:text-navy-200">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200 dark:bg-navy-700 dark:divide-navy-600">
                        @foreach ($paymentMethods as $paymentMethod)
                        <tr>
                                <td class="px-6 py-4 text-sm font-medium text-slate-900 dark:text-navy-50">
                                    {{ $paymentMethod->id }}</td>
                                    <td
                                                class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100">
                                                {{ $paymentMethod->name_ar }}
                                            </td>
                                            <td
                                                class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100">
                                                {{ $paymentMethod->name_en }}
                                            </td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100">
                                    <img src="{{ $paymentMethod->imageWithFullPath }}" alt="{{ $paymentMethod->name }}"
                                        class="h-10 w-10 object-cover">
                                </td>

                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100 flex flex-row">

                                    @can('paymentMethods-restore')
                                        <a href="{{ route('payments.restore', $paymentMethod->id) }}"
                                            class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                    @endcan

                                    @can('paymentMethods-forceDelete')
                                        <form action="{{ route('payments.permdelete', $paymentMethod->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this Payment Method?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                            class="mx-2 btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90 btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                                <i class="fa fa-trash-alt"></i></button>

                                        </form>
                                    @endcan

                                    {{-- <button type="submit" data-toggle="modal" data-target="#modal1"
                                    class="mx-2 btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90 btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                                            <i class="fa fa-trash-alt"></i></button>


                                @component('dashboard.layouts.deletemodal', ['route' => route('payments.permdelete', $paymentMethod->id)])
                                @endcomponent --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
