@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/user-list.css') }}" />
@endsection

@section('content')
<div class="user-list__content">
    <div class="user-list__header">
        <div class="user-list__ttl">
            <h2>ユーザー一覧</h2>
        </div>
    </div>

    <div class="user-list">
        <table class="user-list__table">
            <tr class="title__row">
                <th class="table__label">名前</th>
                <th class="table__label">メールアドレス</th>
            </tr>

            @foreach ($users as $user)
                <tr class="value__row">
                    <td class="value__list">
                        <a href="/userpage?id={{ $user->id }}" class="link__button">
                            {{ $user->name }}
                        </a>
                    </td>
                    <td class="value__list">{{ $user->email }}</td>
                </tr>
            @endforeach
        </table>


    </div>

    <div class="pagination">
        {{ $users->links('vendor/pagination/custom') }}
    </div>
</div>
@endsection

