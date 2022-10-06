<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Todo;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
  public function index()
  {
    $tags = Tag::all();
    $user = Auth::user();
    $todos = Todo::with(['user','tag'])->where('user_id', Auth::id())->get();

    return view('index',['todos' => $todos, 'user' => $user, 'tags' => $tags]);
  }

  public function create(TodoRequest $request)
  {
    $form = $request->all();
    $form = array_merge($form,array('user_id'=>\Auth::id()));

    Todo::create($form);

    return redirect()->route('home');
  }

  public function update(TodoRequest $request)
  {
    $form = $request->all();
    unset($form['_token']);

    Todo::where('id', $request->id)->update($form);

    return redirect()->back() ;
  }

  public function delete(Request $request)
  {
    Todo::find($request->id)->delete();

    return redirect()->route('home');
  }

  public function find()
  {
    $tags = Tag::all();
    $user = Auth::user();

    return view('find',['user' => $user, 'tags' => $tags]);
  }

  public function search(Request $request)
  {
    $form = $request->all();

    if($form['tag_id'] == null) {
      $todos = Todo::with(['user','tag'])->
        where([['user_id', Auth::id()],
              ['task_name', 'LIKE', "%{$form['task_name']}%"]
              ])->get();
    }else{
      $todos = Todo::with(['user','tag'])->
        where([['user_id', Auth::id()],
              ['tag_id', $form['tag_id']],
              ['task_name', 'LIKE', "%{$form['task_name']}%"]
              ])->get();
    }

    $tags = Tag::all();
    $user = Auth::user();

    return view('find',['todos' => $todos, 'user' => $user, 'tags' => $tags]);
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('login');
  }

}
