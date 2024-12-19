<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pformat2Controller;
use App\Http\Controllers\Format2Controller;
use App\Http\Controllers\F2Controller;
use App\Http\Controllers\Format3Controller;
use App\Http\Controllers\InspectionsController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\Format5Controller;
use App\Http\Controllers\F5Controller;
use App\Http\Controllers\Format6Controller;
use App\Http\Controllers\F6Controller;
use App\Http\Controllers\Format4Controller;
use App\Http\Controllers\F7Controller;
use App\Http\Controllers\DesicionController;

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
Route::post('pformat2/verifyData', [Pformat2Controller::class, 'actVerifyData']);
//
// Route::get('format2/show',[Format2Controller::class, 'actShow']);


// reclamo
Route::get('format2/form', [Format2Controller::class, 'actForm']);
Route::get('format2/show', [Format2Controller::class, 'actShow']);
Route::post('format2/saveClaim', [Format2Controller::class, 'actSaveClaim']);
Route::post('format2/saveChangeClaim', [Format2Controller::class, 'actSaveChangeClaim']);
Route::get('format2/list', [Format2Controller::class, 'actList']);
Route::get('format2/edit', [Format2Controller::class, 'actEdit']);
Route::post('format2/fillReclaimWeb', [Format2Controller::class, 'actFillReclaimWeb']);


// reclamo form
Route::post('format2/searchReclaim', [Format2Controller::class, 'actSearchReclaim']);
Route::post('format2/searchData', [Format2Controller::class, 'actSearchData']);
Route::post('format2/searchName', [Format2Controller::class, 'actSearchName']);
Route::post('format2/searchIns', [Format2Controller::class, 'actSearchIns']);
// Route::post('format2/showEvidence', [Format2Controller::class, 'actShowEvidence']);
Route::get('format2/showEvidence/{idFo2?}',[Format2Controller::class, 'actShowEvidence'])->name('detalle-archivo');
Route::post('format2/changeProcess',[Format2Controller::class, 'actChangeProcess']);
Route::post('format2/loadClaim',[Format2Controller::class, 'actLoadClaim']);


Route::get('format2/f2/{idFo2?}',[F2Controller::class, 'actF2'])->name('f2');






Route::get('court/start',[HomeController::class, 'actStart'])->name('formatThree');//no porq pero vota error por esto

Route::post('ins/gethora',[InspectionsController::class, 'obtenerHorariosDisponiblesPorHora']);
Route::get('ins/getdate',[InspectionsController::class, 'obtenerFechasOcupadas']);
Route::get('ins/getavailable',[InspectionsController::class, 'tecnicosDisponibles']);
// Route::post('ins/changeDateInspection',[InspectionsController::class, 'actChangeDateInspection']);
Route::get('ins/obtenerInspecciones', [InspectionsController::class, 'obtenerInspecciones']);
Route::get('ins/obtenerHorariosDisponiblesPorMes', [InspectionsController::class, 'obtenerHorariosDisponiblesPorMes']);
Route::post('ins/saveChangeIns',[InspectionsController::class, 'actSaveChangeIns']);



// formato3
Route::get('format3/show/{ins}',[Format3Controller::class, 'actShow']);

// inspection interna y externa
Route::get('inspection/show',[InspectionController::class, 'actShow']);
Route::get('inspection/list', [InspectionController::class, 'actList']);
Route::post('inspection/changeProcess', [InspectionController::class, 'actChangeProcess']);

// formato 5

Route::post('format5/save', [Format5Controller::class, 'actSave']);
Route::post('format5/f5', [Format5Controller::class, 'actF5']);
Route::get('format5/file/{idFo5}', [Format5Controller::class, 'actFile'])->name('format5-file');
Route::get('format5/f5/{idFo2?}',[F5Controller::class, 'actF5'])->name('f5');

// formato 6
Route::post('format6/save', [Format6Controller::class, 'actSave']);
Route::post('format6/f6', [Format6Controller::class, 'actF6']);
Route::get('format6/file/{idFo6}', [Format6Controller::class, 'actFile'])->name('format6-file');
Route::get('format6/f6/{idFo2?}',[F6Controller::class, 'actF6'])->name('f6');
// formato 4 acta de conciliacion

Route::get('format4/show',[Format4Controller::class, 'actShow']);
Route::get('format4/list', [Format4Controller::class, 'actList']);
Route::post('format4/save', [Format4Controller::class, 'actSave']);
Route::post('format4/f4', [Format4Controller::class, 'actF4']);
Route::post('format4/saveFile', [Format4Controller::class, 'actSaveFile']);
Route::get('format4/file/{idFo4}', [Format4Controller::class, 'actFile'])->name('format4-file');
Route::post('format4/changeProcess', [Format4Controller::class, 'actChangeProcess']);
// formato 7
Route::get('format7/f7/{idFo2?}',[F7Controller::class, 'actF7'])->name('f7');
// formato 10 resoluciones
Route::get('desicion/show',[DesicionController::class, 'actShow']);
Route::get('desicion/list', [DesicionController::class, 'actList']);
Route::post('desicion/changeProcess', [DesicionController::class, 'actChangeProcess']);
