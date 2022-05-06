@props(['bind'=>false, 'value'=>'', 'type'=>'text', 'label', 'name', 'disabled' => false])

@php
if($bind && isset($bind[$name])) {
    $value = $bind[$name];
}
if(old($name)) {
    $value = old($name);
}

@endphp

<div class="mb-4">
    <x-label :for="$name" :value="$label" />

    @if($type == "checkbox")
        <x-input :id="$name" class="block mt-1 w-full" :type="$type" :name="$name" value="1" :checked="$value" />
    @else
        <x-input :id="$name" class="block mt-1 w-full" :type="$type" :name="$name" :value="$value" />
    @endif
</div>