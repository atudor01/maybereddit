<html>
<head>

    <title>
        MaybeReddit
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="{{ asset('helper.js') }}" ></script>

{{--    <script type="text/javascript" src="{{ asset('js/helper.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{URL::asset('js/helper.js')}}"></script>--}}

</head>

<body>
<div class="w-full flex flex-col h-screen justify-between">
<nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 dark:bg-gray-900 bg-slate-200">



    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="relative bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex justify-between items-center border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10">
                <div class="flex justify-start lg:w-0 lg:flex-1">
                    <a href="{{route('posts.index')}}">
                        <span class="sr-only">Workflow</span>
                        <img class="h-8 w-auto sm:h-10" src="https://tailwindui.com/img/logos/workflow-mark.svg?color=indigo&shade=600" alt="">
                    </a>
                </div>
                <div class="-mr-2 -my-2 md:hidden">
                    <button type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-expanded="false">
                        <span class="sr-only">Open menu</span>
                        <!-- Heroicon name: outline/menu -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
                <nav class="hidden md:flex space-x-10">
                    @if(Route::is('posts.index'))

                    @else
                    <a href="{{route('posts.index')}}" class="text-base font-medium text-gray-500 hover:text-gray-900"> Home </a>
                    @endif

                @if(Route::is('posts.create'))

                        @else
                        <a href="{{route('posts.create')}}" class="text-base font-medium text-gray-500 hover:text-gray-900"> Create a Post </a>
                    @endif


                </nav>
                <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
                    @if (Route::has('login'))
                                        <div class="">
                                            @auth
                                                <a href="{{ url('/dashboard') }}" class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">Dashboard</a>
                                            @else
                                                <a href="{{ route('login') }}" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">Log in</a>

                                                @if (Route::has('register'))
                                                    <a href="{{ route('register') }}" class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">Register</a>
                                                @endif
                                            @endauth
                                        </div>
                                    @endif
{{--                    <a href="#" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"> Sign in </a>--}}
{{--                    <a href="#" class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"> Sign up </a>--}}
                </div>
            </div>
        </div>

        <!--
          Mobile menu, show/hide based on mobile menu state.

          Entering: "duration-200 ease-out"
            From: "opacity-0 scale-95"
            To: "opacity-100 scale-100"
          Leaving: "duration-100 ease-in"
            From: "opacity-100 scale-100"
            To: "opacity-0 scale-95"
        -->

    </div>

</nav>

