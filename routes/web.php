<?php

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
use App\Mail\WelcomMail;
// Route::get('/email', function(){

//     Mail::to('vlarrabis@gmail.com')->send(new WelcomMail());
//     return new WelcomMail();
// });

Route::get('/report_pdf','ReportsController@leftReliefpdf');
Route::get('/pdf_asd',function(){return view('pages.pdf_test');});
Route::get('/donations_pdf','ReportsController@donationpdf');
Route::get('/relief_pdf','ReportsController@reliefpdf');
Route::put('/relief_item_add','ReliefItemsController@store')->middleware('admin');
Route::get('/relief_items/{id}','ReliefsController@relief_items')->middleware('admin');
Route::get('gen_donation_pdf','DonationsController@donationpdf')->middleware('admin');
Route::get('gen_donor_pdf','DonorsController@donorpdf')->middleware('admin');
Route::get('gen_resident_pdf','ResidentsController@genpdf')->middleware('admin');


Route::get('/asd','ExpendituresController@test');

Route::get('/super_admin/registration', function(){return view('pages.super_admin');});
Route::get('/city_admin/registration', function(){return view('pages.city_admin');});
Route::put('/distributor_change_pass','UsersController@distributor_pass');
Route::get('/relief_qr/{id}','ReliefsController@scannedrel');
Route::get('/scanned_qr/{id}','ResidentsController@scanqr');
Route::put('/recieved_relief','ResidentsController@recieved_relief');
Route::post('/log','ApiController@login');
Route::put('/posttest','DonorsController@posttest');
Route::get('/postman/{id}','ResidentsController@postman');

Route::put('/reset_distributor_password','UsersController@reset')->middleware('admin');
Route::put('/search_result', 'UsersController@search')->middleware('admin');
Route::put('/update_status','UsersController@update_status')->middleware('admin');
Route::put('/edit_distributor','UsersController@editinfo')->middleware('admin');
Route::get('/distributor','UsersController@distributor')->middleware('admin');
Route::post('/register_distributor','UsersController@register')->middleware('admin');
Route::put('/delete_distributor','UsersController@softdeletedist')->middleware('admin');


Route::put('/delete_donor','DonorsController@softdelete')->middleware('admin');
Route::put('/delete_relief','ReliefsController@softdelete')->middleware('admin');
Route::put('/delete_expenditure','ExpendituresController@softdelete')->middleware('admin');
Route::put('/delete_exp_item','BoughtItemsController@softdelete')->middleware('admin');


// City_Admin Pages
Route::get('/barangay_expenditures','ExpendituresController@city_expenditures')->middleware('cityadmin');
Route::get('/donation_recieved','DonorsController@donation_city')->middleware('cityadmin');
Route::get('/donation_recieved/{id}','DonorsController@donation_recieve')->middleware('cityadmin');
Route::get('/relief_information','ReliefsController@city_relief')->middleware('cityadmin');
Route::get('/update_information','PagesController@updateinfo')->middleware('cityadmin');
Route::get('/barangay_trashed','TrashController@brgytrashed')->middleware('cityadmin');
Route::get('/barangay_relief_receivers','ReliefsController@relief_receivers')->middleware('cityadmin');


Route::get('/recieved_list','ResidentsController@records')->middleware('admin');


Route::get('/super_admin','UsersController@admin_account')->middleware('superadmin');
Route::put('/update_admin_account','UsersController@update_account')->middleware('superadmin');
Route::get('/edit_super_admin_account','PagesController@supereditaccount')->middleware('superadmin');
Route::post('/send_email','Auth\ForgotPasswordController@password');



Route::get('/reset_password','PagesController@reset_password');
Route::get('/admin/registration','PagesController@admin_reg');
Route::post('/verify','UsersController@create_admin')->name('admin_reg');






Route::get('/','PagesController@index')->name('signin');

Route::get('/expenses','ExpendituresController@expenses');
Route::get('/brgyPage','DonorsController@donationsDisp')->middleware('visitor');
Route::get('/givendonation/{id}','DonorsController@givendonation')->middleware('visitor');
Route::get('/edit_account','PagesController@editaccount')->middleware('visitor')->name('editaccount');
Route::get('/update_account','PagesController@updateaccount')->middleware('admin')->name('updateaccount');

/*Route::get('/resident','PagesController@resident');*/
// Route::get('/donations','PagesController@donation');
// Route::get('/relief','PagesController@relief');
Route::get('/signin','PagesController@signin');
Route::get('/reg','PagesController@reg')->name('newaccount');
Route::get('/adminview','PagesController@adminview')->middleware('admin');
Route::get('/smsSender','SenderController@sender')->middleware('admin');
Route::get('/dashboard','PagesController@dashboard')->middleware('admin');
Route::get('/list_of_receivers','ResidentsController@listToReceive')->middleware('admin');
Route::get('/expenditures','ExpendituresController@index')->middleware('admin');
Route::put('/register_expenditure','ExpendituresController@store')->middleware('admin');
Route::get('/expenditure_item/{id}','ExpendituresController@expitem')->middleware('admin');
Route::put('/exp_add_item','BoughtItemsController@store')->middleware('admin');
Route::get('/reciever_list','ResidentsController@recievers')->middleware('visitor');
Route::get('/trashed','TrashController@index');
Route::put('/edit_donor_info','DonorsController@editinfo')->middleware('admin');

Route::put('/donation_complete','DonationsController@completed')->middleware('admin');
Route::put('/del_donation','DonationsController@softdelete')->middleware('admin');

Route::put('/changepass','UsersController@changepass')->name('changepass');
Route::put('/updateuser','UsersController@editacc')->name('updateUser');
// Route::get('/expenditure', function(){
//     return view('pages.expenditures');
// });
// Route::get('/dlqr','QrcodeDLController@display');
// Route::get('/qrdisplay','PagesController@qrdisplay');
// Route::post('/sender','SenderController@itexmofunc');

Route::get('/test',function ()  {

    // $donation = App\Donation::first();
    $relief = App\Relief::with('donations')->latest();
    $relief->donations()->attach([1,3,5]);
    // $relief->donations()->attach($donation->donation_id);
    
});

// ajax method
// Route::post('/residentadd','ResidentsController@store');
Route::post('/addrelief','ReliefsController@store')->middleware('admin');
Route::put('/residentupdate/{id}','ResidentsController@update')->middleware('admin');
Route::put('/residentupdateqr/{id}','ResidentsController@updateqr')->middleware('admin');
// end ajax method

// modified resources
Route::post('/donor/send','DonorsController@donorsms')->middleware('admin');
Route::post('/resident/send','ResidentsController@residentsms')->middleware('admin');
Route::get('/donorInfo/{donor}','DonorsController@info')->middleware('admin');
Route::get('/search','ResidentsController@search')->middleware('admin');
Route::put('/duplicateCheck','ResidentsController@duplicateCheck');
Route::put('/updateAll','ResidentsController@updateAllQr')->middleware('admin');
Route::put('/purokqrupdate','ResidentsController@purokQrupdate')->middleware('admin');
Route::put('/residentdelete','ResidentsController@softdelete')->middleware('admin');
Route::put('/relief_complete','ReliefsController@complete')->middleware('admin')->name('reliefdelete');
Route::get('/distributedRelief', 'ReliefsController@completed')->middleware('admin');
Route::get('/relief_distributed','ReliefsController@distRel')->middleware('visitor');
Route::get('/relief_to_be_distribute','ReliefsController@relToDist')->middleware('visitor');
// Route::get('/edit_account','Userscontroller@editUser')->middleware('visitor')->name('editaccount');
// end modifoed resources

Route::resource('posts','PostsController')->middleware('admin');
Route::resource('/relief','ReliefsController')->middleware('admin');
Route::resource('/resident','ResidentsController')->middleware('admin');
Route::resource('/donation','DonorsController')->middleware('admin');
Route::resource('/donorInfo','DonationsController')->middleware('admin');
Route::get('/recipients','ResidentsController@recipients')->middleware('visitor');
// Route::resource('/resident/{$resident}','ResidentsController@show');
// Route::resource('/relief/{relid}','ReliefsController@show')->middleware('auth');
// Route::resource('/smsSender/send','ResidentsController@itexmo');

// Route::resource('/donorInfo/{$donation}','DonationsController@show');

// Retrieve Trash

Route::put('/ret_res','TrashController@ret_res');
Route::put('/ret_dist','TrashController@ret_dist');
Route::put('/ret_donor','TrashController@ret_donor');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
