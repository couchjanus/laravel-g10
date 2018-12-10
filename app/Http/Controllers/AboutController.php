<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AboutController extends Controller {

  public function __invoke()

  {
    return view('home.about', ['title' => 'About Page']);
  }


}