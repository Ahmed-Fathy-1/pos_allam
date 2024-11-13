@extends('dashboard.layouts.master')

@section('title', 'Update package')

@push('style')
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
                <li class="flex items-center space-x-2">
                    @can('packages-list')
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                            href="{{ route('packages.index') }}">package List</a>
                    @endcan
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li>Update package</li>
            </ul>
        </div>
        <div>
            @include('dashboard.partials._session')
        </div>

        <div class="col-span-12 grid lg:col-span-12">
            <div class="card">
                <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                    <div class="flex items-center space-x-2">
                        <div
                            class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-1 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                            <i class="fa-solid fa-circle-plus"></i>
                        </div>
                        <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                            package
                        </h4>

                    </div>
                </div>
                @can('packages-edit')
                    <form action="{{ route('packages.update', $packages->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4 p-4 sm:p-5">
                        <label class="block">
                            <span>title</span>

                            <input name="title" value="{{ $packages->title }}"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter title" type="text">
                        </label>
                        @error('title')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror


                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Description</span>
                        </label>

                        <div class="w-full">
                            <div id="editor1" class="h-48"></div>
                        </div>
                        <textarea id="descOne" name="description" style="display: none;"></textarea>

                        @error('description')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror


                        <label class="block">
                            <span>What type of event is stutas?</span>
                            <select
                                class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                                name="active">
                                <option value="1">Active</option>
                                <option value="0">InActive</option>

                            </select>
                        </label>
                        @error('active')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror


                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                        <div class="flex gap-3">

                            <div class="flex-1">
                                <label class="block">
                                    <span>Price_monthly</span>

                                    <input name="Price_monthly" value="{{ $packages->packageDetails->Price_monthly }}"
                                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Enter Price_monthly" type="text">
                                </label>
                                @error('Price_monthly')
                                    <span class="text-tiny+ text-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex-1">
                                <label class="block">
                                    <span>Price_annually</span>

                                    <input name="Price_annually" value="{{ $packages->packageDetails->Price_annually }}"
                                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Enter Price_annually" type="text">
                                </label>
                                @error('Price_annually')
                                    <span class="text-tiny+ text-error">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="flex gap-3">

                            <div class="flex-1">

                                <label class="block">
                                    <span>storage_monthly</span>

                                    <input name="storage_monthly" value="{{ $packages->packageDetails->storage_monthly }}"
                                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Enter storage_monthly" type="text">
                                </label>
                                @error('storage_monthly')
                                    <span class="text-tiny+ text-error">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="flex-1">

                                <label class="block">
                                    <span>storage_annually</span>

                                    <input name="storage_annually" value="{{ $packages->packageDetails->storage_annually }}"
                                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Enter storage_annually" type="text">
                                </label>
                                @error('storage_annually')
                                    <span class="text-tiny+ text-error">{{ $message }}</span>
                                @enderror


                            </div>

                        </div>



                        <div class="flex gap-3">

                            <div class="flex-1">

                                <label class="block">
                                    <span>interactive_archives</span>

                                    <input name="interactive_archives" value="{{ $packages->packageDetails->interactive_archives }}"
                                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Enter interactive_archives" type="text">
                                </label>
                                @error('interactive_archives')
                                    <span class="text-tiny+ text-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex-1">

                                <label class="block">
                                    <span>custom_branding</span>

                                    <input name="custom_branding" value="{{ $packages->packageDetails->custom_branding }}"
                                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Enter custom_branding" type="text">
                                </label>
                                @error('custom_branding')
                                    <span class="text-tiny+ text-error">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>


                        <div class="flex gap-3">

                            <div class="flex-1">


                                <label class="block">
                                    <span>messages</span>

                                    <input name="messages" value="{{ $packages->packageDetails->messages }}"
                                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Enter messages" type="text">
                                </label>
                                @error('messages')
                                    <span class="text-tiny+ text-error">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="flex-1">
                                <label class="block">
                                    <span>notifications</span>

                                    <input name="notifications" value="{{ $packages->packageDetails->notifications }}"
                                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Enter notifications" type="number">
                                </label>
                                @error('notifications')
                                    <span class="text-tiny+ text-error">{{ $message }}</span>
                                @enderror


                            </div>

                        </div>

                        <div class="flex gap-3">

                            <div class="flex-1">
                                <label class="block">
                                    <span>main_show</span>

                                    <input name="main_show" value="{{ $packages->packageDetails->main_show }}"
                                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Enter main_show" type="number">
                                </label>
                                @error('main_show')
                                    <span class="text-tiny+ text-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex-1">
                                <label class="block">
                                    <span>main_search</span>

                                    <input name="main_search" value="{{ $packages->packageDetails->main_search }}"
                                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Enter main_search" type="number">
                                </label>
                                @error('main_search')
                                    <span class="text-tiny+ text-error">{{ $message }}</span>
                                @enderror


                            </div>

                        </div>

                        <label class="block">
                            <span>statics</span>

                            <input name="statics" value="{{ $packages->packageDetails->statics }}"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter statics" type="number">
                        </label>
                        @error('statics')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror



                        <label class="block">
                            <span>priority</span>

                            <input name="priority" value="{{ $packages->packageDetails->priority }}"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter priority" type="number">
                        </label>
                        @error('priority')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror


                        <div class="flex justify-end space-x-2">
                            <button type="submit"
                                class="btn space-x-2 bg-success font-medium text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                <span>Update</span>
                            </button>
                        </div>
                    </div>
                </form>
                @endcan
            </div>
        </div>

    </main>
@endsection

@push('scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
        // Configuration for editor 2
        const config1 = {
            modules: {
                toolbar: [
                    ["bold", "italic", "underline", "strike"], // toggled buttons
                    ["blockquote", "code-block"],
                    [{
                        header: 1
                    }, {
                        header: 2
                    }], // custom button values
                    [{
                        list: "ordered"
                    }, {
                        list: "bullet"
                    }],
                    [{
                        script: "sub"
                    }, {
                        script: "super"
                    }], // superscript/subscript
                    [{
                        indent: "-1"
                    }, {
                        indent: "+1"
                    }], // outdent/indent
                    [{
                        direction: "rtl"
                    }], // text direction
                    [{
                        size: ["small", false, "large", "huge"]
                    }], // custom dropdown
                    [{
                        header: [1, 2, 3, 4, 5, 6, false]
                    }],
                    [{
                        color: []
                    }, {
                        background: []
                    }], // dropdown with defaults from theme
                    [{
                        font: []
                    }],
                    [{
                        align: []
                    }],
                    ["clean"], // remove formatting button
                ],

            },
            placeholder: "Enter your content...",
            theme: "snow",


        };

        const editor1 = document.querySelector("#editor1");
        const quill1 = new Quill(editor1, config1);

        // Get the value you want to set in the editor
        const descOne = {!! json_encode($packages->description) !!};

        // Set the value of the editor
        quill1.root.innerHTML = descOne;

        // Attach event listener and update hidden input
        quill1.on("text-change", function() {
            document.getElementById("descOne").value = quill1.root.innerHTML;
        });
    </script>
@endpush
