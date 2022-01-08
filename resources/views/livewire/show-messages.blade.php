<div wire:init="loadMessages">
    {{-- <div class="container"> --}}
    <div class="container">

        <x-table>

            <div class="py-4 flex item-center">
                <div class="flex item-centre">
                    <span>Show</span>
                    <select class="mx-2 form-control" wire:model="number">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <x-jet-input class="flex-1 mr-4" type="text" wire:model="search" placeholder="Search" />

                {{-- <!-- @livewire('create-post') --> --}}
            </div>

            @if (count($contactMessage))

                {{-- @foreach ($contactMessage as $message) --}}
                <table
                    class="hidden w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-2">
                    <thead class="text-white">
                        {{-- @foreach ($contactMessage as $message) --}}
                        <tr class="hidden bg-blue-300 flex flex-col flex-no-wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                            <th class="p-2 text-left border">Name</th>
                            <th class="p-2 text-left border">Email</th>
                            <th class="p-2 text-left border">Message</th>
                            <th class="p-2 text-left border">Actions</th>
                        </tr>
                        {{-- @endforeach --}}
                    </thead>
                    <tbody class="flex-1 sm:flex-none">
                        @foreach ($contactMessage as $message)
                            <tr class="hidden flex flex-col flex-no-wrap sm:table-row mb-2 sm:mb-0 overflow-hidden">
                                <td class="border-grey-light border hover:bg-gray-100 p-2">{{ $message->name }}</td>
                                <td class="border-grey-light border hover:bg-gray-100 p-2">{{ $message->email }}</td>
                                <td class="border-grey-light border hover:bg-gray-100 p-2">{{ $message->message }}</td>
                                <td class="border-grey-light border hover:bg-gray-100 p-2 text-center text-red-400 hover:text-red-600 hover:font-medium cursor-pointer">
                                    <a href="{{ route('message.delete', $message->id) }}"
                                        onclick="return confirm('Are you sure you want to delete?')"
                                        class="text-red-500">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- @endforeach --}}


                {{-- MOBILE --}}
                @foreach ($contactMessage as $message)
                <table
                    class="sm:hidden table-mobile w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-2">
                    
                    <tbody class="flex-1 sm:flex-none">
                        {{-- @foreach ($contactMessage as $message) --}}
                            
                            <tr class="sm:hidden">
                                <td class="w-25 border-grey-light border hover:bg-gray-100 p-2 bg-blue-300">name</td>
                                <td class="w-75 border-grey-light border hover:bg-gray-100 p-2 bg-red-100">
                                    {{ $message->name }}</td>
                            </tr>
                            <tr class="sm:hidden">
                                <td class="w-25 border-grey-light border hover:bg-gray-100 p-2 bg-blue-300">email</td>
                                <td class="w-75 border-grey-light border hover:bg-gray-100 p-2 bg-red-100">
                                    {{ $message->email }}</td>
                            </tr>
                            <tr class="sm:hidden">
                                <td class="w-25 border-grey-light border hover:bg-gray-100 p-2 bg-blue-300">Message</td>
                                <td class="w-75 border-grey-light border hover:bg-gray-100 p-2 bg-red-100">
                                    {{ $message->message }}</td>
                            </tr>
                            <tr class="sm:hidden">
                                <td class="w-25 border-grey-light border hover:bg-gray-100 p-2 bg-blue-300">Action</td>
                                <td class="w-75 border-grey-light border hover:bg-gray-100 p-2 bg-red-100 text-center">
                                    <a href="{{ route('message.delete', $message->id) }}"
                                        onclick="return confirm('Are you sure you want to delete?')"
                                        class="text-red-500">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
                @endforeach

                @if ($contactMessage->hasPages())
                    <div class="px-6 py-3 bg-gray-50">{{ $contactMessage->links() }}</div>
                @endif
                {{-- {{ $contactMessage->links() }} --}}


            @else
                <div class="px-6 py-4" cursor-pointer>No entries</div>
            @endif


        </x-table>


        <x-table>

            <div class="px-6 py-4 flex item-center">
                <div class="flex item-centre">
                    <span>Show</span>
                    <select class="mx-2 form-control" wire:model="number">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <x-jet-input class="flex-1 mr-4" type="text" wire:model="search" placeholder="Search" />

                {{-- @livewire('create-post') --}}
            </div>

            @if (count($contactMessage))



                {{-- <div class="card-header">Message Data</div> --}}

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif


                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('id')">
                                #
                                {{-- Sort --}}
                                @if ($sort == 'id')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>

                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif
                            </th>

                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('name')">
                                Name
                                {{-- Sort --}}
                                @if ($sort == 'name')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>

                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif
                            </th>

                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('email')">
                                Email
                                {{-- Sort --}}
                                @if ($sort == 'email')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>

                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('subject')">
                                Subject
                                {{-- Sort --}}
                                @if ($sort == 'subject')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>

                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('message')">
                                Message
                                {{-- Sort --}}
                                @if ($sort == 'message')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>

                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif
                            </th>

                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php($i = 1)
                        <!--If using pagination this won't work perfectly -->
                        @foreach ($contactMessage as $message)
                            <tr>
                                <th>{{ $i++ }}</th>
                                <!-- If using pagination this won't work perfectly - It would start from 1 again when changing page -->
                                <!--<th>2xcurly brackets $messageMessage->firstItem()+$loop->index 2xcurly brackets</th>  Prevent pagination to start again from 1 when click next page -->
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->subject }}</td>
                                <td>{{ $message->message }}</td>
                                <td>
                                    {{-- <a href="{{ route('message.edit', $message->id) }}" class="btn btn-info">Edit</a> --}}
                                    <a href="{{ route('message.delete', $message->id) }}"
                                        onclick="return confirm('Are you sure you want to delete?')"
                                        class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($contactMessage->hasPages())
                    <div class="px-6 py-3 bg-gray-50">{{ $contactMessage->links() }}</div>
                @endif
                {{-- {{ $contactMessage->links() }} --}}


            @else
                <div class="px-6 py-4" cursor-pointer>No entries</div>
            @endif


        </x-table>

    </div>
</div>

<style>
    /* html,
    body {
      height: 100%;
    } */

    @media (min-width: 640px) {
        table {
            display: inline-table !important;
        }

        thead tr:not(:first-child) {
            display: none;
        }
    }

    /* td:not(:last-child) {
        border-bottom: 0;
    } */

    th:not(:last-child) {
        border-bottom: 2px solid rgba(0, 0, 0, .1);
    }

</style>
