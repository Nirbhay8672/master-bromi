<?php

use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\BranchesController;
use App\Http\Controllers\Admin\BuildingController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\EnquiriesController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\IndustrialPropertyController;
use App\Http\Controllers\Admin\InstaPropertiesController;
use App\Http\Controllers\Admin\LandPropertyController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\ProjectUnitController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\TicketsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserNotificationsController;
use App\Http\Controllers\Admin\integrationController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\TalukaController;
use App\Http\Controllers\Admin\VillageController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MasterPropertyController;
use App\Http\Controllers\Admin\ShareController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'revalidate'], function () {
    
    Route::get('/get-location', [LocationController::class, 'index'])->name('admin.getCurrentLocation');


	Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
	Route::post('login', [AdminLoginController::class, 'login'])->name('admin-login');
	Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register');
	Route::post('register', [RegisterController::class, 'register'])->name('admin-register');
	Route::post('storeUser', [RegisterController::class, 'storeUser'])->name('admin.storeUser');
	
	Route::get('otp-form', [OtpController::class, 'showOtpForm'])->name('admin.otpForm');
	Route::post('otp-post', [OtpController::class, 'otpVerification'])->name('admin.otp-verification');

	// // Profile Routes


	//     Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
	//     Route::post('/upload-users', [UserController::class, 'uploadUsers'])->name('upload');

	//     Route::get('export/', [UserController::class, 'export'])->name('export');

	// });
	Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
	
	Route::group(['middleware' => ['auth']], function () {
        Route::any('/Plans', [HomeController::class, 'plan_index'])->name('admin.plans');
        Route::any('/price-calc', [HomeController::class, 'priceCalculator'])->name('admin.calc');
        Route::post('/save-plan-user', [HomeController::class, 'plan_save'])->name('admin.savePlan');
        Route::any('cashfree/payments/success', [HomeController::class, 'payment_success'])->name('admin.paymentSuccess');
        Route::post('/increase-user-limit', [HomeController::class, 'increaseUserLimit'])->name('admin.increaseUserLimit');
        // apply coupon
        Route::any('apply-coupon-code', [HomeController::class, 'applyCoupuonCode'])->name('admin.apply-coupon');
        // Route::get('verify-otp', [HomeController::class, 'showVerifyForm'])->name('admin.otp.verify');
        // Route::post('verify-otp', [HomeController::class, 'verifyEmailOtp'])->name('admin.otp.submit');

    });
    
	Route::group(['middleware' => ['auth', 'checkPlanExpiry']], function () {
		Route::get('/', [HomeController::class, 'index'])->middleware(['permission:view-dashboard'])->name('admin');
		Route::post('/save-onesignal-id', function(Request $request) {
            try {
                $user = Auth::user();
                $user->onesignal_token = $request->input('playerId');
                $user->save();
                return response()->json(['error' => false, 'data' => $user->onesignal_token]);
            } catch (\Throwable $th) {
                return response()->json(['error' => true, 'data' => $th->getMessage()]);
            }
        })->name('admin.saveOnesignal');

		Route::any('/districts', [DistrictController::class, 'index'])->name('admin.districts');
		Route::post('/import-district', [DistrictController::class, 'districtImport'])->name('admin.importDistrict');
		Route::post('/save-district', [DistrictController::class, 'saveDistrict'])->name('admin.save_district');
		Route::post('/get-district', [DistrictController::class, 'getDistrict'])->name('admin.get_district');
		Route::post('/delete-district', [DistrictController::class, 'destroy'])->name('admin.destroy-district');
		
	    Route::any('/talukas', [TalukaController::class, 'index'])->name('admin.talukas');
		Route::post('/save-taluka', [TalukaController::class, 'saveTaluka'])->name('admin.save_taluka');
		Route::post('/get-taluka', [TalukaController::class, 'getTaluka'])->name('admin.get_taluka');
		Route::post('/delete-taluka', [TalukaController::class, 'destroy'])->name('admin.destroy_taluka');
		
		Route::any('/settings-get-taluka-for-import', [TalukaController::class, 'getTalukaForImport'])->name('admin.setting.getTaluka');
		Route::post('/settings-import-taluka', [TalukaController::class, 'importTaluka'])->name('admin.importTaluka');
		
		Route::any('/villages', [VillageController::class, 'index'])->name('admin.villages');
		Route::post('/save-village', [VillageController::class, 'saveVillage'])->name('admin.save_village');
		Route::post('/get-village', [VillageController::class, 'getVillage'])->name('admin.get_village');
		Route::post('/delete-village', [VillageController::class, 'destroy'])->name('admin.destroy_village');
		Route::any('/settings-get-village-for-import', [VillageController::class, 'getVillageForImport'])->name('admin.settings.getVillageForImport');
		Route::post('/import-village', [VillageController::class, 'importVillage'])->name('admin.importvillage');
		
		
		Route::any('/Areas', [AreaController::class, 'index'])->middleware(['permission:area-list'])->name('admin.areas');
		Route::post('/get-area', [AreaController::class, 'getSpecificArea'])->name('admin.getArea');
		Route::post('/save-area', [AreaController::class, 'saveArea'])->name('admin.saveArea');
		Route::post('/import-area', [AreaController::class, 'importArea'])->name('admin.importarea');
		Route::post('/delete-area', [AreaController::class, 'destroy'])->name('admin.deleteArea');
		Route::any('/Buildings', [BuildingController::class, 'index'])->name('admin.buildings');
		Route::post('/get-building', [BuildingController::class, 'getSpecificBuilding'])->name('admin.getBuilding');
		Route::post('/delete-building', [BuildingController::class, 'destroy'])->name('admin.deleteBuilding');
		Route::post('/save-building', [BuildingController::class, 'saveBuilding'])->name('admin.saveBuilding');
		Route::post('/import-building', [BuildingController::class, 'importBuilding'])->name('admin.importbuilding');
		Route::any('/Properties', [PropertyController::class, 'index'])->middleware(['permission:property-list'])->name('admin.properties');
		Route::post('/get-property', [PropertyController::class, 'getSpecificProperty'])->name('admin.getProperty');
		Route::post('/delete-property', [PropertyController::class, 'destroy'])->name('admin.deleteProperty');
		Route::post('/save-property', [PropertyController::class, 'saveProperty'])->name('admin.saveProperty');
        Route::get('/download-zip/{type}/{prop}', [PropertyController::class,'downloadZip'])->name('download.zip');
		route::post('/share-prop-remove', [ShareController::class, 'destroyShareProp'])->name('admin.deletedShareProp');
		Route::post('/import-property', [PropertyController::class, 'importProperty'])->name('admin.importproperty');
		Route::post('/import-IndustrialProperty', [IndustrialPropertyController::class, 'importProperty'])->name('admin.importIndustrialproperty');
		Route::get('/import-property-template', [PropertyController::class, 'importPropertyTemplate'])->name('admin.importpropertyTemplate');
		Route::get('/admin/property/category', [PropertyController::class, 'getpropertyCategory'])->name('admin.property.category');
		Route::get('/import-industrialproperty-template', [IndustrialPropertyController::class, 'importPropertyTemplate'])->name('admin.importindustrialpropertyTemplate');
		Route::get('/admin/enquiry/category', [EnquiriesController::class, 'getEnquiryCategory'])->name('admin.enquiry.category');
		Route::get('/import-enquiry-template', [EnquiriesController::class, 'importEnquiryTemplate'])->name('admin.importenquiryTemplate');
		Route::any('/Enquiries', [EnquiriesController::class, 'index'])->middleware(['permission:enquiry-list'])->name('admin.enquiries');
		Route::any('/Enquiries-Calendar', [EnquiriesController::class, 'enquiryCalendar'])->name('admin.enquiries.calendar');
		Route::delete('/Enquiries-Calendar-delete/{id}', [EnquiriesController::class, 'deleteRecord'])->name('admin.enquiries.calendar.delete');
		Route::post('/get-enquiry', [EnquiriesController::class, 'getSpecificEnquiry'])->name('admin.getEnquiry');
		Route::post('/delete-enquiry', [EnquiriesController::class, 'destroy'])->name('admin.deleteEnquiry');
		Route::post('/save-enquiry', [EnquiriesController::class, 'saveEnquiry'])->name('admin.saveEnquiry');
		Route::post('/import-enquiry', [EnquiriesController::class, 'importEnquiry'])->name('admin.importenquiry');
		Route::any('/Projects', [ProjectsController::class, 'index'])->middleware(['permission:project-list'])->name('admin.projects');
	    Route::any('/all-projects', [ProjectsController::class, 'allprojectList'])->name('admin.all-projects');
		Route::post('/get-projects', [ProjectsController::class, 'getSpecificProject'])->name('admin.getProject');
		Route::get('/get-projects-by-unit', [ProjectsController::class, 'projectByUnit'])->name('admin.project.byunit');
		Route::post('/delete-projects', [ProjectsController::class, 'destroy'])->name('admin.deleteProject');
		Route::post('/save-projects', [ProjectsController::class, 'saveProject'])->name('admin.saveProject');
		Route::any('/project/view/{id}', [ProjectsController::class, 'viewProject'])->name('admin.viewProject');
		Route::get('/view-document/{filename}', [ProjectsController::class, 'viewProjectDocument'])->name('admin.project.document');

		Route::post('/import-projects', [ProjectsController::class, 'importProject'])->name('admin.importproject');
		Route::any('/Users', [UserController::class, 'index'])->name('admin.users');
		Route::post('/get-user', [UserController::class, 'getSpecificUser'])->name('admin.getUser');
		Route::post('/delete-user', [UserController::class, 'destroy'])->name('admin.deleteUser');
		Route::post('/save-user', [UserController::class, 'saveUser'])->name('admin.saveUser');
		
// 		Partnercontroller
		route::get('/find_user_records', [PartnerController::class, 'findUserRecords'])->name('admin.findUser');
		route::post('/add-partner', [PartnerController::class, 'addPartner'])->name('admin.addPartner');
		route::get('/index-partner', [PartnerController::class, 'index'])->name('admin.partner.index');
		route::get('/request-partner', [PartnerController::class, 'partnerRequest'])->name('admin.partnerRequest');
		route::get('/partners', [PartnerController::class, 'users'])->name('admin.partnerUsers');
		route::post('/partner-remove', [PartnerController::class, 'deletedPartner'])->name('admin.deletePartner');
		route::post('/add-share-partner', [PartnerController::class, 'userPartner'])->name('admin.sharePartner');


		Route::any('/Roles', [RoleController::class, 'index'])->name('admin.roles');
		Route::any('/Settings', [HomeController::class, 'Settings'])->name('admin.settings');
		Route::post('/get-role', [RoleController::class, 'getSpecificRole'])->name('admin.getRole');
		Route::post('/delete-role', [RoleController::class, 'destroy'])->name('admin.deleteRole');
		Route::post('/save-role', [RoleController::class, 'saveRole'])->name('admin.saveRole');
		Route::any('/Activity-Logs', [HomeController::class, 'getActivityLogs'])->name('admin.logs');
		// Route::any('/Plans', [HomeController::class, 'plan_index'])->name('admin.plans');
		// Route::post('/save-plan-user', [HomeController::class, 'plan_save'])->name('admin.savePlan');
		
        
		Route::post('/upgrade-user-limit', [HomeController::class, 'upgrade_user_limit'])->name('admin.upgradeUserLimit');
		Route::post('/upgrade-plan-user', [HomeController::class, 'upgrade_plan'])->name('admin.upgradePlan');
		Route::post('/search', [HomeController::class, 'search'])->name('admin.search');
		Route::post('/changepassword', [HomeController::class, 'chnagePassword'])->name('chnage-pwd');
		Route::post('/changeprofile', [HomeController::class, 'chnageProfile'])->name('chnage-profile');

		Route::post('/export-enquiry', [EnquiriesController::class, 'exportEnquiry'])->name('admin.export.enquiry');
		Route::post('/export-property', [PropertyController::class, 'exportProperty'])->name('admin.export.property');

		Route::any('/send-Request', [PropertyController::class, 'sendRequest'])->name('admin.shared.send');

		Route::any('/Industrial-Properties', [IndustrialPropertyController::class, 'index'])->name('admin.industrial.properties');
		Route::post('/get-industrial-property', [IndustrialPropertyController::class, 'getSpecificProperty'])->name('admin.industrial.getProperty');
		Route::post('/delete-industrial-property', [IndustrialPropertyController::class, 'destroy'])->name('admin.industrial.deleteProperty');
		Route::post('/save-industrial-property', [IndustrialPropertyController::class, 'saveProperty'])->name('admin.industrial.saveProperty');

		Route::any('/Land-Properties', [LandPropertyController::class, 'index'])->name('admin.land.properties');
		Route::post('/get-land-property', [LandPropertyController::class, 'getSpecificProperty'])->name('admin.land.getProperty');
		Route::post('/delete-land-property', [LandPropertyController::class, 'destroy'])->name('admin.land.deleteProperty');
		Route::post('/save-land-property', [LandPropertyController::class, 'saveProperty'])->name('admin.land.saveProperty');

		Route::any('/Project-Units', [ProjectUnitController::class, 'index'])->name('admin.project.unit');
		Route::post('/get-project-unit', [ProjectUnitController::class, 'getSpecificUnit'])->name('admin.project.getUnit');
		Route::post('/delete-project-unit', [ProjectUnitController::class, 'destroy'])->name('admin.project.deleteUnit');
		Route::post('/save-project-unit', [ProjectUnitController::class, 'saveUnit'])->name('admin.project.saveUnit');

		Route::any('/Branches', [BranchesController::class, 'index'])->name('admin.branches');
		Route::post('/get-branch', [BranchesController::class, 'getSpecificBranch'])->name('admin.getBranch');
		Route::post('/save-branch', [BranchesController::class, 'saveBranch'])->name('admin.saveBranch');
		Route::post('/delete-branch', [BranchesController::class, 'destroy'])->name('admin.deleteBranch');
		
		
		// custom routes for new reports -- START
		Route::any('/source-by-enquiry', [ReportsController::class, 'sourceViseEnquiryPage'])->name('admin.report.source.enquiry.page');
		Route::any('/source-by-enquiry-ajax', [ReportsController::class, 'sourceViseEnquiry'])->name('admin.report.source.enquiry');
		
		Route::any('/assigned-by-enquiry', [ReportsController::class, 'assignedViseEnquiryPage'])->name('admin.report.assigned.enquiry.page');
		Route::any('/assigned-by-enquiry-ajax', [ReportsController::class, 'assignedViseEnquiry'])->name('admin.report.assigned.enquiry');
		
		Route::any('/active-source-by-enquiry', [ReportsController::class, 'activeSourceEnquiryPage'])->name('admin.report.active_source.enquiry.page');
		Route::any('/active-source-by-enquiry-ajax', [ReportsController::class, 'activeSourceEnquiry'])->name('admin.report.active_source.enquiry');
		
		Route::any('/lost-source-by-enquiry', [ReportsController::class, 'lostSourceEnquiryPage'])->name('admin.report.lost_source.enquiry.page');
		Route::any('/lost-source-by-enquiry-ajax', [ReportsController::class, 'lostSourceEnquiry'])->name('admin.report.lost_source.enquiry');

		Route::any('/stage-by-enquiry', [ReportsController::class, 'stageViseEnquiryPage'])->name('admin.report.stage.enquiry.page');
		Route::any('/stage-by-enquiry-ajax', [ReportsController::class, 'stageViseEnquiry'])->name('admin.report.stage.enquiry');
		
	    Route::any('/stage-and-person-by-enquiry', [ReportsController::class, 'stageAndPersonViseEnquiryPage'])->name('admin.report.stage_and_person.enquiry.page');
		Route::any('/stage-and-person-by-enquiry-ajax', [ReportsController::class, 'stageAndPersonViseEnquiry'])->name('admin.report.stage_and_person.enquiry');
		
		Route::any('/person-by-enquiry', [ReportsController::class, 'personViseEnquiryPage'])->name('admin.report.person.enquiry.page');
		Route::any('/person-by-enquiry-ajax', [ReportsController::class, 'personViseEnquiry'])->name('admin.report.person.enquiry');
		
		Route::any('/person-date-by-enquiry', [ReportsController::class, 'personDateViseEnquiryPage'])->name('admin.report.person_date.enquiry.page');
		Route::any('/person-date-by-enquiry-ajax', [ReportsController::class, 'personDateViseEnquiry'])->name('admin.report.person_date.enquiry');
		
		// custom routes for new report -- END

		Route::any('/employee-audit-log', [ReportsController::class, 'EmployeeAuditLog'])->name('admin.report.employee.audit');
		Route::any('/employee-by-enquiry', [ReportsController::class, 'EmployeeByEnquiry'])->name('admin.report.employee.enquiry');
		Route::any('/employee-logged', [ReportsController::class, 'EmployeeLogged'])->name('admin.report.logged');
		Route::any('/employee-remarks', [ReportsController::class, 'EnquiryRemarks'])->name('admin.enquiry.remarks');
		Route::any('/property-rented-sold', [ReportsController::class, 'PropertySold'])->name('admin.reports.sold');
		Route::any('/property-viewer', [ReportsController::class, 'PropertyViewer'])->name('admin.reports.viewer');
		Route::any('/Enquiry-Period', [ReportsController::class, 'EnquiryPeriod'])->name('admin.reports.enquiry.period');
		Route::any('/employee-performance', [ReportsController::class, 'employeePerformance'])->name('admin.employee.performance');
		Route::any('/reports', [ReportsController::class, 'ReportPage'])->name('admin.reports');
		Route::get('/Profile-details', [HomeController::class, 'ProfileDetails'])->name('admin.profile.details');
		Route::get('/share-property', [PropertyController::class, 'ShareProperty'])->name('admin.share.property');

		Route::post('/unit-save-property', [ProjectUnitController::class, 'storeProperty'])->name('admin.unit.saveproperty');
		
		//state city
		Route::post('/property/state', [PropertyController::class, 'state'])->name('admin.property.state');
        Route::get('/update-property-status', [PropertyController::class, 'updatePropertyStatus'])->name('admin.updatePropertyStatus');
        Route::get('/update-enquiry-status', [EnquiriesController::class, 'updateEnquiryStatus'])->name('admin.updateEnquiryStatus');


		Route::post('/change-property-status', [PropertyController::class, 'changePropertyStatus'])->name('admin.changePropertyStatus');
		Route::post('/change-project-status', [ProjectsController::class, 'changeProjectStatus'])->name('admin.changeProjectStatus');
		Route::post('/change-enquiry-status', [EnquiriesController::class, 'changeEnquiryStatus'])->name('admin.changeEnquiryStatus');
		Route::get('/get-enquiry-configuration', [EnquiriesController::class, 'getEnquiryConfiguration'])->name('admin.getEnquiryConfiguration');

        //Share Property
		Route::any('/shared-properties', [ShareController::class, 'sharedPropertyIndex'])->middleware(['permission:shared-property'])->name('admin.shared.properties');
		Route::any('/shared-requests', [ShareController::class, 'sharedPropertyRequests'])->name('admin.shared.requests');
		Route::any('/accept-shared-requests', [ShareController::class, 'acceptRequest'])->name('admin.shared.accept');
		Route::any('/cancel-shared-requests', [ShareController::class, 'cancelRequest'])->name('admin.shared.cancel');
		Route::get('/request-users', [PartnerController::class, 'userRequest'])->name('admin.userRequest');
		Route::any('/accept-User-shared-requests', [PartnerController::class, 'acceptUserRequest'])->name('admin.userShared.accept');

		
		Route::post('/get-shared-property', [PropertyController::class, 'getSharedProperty'])->name('admin.get.sharedProperty');
		Route::any('/insta-properties', [InstaPropertiesController::class, 'index'])->name('admin.insta.properties');
		Route::post('/get-insta-property', [InstaPropertiesController::class, 'getSpecificProperty'])->name('admin.getinstaProperty');
		Route::post('/delete-insta-property', [InstaPropertiesController::class, 'destroy'])->name('admin.deleteinstaProperty');
		Route::post('/save-insta-property', [InstaPropertiesController::class, 'saveProperty'])->name('admin.saveinstaProperty');

		//Settings
		Route::get('/settings-city', [SettingsController::class, 'cities_index'])->name('admin.settings.city');
		Route::post('/settings-get-city', [SettingsController::class, 'get_city'])->name('admin.settings.getcity');
		Route::post('/settings-save-city', [SettingsController::class, 'cities_store'])->name('admin.settings.savecity');
		Route::post('/settings-import-city', [HomeController::class, 'importCity'])->name('admin.importcity');
		Route::post('/settings-import-builder', [SettingsController::class, 'builder_import'])->name('admin.settings.importbuilder');
		Route::post('/settings-import-state', [SettingsController::class, 'state_import'])->name('admin.settings.importstate');
		Route::post('/settings-delete-city', [SettingsController::class, 'cities_destroy'])->name('admin.settings.destroycity');
		Route::post('/settings-get-city-for-import', [SettingsController::class, 'getCityForImport'])->name('admin.settings.getCityForImport');
		Route::post('/settings-get-area-for-import', [SettingsController::class, 'getAreaForImport'])->name('admin.settings.getAreaForImport');
		//States - start
		Route::get('/settings-state', [SettingsController::class, 'states_index'])->name('admin.settings.state');
		Route::post('/settings-get-state', [SettingsController::class, 'get_state'])->name('admin.settings.getstate');
		Route::post('/settings-save-state', [SettingsController::class, 'states_store'])->name('admin.settings.savestate');
		Route::post('/settings-delete-state', [SettingsController::class, 'states_destroy'])->name('admin.settings.destroystate');
		//States - end

		Route::get('/settings-builder', [SettingsController::class, 'builder_index'])->name('admin.settings.builder');
		Route::post('/settings-get-builder', [SettingsController::class, 'get_builder'])->name('admin.settings.getbuilder');
		Route::post('/settings-save-builder', [SettingsController::class, 'builder_store'])->name('admin.settings.savebuilder');
		Route::post('/settings-delete-builder', [SettingsController::class, 'builder_destroy'])->name('admin.settings.destroybuilder');
		Route::get('/settings-property-configuration', [SettingsController::class, 'property_configuration'])->name('admin.settings.property_configuration');
		Route::get('/settings-building-configuration', [SettingsController::class, 'building_configuration'])->name('admin.settings.building_configuration');
		Route::get('/settings-enquiry-configuration', [SettingsController::class, 'enquiry_configuration'])->name('admin.settings.enquiry_configuration');
		Route::post('/save-settings-configuration', [SettingsController::class, 'save_settings_configuration'])->name('admin.settings.save_settings_configuration');
		Route::post('/save-settings-configuration1', [SettingsController::class, 'save_settings_configuration1'])->name('admin.settings.save_settings_configuration1');
		Route::post('/save-settings-construction-docs', [SettingsController::class, 'save_const_docs'])->name('admin.settings.save_const_docs');
        Route::get('/get-settings-construction-docs', [SettingsController::class, 'get_const_docs'])->name('admin.settings.get_const_docs');
		Route::post('/get-settings-configuration', [SettingsController::class, 'get_settings_configuration'])->name('admin.settings.get_settings_configuration');
		Route::post('/get-subcategory', [SettingsController::class, 'get_subcategory'])->name('admin.settings.get_subcategory'); 
		Route::post('/delete-settings-configuration', [SettingsController::class, 'delete_settings_configuration'])->name('admin.settings.delete_settings_configuration');
		Route::post('/delete-settings-configuration1', [SettingsController::class, 'delete_settings_configuration1'])->name('admin.settings.delete_settings_configuration1');

		Route::post('/transfer-Enquiry', [EnquiriesController::class, 'transferNow'])->name('admin.transferEnquiry');
		Route::post('/get-ContactList', [EnquiriesController::class, 'getContacts'])->name('admin.getContactList');
		Route::post('/save-ContactList', [EnquiriesController::class, 'saveContacts'])->name('admin.saveContactList');
		Route::post('/save-buildingImages', [ProjectsController::class, 'saveBuildingImages'])->name('admin.saveBuildingImages');
		Route::post('/save-landImages', [LandPropertyController::class, 'saveLandImages'])->name('admin.saveLandImages');
		Route::post('/get-Progress', [EnquiriesController::class, 'getProgress'])->name('admin.getProgress');
		Route::post('/get-Schedule', [EnquiriesController::class, 'getSchedule'])->name('admin.getSchedule');
		Route::post('/delete-Progress', [EnquiriesController::class, 'Progress'])->name('admin.deleteProgress');
		Route::post('/save-comment', [EnquiriesController::class, 'saveComments'])->name('admin.enquiry.saveComment');
		Route::post('/get-comment', [EnquiriesController::class, 'getComments'])->name('admin.enquiry.getComment');
		Route::get('/get-notifications', [UserNotificationsController::class, 'index'])->name('admin.notifications');
		Route::post('/save-Progress', [EnquiriesController::class, 'saveProgress'])->name('admin.saveProgress');
		Route::post('/save-schedule', [EnquiriesController::class, 'saveSchedule'])->name('admin.saveSchedule');
		Route::post('/get-assigned-history', [EnquiriesController::class, 'getEnquiryHistory'])->name('admin.get.assign.history');
		Route::get('/view-enquiry/{id}', [EnquiriesController::class, 'viewEnquiry'])->name('admin.view.enquiry');
		Route::get('/property/view/{id}', [PropertyController::class, 'view'])->name('admin.project.view');
		Route::get('/get-property-configuration', [PropertyController::class, 'getPropertyConfiguration'])->name('admin.getPropertyConfiguration');
		Route::get('/enquiries-calendar/view', [EnquiriesController::class, 'calenderDetail'])->name('admin.enquiries.calendar.view');
		Route::get('/get/property/form', [PropertyController::class, 'changeFormType'])->name('admin.property.form');
		Route::get('/property/add', [PropertyController::class, 'addProperty'])->middleware(['permission:property-create'])->name('admin.property.add');
		Route::get('/property/edit/{id}', [PropertyController::class, 'editProperty'])->middleware(['permission:property-edit'])->name('admin.property.edit');
		Route::get('/enquiry/add', [EnquiriesController::class, 'addEnquiry'])->middleware(['permission:enquiry-create'])->name('admin.enquiry.add');
		Route::get('/enquiry/edit/{id}', [EnquiriesController::class, 'editEnquiry'])->middleware(['permission:enquiry-edit'])->name('admin.enquiry.edit');
		Route::get('/project/add', [ProjectsController::class, 'addproject'])->middleware(['permission:project-create'])->name('admin.project.add');
		Route::get('/project/edit/{id}', [ProjectsController::class, 'editProject'])->middleware(['permission:project-edit'])->name('admin.project.edit');
		Route::get('/project/unit/add', [ProjectUnitController::class, 'addUnit'])->name('admin.unit.add');
		Route::get('/project/unit/edit/{id}', [ProjectUnitController::class, 'editUnit'])->name('admin.unit.edit');
		Route::get('/user/add', [UserController::class, 'adduser'])->name('admin.user.add');
		Route::get('/user/edit/{id}', [UserController::class, 'editUser'])->name('admin.user.edit');
		Route::any('/integration', [integrationController::class, 'show'])->name('admin.integration');
		Route::post('/emaildataget', [integrationController::class, 'emaildataget'])->name('admin.integrationemaildataget');
		Route::post('/integrationemailsendmailform', [integrationController::class, 'integrationemailsendmailform'])->name('admin.integrationemailsendmailform');
		
		// Email Route
		Route::get('/email-template', [integrationController::class, 'index'])->name('admin.email.index');
		Route::get('/email-template/create', [integrationController::class, 'create'])->name('admin.email.create');
		Route::post('/email-template/store', [integrationController::class, 'store'])->name('admin.email.store');
		Route::get('/email-template/edit/{id}', [integrationController::class, 'edit'])->name('admin.email.edit');
		Route::post('/email-template/update/{id}', [integrationController::class, 'update'])->name('admin.email.update');
		Route::post('/email-template/delete/{id}', [integrationController::class, 'destroy'])->name('admin.email.delete');
		Route::post('/email-template/show/{id}', [integrationController::class, 'showId'])->name('admin.email.show');
		
		// SMS Route
		Route::get('/sms-template', [integrationController::class, 'smsIndex'])->name('admin.smsemail.index');
		Route::get('/sms-template/create', [integrationController::class, 'smsCreate'])->name('admin.smsemail.create');
		Route::post('/sms-template/store', [integrationController::class, 'smsStore'])->name('admin.smsemail.store');
		Route::get('/sms-template/edit/{id}', [integrationController::class, 'smsEdit'])->name('admin.smsemail.edit');
		Route::post('/sms-template/update/{id}', [integrationController::class, 'smsUpdate'])->name('admin.smsemail.update');
		Route::post('/sms-template/delete/{id}', [integrationController::class, 'smsDestroy'])->name('admin.smsemail.delete');
		Route::post('/sms-template/show/{id}', [integrationController::class, 'smsShowId'])->name('admin.smsemail.show');
	
		//start invoice Route
		Route::any('/create-invoice', [PropertyController::class, 'createInvoice'])->name('createInvoice');
		Route::post('/invoice', [PropertyController::class, 'invoice'])->name('invoice');
		//end invoice Route
		
		// visiting card Route
		Route::any('/VisitingCard', [HomeController::class, 'VisitingCard'])->name('admin.VisitingCard');
		// end visiting card Route
		
			// Ticket System Routes
		Route::any('index', [TicketsController :: class,'index'])->name('admin.index');
			Route::any('create', [TicketsController :: class,'create'])->name('admin.create');
			Route::any('new-ticket', [TicketsController :: class,'store'])->name('admin.new.ticket');
			Route::any('my_tickets', [TicketsController :: class,'userTickets'])->name('admin.my_tickets');
			Route::any('tickets/{ticket_id}', [TicketsController :: class,'show'])->name('admin.tickets');
			Route::any('close_ticket/{ticket_id}', [TicketsController :: class,'close'])->name('admin.tickets.close');
			Route::any('comment', [CommentsController:: class,'postComment'])->name('admin.comment');
		//Ticket System Routes End
	});
	Route::get('forgotpassword', [AdminLoginController::class, 'showForgotPasswordForm'])->name('admin.forgotpassword');
	Route::any('forget-password', [AdminLoginController::class, 'submitForgetPasswordForm'])->name('admin.forget.password.post');
	Route::any('reset-password/{token}', [AdminLoginController::class, 'showResetPasswordForm'])->name('admin.reset.password.get');
	Route::post('reset-password', [AdminLoginController::class, 'submitResetPasswordForm'])->name('admin.reset.password.post');

	//Master Property Routes
	Route::prefix('master-properties')->as('admin.master_properties.')->group(function () {
		Route::get('index', [MasterPropertyController::class, 'index'])->name('index');
		Route::get('data-table', [MasterPropertyController::class, 'dataTable'])->name('data_table');
	});
});
