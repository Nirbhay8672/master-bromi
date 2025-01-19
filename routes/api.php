<?php

// use Illuminate\Http\Request;

use App\Http\Controllers\Admin\ProjectsController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\HomeController;
// // use App\Http\Controllers\Api\ApiController;
// use App\Http\Controllers\Api\UserController;
// use App\Http\Controllers\Api\VerificationController;

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



Route::get('/get', [App\Http\Controllers\Api\AuthController::class, 'get']);

// Api Route Started
Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
//verification token
Route::post('/generate_verificationP_token', [App\Http\Controllers\Api\AuthController::class, 'generateToken']);
Route::post('/verify_verification_token', [App\Http\Controllers\Api\AuthController::class, 'verifyToken']);
//verification token
Route::get('/state', [App\Http\Controllers\Api\AuthController::class, 'getstate']);
Route::post('/city', [App\Http\Controllers\Api\AuthController::class, 'getcity']);

Route::post('/forgot-password', [App\Http\Controllers\Api\AuthController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [App\Http\Controllers\Api\AuthController::class, 'reset']);


Route::get('/getData',[App\Http\Controllers\Api\AuthController::class , 'getData']);

//Protecting Routes

//  Route::group(['middleware' => 'auth:sanctum'], function () {
//         Route::get('logout',     [App\Http\Controllers\Api\AuthController::class, 'login']);
//         Route::get('profile',      ' [App\Http\Controllers\Api\AuthController::class, 'profile']');
//     });
Route::group(['middleware' => ['auth:sanctum']], function () {
    
    Route::post('/profile', [App\Http\Controllers\Api\AuthController::class, 'profile']);
    Route::post('/edit_profile', [App\Http\Controllers\Api\AuthController::class, 'chnageProfile']);
    Route::post('/changepassword', [App\Http\Controllers\Api\AuthController::class, 'chnagePassword'])->name('change-pwd');

    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);

    
    //forms    
    Route::get('/getformdata', [App\Http\Controllers\Api\FormsController::class, 'getformdata']);
    Route::post('/addform', [App\Http\Controllers\Api\FormsController::class, 'addForm']);
    Route::post('/editform', [App\Http\Controllers\Api\FormsController::class, 'editForm']);
    Route::post('/addformtype', [App\Http\Controllers\Api\FormsController::class, 'addFormType']);
    Route::post('/editformtype', [App\Http\Controllers\Api\FormsController::class, 'editFormType']);
    Route::post('/addformfiled', [App\Http\Controllers\Api\FormsController::class, 'addFormFiled']);
    Route::post('/editformfiled', [App\Http\Controllers\Api\FormsController::class, 'editFormFiled']);
    Route::post('/formfieldimport', [App\Http\Controllers\Api\FormsController::class, 'importExcel']);

    //Property
    Route::post('/list_property', [App\Http\Controllers\Api\propertyController::class, 'index']);
    Route::post('/add_property', [App\Http\Controllers\Api\propertyController::class, 'saveProperty']);
    Route::post('/property', [App\Http\Controllers\Api\propertyController::class, 'index']);
    Route::get('/show_property/{id}', [App\Http\Controllers\Api\propertyController::class, 'show']);
    Route::get('/delete/{id}', [App\Http\Controllers\Api\propertyController::class, 'destory']);
    Route::get('/isfavorites', [App\Http\Controllers\Api\propertyController::class, 'IsFavorites']);
    Route::post('/export-property', [App\Http\Controllers\Api\PropertyController::class, 'exportProperty']);


    //Enquiry
    Route::get('/list_enquiry', [App\Http\Controllers\Api\EnquiriesController::class, 'index']);
    Route::post('/add_Inquiry', [App\Http\Controllers\Api\EnquiriesController::class, 'saveEnquiry']);
    Route::post('/update_enquiry', [App\Http\Controllers\Api\EnquiriesController::class, 'saveEnquiry']);
 Route::Post('/show_enquiry', [App\Http\Controllers\Api\EnquiriesController::class, 'show']);
    Route::post('/delete_enquiry', [App\Http\Controllers\Api\EnquiriesController::class, 'destory']);
     Route::post('/filter_enquiry', [App\Http\Controllers\Api\EnquiriesController::class, 'filterEnquiry']);
    Route::post('/import_enquiry', [App\Http\Controllers\Api\EnquiriesController::class, 'importEnquiry']);
    Route::post('/export_enquiry', [App\Http\Controllers\Api\EnquiriesController::class, 'exportEnquiry']);
    Route::post('/matching_enquiry', [App\Http\Controllers\Api\EnquiriesController::class, 'matchingEnquiry']);
    Route::post('/prograss_list_enquiry', [App\Http\Controllers\Api\EnquiriesController::class, 'listPrograss']);
    Route::post('/add_transfer_enquiry', [App\Http\Controllers\Api\EnquiriesController::class, 'transferEnquiry']);
    Route::post('/transfer_enquiry', [App\Http\Controllers\Api\EnquiriesController::class, 'listTransferEnquiry']);
    Route::post('/get_contact_enquiry', [App\Http\Controllers\Api\EnquiriesController::class, 'getContacts']);
    Route::post('/add_contact_enquiry', [App\Http\Controllers\Api\EnquiriesController::class, 'saveContacts']);

   
   

    Route::post('enquiry-step-one', [App\Http\Controllers\Api\EnquiriesController::class, 'step1']);
    Route::post('enquiry-step-two', [App\Http\Controllers\Api\EnquiriesController::class, 'step2']);
    Route::post('enquiry-step-three', [App\Http\Controllers\Api\EnquiriesController::class, 'step3']);
 
    //Project
    Route::get('/Projects', [App\Http\Controllers\Api\ProjectsController::class, 'index']);
    Route::get('/show_project/{id}', [App\Http\Controllers\Api\ProjectsController::class, 'show']);
    Route::get('/delete_projects/{id}', [App\Http\Controllers\Api\ProjectsController::class, 'destroy']);
    Route::post('/add_projects', [App\Http\Controllers\Api\ProjectsController::class, 'saveProject']);
    Route::post('/update_projects', [App\Http\Controllers\Api\ProjectsController::class, 'saveProject']);


//Setting
    Route::group(['prefix' => 'setting'], function () {
    
        Route::get('/list_state', [App\Http\Controllers\Api\SettingsController::class, 'getstate']);
        Route::post('/add_state', [App\Http\Controllers\Api\SettingsController::class, 'addState']);
        Route::post('/delete_state', [App\Http\Controllers\Api\SettingsController::class, 'destroyState']);
    
        Route::get('/list_city', [App\Http\Controllers\Api\SettingsController::class, 'getcity']);
        Route::post('/add_city', [App\Http\Controllers\Api\SettingsController::class, 'addcity']);
        Route::post('/delete_city', [App\Http\Controllers\Api\SettingsController::class, 'destroycity']);
    
        Route::get('/list_area', [App\Http\Controllers\Api\SettingsController::class, 'areaList']);
        Route::post('/add_area', [App\Http\Controllers\Api\SettingsController::class, 'areaAdd']);
        Route::post('/delete_area', [App\Http\Controllers\Api\SettingsController::class, 'areaDestroy']);
    
        Route::get('/list_district', [App\Http\Controllers\Api\SettingsController::class, 'districtList']);
        Route::post('/add_district', [App\Http\Controllers\Api\SettingsController::class, 'districtAdd']);
        Route::post('/delete_district', [App\Http\Controllers\Api\SettingsController::class, 'districtDestroy']);
    
        Route::get('/list_taluka', [App\Http\Controllers\Api\SettingsController::class, 'talukaList']);
        Route::post('/add_taluka', [App\Http\Controllers\Api\SettingsController::class, 'talukaAdd']);
        Route::post('/delete_taluka', [App\Http\Controllers\Api\SettingsController::class, 'talukaDestroy']);
        
         Route::get('/list_builder', [App\Http\Controllers\Api\SettingsController::class, 'builder_index']);
        Route::post('/add_builder', [App\Http\Controllers\Api\SettingsController::class, 'builder_store']);
        Route::post('/delete_builder', [App\Http\Controllers\Api\SettingsController::class, 'builder_destroy']);
    
        Route::get('/property_configuration', [App\Http\Controllers\Api\SettingsController::class, 'property_configuration']);
        Route::post('/add_property_configration/{id}', [App\Http\Controllers\Api\SettingsController::class, 'add_configuration']);
        Route::get('/delete_property_configuration', [App\Http\Controllers\Api\SettingsController::class, 'delete_configuration']);

        Route::get('/building_configuration', [App\Http\Controllers\Api\SettingsController::class, 'building_configuration']);
        Route::post('/add_building_configration/{id}', [App\Http\Controllers\Api\SettingsController::class, 'add_configuration']);
        Route::Post('/delete_building_configuration', [App\Http\Controllers\Api\SettingsController::class, 'delete_configuration']);

        Route::get('/enquiry_configuration', [App\Http\Controllers\Api\SettingsController::class, 'enquiry_configuration']);
        Route::post('/add_enquiry_configration/{id}', [App\Http\Controllers\Api\SettingsController::class, 'add_configuration']);
        Route::get('/delete_enquiry_configuration', [App\Http\Controllers\Api\SettingsController::class, 'delete_configuration']);

        //invoice
        Route::post('/add_invoice', [App\Http\Controllers\Api\SettingsController::class, 'addInvoice']);
        //Cards
        Route::get('/cards', [App\Http\Controllers\Api\SettingsController::class, 'Cards']);

    
       
    });
    
    // Ticket System Routes
    Route::any('ticket_index', [App\Http\Controllers\Api\TicketsController :: class,'index'])->name('ticket.index');
    Route::any('store_ticket', [App\Http\Controllers\Api\TicketsController :: class,'store'])->name('ticket.store.ticket');
    Route::any('my_tickets', [App\Http\Controllers\Api\TicketsController :: class,'userTickets'])->name('ticket.my_tickets');
    Route::any('tickets/{ticket_id}', [App\Http\Controllers\Api\TicketsController :: class,'show'])->name('ticket.tickets');

        Route::any('/Branches', [App\Http\Controllers\Api\BranchesController::class, 'index']);
		Route::post('/get-branch', [App\Http\Controllers\Api\BranchesController::class, 'getSpecificBranch']);
		Route::post('/save-branch', [App\Http\Controllers\Api\BranchesController::class, 'saveBranch']);
		Route::post('/delete-branch', [App\Http\Controllers\Api\BranchesController::class, 'destroy']);
		
        Route::get('/list_user', [App\Http\Controllers\Api\UserController::class, 'user_index']);
        Route::post('/add_user', [App\Http\Controllers\Api\UserController::class, 'saveUser']);
        Route::post('/delete_user', [App\Http\Controllers\Api\UserController::class, 'user_destroy']);
    

  //Role
        Route::post('/add_role', [App\Http\Controllers\Api\UserController::class, 'saveRole']);
        Route::get('/role_list', [App\Http\Controllers\Api\UserController::class, 'roleList']);
        Route::post('/delete_role', [App\Http\Controllers\Api\UserController::class, 'destroyRole']);

        //profile
        Route::get('/user_profile', [App\Http\Controllers\Api\UserController::class, 'ProfileDetails']);
        Route::post('/edit_profile1', [App\Http\Controllers\Api\UserController::class, 'chnageProfile']);
        Route::post('/changepassword1', [App\Http\Controllers\Api\UserController::class, 'chnagePassword']);




    //Report
    Route::any('/employee-audit-log', [App\Http\Controllers\Api\ReportsController::class, 'EmployeeAuditLog']);
    Route::any('/employee-by-enquiry', [App\Http\Controllers\Api\ReportsController::class, 'EmployeeByEnquiry']);
    Route::any('/employee-logged', [App\Http\Controllers\Api\ReportsController::class, 'EmployeeLogged']);
    Route::any('/employee-remarks', [App\Http\Controllers\Api\ReportsController::class, 'EnquiryRemarks']);
    Route::any('/property-rented-sold', [App\Http\Controllers\Api\ReportsController::class, 'PropertySold']);
    Route::any('/property-viewer', [App\Http\Controllers\Api\ReportsController::class, 'PropertyViewer']);
    Route::any('/Enquiry-Period', [App\Http\Controllers\Api\ReportsController::class, 'EnquiryPeriod']);
    Route::any('/employee-performance', [App\Http\Controllers\Api\ReportsController::class, 'employeePerformance']);
    Route::any('/reports', [App\Http\Controllers\Api\ReportsController::class, 'ReportPage']);
    Route::get('/Profile-details', [HomeController::class, 'ProfileDetails']);
    Route::get('/share-property', [PropertyController::class, 'ShareProperty']);

    Route::get('/dashboard', [App\Http\Controllers\Api\HomeController::class, 'index']);

});
