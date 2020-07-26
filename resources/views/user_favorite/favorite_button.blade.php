{{-- お気に入り登録／お気に入り削除ボタンを表示する部分共通のView --}}

@if (Auth::id() != $micropost->user_id)
    @if (Auth::user()->is_favorites($micropost->id))
        {{-- お気に入り削除ボタンのフォーム --}}
        {!! Form::open(['route' => ['favorites.unfavorite', $micropost->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unfavorite', ['class' => "btn btn-success btn-sm"]) !!}
       {!! Form::close() !!}
    @else
        {{-- お気に入り登録ボタンのフォーム --}}
        {!! Form::open(['route' => ['favorites.favorite', $micropost->id]]) !!}
            {!! Form::submit('Favorite', ['class' => "btn btn-light btn-sm"]) !!}
        {!! Form::close() !!}
    @endif
@endif