@component('mail::message')
# {{ $seriesName }} was created

The series {{ $seriesName }} with {{ $seasonsQty }} seasons and {{ $episodesPerSeason }} episodes per season was created.

You can view it here:

@component('mail::button', ['url' => route('seasons.index', $seriesId)])
Go to series
@endcomponent

@endcomponent
