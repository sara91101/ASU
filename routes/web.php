<?php
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\CoalitionController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DspaceLinkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReportController;

Route::group(['middleware' => ['visitors']],function()
{
    Route::get('/change/{lang}', [HomeController::class, 'changeLanguage']);

    Route::post('/searchable', [HomeController::class, 'searchable']);
    Route::get('/generalSearch', [HomeController::class, 'generalSearch']);


    Route::get('/', [HomeController::class, 'websiteHome'])->name("websiteHome");
    Route::get('/about', [HomeController::class, 'websiteAbout'])->name("about");
    Route::get('/members/{type}', [HomeController::class, 'websiteMembersByType'])->name("members");
    Route::get('/members', [HomeController::class, 'websiteMembers'])->name("members");
    Route::get('/membership', [HomeController::class, 'membership'])->name("membership");
    Route::get('/news', [HomeController::class, 'news'])->name("news");
    Route::get('/coalition', [HomeController::class, 'coalition'])->name("coalition");
    Route::get('/simulation', [HomeController::class, 'simulation'])->name("simulation");
    Route::get('/contact', [HomeController::class, 'contactUs'])->name("contactUs");
    Route::get('/committee/{id}', [HomeController::class, 'committee'])->name("committee");
    Route::get('/dspaceContent/{id}', [HomeController::class, 'dspace'])->name("dspaceContent");
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts');
    Route::post('/subscribe', [UniversityController::class, 'store'])->name('subscribe');


    Route::get('/committes', [CommitteeController::class, 'committes'])->name('committes');

    Route::get('/asu_admin_login', [LoginController::class,'showLoginForm'])->name('login');
    Route::post('/asu_admin_login', [LoginController::class,'login']);
    Route::post('/logout', [LoginController::class,'logout'])->name('logout');

    //university Login
    Route::get('/universityLogin', [UniversityController::class,'showLoginForm']);
    Route::post('/university-Login', [UniversityController::class,'login']);
    Route::get('/university-logout', [UniversityController::class,'logout']);

    Route::get('/universityProfile', [UniversityController::class,'profile']);
    Route::get('/editMembership', [UniversityController::class,'editMembership']);
    Route::post('/updateMembership', [UniversityController::class,'updateMembership']);
    Route::post('/serviceApply', [UniversityController::class,'serviceApply']);
    Route::post('/university_change_password', [UniversityController::class,'university_change_password']);
});

Route::group(['middleware' => ['auth','Privilege']],function()
{
    Route::post('/change_password', [HomeController::class, 'change_password'])->name('change_password');

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //website inforamtin details
    Route::get('/website', [InfoController::class, 'index'])->name('website');
    Route::post('/website', [InfoController::class, 'index'])->name('website');
    Route::post('/newHome', [InfoController::class, 'store'])->name('newHome');
    Route::get('/destroyHome/{Home_id}', [InfoController::class, 'destroy'])->name('destroyHome');
    Route::post('/updateHome', [InfoController::class, 'update'])->name('updateHome');

    //Units
    Route::get('/units', [UnitController::class, 'index'])->name('units');
    Route::post('/units', [UnitController::class, 'store'])->name('storeUnit');
    Route::get('/destroyUnit/{type_id}', [UnitController::class, 'destroy'])->name('destroyUnit');
    Route::post('/updateUnit', [UnitController::class, 'update'])->name('updateUnit');

    //Universities
    Route::get('/universities', [UniversityController::class, 'index'])->name('universities');
    Route::get('/destroyUniversity/{university_id}', [UniversityController::class, 'destroy'])->name('destroyUniversity');
    Route::get('/editUniversity/{university_id}', [UniversityController::class, 'edit'])->name('editUniversity');
    Route::post('/universities/{university_id}', [UniversityController::class, 'update'])->name('universities');

    //committees
    Route::get('/committees', [CommitteeController::class, 'index'])->name('committees');
    Route::post('/committees', [CommitteeController::class, 'store'])->name('storeCommittee');
    Route::get('/addCommittee', [CommitteeController::class, 'create'])->name('addCommittee');
    Route::get('/showCommittee/{Committee_id}', [CommitteeController::class, 'show'])->name('showCommittee');
    Route::get('/destroyCommittee/{Committee_id}', [CommitteeController::class, 'destroy'])->name('destroyCommittee');
    Route::get('/editCommittee/{Committee_id}', [CommitteeController::class, 'edit'])->name('editCommittee');
    Route::post('/committees/{Committee_id}', [CommitteeController::class, 'update'])->name('updateCommittee');


    //faqs
    Route::get('/faqs', [FAQController::class, 'index'])->name('faqs');
    Route::post('/faqs', [FAQController::class, 'store'])->name('faqs');
    Route::get('/destroyFaq/{type_id}', [FAQController::class, 'destroy'])->name('destroyFaq');
    Route::post('/updateFAQ', [FAQController::class, 'update'])->name('updateFAQ');

    //contacts
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
    Route::get('/destroyContact/{type_id}', [ContactController::class, 'destroy'])->name('destroyContact');
    Route::post('/replyContact', [ContactController::class, 'reply'])->name('replyContact');


    //coalitions
    Route::get('/coalitions', [CoalitionController::class, 'index'])->name('coalitions');
    Route::post('/coalitions', [CoalitionController::class, 'index'])->name('coalitions');
    Route::post('/newCoalition', [CoalitionController::class, 'store'])->name('newCoalition');
    Route::get('/destroyCoalition/{Coalition_id}', [CoalitionController::class, 'destroy'])->name('destroyCoalition');
    Route::post('/updateCoalition', [CoalitionController::class, 'update'])->name('updateCoalition');

    //simulations
    Route::get('/simulations', [SimulationController::class, 'index'])->name('simulations');
    Route::post('/simulations', [SimulationController::class, 'index'])->name('simulations');
    Route::post('/newSimulation', [SimulationController::class, 'store'])->name('newSimulation');
    Route::get('/destroySimulation/{Simulation_id}', [SimulationController::class, 'destroy'])->name('destroySimulation');
    Route::post('/updateSimulation', [SimulationController::class, 'update'])->name('updateSimulation');


    //team
    Route::get('/team', [TeamController::class, 'index'])->name('team');
    Route::post('/team', [TeamController::class, 'index'])->name('team');
    Route::get('/allTeam', [TeamController::class, 'showAll'])->name('allTeam');
    Route::get('/createTeam', [TeamController::class, 'create'])->name('createTeam');
    Route::post('/newTeam', [TeamController::class, 'store'])->name('newTeam');
    Route::get('/editTeam/{Team_id}', [TeamController::class, 'edit'])->name('editTeam');
    Route::get('/destroyTeam/{Team_id}', [TeamController::class, 'destroy'])->name('destroyTeam');
    Route::post('/updateTeam/{Team_id}', [TeamController::class, 'update'])->name('updateTeam');

    //services
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::post('/services', [ServiceController::class, 'index'])->name('services');
    Route::get('/allServices', [ServiceController::class, 'showAll'])->name('allServices');
    Route::get('/createService', [ServiceController::class, 'create'])->name('createService');
    Route::post('/newService', [ServiceController::class, 'store'])->name('newService');
    Route::get('/editService/{Service_id}', [ServiceController::class, 'edit'])->name('editService');
    Route::get('/destroyService/{Service_id}', [ServiceController::class, 'destroy'])->name('destroyService');
    Route::post('/updateService/{Service_id}', [ServiceController::class, 'update'])->name('updateService');


    //Users
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/newUser', [UserController::class, 'store'])->name('newUser');
    Route::get('/destroyUser/{User_id}', [UserController::class, 'destroy'])->name('destroyUser');
    Route::post('/updateUser', [UserController::class, 'update'])->name('updateUser');


    //levels
    Route::get('/levels', [LevelController::class, 'index'])->name('levels');
    Route::post('/newLevel', [LevelController::class, 'store'])->name('newLevel');
    Route::get('/destroyLevel/{Level_id}', [LevelController::class, 'destroy'])->name('destroyLevel');
    Route::get('/editLevel/{Level_id}', [LevelController::class, 'edit'])->name('editLevel');
    Route::post('/updateLevel/{level_id}', [LevelController::class, 'update'])->name('updateLevel');
    Route::get('/createLevel', [LevelController::class, 'create'])->name('createLevel');


    //advertisements
    Route::get('/advertisements', [AdvertisementController::class, 'index'])->name('advertisements');
    Route::post('/advertisements', [AdvertisementController::class, 'store'])->name('storeAdvertisement');
    Route::get('/destroyAdvertisement/{type_id}', [AdvertisementController::class, 'destroy'])->name('destroyAdvertisement');
    Route::get('/archieveAdvertisement/{type_id}', [AdvertisementController::class, 'archieve'])->name('archieveAdvertisement');
    Route::post('/updateAdvertisement', [AdvertisementController::class, 'update'])->name('updateAdvertisement');

  	//dspaceLinks
  	Route::get('/dspaceLinks', [DspaceLinkController::class, 'index'])->name('dspaceLinks');
    Route::get('/createDspaceLink', [DspaceLinkController::class, 'create'])->name('createDspaceLink');
    Route::post('/newDspaceLink', [DspaceLinkController::class, 'store'])->name('newDspaceLink');
    Route::get('/editDspaceLink/{dspaceLink_id}', [DspaceLinkController::class, 'edit'])->name('editDspaceLink');
    Route::get('/destroyDspaceLink/{dspaceLink_id}', [DspaceLinkController::class, 'destroy'])->name('destroyDspaceLink');
    Route::post('/updateDspaceLink/{dspaceLink_id}', [DspaceLinkController::class, 'update'])->name('updateDspaceLink');

    Route::get('/universitiesByService', [ReportController::class, 'universitiesByService'])->name('universitiesByService');
    Route::get('/universitiesByTypes', [ReportController::class, 'universitiesByTypes'])->name('universitiesByTypes');
    Route::get('/contactsByCategory', [ReportController::class, 'contactsByCategory'])->name('contactsByCategory');

    Route::get('/services_requests', [UniversityController::class, 'services_requests'])->name('services_requests');

});
