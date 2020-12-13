@extends('layouts.mainPage')
@section('title', $title)
{{-- title TRang chu --}}
@section('content')
<h1>Day la index</h1>

<h1> {{($userName)}}</h1>
<h1>{{($email)}}</h1>
@endsection
