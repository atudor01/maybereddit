<div>
    <input wire:model="search" type="text" placeholder="Search users..."/>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                            <tbody>
                            @foreach ($users as $user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        <a href=""
                                           class="text-gray-900 dark:text-white">{{ $user->name }}</a>
                                    </th>

                                    <td class="px-6 py-4 ">
                                        <a href=""
                                           class=" px-8 ml-10 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700  focus:outline-none dark:focus:ring-blue-800">Edit
                                            user</a>
                                    </td>

                                    <td class="px-6 py-4">
                                        <form method="POST" action="">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class=" px-8 ml-10 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700  focus:outline-none dark:focus:ring-blue-800">
                                                Delete user
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {{$users->links()}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
