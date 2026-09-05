<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Dashboard') - SD Learning Center</title>

    <link rel="icon" href="{{ asset('assets/admin/img/favicon.ico') }}">

    <link href="{{ asset('assets/admin/css/tabler.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/tabler-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/custom.css') }}" rel="stylesheet">
</head>