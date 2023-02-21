<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $section->title }}
            </h2>
            <div>
                <a href="{{ route('sections.createSub', $section->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Add {{$section->sectionType->singular}}
                </a>
                @if($section->parent_id != 0)
                    <a href="{{ route('sections.show',$section->parent_id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{$section->sectionType->plural}}
                    </a>
                @else
                    <a href="{{ route('sections.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{$section->sectionType->plural}}
                    </a>
                @endif
            </div>
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
                                    Title
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Sub Sections
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
                            @foreach($section->children as $child)
                            <tr class="bg-white border-b">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                    {{$child->title}}
                                </th>
                                <td class="py-4 px-6">
                                    <a href="{{ route('sections.show',$child->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Sub Sections
                                    </a>
                                </td>
                                <td class="py-4 px-6">
                                    <a href="{{ route('sections.edit',$child->id) }}" 
                                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                                        Edit
                                    </a>
                                </td>
                                <td class="py-4 px-6">
                                    {!! Form::open(['route' => ['sections.destroy', $child->id], 'method' => 'POST', 'class' => 'inline-block']) !!}
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
