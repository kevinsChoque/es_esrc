<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Format2Controller;
use App\Http\Controllers\Format3Controller;
use App\Http\Controllers\InspectionsController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\Format5Controller;
use App\Http\Controllers\Format6Controller;
use App\Http\Controllers\Format4Controller;

// portal
Route::get('/', [PortalController::class, 'actReclamoComercial']);
// login
Route::get('login/login',[LoginController::class, 'actLogin']);
Route::post('login/sigin',[LoginController::class, 'actSigin']);
// dashboard
Route::get('home/home',[HomeController::class, 'actHome']);
// reclamo portal
Route::post('format2/savePortal',[Format2Controller::class, 'actSavePortal']);
Route::post('format2/searchInscription',[Format2Controller::class, 'actSearchInscription']);
// Route::get('format2/show',[Format2Controller::class, 'actShow']);


// reclamo
Route::get('format2/form', [Format2Controller::class, 'actForm']);
Route::get('format2/show', [Format2Controller::class, 'actShow']);
Route::post('format2/saveClaim', [Format2Controller::class, 'actSaveClaim']);
Route::get('format2/list', [Format2Controller::class, 'actList']);
Route::get('format2/edit', [Format2Controller::class, 'actEdit']);
Route::post('format2/fillReclaimWeb', [Format2Controller::class, 'actFillReclaimWeb']);


// reclamo form
Route::post('format2/searchReclaim', [Format2Controller::class, 'actSearchReclaim']);
Route::post('format2/searchData', [Format2Controller::class, 'actSearchData']);
Route::post('format2/searchName', [Format2Controller::class, 'actSearchName']);
Route::post('format2/searchIns', [Format2Controller::class, 'actSearchIns']);



Route::get('court/start',[HomeController::class, 'actStart'])->name('formatThree');//no porq pero vota error por esto

Route::post('ins/gethora',[InspectionsController::class, 'obtenerHorariosDisponiblesPorHora']);
Route::get('ins/getdate',[InspectionsController::class, 'obtenerFechasOcupadas']);
Route::get('ins/getavailable',[InspectionsController::class, 'tecnicosDisponibles']);

// formato3
Route::get('format3/show/{ins}',[Format3Controller::class, 'actShow']);

// inspection interna y externa
Route::get('inspection/show',[InspectionController::class, 'actShow']);
Route::get('inspection/list', [InspectionController::class, 'actList']);
// formato 5

Route::post('format5/save', [Format5Controller::class, 'actSave']);
Route::post('format5/f5', [Format5Controller::class, 'actF5']);
Route::get('format5/file/{idFo5}', [Format5Controller::class, 'actFile'])->name('format5-file');

// formato 6
Route::post('format6/save', [Format6Controller::class, 'actSave']);
Route::post('format6/f6', [Format6Controller::class, 'actF6']);
Route::get('format6/file/{idFo6}', [Format6Controller::class, 'actFile'])->name('format6-file');
// formato 4 acta de conciliacion

Route::get('format4/show',[Format4Controller::class, 'actShow']);
Route::get('format4/list', [Format4Controller::class, 'actList']);
Route::post('format4/save', [Format4Controller::class, 'actSave']);
Route::post('format4/f4', [Format4Controller::class, 'actF4']);
Route::post('format4/saveFile', [Format4Controller::class, 'actSaveFile']);
Route::get('format4/file/{idFo4}', [Format4Controller::class, 'actFile'])->name('format4-file');

