@extends('layouts.bootstrap')

@section('content')
  <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">{{ isset($heading)? $heading : 'All users' }}</div>
            <!-- Table -->
            <table class="table">
            <tr><th>Name</th>
            @if(Auth::check() && Auth::user()->is_super)
            <th>Publisher</th>
            <th></th>
            @endif
            </tr>
          @foreach($users as $user)
              <tr>
              <td>{{ HTML::linkAction('ArticlesController@author', $user->name,array($user->id)) }}</td>
              @if(Auth::check() && Auth::user()->is_super)
              <td>
                  @if($user->is_super)
                      Yes
                  @else
                      No
                  @endif
              </td>
              <td>
              <div class="btn-group">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                    Actions <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li>{{ HTML::linkAction('UsersController@destroy', 'Delete', array($user->id)) }}</li>
                        @if($user->is_super)
                            <li>{{ HTML::linkAction('UsersController@revoke_super', 'Revoke Publisher', array($user->id)) }}</li>
                        @else
                            <li>{{ HTML::linkAction('UsersController@grant_super', 'Grant Publisher', array($user->id)) }}</li>
                        @endif
                  </ul>
              </div>
              </td>
              @endif
              </tr>
          @endforeach
          </table>
          </div>
@endsection