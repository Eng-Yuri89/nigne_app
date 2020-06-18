<?php
Route::get('test_email' , function (){
    return 'Hello email';
})->middleware(['auth' , 'email_verified']);


Route::get('super_admin' , function (){
    return 'Hello supper admin';
})->middleware(['auth' , 'email_verified','user_is_admin','user_is_support']);

Route::get('test_admin' , function (){
    return 'Hello admin';
})->middleware(['auth' , 'email_verified','user_is_admin']);


Route::get('test_support' , function (){
    return 'Hello support';
})->middleware(['auth' , 'email_verified','user_is_support']);


Route::get('role-user', function () {
    $role=\App\Role::find(1);
    return $role->users;   });

Route::get('user-role', function () {
    $user=\App\User::find(1);
    return $user->roles;
});


Route::get('tag-test', function () {
    $tag=Tag::find(1);
    return $tag->products;
});

Route::get('ptag-test', function () {
    $product=\App\Product::find(2);
    return $product->tags;
});

Route::get('states', function () {
    return \App\State::with(['country' , 'cities'])->paginate(1);
});


Route::get('countries', function () {
    return \App\Country::with(['cities' , 'states'])->paginate(1);
});

Route::get('cities', function () {
    return City::with(['state' , 'country'])->paginate(1);
});





Route::get('import-units', 'DataImportController' );


Route::get('users', function () {
    return \App\User::paginate(15);
});

Route::get('products', function () {
    return \App\Product::with(['images'])->paginate(100);
});


Route::get('images', function () {
    return \App\Image::paginate(100);
});
