@props([
    'bind'=>false, 
    'value'=>'', 
    'type'=>'text', 
    'label', 
    'name', 
    'disabled' => false, 
    'options'=>[],
    'info' => false
])

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
        <x-input x-ref="{{ $name }}" :disabled="$disabled" :id="$name" class=" block h-6 w-6" :type="$type" :name="$name" value="1" :checked="$value" :attributes="$attributes" />
        <x-label :for="$name" :value="$label" class="cursor-pointer" />
        @if($info)<small class="text-gray-600">{{ $info }}</small>@endif
    </div>
@elseif($type == "select")
    <div class="mb-4">
        <x-label :for="$name" :value="$label" class="cursor-pointer" />
        <select x-ref="{{ $name }}" @if($disabled) disabled @endif id="{{ $name }}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="{{ $name }}" {{$attributes }}>
            @foreach($options as $optionLabel=>$optionValue) 
                <option value="{{ $optionValue }}" @if($optionValue == $value) selected @endif>{{ $optionLabel }}</option>
            @endforeach
        </select>
        @if($info)<small class="text-gray-600">{{ $info }}</small>@endif
    </div>
@else
    <div class="mb-4">
        <x-label :for="$name" :value="$label" />
        <x-input x-ref="{{ $name }}" :disabled="$disabled" :id="$name" class="block mt-1 w-full" :type="$type" :name="$name" :value="$value" :attributes="$attributes" />
        @if($info)<small class="text-gray-600">{{ $info }}</small>@endif
    </div>
@endif