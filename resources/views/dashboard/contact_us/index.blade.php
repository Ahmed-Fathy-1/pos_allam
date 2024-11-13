@extends('dashboard.layouts.master')

@section('title', 'Contact Us')

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
                        href="{{ route('homePage') }}">Home
                    </a>

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li>
                    <a>
                        Contact Us
                    </a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                    Contact Us Entries
                </h4>

                @can('contactUs-forceDeleted')
                    <a href="{{ route('contact-us.trashed') }}" class="btn bg-error text-white hover:bg-error-focus focus:bg-error-focus dark:bg-error dark:hover:bg-error-focus dark:focus:bg-error-focus mt-4">
                        View Deleted Contacts
                    </a>
                @endcan


            </div>

            <div class="p-4 sm:p-5">
                <table class="min-w-full divide-y divide-slate-200 dark:divide-navy-500">
                    <thead class="bg-slate-50 dark:bg-navy-600">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider dark:text-navy-200">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider dark:text-navy-200">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider dark:text-navy-200">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider dark:text-navy-200">Phone</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider dark:text-navy-200">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200 dark:bg-navy-700 dark:divide-navy-600">
                        @foreach ($contacts as $contact)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-slate-900 dark:text-navy-50">{{ ($contacts->currentPage() - 1) * $contacts->perPage() + $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100">{{ $contact->name }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100">{{ $contact->email }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100">{{ $contact->phone ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100 flex space-x-2">
                                    <!-- View Button -->
                                    @can('contactUs-list')
                                        <a href="{{ route('contact-us.show', $contact->id) }}" class="btn h-8 w-8 p-0 text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                    @endcan

                                    <!-- Delete Button with data-route attribute -->





                                    <form action="{{ route('contact-us.destroy', $contact->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                        class="mx-2 btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90 btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                            <i class="fa fa-trash-alt"></i></button>
                                    </form>




                                </td>
                            </tr>
                        @endforeach
                    </div>
                    </tbody>
                </table>
            </div>
            <div class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5">
                <ol class="pagination space-x-1.5">
                    {{ $contacts->links('vendor.pagination.mados-ui') }}
                </ol>
            </div>
        </div>
    </main>
@endsection

