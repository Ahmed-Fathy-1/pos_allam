@extends('dashboard.layouts.master')

@section('title', 'paymentMethod')

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
                <li>paymentMethods list</li>
            </ul>
        </div>

        <div>
            @include('dashboard.partials._session')
        </div>

        <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">

            <!-- Table With Filter -->
            <div id="table-filter">
                <div class="ac js-enabled" id="ac-4">
                    <div class="card">
                        <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                            <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                                Table With paymentMethods
                            </h2>
                        </br>
                            <div class="flex">

                                @can('paymentMethods-create')
                                    <a href="{{ route('payment-methods.create') }}"
                                        class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                        <i class="fa-solid fa-plus"></i>
                                        <span> Add paymentMethod </span>
                                    </a>
                                @endcan
                                <div class="w-4"></div>
                                @can('paymentMethods-delete')
                                    <a href="{{ route('payments.trashedPaymethod') }}" class="btn space-x-2 bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                          <i class="fa-solid fa-trash"></i>
                                        <span>  View Deleted paymentMethods </span>
                                    </a>
                                 @endcan

                            </div>
                        </div>
                    <div class="card mt-3">
                        <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                            <table class="is-hoverable w-full text-left">
                                <thead>
                                    <tr>
                                        <th
                                            class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            #
                                        </th>
                                        <th
                                        class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                        name english
                                    </th>
                                        <th
                                            class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            name arabic
                                        </th>
                                        <th
                                            class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            status
                                        </th>
                                        <th
                                            class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            user name
                                        </th>

                                        <th
                                            class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            image
                                        </th>
                                        <th
                                            class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paymentMethods as $paymentMethod)
                                        <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $loop->iteration }}</td>
                                            <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                                {{ $paymentMethod->name_ar }}
                                            </td>
                                            <td
                                                class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                                {{ $paymentMethod->name_en }}
                                            </td>
                                            <td
                                                class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                                {{ $paymentMethod->status == 1 ? 'Active' : 'Inactive' }}
                                            </td>

                                            <td
                                                class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                                {{ $paymentMethod->user->name }}
                                            </td>

                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                <div class="avatar flex h-10 w-10">
                                                    <img class="mask is-squircle"
                                                        src="{{ $paymentMethod->imageWithFullPath }}" alt="avatar">
                                                </div>
                                            </td>


                                            <td data-column-id="actions" class="gridjs-td">
                                                <span>
                                                    <div class="flex space-x-2">
                                                        {{-- @can('paymentMethod-list') --}}

                                                        {{-- <a href="{{ route('payment-methods.show', $paymentMethod->id) }}"
                                                            class="btn h-8 w-8 p-0 text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a> --}}
                                                        {{-- @endcan --}}

                                                         @can('paymentMethods-edit')
                                                            <a href="{{ route('payment-methods.edit', $paymentMethod->id) }}"
                                                                onclick="$notification({ text: 'Item edit action', variant: 'info' })"
                                                                class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                         @endcan
                                                        {{-- @can('paymentMethod-delete') --}}































{{--
                                                        <button data-toggle="modal" data-target="#modal1"
                                                            class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90 btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                                            <i class="fa fa-trash-alt"></i>
                                                        </button>


                                                        <div class="modal fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                                                            id="modal1" role="dialog">
                                                            <div class="modal-overlay absolute inset-0 bg-slate-900/60">
                                                            </div>
                                                            <div
                                                                class="modal-content scrollbar-sm relative flex max-w-lg flex-col items-center overflow-y-auto rounded-lg bg-white px-4 py-10 text-center dark:bg-navy-700 sm:px-5">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="inline h-28 w-28 shrink-0 text-success"
                                                                    fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                    </path>
                                                                </svg>

                                                                <div class="mt-4">
                                                                    <h2 class="text-2xl text-slate-700 dark:text-navy-100">
                                                                        Confirmed Delete
                                                                    </h2>
                                                                    <p class="mt-2">
                                                                        Are you sure you want to delete this item?
                                                                    </p>
                                                                    <form
                                                                        action="{{ route('payment-methods.destroy', $paymentMethod->id) }}"
                                                                        method="post">
                                                                        @method('delete')
                                                                        @csrf
                                                                        <button data-close-modal=""
                                                                            class="btn mt-6 bg-success font-medium text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90">
                                                                            submit
                                                                        </button>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div> --}}








                                                        @can('paymentMethods-delete')
                                                            <form action="{{ route('payment-methods.destroy', $paymentMethod->id) }}" method="POST"
                                                                onsubmit="return confirm('Are you sure you want to delete this Payment Method?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                class="mx-2 btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90 btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                                                    <i class="fa fa-trash-alt"></i></button>

                                                            </form>
                                                        @endcan












                                                        {{-- @endcan --}}

                                                    </div>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div
                            class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5">
                            <ol class="pagination space-x-1.5">
                                {{ $paymentMethods->links('vendor.pagination.mados-ui') }}
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>



@endsection

@push('scripts')
@endpush
