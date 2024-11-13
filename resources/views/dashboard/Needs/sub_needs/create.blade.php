@extends('dashboard.layouts.master')
@section('title', 'Create Features')
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

                @can('subNeeds-list')
                    <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                    href="{{ route('sub_needs.index') }}">Sub-Needs</a>
                @endcan

                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <li>Create User Needs</li>
            </ul>
        </div>
        <div>
            @include('dashboard.partials._session')
        </div>

        <div class="col-span-12 grid lg:col-span-12">
            <h4 class="card">
                <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                    <div class="flex items-center space-x-2">
                        <div
                            class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-1 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                            {{-- <i class="fa-solid fa-layer-group"></i> --}}
                            <i class="fa-solid fa-circle-plus"></i>
                        </div>
                        <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                            Create User Needs
                        </h4>

                    </div>
                </div>
                @can('subNeeds-create')
                    <form action="{{ route('sub_needs.store') }}" method="POST" enctype="multipart/form-data" id="identifier">
                    @csrf
                    <h4 class="space-y-4 p-4 sm:p-5">
                        <br>
                        <label class="block">

                            <br>
                            <label class="block">
                                <span>Title</span>

                                <input name="title"
                                       class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                       placeholder="Enter Title" type="text" value="">
                            </label>
                            @error('title')
                               <span class="text-tiny+ text-error">{{$message}}</span>
                            @enderror

                            <label class="block pt-4">
                                <span class="font-medium text-slate-600 dark:text-navy-100"> Description </span>
                            </label>
                            <div class="w-full">
                                <div id="editor2" class="h-48"></div>
                            </div>
                            <textarea id="descTwo" name="desc" style="display: none;"></textarea>

                            @error('desc')
                            <span class="text-tiny+ text-error"></span>
                            @enderror
                            <label class="block pt-4">
                                <span class="font-medium text-slate-600 dark:text-navy-100">Photo</span>
                            </label>
                            <label
                                class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                                <input onchange="previewImage(this)" tabindex="-1" type="file" name="image"
                                       class="pointer-events-none absolute inset-0 h-full w-full opacity-0" />
                                <div class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                    <span>Choose File</span>
                                </div>
                            </label>
                            <div>
                                <img id="imagePreview1" alt="Current Image"
                                     style="max-width: 150px;">
                            </div>
                            @error('image')
                                 <span class="text-tiny+ text-error">{{ $message }}</span>
                            @enderror

                        </label>
                        <br>
                        <div class="flex justify-end space-x-2">
                            <button type="submit"
                                    class="btn space-x-2 bg-success font-medium text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                <span>Add</span>
                            </button>
                        </div>
                    </h4>
                </form>
                @endcan
            </h4>
        </div>
    </main>
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

        const editor2 = document.querySelector("#editor2");
        const quill2 = new Quill(editor2, config2);

        const descTwo = '{{ old('desc') }}';

        // Set the value of the editor
        quill2.root.innerHTML = descTwo;

        // Attach event listener and Create hidden input
        quill2.on("text-change", function() {
            document.getElementById("descTwo").value = quill2.root.innerHTML;
        });
    </script>

    <script>
        function previewImage(input) {
            var preview = document.getElementById('imagePreview1');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }
    </script>
@endpush
