@extends('dashboard.layouts.master')

@section('title', 'Deleted Contacts')

@section('main')
<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center space-x-4 py-5 lg:py-6">
        <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
            Deleted Contacts
        </h2>
        <div class="hidden h-full py-1 sm:flex">
            <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
        </div>
        <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
            <li>
                <a href="{{ route('homePage') }}" class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent">
                    Home >
                </a>
            </li>
            <li>
                @can('contactUs-list')
                    <a href="{{ route('contact-us.index') }}" class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent">
                        Contact Us >
                    </a>
                @endcan
            </li>
            <li>
                <a>
                   Deleted Contact Us
                </a>
            </li>

        </ul>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
        <div id="table-filter">
            <div class="ac js-enabled" id="ac-4">

                <div class="flex items-center justify-between">
                    <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                        Deleted Contact Us Entries
                    </h2>

                </div>

                <div class="card mt-3">
                    <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                        <table class="is-hoverable w-full text-left">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                        #
                                    </th>
                                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                        Name
                                    </th>
                                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                        Email
                                    </th>
                                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                        Phone
                                    </th>
                                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $index => $contact)
                                    <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ ($contacts->currentPage() - 1) * $contacts->perPage() + $index + 1 }}</td>
                                        <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                            {{ $contact->name }}
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                            {{ $contact->email }}
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                            {{ $contact->phone ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100 flex flex-row">
                                            {{-- <div class="flex space-x-4">
                                                <!-- Restore Button -->
                                                <form action="{{ route('contact-us.restore', $contact->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn bg-primary text-white hover:bg-primary-focus focus:bg-primary-focus dark:bg-primary dark:hover:bg-primary-focus dark:focus:bg-primary-focus">
                                                        Restore
                                                    </button>
                                                </form>

                                                <!-- Permanent Delete Button -->
                                                <form action="{{ route('contact-us.forceDelete', $contact->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn bg-error text-white hover:bg-error-focus focus:bg-error-focus dark:bg-error dark:hover:bg-error-focus dark:focus:bg-error-focus">
                                                        Permanent Delete
                                                    </button>
                                                </form>

                                            </div> --}}


                                            @can('contactUs-restore')
                                                <a href="{{ route('contact-us.restore', $contact->id) }}"
                                                    class="mx-2 btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-203 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90 btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-error/20 active:bg-info/25">
                                                    <i class="fa fa-refresh"></i>
                                                </a>
                                            @endcan

                                            @can('contactUs-forceDeleted')

                                                    <form action="{{ route('contact-us.forceDelete', $contact->id) }}" method="POST"
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

                    <div class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5">
                        <ol class="pagination space-x-1.5">
                            {{ $contacts->links('vendor.pagination.mados-ui') }}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
