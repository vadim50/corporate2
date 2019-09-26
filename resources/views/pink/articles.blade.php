@extends(env('THEME').'.layouts.site')

@section('navigation')
	{!! $navigation !!}
@endsection

@section('content')
	{!! $section !!}
@endsection

@section('bar')
	{!! $rightBar !!}
@endsection

@section('footer')
	{!! $footer !!}
@endsection