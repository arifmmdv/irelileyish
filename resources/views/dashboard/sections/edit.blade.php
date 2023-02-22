<x-app-layout>
	<x-slot name="header">
		<div class="flex justify-between items-center">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit {{ $section->sectionType->title }}
			</h2>
			<div>
				@if($section->parent_id != 0)
					<a href="{{ route('sections.show',$section->parent_id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ $section->sectionType->plural }}
					</a>
				@else
				<a href="{{ route('sections.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ $section->sectionType->plural }}
				</a>
				@endif
			</div>
		</div>
	</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {!! Form::open(['route' => ['sections.update',$section->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="flex flex-wrap">
                <div class="w-9/12 p-1">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                        @foreach($languages as $language)
                        <div class="p-2">
                            <label for="title_{{$language->locale}}" class="block font-medium text-gray-700">Title - {{$language->locale}}</label>
                            <input type="text" name="title_{{$language->locale}}" id="title_{{$language->locale}}" value="{{$section->getTranslation('title', $language->locale)}}" autocomplete="given-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        @endforeach
                        <hr class="mt-4 mb-1">
                        <div class="p-2">
                            <label for="image" class="block font-medium text-gray-700">Image</label>
                            <div class="w-full flex flex-wrap items-center">
                                <input type="file" name="image" id="image" class="w-8/12 mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                @if($section->getFirstMedia('main') != null)
                                <div class="w-2/12 pl-1">
                                    <a href="{{ route('sections.deleteImage',$section->getFirstMedia('main')->id) }}" onclick="return confirm('Are you sure?')" class="w-full inline-flex items-center justify-center mt-1 px-4 py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:rose-2 focus:ring-offset-2 focus:ring-rose-500">
                                        Delete
                                    </a>
                                </div>
                                <div class="w-2/12 pl-1">
                                    <img src="{{$section->getFirstMediaUrl('main')}}" alt="{{$section->title}}">
                                </div>
                                @endif
                            </div>
                        </div>
                        @foreach($languages as $language)
                            <div class="w-full p-2">
                                <label for="content_{{$language->locale}}" class="block font-medium text-gray-700">Content - {{$language->locale}}</label>
                                <textarea 
                                    name="content_{{$language->locale}}" 
                                    id="content_{{$language->locale}}" cols="30" rows="10" 
                                    class="textarea ">{!! $section->getTranslation('content', $language->locale) !!}</textarea>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="w-3/12 p-1">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                        <div class="w-full p-2">
                            <label for="status" class="block font-medium text-gray-700">{{ __('Status') }}</label>
                            <select id="status" name="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="published" @if($section->status === "published") selected @endif >Published</option>
                                <option value="draft" @if($section->status === "draft") selected @endif >Draft</option>
                            </select>
                        </div>
                        <div class="w-full p-2">
                            <label for="template_id" class="block font-medium text-gray-700">{{ __('Templates') }}</label>
                            <select id="template_id" name="template_id" autocomplete="template_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="0">{{ __('Templates') }}</option>
                                @foreach($templates as $template)
                                    <option value="{{$template->id}}" @if($section->template_id == $template->id) selected @endif >{{$template->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full p-2">
                            <label for="sub_sections_template" class="block font-medium text-gray-700">{{ __('Sub Templates') }}</label>
                            <select id="sub_sections_template" name="sub_sections_template" autocomplete="sub_sections_template" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="0">{{ __('Templates') }}</option>
                                @foreach($templates as $template)
                                    <option value="{{$template->id}}" @if($section->sub_sections_template == $template->id) selected @endif >{{$template->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="p-2">
                            <label for="class" class="block font-medium text-gray-700">Class</label>
                            <input type="text" name="class" id="class" value="{{$section->class_name}}" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 mt-2">
                        <div class="p-2">
                            <label for="images" class="block font-medium text-gray-700">Images</label>
                            <input type="file" name="images[]" id="images" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" multiple>
                        </div>
                        <div class="">
                            @foreach($section->getMedia('images') as $image)
                                <div class="w-full flex flex-wrap items-center p-2">
                                    <div class="w-2/12">
                                        @if(!$loop->first)
                                        <a href="{{ route('sections.mainImage',$image->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up">
                                                <line x1="12" y1="19" x2="12" y2="5"></line>
                                                <polyline points="5 12 12 5 19 12"></polyline>
                                            </svg>
                                        </a>
                                        @endif
                                    </div>
                                    <a href="{{$image->getUrl()}}" class="w-8/12" target="_blank">
                                        <img src="{{$image->getUrl()}}" alt="">
                                    </a>
                                    <a href="{{ route('sections.deleteImage',$image->id) }}" 
                                        onclick="return confirm('Are you sure?')" 
                                        class="w-2/12 px-2">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap">
                <div class="w-9/12 p-1">
                    @if(isset($section->template->fields))
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="px-4 py-4 bg-gray-50 sm:px-6 border-b border-gray-300">
                            <h3 class="font-semibold text-md text-gray-800 leading-tight">Custom Fields</h3>
                        </div>
                        <div class="p-4">
                            @foreach($section->template->fields as $field)
															@if($field->field_type == 1)
																@foreach($languages as $language)
																	<div class="p-2">
																			<label 
																					for="{{$field->slug}}_{{$language->locale}}" 
																					class="block font-medium text-gray-700">
																							{{$field->title}} - <span>{{$language->locale}}</span>
																			</label>
																			<input 
																					type="text" 
																					value="{{$field->value($section->id, $language->locale)}}"
																					name="custom_{{$field->slug}}_{{$language->locale}}" 
																					id="{{$field->slug}}_{{$language->locale}}"  
																					class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
																		</div>
																@endforeach
																@elseif($field->field_type == 2)
																	@foreach($languages as $language)
																		<div class="p-2">
																			<label 
																				for="{{$field->slug}}_{{$language->locale}}" 
																				class="block font-medium text-gray-700">
																						{{$field->title}} - <span>{{$language->locale}}</span>
																			</label>
																			<textarea
																				class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" 
																				name="custom_{{$field->slug}}_{{$language->locale}}"
																				id="" cols="30" rows="10">{!! $field->value($section->id, $language->locale) !!}</textarea>
																			</div>
																		@endforeach
																		@elseif($field->field_type == 3)
																			<div class="p-2">
																				<label 
																						for="{{$field->slug}}_{{$language->locale}}" 
																						class="block font-medium text-gray-700">
																								{{$field->title}}
																				</label>
																				<div class="w-full flex flex-wrap items-center">
																					<input 
																						type="file"
																						name="custom_{{$field->slug}}" 
																						id="{{$field->slug}}_{{$language->locale}}"  
																						class="mt-1 block w-8/12 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
																						@if($field->getFirstMedia('field') !== null)
																							<div class="w-2/12 pl-1">
																								<a href="{{ route('sections.deleteImage',$field->getFirstMedia('field')->id) }}" 
																										onclick="return confirm('Are you sure?')" 
																										class="w-full inline-flex items-center justify-center mt-1 px-4 py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:rose-2 focus:ring-offset-2 focus:ring-rose-500">
																									Delete
																								</a>
																							</div>
																							<div class="w-2/12 pl-1">
																								<img src="{{$field->getFirstMediaUrl('field')}}" alt="{{$field->title}}">
																							</div>
																						@endif
																				</div>
																			</div>
																		@endif
                                <hr class="mt-4 mb-1">
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                <div class="w-3/12 p-1">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="px-4 py-4 bg-gray-50 sm:px-6 border-b border-gray-300">
                            <h3 class="font-semibold text-md text-gray-800 leading-tight">Seo</h3>
                        </div>
                        <div class="p-4">
                            @foreach($languages as $language)
                                <div class="p-2">
                                    <label for="seo_title_{{$language->locale}}" class="block font-medium text-gray-700">Title - {{$language->locale}}</label>
                                    <input 
                                        type="text" name="seo_title_{{$language->locale}}" 
                                        id="seo_title_{{$language->locale}}" value="{{$section->getTranslation('seo_title', $language->locale)}}" 
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                            @endforeach
                            @foreach($languages as $language)
                                <div class="p-2">
                                    <label for="seo_description_{{$language->locale}}" class="block font-medium text-gray-700">Description - {{$language->locale}}</label>
                                    <input 
                                        type="text" name="seo_description_{{$language->locale}}" 
                                        id="seo_description_{{$language->locale}}" value="{{$section->getTranslation('seo_description', $language->locale)}}" 
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{Form::hidden('_method','PUT')}}

            <div class="bg-white overflow-hidden sm:rounded-lg mx-1 mt-2">
							<div class="overflow-hidden sm:rounded-md">
								<div class="px-4 py-3 sm:px-6">
									<button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
										Save
									</button>
								</div>
							</div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

</x-app-layout>
