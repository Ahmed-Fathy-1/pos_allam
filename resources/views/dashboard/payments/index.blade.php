@extends('dashboard.layouts.master')

@section('title', 'Payments')

@push('style')
    <script src="{{ asset('SuperAdmin/assets/js/pages/components-modal.js') }}" defer></script>
@endpush

@section('main')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">Payments</h2>
            <div class="hidden h-full py-1 sm:flex">
                <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
            </div>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li>
                    <a href="{{ route('homePage') }}" class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent">
                        Home
                    </a>
                </li>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
                <li>Payments </li>
            </ul>
        </div>

        <div class="card">
            <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">Payments</h4>
                @can('payments-delete')
                    <a class="btn bg-error text-white hover:bg-error-focus focus:bg-error-focus dark:bg-error dark:hover:bg-error-focus dark:focus:bg-error-focus mt-4"
                       href="{{ route('payments.deleted') }}"> Deleted Payments </a>
                @endcan
            </div>

            <!-- Success and Error Messages -->
            <div class="p-4 sm:p-5">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" style="background-color: #10b981; color: white" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" aria-label="Close" style="color: white"  onclick="this.parentElement.style.display='none';">
                            <svg class="fill-current h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M10 9l-5 5-1-1 5-5-5-5 1-1 5 5 5-5 1 1-5 5 5 5-1 1-5-5z"/></svg>
                        </button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-500 border border-red-600 text-white px-4 py-3 rounded relative" style="background-color: #b80000; color: white" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" aria-label="Close" style="color: white" onclick="this.parentElement.style.display='none';">
                            <svg class="fill-current h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M10 9l-5 5-1-1 5-5-5-5 1-1 5 5 5-5 1 1-5 5 5 5-1 1-5-5z"/></svg>
                        </button>
                    </div>
                @endif

                <table class="min-w-full divide-y divide-slate-200 dark:divide-navy-500">
                    <thead class="bg-slate-50 dark:bg-navy-600">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider dark:text-navy-200">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider dark:text-navy-200">User Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider dark:text-navy-200">domain name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider dark:text-navy-200">Package Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider dark:text-navy-200">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider dark:text-navy-200">Currency</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider dark:text-navy-200">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider dark:text-navy-200">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200 dark:bg-navy-700 dark:divide-navy-600">
                    @php
                          $i = 1
                     @endphp
                        @foreach ($payments as $record)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-slate-900 dark:text-navy-50">{{ $i }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100">{{ $record->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100">{{ $record->domain_name }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100">{{ $record->package->title }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100">{{ $record->amount }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100">{{ $record->currency }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100">{{ $record->status }}</td>
                                <td data-column-id="actions" class="gridjs-td">
                                    <span>
                                        <div class="flex space-x-2">
                                            @can('payments-edit')
                                                <a href="{{ route('payments.edit', $record->id) }}" class="mx-2 btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-203 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90 btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan

                                            @can('payments-delete')
                                                 <form class="delete" action="{{ route('payments.destroy', $record->id) }}" method="POST">
                                                     <input type="hidden" name="_method" value="DELETE">
                                                     <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                     <button type="submit" class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90 btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                                         <i class="fa fa-trash-alt"></i>
                                                     </button>
                                                 </form>
                                            @endcan
                                        </div>
                                    </span>
                                </td>
                            </tr>
                            @php $i++ @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div
                class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5">
                <ol class="pagination space-x-1.5">
                    {{ $payments->links('vendor.pagination.mados-ui') }}
                </ol>
            </div>
        </div>

    </main>
@endsection
@push('scripts')
    <script>
        $(".delete").on("submit", function(){
            return confirm("Do you want to delete this item?");
        });
    </script>
@endpush
