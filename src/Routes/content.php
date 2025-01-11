<?php

use Daugt\Controllers\Admin\Content\DeleteContentController;
use Daugt\Controllers\Content\AddCommentReactionController;
use Daugt\Controllers\Content\AddCommentReplyController;
use Daugt\Controllers\Content\AddContentReactionController;
use Daugt\Controllers\Content\BlogIndexController;
use Daugt\Controllers\Content\CreateContentCommentController;
use Daugt\Controllers\Content\DeleteCommentController;
use Daugt\Controllers\Content\ShowBlogController;
use Daugt\Controllers\Content\ShowContentController;
use Daugt\Livewire\Content\ContentTable;
use Daugt\Livewire\Content\EditContent;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'can:access admin panel'], 'prefix' => 'admin/content', 'as' => 'admin.content.'], function () {
    Route::get('/', ContentTable::class)->name('index');
    Route::get('/create', EditContent::class)->name('create');
    Route::get('/{content:id}', EditContent::class)->name('edit');
    Route::delete('/{page}', DeleteContentController::class);
});

Route::group(['middleware' => ['web']], function () {
    Route::post('/comments/{comment}/reactions/{reaction}', AddCommentReactionController::class)->name('comments.reactions.add');
    Route::post('/comments/{comment}/reply', AddCommentReplyController::class)->name('comments.reply.add');
    Route::delete('/comments/{comment}', DeleteCommentController::class)->name('comments.delete');


    Route::get('/{first?}/{second?}', ShowContentController::class)->name('content.show');

    Route::post('/{type}/{slug}/comments/create', CreateContentCommentController::class)->name('content.comments.create');
    Route::post('/{type}/{slug}/reactions/{reaction}', AddContentReactionController::class)->name('content.reactions.add');
});
