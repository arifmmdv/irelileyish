<div class="flex">
    <div class="w-1/2 p-2">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            {!! Form::open(['route' => 'menus.store', 'method' => 'POST']) !!}
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-4 bg-gray-50 sm:px-6 border-b border-gray-300">
                        <h3 class="font-semibold text-md text-gray-800 leading-tight">Add Sub Menu</h3>
                    </div>
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="py-1">
                            <label for="title" class="block font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" autocomplete="given-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div class="py-1">
                            <label for="slug" class="block font-medium text-gray-700">Slug</label>
                            <input type="text" name="slug" id="slug" autocomplete="given-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div class="py-1">
                            <label for="external" class="block font-medium text-gray-700">External</label>
                            <select id="external" name="external" autocomplete="external" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <input type="hidden" name="navigation_id" value="{{$navigation_id}}">
                        <input type="hidden" name="parent_id" value="{{$parent_id}}">
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Add
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="w-1/2 p-2">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg pt-2">
            <div class="overflow-x-auto relative">
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
                        @foreach($menus as $child)
                        <tr class="bg-white border-b">
                            <td class="py-4 px-6">
                                {{$child->title}}
                            </td>
                            <td class="py-4 px-6">
                                <a href="{{ route('menus.edit',$child->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                                    Edit
                                </a>
                            </td>
                            <td class="py-4 px-6">
                                {!! Form::open(['route' => ['menus.destroy', $child->id], 'method' => 'POST', 'class' => 'inline-block']) !!}
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