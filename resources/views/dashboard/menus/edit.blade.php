<x-app-layout>
    <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Edit Menu') }}
                </h2>
                @if($menu->parent_id == 0)
                    <a href="{{ route('navigations.edit',$menu->navigation_id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Back
                    </a>
                @else
                    <a href="{{ route('menus.edit',$menu->parent_id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Back
                    </a>
                @endif
            </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <div class="w-full p-2">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg pt-2">
                        {!! Form::open(['route' => ['menus.update',$menu->id], 'method' => 'POST']) !!}
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="flex flex-wrap">
                                        <div class="w-1/2 p-2">
                                            <label for="title" class="block font-medium text-gray-700">Title</label>
                                            <input type="text" name="title" id="title" value="{{$menu->title}}" autocomplete="given-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                        </div>

                                        <div class="w-1/2 p-2">
                                            <label for="slug" class="block font-medium text-gray-700">Slug</label>
                                            <input type="text" name="slug" id="slug" value="{{$menu->slug}}" autocomplete="given-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                        </div>

                                        <div class="w-1/2 p-2">
                                            <label for="external" class="block font-medium text-gray-700">External</label>
                                            <select id="external" name="external" autocomplete="external" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                                <option value="0" @if($menu->external == '0')selected @endif>No</option>
                                                <option value="1" @if($menu->external == '1')selected @endif>Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{Form::hidden('_method','PUT')}}
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Save
                                    </button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            @include('dashboard.menus.menus')
        </div>
    </div>
</x-app-layout>
