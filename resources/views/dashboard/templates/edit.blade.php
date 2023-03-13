<x-app-layout>
    <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Edit Template') }}
                </h2>
                <a href="{{ route('templates.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Templates
                </a>
            </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg pt-2">
                {!! Form::open(['route' => ['templates.update',$template->id], 'method' => 'POST']) !!}
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="flex flex-wrap">
                                <div class="w-1/2 p-2">
                                    <label for="title" class="block font-medium text-gray-700">Title</label>
                                    <input type="text" name="title" id="title" value="{{$template->title}}" autocomplete="given-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                <div class="w-1/2 p-2">
                                    <label for="hide_content" class="block font-medium text-gray-700">Content</label>
                                    <select id="hide_content" name="hide_content" autocomplete="hide_content" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="0" @if($template->hide_content == 0)selected @endif>Show</option>
                                        <option value="1" @if($template->hide_content == 1)selected @endif>Hide</option>
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

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4">
                {!! Form::open(['route' => ['templates.storeField',$template->id], 'method' => 'POST']) !!}
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-4 bg-gray-50 sm:px-6 border-b border-gray-300">
                            <h3 class="font-semibold text-md text-gray-800 leading-tight">Add Field</h3>
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="flex flex-wrap">
                                <div class="w-1/2 p-2">
                                    <label for="title" class="block font-medium text-gray-700">Title</label>
                                    <input type="text" name="title" id="title" autocomplete="given-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                <div class="w-1/2 p-2">
                                    <label for="field_type" class="block font-medium text-gray-700">Type</label>
                                    <select id="field_type" name="field_type" autocomplete="field_type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="1">Text</option>
                                        <option value="2">Textarea</option>
                                        <option value="3">Image</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Save
                            </button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4">
                <div class="px-4 py-4 bg-gray-50 sm:px-6 border-b border-gray-300">
                    <h3 class="font-semibold text-md text-gray-800 leading-tight">Fields</h3>
                </div>
                <div class="overflow-x-auto relative pt-2">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-700 uppercase">
                            <tr class="bg-white border-b">
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
                            @foreach($template->fields as $field)
                            <tr class="bg-white">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                    {{$field->title}}
                                </th>
                                <td class="py-4 px-6">
                                    <a href="{{ route('fields.edit',$field->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                                        Edit
                                    </a>
                                </td>
                                <td class="py-4 px-6">
                                    {!! Form::open(['route' => ['fields.destroy', $field->id], 'method' => 'POST', 'class' => 'inline-block']) !!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    <button 
                                        onclick="return confirm('Are you sure?')" 
                                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md 
                                              shadow-sm text-sm font-medium text-white 
                                              bg-rose-600 hover:bg-rose-700 
                                              focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">
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
