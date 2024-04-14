<?php

use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChargilyPayController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataTablesController;
use App\Http\Controllers\DiseasesController;

use App\Http\Controllers\EventController;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\icons\MdiIcons;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\tables\Basic as TablesBasic;

use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;


use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

















// Main Page Route
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);



Route::middleware('auth')->group(function () {

  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  // DataTables
  Route::get('/users', [DataTablesController::class, 'users'])->name('users');
  Route::get('/user-porfiles', [DataTablesController::class, 'userProfiles'])->name('user.profiles');
  Route::get('/sellers', [DataTablesController::class, 'sellers'])->name('sellers');
  Route::get('/experts', [DataTablesController::class, 'experts'])->name('experts');
  Route::get('/products', [DataTablesController::class, 'products'])->name('products');
  Route::get('/categorys', [DataTablesController::class, 'categorys'])->name('categorys');
  Route::get('/category/{id}/subcategorys', [DataTablesController::class, 'category_subcategorys'])->name('category.subcategorys');
  Route::get('/sales', [DataTablesController::class, 'sales'])->name('sales');
  Route::get('/blogs', [DataTablesController::class, 'blogs'])->name('blogs');
  Route::get('/plans', [DataTablesController::class, 'plans'])->name('plans');
  Route::get('/coupons', [DataTablesController::class, 'coupons'])->name('coupons');

  // Dashboard Settings
  Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
  Route::get('/website-settings', [SettingsController::class, 'website'])->name('settings.website');
  Route::get('/account-settings', [SettingsController::class, 'account'])->name('settings.account');
  Route::get('/store-settings', [SettingsController::class, 'store'])->name('settings.store');

  // Cart
  Route::get('/cart', [CartController::class, 'index'])->name('cart');
  Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
  Route::get('/cart/delete', [CartController::class, 'delete'])->name('cart.delete');
  Route::get('/cart/update', [CartController::class, 'update'])->name('cart.update');

  // Products
  Route::get('/product/{id}', [ProductsController::class, 'index'])->name('product.index');
  Route::post('/product/create', [ProductsController::class, 'create'])->name('product.create');
  Route::get('/product/delete', [ProductsController::class, 'delete'])->name('product.delete');
  Route::post('/product/update', [ProductsController::class, 'update'])->name('product.update');

  // Categories
  Route::get('/category/{id}', [CategoryController::class, 'get'])->name('category.get');
  Route::post('/category/create', [CategoryController::class, 'create'])->name('category.create');
  Route::delete('/category/{id}', [CategoryController::class, 'delete'])->name('category.delete');
  Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');

  // Categories
  Route::get('/subcategory/{id}', [SubCategoryController::class, 'get'])->name('subcategory.get');
  Route::post('/subcategory/create', [SubCategoryController::class, 'create'])->name('subcategory.create');
  Route::delete('/subcategory/{id}', [SubCategoryController::class, 'delete'])->name('subcategory.delete');
  Route::post('/subcategory/update', [SubCategoryController::class, 'update'])->name('subcategory.update');

  // Coupons
  Route::get('/coupon/{id}', [CouponController::class, 'index'])->name('coupon');
  Route::post('/coupon/create', [CouponController::class, 'create'])->name('coupon.add');
  Route::delete('/coupon/{id}', [CouponController::class, 'delete'])->name('coupon.delete');
  Route::get('/coupon/update', [CouponController::class, 'update'])->name('coupon.update');

  // Blogs
  Route::get('/blog/{id}', [BlogsController::class, 'get'])->name('blog.get');
  Route::post('/blog/create', [BlogsController::class, 'create'])->name('blog.create');
  Route::get('/blog/delete', [BlogsController::class, 'delete'])->name('blog.delete');
  Route::post('/blog/update', [BlogsController::class, 'update'])->name('blog.update');

  Route::get('/home/blogs', [BlogsController::class, 'index'])->name('blog.index');
  Route::get('/home/blogs/{id}', [BlogsController::class, 'ones'])->name('blog.ones');

  // Plans
  Route::get('/pricing-plan', [PlanController::class, 'index'])->name('plans.index');
  Route::get('/change-profile', [PlanController::class, 'change_profile'])->name('user.change.profile');
  Route::post('/change-profile-action', [PlanController::class, 'change_profile_action'])->name('user.change.profile.action');

  // Deasease
  Route::get('/diseases', [DiseasesController::class, 'index'])->name('diseases');
  Route::match(['get', 'post'], '/diseases/predict', [DiseasesController::class, 'predict'])->name('diseases.predict');

  // Events
  Route::get('/events', [EventController::class, 'index'])->name('events');

  // Authentication
  Route::get('/auth/logout', [LoginBasic::class, 'logout'])->name('logout.action');

  //Payment
  Route::get('chargily/pay', [ChargilyPayController::class, 'pay'])->name('chargily.payment.pay');
  Route::post('chargily/payment/success', [ChargilyPayController::class, 'handleSuccess'])->name('chargily.payment.success');
  Route::post('chargily/payment/webhook', [ChargilyPayController::class, 'handleWebhook'])->name('chargily.payment.webhook');

  // Pages Of Website
  Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
  Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

  Route::get('pages/terms-of-use', [SettingsController::class, 'get_terms_of_use'])->name('services.terms-of-use');
  Route::get('pages/about-us', [SettingsController::class, 'get_about_us'])->name('services.about-us');
  Route::get('pages/privacy-and-policy', [SettingsController::class, 'get_privacy_and_policy'])->name('services.privacy-and-policy');
  Route::get('pages/delivery', [SettingsController::class, 'get_delivery'])->name('services.delivery');
  Route::get('pages/secure-payment', [SettingsController::class, 'get_secure_payment'])->name('services.secure-payment');


  Route::post('/terms-of-use/update', [SettingsController::class, 'update_terms_of_use'])->name('terms_of_use.update');
  Route::post('/about-us/update', [SettingsController::class, 'update_about_us'])->name('about_us.update');
  Route::post('/privacy-and-policy/update', [SettingsController::class, 'update_privacy_and_policy'])->name('privacy_and_policy.update');
  Route::post('/delivery/update', [SettingsController::class, 'update_delivery'])->name('delivery.update');
  Route::post('/secure-payment/update', [SettingsController::class, 'update_secure_payment'])->name('secure_payment.update');

});

Route::middleware('guest')->group(function () {

  // authentication
    Route::get('login/google', [LoginBasic::class,'redirectToGoogle'])->name('auth.google.redirect');
    Route::get('login/google/callback', [LoginBasic::class,'handleGoogleCallback'])->name('auth.google.callback');

    Route::get('/login/facebook', [LoginBasic::class,'redirectToFacebook'])->name('auth.facebook.redirect');
    Route::get('/login/facebook/callback', [LoginBasic::class,'handleFacebookCallback'])->name('auth.facebook.callback');


    Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('login');
    Route::post('/auth/login', [LoginBasic::class, 'login'])->name('login.action');
    Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('register');
    Route::post('/auth/register', [RegisterBasic::class, 'register'])->name('register.action');
    Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password');
    Route::post('/auth/forgot-password', [ForgotPasswordBasic::class, 'forgot_password'])->name('auth-reset-password.action');

});



  Route::get('/terms-of-use', [SettingsController::class, 'terms_of_use'])->name('terms_of_use');
  Route::get('/about-us', [SettingsController::class, 'about_us'])->name('about_us');
  Route::get('/privacy-and-policy', [SettingsController::class, 'privacy_and_policy'])->name('privacy_and_policy');
  Route::get('/delivery', [SettingsController::class, 'delivery'])->name('delivery');
  Route::get('/secure-payment', [SettingsController::class, 'secure_payment'])->name('secure_payment');


  Route::get('change-language/{locale}', [LanguageController::class, 'change'])->name('change.language');
  Route::get('change-currency/{currency}', [CurrencyController::class, 'change'])->name('change.currency');
  Route::get('/get-states/{countryId}', [CountryController::class, 'getStates'])->name('get.states');
  Route::get('/get-cities/{countryId}/{stateId}', [CountryController::class, 'getCities'])->name('get.cities');





  Route::get('/ddd', function () {
    // Clear cache
    Artisan::call('cache:clear');
    // Clear configuration cache
    Artisan::call('config:cache');
    // Cache routes
    Artisan::call('route:cache');
    // Cache views
    Artisan::call('view:cache');

    return 'Cache cleared successfully.';
  });


















// layout
Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');

// pages
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-connections');
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');


// cards
Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

// User Interface
Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

// extended ui
Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');

// icons
Route::get('/icons/icons-mdi', [MdiIcons::class, 'index'])->name('icons-mdi');

// form elements
Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

// tables
Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');
