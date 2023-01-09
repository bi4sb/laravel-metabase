@extends(config('laravolt.metabase.view.layout'))
@section('content')
    <x-metabase :dashboard="$id" :exp="$exp" :params="$params"></x-metabase>
@endsection
