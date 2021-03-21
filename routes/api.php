<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('mentors', 'MentorController@index');
Route::get('mentors/{id}', 'MentorController@show');
Route::post('mentors', 'MentorController@create');
Route::put('mentors/{id}', 'MentorController@update');
Route::delete('mentors/{id}', 'MentorController@destroy');

Route::get('courses', 'CourseController@index');
Route::get('courses/{id}', 'CourseController@show');
Route::post('courses', 'CourseController@create');
Route::put('courses/{id}', 'CourseController@update');
Route::delete('courses/{id}', 'CourseController@destroy');

Route::get('chapters', 'ChapterController@index');
Route::get('chapters/{id}', 'ChapterController@show');
Route::post('chapters', 'ChapterController@create');
Route::put('chapters/{id}', 'ChapterController@update');
Route::delete('chapters/{id}', 'ChapterController@destroy');

Route::get('lessons', 'LessonController@index');
Route::get('lessons/{id}', 'LessonController@show');
Route::post('lessons', 'LessonController@create');
Route::put('lessons/{id}', 'LessonController@update');
Route::delete('lessons/{id}', 'LessonController@destroy');

Route::get('image_courses/{id}', 'ImageCourseController@show');
Route::post('image_courses', 'ImageCourseController@create');
Route::put('image_courses/{id}', 'ImageCourseController@update');
Route::delete('image_courses/{id}', 'ImageCourseController@destroy');

Route::get('my_courses', 'MyCourseController@index');
Route::get('my_courses/{id}', 'MyCourseController@show');
Route::post('my_courses', 'MyCourseController@create');
Route::post('my_courses/premium', 'MyCourseController@createPremiumAccess');

Route::post('reviews', 'ReviewController@create');
Route::put('reviews/{id}', 'ReviewController@update');
Route::delete('reviews/{id}', 'ReviewController@destroy');
