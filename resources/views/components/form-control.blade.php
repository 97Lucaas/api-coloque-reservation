@props(['bind'=>false, 'value'=>'', 'type'=>'text', 'label', 'name', 'disabled' => false, 'options'=>[]])

@php
if($bind && isset($bind[$name])) {
    $value = $bind[$name];
}
if(old($name)) {
    $value = old($name);
}

@endphp

@if($type == "checkbox")
    <div class="flex flex-row mb-4 items-center gap-3">
        <x-input :id="$name" class=" block h-6 w-6" :type="$type" :name="$name" value="1" :checked="$value" />
        <x-label :for="$name" :value="$label" class="cursor-pointer" />
    </div>
@elseif($type == "select")
    <div class="mb-4">
        <x-label :for="$name" :value="$label" class="cursor-pointer" />
        <select id="{{ $name }}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="{{ $name }}">
            @foreach($options as $option) 
                <option value="{{ $option }}" @if($option == $value) selected @endif>{{ $option }}</option>
            @endforeach
        </select>
    </div>
@else
    <div class="mb-4">
        <x-label :for="$name" :value="$label" />
        <x-input :id="$name" class="block mt-1 w-full" :type="$type" :name="$name" :value="$value" />
    </div>
@endif