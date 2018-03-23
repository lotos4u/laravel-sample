@extends('basic.blocks.form')

@section('block-title')
    @if(isset($block_title)){{ $block_title }}@endif
@endsection

@section('block-subtitle')
    @if(isset($block_subtitle)){{ $block_subtitle }}@endif
@endsection

