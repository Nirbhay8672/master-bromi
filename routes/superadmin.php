<?php
use App\Http\Controllers\Superadmin\BromiEnquiryController;
use App\Http\Controllers\Superadmin\CouponController;
use App\Http\Controllers\Superadmin\EmailTemplateController;
use App\Http\Controllers\Superadmin\HomeController;
use App\Http\Controllers\Superadmin\NotificationController;
use App\Http\Controllers\Superadmin\PlanController;
use App\Http\Controllers\Superadmin\ReraController;
use App\Http\Controllers\Superadmin\SuperSettingController;
use App\Http\Controllers\Superadmin\UserController;
use App\Http\Controllers\Superadmin\TicketsController;
use App\Http\Controllers\Superadmin\CommentsController;
use App\Http\Controllers\Superadmin\ImportController;
use App\Http\Controllers\Superadmin\ProjectsController;
use App\Http\Controllers\Superadmin\SuperTalukaController;
use App\Http\Controllers\Superadmin\SuperVillageController;
use App\Http\Controllers\Superadmin\UnitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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

	Route::get('optimize_clear', function () {
		return Artisan::call('optimize:clear');
	});
	Route::get('optimize', function () {
		return Artisan::call('optimize');
	});

	Route::group(['middleware' => ['auth', 'superadmin']], function () {
        Route::post('/save-onesignal-id', function (Request $request) {
            try {
                $user = Auth::user();
                $user->onesignal_token = $request->input('playerId');
                $user->save();
                return response()->json(['error' => false, 'data' => $user->onesignal_token]);
            } catch (\Throwable $th) {
                return response()->json(['error' => true, 'data' => $th->getMessage()]);
            }
        })->name('superadmin.saveOnesignal');
		Route::get('/', [HomeController::class, 'index'])->name('superadmin');
		Route::any('/Users', [UserController::class, 'index'])->name('superadmin.users');
		Route::get('/user-profile/{id}', [UserController::class, 'profile'])->name('superadmin.user-profile');
		Route::post('/get-user', [UserController::class, 'getSpecificUser'])->name('superadmin.getUser');
		Route::post('/delete-user', [UserController::class, 'destroy'])->name('superadmin.deleteUser');
		Route::post('/save-user', [UserController::class, 'saveUser'])->name('superadmin.saveUser');
		Route::post('/check-for-delete-users', [UserController::class, 'checkForDeleteUsers'])->name('superadmin.checkForDeleteUsers');
		Route::post('/delete-all-users', [UserController::class, 'deleteAllUsers'])->name('superadmin.deleteAllUsers');

		Route::any('/units', [UnitController::class, 'index'])->name('superadmin.units');
		Route::post('/get-unit', [UnitController::class, 'getUnit'])->name('superadmin.getUnit');
		Route::post('/delete-unit', [UnitController::class, 'destroy'])->name('superadmin.deleteUnits');
		Route::post('/save-unit', [UnitController::class, 'saveUnit'])->name('superadmin.saveUnits');
		
		Route::any('/team-members', [UserController::class, 'membersList'])->name('superadmin.members');
		Route::post('/get-member', [UserController::class, 'getSpecificMember'])->name('superadmin.getMember');
		Route::post('/delete-member', [UserController::class, 'destroyMember'])->name('superadmin.deleteMember');
		Route::post('/save-member', [UserController::class, 'saveMember'])->name('superadmin.saveMember');
		
		Route::any('/brom-enquiries', [BromiEnquiryController::class, 'index'])->name('superadmin.listEnquiries');
		Route::any('/superadmin-brom-enquiries', [BromiEnquiryController::class, 'superadminList'])->name('superadmin.adminEnquiries');
		Route::post('/save-brom-enquiry', [BromiEnquiryController::class, 'store'])->name('superadmin.saveEnquiry');
		Route::post('/get-brom-enquiry', [BromiEnquiryController::class, 'show'])->name('superadmin.showEnquiry');
        Route::post('/save-brom-enquiry-progress', [BromiEnquiryController::class, 'saveProgress'])->name('superadmin.saveProgress');
        Route::post('/get-Progress', [BromiEnquiryController::class, 'getProgress'])->name('superadmin.getProgress');
        Route::post('/delete-lead', [BromiEnquiryController::class, 'destroyLead'])->name('superadmin.deleteLead');
        Route::post('/super-area', [BromiEnquiryController::class, 'getSuperArea'])->name('superadmin.superArea');
		Route::any('/Enquiries-Calendar', [BromiEnquiryController::class, 'enquiryCalendar'])->name('superadmin.enquiries.calendar');
        Route::get('/enquiries-calendar/view', [BromiEnquiryController::class, 'calenderDetail'])->name('superadmin.enquiries.calendar.view');
		
		Route::any('/Plans', [PlanController::class, 'index'])->name('superadmin.plans');
		Route::post('/get-plan', [PlanController::class, 'getSpecificPlan'])->name('superadmin.getPlan');
		Route::post('/delete-plan', [PlanController::class, 'destroy'])->name('superadmin.deletePlan');
		Route::post('/save-plan', [PlanController::class, 'savePlan'])->name('superadmin.savePlan');
		Route::any('/Coupons', [CouponController::class, 'index'])->name('superadmin.coupons');
		Route::any('/update-coupon-status', [CouponController::class, 'updateStatus'])->name('superadmin.update_coupon');
		Route::post('/get-coupon', [CouponController::class, 'getSpecificCoupon'])->name('superadmin.getCoupon');
		Route::post('/delete-coupon', [CouponController::class, 'destroy'])->name('superadmin.deleteCoupon');
		Route::post('/save-coupon', [CouponController::class, 'saveCoupon'])->name('superadmin.saveCoupon');
		Route::any('/Notifications', [NotificationController::class, 'index'])->name('superadmin.notifications');
		Route::post('/get-notification', [NotificationController::class, 'getSpecificNotification'])->name('superadmin.getNotification');
		Route::post('/delete-notification', [NotificationController::class, 'destroy'])->name('superadmin.deleteNotification');
		Route::post('/save-notification', [NotificationController::class, 'saveNotification'])->name('superadmin.saveNotification');
		Route::post('/city-state-wise', [NotificationController::class, 'getCityByState'])->name('superadmin.cityByState');
		Route::any('/tp-scheme', [HomeController::class, 'tpSchemeIndex'])->name('superadmin.tpscheme');
		Route::post('/tp-schemes', [HomeController::class, 'getTpScheme'])->name('superadmin.getTpScheme');
		Route::post('/delete-schemes', [HomeController::class, 'deleteScheme'])->name('superadmin.deleteScheme');
		Route::post('/save-schemes', [HomeController::class, 'saveScheme'])->name('superadmin.saveScheme');
		Route::post('/save-tpimages', [HomeController::class, 'saveTpImages'])->name('superadmin.TpImages');
		Route::post('/change-user-status', [UserController::class, 'changeStatus'])->name('superadmin.changeUserStatus');
		Route::any('/Rera', [ReraController::class, 'index'])->name('superadmin.rera');

		// project routes
		Route::any('/superadmin/Projects', [ProjectsController::class, 'projects'])->name('superadmin.projects');
		Route::get('/superadmin/project/add', [ProjectsController::class, 'addproject'])->name('superadmin.project.add');
		Route::get('/superadmin/project/edit/{id}', [ProjectsController::class, 'editProject'])->name('superadmin.project.edit');
		Route::post('/superadmin/save-projects', [ProjectsController::class, 'saveProject'])->name('superadmin.saveProject');
		Route::post('/superadmin/delete-projects', [ProjectsController::class, 'destroy'])->name('superadmin.deleteProject');
		Route::any('/superadmin/project/view/{id}', [ProjectsController::class, 'viewProject'])->name('superadmin.viewProject');
		Route::get('/superadmin/view-document/{filename}', [ProjectsController::class, 'viewProjectDocument'])->name('superadmin.project.document');

		Route::get('/settings', [SuperSettingController::class, 'index'])->name('superadmin.settings');

		Route::get('/settings-state', [SuperSettingController::class, 'states_index'])->name('superadmin.settings.state');
		Route::post('/settings-get-state', [SuperSettingController::class, 'get_state'])->name('superadmin.settings.getState');
		Route::post('/settings-save-state', [SuperSettingController::class, 'state_store'])->name('superadmin.settings.saveState');
		Route::post('/settings-delete-state', [SuperSettingController::class, 'destroy_state'])->name('superadmin.settings.deleteState');

		Route::get('/settings-district', [SuperSettingController::class, 'district_index'])->name('superadmin.settings.district');
		Route::post('/settings-get-district', [SuperSettingController::class, 'get_district'])->name('superadmin.settings.getDistrict');
		Route::post('/settings-save-district', [SuperSettingController::class, 'district_store'])->name('superadmin.settings.saveDistrict');
		Route::post('/settings-delete-district', [SuperSettingController::class, 'district_destroy'])->name('superadmin.settings.deleteDistrict');

		Route::get('/settings-city', [SuperSettingController::class, 'cities_index'])->name('superadmin.settings.city');
		Route::post('/settings-get-city', [SuperSettingController::class, 'get_city'])->name('superadmin.settings.getcity');
		Route::post('/settings-save-city', [SuperSettingController::class, 'cities_store'])->name('superadmin.settings.savecity');
		Route::post('/settings-delete-city', [SuperSettingController::class, 'cities_destroy'])->name('superadmin.settings.deletecity');

		Route::get('/settings-area', [SuperSettingController::class, 'area_index'])->name('superadmin.settings.area');
		Route::post('/settings-get-area', [SuperSettingController::class, 'get_area'])->name('superadmin.settings.getarea');
		Route::post('/settings-save-area', [SuperSettingController::class, 'area_store'])->name('superadmin.settings.savearea');
		Route::post('/settings-delete-area', [SuperSettingController::class, 'area_delete'])->name('superadmin.settings.deletearea');

		Route::get('/email-template', [EmailTemplateController::class, 'index'])->name('superadmin.email.index');
		Route::get('/email-template/create', [EmailTemplateController::class, 'create'])->name('superadmin.email.create');
		Route::post('/email-template/store', [EmailTemplateController::class, 'store'])->name('superadmin.email.store');
		Route::get('/email-template/edit/{id}', [EmailTemplateController::class, 'edit'])->name('superadmin.email.edit');
		Route::post('/email-template/update/{id}', [EmailTemplateController::class, 'update'])->name('superadmin.email.update');
		Route::post('/email-template/delete/{id}', [EmailTemplateController::class, 'destroy'])->name('superadmin.email.delete');
		Route::post('/email-template/show/{id}', [EmailTemplateController::class, 'show'])->name('superadmin.email.show');

		Route::get('/sms-template', [EmailTemplateController::class, 'smsindex'])->name('superadmin.sms.index');
		Route::get('/sms-template/create', [EmailTemplateController::class, 'smscreate'])->name('superadmin.sms.create');
		Route::post('/sms-template/store', [EmailTemplateController::class, 'smsstore'])->name('superadmin.sms.store');
		Route::get('/sms-template/edit/{id}', [EmailTemplateController::class, 'smsedit'])->name('superadmin.sms.edit');
		Route::post('/sms-template/update/{id}', [EmailTemplateController::class, 'smsupdate'])->name('superadmin.sms.update');
		Route::post('/sms-template/delete/{id}', [EmailTemplateController::class, 'smsdestroy'])->name('superadmin.sms.delete');
		Route::post('/sms-template/show/{id}', [EmailTemplateController::class, 'smsshow'])->name('superadmin.sms.show');
        Route::any('/builders', [HomeController::class, 'builders'])->name('superadmin.builders');

		Route::any('tickets', [TicketsController::class, 'index'])->name('superadmin.tickets');
		Route::any('close_ticket/{ticket_id}', [TicketsController::class, 'close']);
		Route::any('tickets/{ticket_id}', [TicketsController::class, 'show']);
		Route::any('comment', [CommentsController::class, 'postComment'])->name('superadmin.comment');

		Route::get('/settings-taluka', [SuperTalukaController::class, 'index'])->name('superadmin.settings.taluka');
		Route::post('/settings-save-taluka', [SuperTalukaController::class, 'store'])->name('superadmin.settings.savetaluka');
		Route::post('/settings-edit-taluka', [SuperTalukaController::class, 'details'])->name('superadmin.settings.talukaDetails');
		Route::post('/settings-delete-taluka', [SuperTalukaController::class, 'talukas_destroy'])->name('superadmin.settings.deletetaluka');

		Route::get('/settings-village', [SuperVillageController::class, 'village_index'])->name('superadmin.settings.village');
		Route::post('/settings-get-village', [SuperVillageController::class, 'get_village'])->name('superadmin.settings.getvillage');
		Route::post('/settings-save-village', [SuperVillageController::class, 'village_store'])->name('superadmin.settings.saveVillage');
		Route::post('/settings-delete-village', [SuperVillageController::class, 'village_delete'])->name('superadmin.settings.deletevillage');
		
		Route::any('/users-login-activity', [UserController::class, 'loginActivity'])->name('superadmin.usersLoginActivity');

		Route::post('/state-import', [ImportController::class, 'stateImport'])->name('superadmin.stateImport');
		Route::post('/city-import', [ImportController::class, 'cityImport'])->name('superadmin.cityImport');
		Route::post('/locality-import', [ImportController::class, 'localityImport'])->name('superadmin.areaImport');
		Route::post('/district-import', [ImportController::class, 'districtImport'])->name('superadmin.districtImport');
		Route::post('/taluka-import', [ImportController::class, 'talukaImport'])->name('superadmin.talukaImport');
		Route::post('/village-import', [ImportController::class, 'villageImport'])->name('superadmin.villageImport');

		Route::post('/assign-lead', [BromiEnquiryController::class, 'assignLead'])->name('superadmin.assignLead');
		Route::post('/get-lead-history', [BromiEnquiryController::class, 'getLeadHistory'])->name('superadmin.getLeadHistory');

		Route::get('/district-template', [SuperSettingController::class, 'districtTemplate'])->name('superadmin.districtTemplate');
		Route::get('/taluka-template', [SuperSettingController::class, 'talukaTemplate'])->name('superadmin.talukaTemplate');
		Route::get('/village-template', [SuperSettingController::class, 'villageTemplate'])->name('superadmin.villageTemplate');

		Route::get('/view-sample/{filename}', [SuperSettingController::class, 'viewSampleFile'])->name('superadmin.sample');
	});
});
