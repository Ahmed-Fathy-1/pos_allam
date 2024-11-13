@extends('dashboard.layouts.master')

@section('title', 'About Us')

@push('style')
@endpush

@section('main')

    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                About Us
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
                <li>About Us</li>
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
                            About Us Information
                        </h4>

                    </div>
                </div>
                @can('aboutUs-edit')
                    <form action="{{ route('about_us.update', $aboutUs->id) }}" method="POST" enctype="multipart/form-data"
                      id="about-form">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4 p-4 sm:p-5">

                        <label class="block">
                            <span>Intro Title</span>

                            <input name="intro_title"
                                   class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                   placeholder="Enter Title" type="text" value="{{ $aboutUs->intro_title }}">
                        </label>
                        @error('intro_title')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Intro Description</span>
                        </label>
                        <div class="w-full">
                            <div id="editor1" class="h-48"></div>
                        </div>
                        <textarea id="descOne" name="intro_desc" style="display: none;">{{ $aboutUs->intro_desc }}</textarea>

                        @error('intro_desc')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>Numbers Client Title</span>

                            <input name="numbers_clients_title"
                                   class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                   placeholder="Enter Title" type="text" value="{{ $aboutUs->numbers_clients_title }}">
                        </label>
                        @error('numbers_clients_title')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>Numbers Client Count</span>

                            <input name="numbers_clients_count"
                                   class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                   placeholder="Enter Title" type="text" value="{{ $aboutUs->numbers_clients_count }}">
                        </label>
                        @error('numbers_clients_count')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>Numbers Downloads Title</span>

                            <input name="numbers_downloads_title"
                                   class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                   placeholder="Enter Title" type="text" value="{{ $aboutUs->numbers_downloads_title }}">
                        </label>
                        @error('numbers_downloads_title')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>Numbers Downloads Count</span>

                            <input name="numbers_downloads_count"
                                   class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                   placeholder="Enter Title" type="text" value="{{ $aboutUs->numbers_downloads_count }}">
                        </label>
                        @error('numbers_downloads_count')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>Numbers Projects Title</span>

                            <input name="numbers_projects_title"
                                   class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                   placeholder="Enter Title" type="text" value="{{ $aboutUs->numbers_projects_title }}">
                        </label>
                        @error('numbers_projects_title')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>Numbers Projects Count</span>

                            <input name="numbers_projects_count"
                                   class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                   placeholder="Enter Title" type="text" value="{{ $aboutUs->numbers_projects_count }}">
                        </label>
                        @error('numbers_projects_count')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>Workflow Title</span>

                            <input name="workflow_title"
                                   class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                   placeholder="Enter Title" type="text" value="{{ $aboutUs->workflow_title }}">
                        </label>
                        @error('workflow_title')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        {{-- Worflow Descriptions --}}
                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Workflow Description</span>
                        </label>
                        <div class="w-full">
                            <div id="editor2" class="h-48"></div>
                        </div>
                        <textarea id="descTwo" name="workflow_desc" style="display: none;">{{ $aboutUs->workflow_desc }}</textarea>

                        @error('workflow_desc')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>Workflow Downloads Title</span>

                            <input name="workflow_download_title"
                                   class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                   placeholder="Enter Title" type="text" value="{{ $aboutUs->workflow_download_title }}">
                        </label>
                        @error('workflow_download_title')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        {{-- Workflow Downloads Description --}}
                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Workflow Downloads Description</span>
                        </label>
                        <div class="w-full">
                            <div id="editor3" class="h-48"></div>
                        </div>
                        <textarea id="descThree" name="workflow_download_desc" style="display: none;">{{ $aboutUs->workflow_download_desc }}</textarea>

                        @error('workflow_download_desc')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>Workflow Downloads Number</span>

                            <input name="workflow_download_number"
                                   class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                   placeholder="Enter Title" type="text" value="{{ $aboutUs->workflow_download_number }}">
                        </label>
                        @error('workflow_download_number')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <!-- Workflow Download Image Label -->
                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Workflow Download Image</span>
                        </label>

                        <!-- File Upload Button -->
                        <label class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                            <input
                                onchange="previewImage(this)"
                                tabindex="-1"
                                type="file"
                                name="workflow_download_image"
                                class="pointer-events-none absolute inset-0 h-full w-full opacity-0"
                            />
                            <div class="flex items-center space-x-2">
                                <!-- Upload Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                <span>Choose File</span>
                            </div>
                        </label>

                        <!-- Image Preview -->
                        <div>
                            <img
                                id="imagePreview"
                                src="{{ asset('storage/uploads/about_us/'.$aboutUs->workflow_download_image) }}"
                                alt="Current Image"
                                style="max-width: 150px;"
                            >
                        </div>

                        <!-- Error Message -->
                        @error('workflow_download_image')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror


                        <label class="block">
                            <span>Workflow Manage Title</span>

                            <input name="workflow_manage_title"
                                   class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                   placeholder="Enter Title" type="text" value="{{ $aboutUs->workflow_manage_title	 }}">
                        </label>
                        @error('workflow_manage_title')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Workflow Manage Description</span>
                        </label>
                        <div class="w-full">
                            <div id="editor5" class="h-48"></div>
                        </div>
                        <textarea id="descFive" name="workflow_manage_desc" style="display: none;">{{ $aboutUs->workflow_manage_desc }}</textarea>

                        @error('workflow_manage_desc')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>Workflow Manage Number</span>

                            <input name="workflow_manage_number"
                                   class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                   placeholder="Enter Number" type="text" value="{{ $aboutUs->workflow_manage_number }}">
                        </label>
                        @error('workflow_manage_number')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <!-- Workflow Manage Image Label -->
                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Workflow Manage Image</span>
                        </label>

                        <!-- File Upload Button -->
                        <label
                            class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                            <input onchange="previewImage(this)" tabindex="-1" type="file" name="workflow_manage_image"
                                   class="pointer-events-none absolute inset-0 h-full w-full opacity-0" />
                            <div class="flex items-center space-x-2">
                                <!-- Upload Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                <span>Choose File</span>
                            </div>
                        </label>

                        <!-- Image Preview -->
                        <div>
                            <img id="imagePreview" src="{{ asset('storage/uploads/about_us/'.$aboutUs->workflow_manage_image) }}" alt="Current Image"
                                 style="max-width: 150px;">
                        </div>

                        <!-- Error Message -->
                        @error('workflow_manage_image')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror



                        <label class="block">
                            <span>Workflow Edit Title</span>

                            <input name="workflow_edit_title	"
                                   class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                   placeholder="Enter Title" type="text" value="{{ $aboutUs->workflow_edit_title	 }}">
                        </label>
                        @error('workflow_edit_title	')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Workflow Edit Description</span>
                        </label>
                        <div class="w-full">
                            <div id="editor4" class="h-48"></div>
                        </div>
                        <textarea id="descFour" name="workflow_edit_desc" style="display: none;">{{ $aboutUs->workflow_edit_desc }}</textarea>

                        @error('workflow_edit_desc')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>Workflow Edit Number</span>

                            <input name="workflow_edit_number"
                                   class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                   placeholder="Enter Title" type="text" value="{{ $aboutUs->workflow_edit_number }}">
                        </label>
                        @error('workflow_edit_number')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <!-- Workflow Edit Image Label -->
                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Workflow Edit Image</span>
                        </label>

                        <!-- File Upload Button -->
                        <label
                            class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                            <input onchange="previewImage(this, 'editImagePreview')" tabindex="-1" type="file" name="workflow_edit_image"
                                   class="pointer-events-none absolute inset-0 h-full w-full opacity-0" />
                            <div class="flex items-center space-x-2">
                                <!-- Upload Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                <span>Choose File</span>
                            </div>
                        </label>

                        <!-- Image Preview -->
                        <div>
                            <img id="editImagePreview" src="{{ asset('storage/uploads/about_us/'.$aboutUs->workflow_edit_image) }}" alt="Current Image"
                                 style="max-width: 150px;">
                        </div>

                        <!-- Error Message -->
                        @error('workflow_edit_image')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror


                        <!-- Repeat similar blocks for other descriptions -->

                        @can('aboutUs-submit')
                            <div class="flex justify-end pt-4">
                                <button type="submit"
                                        class="btn bg-primary text-white hover:bg-primary-focus">Update</button>
                            </div>
                        @endcan
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
        const config2 = {
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
        const quill1 = new Quill(editor1, config2);

        const editor2 = document.querySelector("#editor2");
        const quill2 = new Quill(editor2, config2);

        const editor3 = document.querySelector("#editor3");
        const quill3 = new Quill(editor3, config2);

        const editor4 = document.querySelector("#editor4");
        const quill4 = new Quill(editor4, config2);

        const editor5= document.querySelector("#editor5");
        const quill5 = new Quill(editor5, config2);



        // Get the value you want to set in the editor
        const descOne = {!! json_encode($aboutUs->intro_desc) !!};
        const descTwo = {!! json_encode($aboutUs->workflow_desc) !!};
        const descThree = {!! json_encode($aboutUs->workflow_download_desc) !!};
        const descFour = {!! json_encode($aboutUs->workflow_edit_desc) !!};
        const descFive = {!! json_encode($aboutUs->workflow_manage_desc) !!};



        // Set the value of the editor
        quill1.root.innerHTML = descOne;
        quill2.root.innerHTML = descTwo;
        quill3.root.innerHTML = descThree;
        quill4.root.innerHTML = descFour;
        quill5.root.innerHTML = descFive;


        // Attach event listener and update hidden input
        quill1.on("text-change", function() {
            document.getElementById("descOne").value = quill1.root.innerHTML;
        });

        quill2.on("text-change", function() {
            document.getElementById("descTwo").value = quill2.root.innerHTML;
        });

        quill3.on("text-change", function() {
            document.getElementById("descThree").value = quill3.root.innerHTML;
        });

        quill4.on("text-change", function() {
            document.getElementById("descFour").value = quill4.root.innerHTML;
        });

        quill5.on("text-change", function() {
            document.getElementById("descFive").value = quill5.root.innerHTML;
        });

    </script>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }
    </script>


    <script>
        function previewImage(input, imgId) {
            const preview = document.getElementById(imgId);
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }
    </script>

    <script>
        function previewImage(input, imgId) {
            const preview = document.getElementById(imgId);
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }
    </script>


@endpush
