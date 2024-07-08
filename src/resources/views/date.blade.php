@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/date.css') }}" />
@endsection


@section('content')
<div class="date__content">
    <div class="date">
        <form action="/attendance" method="get" class="date__form">
            @csrf
            <button class="before" name="date" value="{{ $yesterday->format('Y-m-d')}}"> &lt;</button>
        </form>
        <p class="date__today">
            {{ $today->format('Y-m-d') }}
        </p>
        <form action="/attendance" method="get" class="date__form">
            @csrf
            <button class="after" name="date" type="date" value="{{ $tomorrow->format('Y-m-d') }}"> &gt;</button>
        </form>
    </div>
    
    <div class="date__content-table">
        <table class="date__table">
            <tr class="title__row">
                <th class="table__label">名前</th>
                <th class="table__label">勤務開始</th>
                <th class="table__label">勤務終了</th>
                <th class="table__label">休憩時間</th>
                <th class="table__label">勤務時間</th>
            </tr>

            @if (!empty($resultArray))
                @foreach ($resultArray as $work)
                    <tr class="value__row">
                        <td class="value__list">{{ $work['user_name'] }}</td>
                        <td class="value__list">{{ $work['start'] }}</td>
                        <td class="value__list">{{ $work['end'] }}</td>
                        <td class="value__list">{{ $work['total_rest'] }}</td>
                        <td class="value__list">{{ $work['total_work'] }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">勤務情報がありません</td>
                </tr>
            @endif
        </table>
    </div>

    <div class="pagination">
        {{ $works->appends(['date' => $today->format('Y-m-d')])->links('vendor/pagination/custom') }}
    </div>

    
</div>
@endsection