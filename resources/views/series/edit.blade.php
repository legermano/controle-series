<x-layout title="Edit Series '{!! $series->name !!}'">
    <x-series.form :action="route('series.update', $series->id)" :update="true" :name="old('name') ?? $series->name"/>
</x-layout>
