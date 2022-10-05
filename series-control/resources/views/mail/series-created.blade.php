@component('mail::message')

# {{ $seriesName }} criada.

Série {{ $seriesName }} com temporadas {{ $seasonsQuantity }} e episódeos {{ $episodesPerSeason}}

Acesse aui:

@component('mail::button', ['url' => route('seasons.index', $seriesId)])
    View
@endcomponent

@endcomponent
