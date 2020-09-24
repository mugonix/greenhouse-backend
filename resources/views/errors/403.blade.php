@extends('errors::minimal')

@section('pageTitle', __('Forbidden'))
@section('title', __('Forbidden Error'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
