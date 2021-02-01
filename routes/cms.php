<?php 


Route::get('/stories', Console\StoryList::class)->name('stories.list');
Route::get('/stories/new', Console\NewStoryForm::class)->name('stories.new');
Route::post('/stories/save', Console\SaveStory::class)->name('stories.save');
Route::get('/stories/{story}/edit', Console\EditStory::class)->name('stories.edit');
Route::post('/stories/{story}/update', Console\UpdateStory::class)->name('stories.update');
Route::get('/stories/{story}/delete', Console\DeleteStory::class)->name('stories.delete');

Route::get('/users', Console\User\UserList::class)->name('users.list');
Route::get('/users/new', Console\User\NewUserForm::class)->name('users.new');
Route::post('/users/save', Console\User\SaveUser::class)->name('users.save');
Route::get('/users/{user}/hOkexhysw3', Console\User\Deleteuser::class)->name('users.delete');
Route::get('users/{user}/edit', Console\User\EditUser::class)->name('users.edit');
Route::post('users/{user}/update', Console\User\UpdateUser::class)->name('users.update');