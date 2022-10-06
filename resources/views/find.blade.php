@extends('layouts.default')
@section('content')

@if (Auth::check())
  <body>
    <div class="todo">
      <div class="todo__content">
        <div class="todo__header">
          <p class="todo__title">タスク検索</p>
          <p class="todo__login-user">「{{$user->name}}」でログイン中</p>
        </div>
        @if(count($errors) > 0)
          <ul class="todo_err-list">
            @foreach ($errors->all() as $error)
            <li>
              {{$error}}
            </li>
            @endforeach
          </ul>
        @endif
        <form class="todo__create" action="/find/search" method="get">
          @csrf
          <input class="todo__create-txt" type="text" name="task_name">
          <select class="todo__create-tag" name="tag_id">
              <option value=""></option>
            @foreach($tags as $tag)
              <option value="{{$tag->id}}">{{$tag->tag_name}}</option>
            @endforeach
          </select>
          <button class="todo__create-btn">検索</button>
        </form>
        <table class="todo__table">
          <tr>
            <th>作成日</th>
            <th>タスク名</th>
            <th>タグ</th>
            <th>更新</th>
            <th>削除</th>
          </tr>
          @if(isset($todos))
            @foreach($todos as $todo)
              <tr>
                <td>
                  {{$todo->created_at}}
                </td>
                <form action="/{{$todo->id}}/update" method="post">
                  @csrf
                  <td>
                    <input class="todo__table-task-name" type="text" name="task_name" value="{{$todo->task_name}}">
                  </td>
                  <td>
                    <select class="todo__table-tag" name="tag_id">
                      @foreach($tags as $tag)
                        @if($tag->id === $todo->tag_id)
                          <option value="{{$tag->id}}" selected="selected">{{$tag->tag_name}}</option>
                        @else
                          <option value="{{$tag->id}}">{{$tag->tag_name}}</option>
                        @endif
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <button class="todo__table-update-btn">更新</button>
                  </td>
                </form>
                <td>
                  <form action="/{{$todo->id}}/delete" method="post">
                    @csrf
                    <button class="todo__table-delete-btn">削除</button>
                  </form>
                </td>
              </tr>
            @endforeach
          @endif
        </table>
        <a href="/home"><button class="todo__back-btn">戻る</button></a>
      </div>
    </div>
  </body>
@else
  <p>ログインしてください（
    <a href="/login">ログイン</a>｜
    <a href="/register">登録</a>）
  </p>
@endif

@endsection
