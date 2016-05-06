@extends('layouts.app')

@section('content')

    <!-- Current Tasks -->
    @if (count($users) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Users list
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                    <th>User</th>
                    <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <!-- Task Name -->
                            <td class="table-text">
                                <div>{{ $user->name }}</div>
                                <div>{{ $user->email }}</div>
                                <div>{{ $user->profile_type }}</div>
                                <div>{{ $user->experience_level }}</div>
                            </td>

                            <!-- Delete Button -->
                            <td>
                                <form action="/user/{{ $user->id }}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">

                                    <button>Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

@endsection
