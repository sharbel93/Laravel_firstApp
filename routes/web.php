<?php
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    //  update the home route by getting a 
// collection of links from the database and passing them to the view
    $links = \App\Link::all();

    // The second argument can be an associative array of data, and the key 
    // ends up being the variable name in the template file.
    return view('welcome', ['links' => $links]);
    
});

Route::get('/submit', function () {
    return view('submit');
});


// we are injecting the Illuminate\Http\Request object, 
// which holds the POST data and other data about the request.
Route::post('/submit', function (Request $request) {
    // we use the request’s validate() method to validate the form data. 
   $data = $request->validate([
       'title' => 'required|max:255',
       'url' => 'required|url|max:255',
       'description' => 'required|max:255'
   ]);
//    We require all three fields, and using the pipe character; 
// we can define multiple rules. All three rules can have a max of 255 characters, 
// and the url field requires a valid URL.
// If validation fails, an exception is thrown,
//  and the route returns the user with the original input data and validation errors.

// we use the tap() helper function to create a new Link model instance 
// and then save it. Using tap allows us to call save() 
// and still return the model instance after the save.
   $link = tap(new App\Link($data))->save();
   return redirect('/');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
