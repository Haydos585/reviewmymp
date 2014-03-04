<?php

class UserController extends \BaseController {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    //Currently redirects to the home page because why not.
    return View::make('static_pages.home');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $user = new User;
    foreach (Input::except('_token') as $key => $value) {
      $user[$key] = $value;
    }
    $user->password = Hash::make($user->password);
    $user->role = "User";

    $validator = Validator::make(
      array(
        'user' => $user
      ),
      array(
        'user["username"]' => 'required|unique:users,username',
        'user["email"]' => 'required|email|unique:users,email',
        'user["password"]' => 'required|min:8'
      )
    );

    if(!$validator->fails())
    {
      $user->save();
      Auth::attempt(array('email' => $user->email, 'password' => Input::get('password')));
      return Redirect::to("/users/$user->id");
    } else {
      return Redirect::to('/');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $user = User::where('id', '=', $id)->first();
    return View::make('users.show')->with('user', $user);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    //Delete the user
    $user = User::find($id);
    $user->delete();
    return Redirect::to('/');
  }

}