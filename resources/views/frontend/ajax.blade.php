@foreach ($categories as $item)
    <li class="list-items"><a href="{{route('help.articles', $item->id)}}">{{$item->getTranslation('name')}}</a></li>
@endforeach
