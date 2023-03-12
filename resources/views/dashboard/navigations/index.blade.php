<x-app-layout>
    <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Navigations') }}
                </h2>
                <a href="{{ route('navigations.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Add Navigation
                </a>
            </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg pt-2">

                <div class="overflow-x-auto relative">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-700 uppercase">
                            <tr class="bg-white border-b">
                                <th scope="col" class="py-3 px-6">
                                    Id
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Title
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Edit
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Delete
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($navigations as $navigation)
                            <tr class="bg-white border-b">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                    {{$navigation->id}}
                                </th>
                                <td class="py-4 px-6">
                                    {{$navigation->title}}
                                </td>
                                <td class="py-4 px-6">
                                    <a href="{{ route('navigations.edit',$navigation->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                                        Edit
                                    </a>
                                </td>
                                <td class="py-4 px-6">
                                    {!! Form::open(['route' => ['navigations.destroy', $navigation->id], 'method' => 'POST', 'class' => 'inline-block']) !!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    <button onclick="return confirm('Are you sure?')" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">
                                        Delete
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
