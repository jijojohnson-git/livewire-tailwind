<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>


    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.3.4/dist/flowbite.min.css" />

    {{-- <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" /> --}}
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
    <script defer src="https://unpkg.com/alpinejs@3.9.1/dist/cdn.min.js"></script>

</head>

<body class="antialiased bg-black font-tahoma" x-data="{isDelete: false}">
    <button class="bg-purple-500 shadow-md shadow-purple-200/50"

    >click me!</button>
    <div class="flex justify-center h-full">

        {{-- <div id="alert-additional-content-2" class="p-4 mb-4 bg-red-100 rounded-lg dark:bg-red-200" aria-hidden="true" role="alert">
                <div class="flex items-center">
                  <svg class="mr-2 w-5 h-5 text-red-700 dark:text-red-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                  <h3 class="text-lg font-medium text-red-700 dark:text-red-800">This is a danger alert</h3>
                </div>
                <div class="mt-2 mb-4 text-sm text-red-700 dark:text-red-800">
                  More info about this info danger goes here. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.
                </div>
                <div class="flex">
                  <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center dark:bg-red-800 dark:hover:bg-red-900">
                    <svg class="-ml-0.5 mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                    View more
                  </button>
                  <button type="button" class="text-red-700 bg-transparent border border-red-700 hover:bg-red-800 hover:text-white focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:border-red-800 dark:text-red-800 dark:hover:text-white" data-collapse-toggle="alert-additional-content-2" aria-label="Close">
                    Dismiss
                  </button>
                </div>
              </div> --}}


        {{-- <livewire:counter class="text-grey-300" id="red"></livewire> --}}

        {{-- <livewire:comment :initialComments="$comments" /> --}}

        <div class="w-6/12">
            <livewire:ticket />
        </div>
        <div class="w-4/12">
            <livewire:comment />
        </div>

    </div>
    <div>
        <livewire:delete-modal />
    </div>

    {{-- <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script> --}}
    @livewireScripts
    {{-- <script src="https://unpkg.com/flowbite@1.3.4/dist/flowbite.js"></script> --}}
    @yield('scripts')

</body>

</html>
