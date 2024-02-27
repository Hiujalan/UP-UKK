<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
// if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
//     require SYSTEMPATH . 'Config/Routes.php';
// }

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// $routes->set404Override(static function () {
//     return view('Admin/others/error-page/error-404');
// });
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Login::login');

$routes->group('login',  static function ($routes) {
    $routes->post('', 'Login::checkLogin');
    $routes->get('register', 'Login::register');
    $routes->post('register', 'Login::createUser');
    $routes->get('registerAlamat', 'Login::registerAlamat');
    $routes->post('registerAlamat', 'Login::updateAlamat');
    $routes->post('updateAlamatBe', 'Login::updateAlamatInBe');
    $routes->get('logout', 'Login::logout');
});

$routes->group('be',  static function ($routes) {
    $routes->get('dashboard', 'Login::dashboard');

    $routes->group('users',  static function ($routes) {
        $routes->get('user', 'Users::user');
        $routes->post('user', 'Users::createUser');
        $routes->post('editUser', 'Users::editUser');
        $routes->get('deleteUser(:any)', 'Users::deleteUser');

        $routes->get('operator', 'Users::operator');
        $routes->post('operator', 'Users::createOperator');
        $routes->post('editOperator', 'Users::editOperator');
        $routes->get('deleteOperator', 'Users::deleteOperator');
    });

    $routes->group('produk',  static function ($routes) {
        $routes->get('barang', 'Produk::barang');
        $routes->post('barang', 'Produk::createBarang');
        $routes->post('editBarang', 'Produk::editBarang');
        $routes->get('deleteBarang', 'Produk::deleteBarang');

        $routes->get('jasa', 'Produk::jasa');
        $routes->post('jasa', 'Produk::createJasa');
        $routes->post('editJasa', 'Produk::editJasa');
        $routes->get('deleteJasa', 'Produk::deleteJasa');

        $routes->get('satuan', 'Produk::satuan');
        $routes->post('satuan', 'Produk::createSatuan');
        $routes->post('editSatuan', 'Produk::editSatuan');
        $routes->get('deleteSatuan', 'Produk::deleteSatuan');

        $routes->get('spesifikasi', 'Produk::spesifikasi');
        $routes->post('spesifikasi', 'Produk::createSpesifikasi');
        $routes->post('editSpesifikasi', 'Produk::editSpesifikasi');
        $routes->get('deleteSpesifikasi', 'Produk::deleteSpesifikasi');

        $routes->get('bank', 'Produk::bank');
        $routes->post('bank', 'Produk::createBank');
        $routes->post('editBank', 'Produk::editBank');
        $routes->get('deleteBank', 'Produk::deleteBank');

        $routes->get('provinsi', 'Produk::provinsi');
        $routes->post('provinsi', 'Produk::createProvinsi');

        $routes->get('kabupaten', 'Produk::kabupaten');
        $routes->post('kabupaten', 'Produk::createKabupaten');

        $routes->post('spesifikasiJasa', 'Produk::spesifikasiJasa');
        $routes->post('spesifikasiBarang', 'Produk::spesifikasiBarang');

        $routes->post('laporanPesanan', 'Produk::laporanPesanan');
        $routes->get('cetakBarang', 'Produk::cetakBarang');
        $routes->get('cetakJasa', 'Produk::cetakJasa');

        $routes->get('selectProduk', 'Produk::selectProduk');

        $routes->post('createPesanan', 'Produk::createPesanan');
        $routes->get('selectUser', 'Produk::selectUser');
    });

    $routes->group('pesanan',  static function ($routes) {
        $routes->get('pesanan', 'Produk::pesanan');
        $routes->post('editPesanan', 'Produk::editPesanan');
        $routes->get('deletePesanan', 'Produk::deletePesanan');

        $routes->post('validasi', 'Produk::validasi');
        $routes->get('cetakInvoicePesanan', 'Produk::cetakInvoicePesanan');
        $routes->post('addBuktiPembayaran', 'Produk::addBuktiPembayaran');
    });

    $routes->group('settings',  static function ($routes) {
        $routes->get('settings', 'Produk::settings');
        $routes->post('settings', 'Produk::editSettings');
    });
});

$routes->group('app',  static function ($routes) {
    $routes->get('home', 'App::home');

    $routes->get('searchProduk', 'App::searchProduk');

    $routes->get('pesananSaya', 'App::pesananSaya');

    $routes->group('shop',  static function ($routes) {
        $routes->get('produk', 'App::produk');
        $routes->get('detailBarang', 'App::detailBarang');
        $routes->get('detailJasa', 'App::detailJasa');
        $routes->get('pembayaran', 'App::pembayaran');

        $routes->post('addjumlahPesanan', 'App::addjumlahPesanan');
        $routes->post('addBuktiPembayaran', 'App::addBuktiPembayaran');
        $routes->get('pembayaranEnd', 'App::pembayaranEnd');

        $routes->get('cetakInvoice', 'App::cetakInvoicePesanan');
        $routes->get('detailPesanan', 'App::detailPesanan');
    });

    $routes->group('user',  static function ($routes) {
        $routes->get('profile', 'App::profile');
        $routes->post('editProfile', 'App::editProfile');
    });
});


// Dashboard
$routes->group('dashboards', static function ($routes) {
    $routes->get('default-dashboard', function () {
        return view('Admin/dashboard/dashboard');
    });
    $routes->get('ecommerce', function () {
        return view('Admin/dashboard/ecommerce_dashboard');
    });
    $routes->get('online_course', function () {
        return view('Admin/dashboard/online_course_dashboard');
    });
    $routes->get('social_dashboard', function () {
        return view('Admin/dashboard/social_dashboard');
    });
    $routes->get('crypto_dashboard', function () {
        return view('Admin/dashboard/crypto_dashboard');
    });
});

// Sales

$routes->group('sales',  static function ($routes) {
    // menu sales
    $routes->get('sales', 'Sales::sales');
    $routes->get('sales_orders', 'Sales::orders');
    $routes->get('sales_customer', 'Sales::customer');
    $routes->get('sales_add_customer', 'Sales::addCostumer');
    $routes->get('sales_invoice', 'Sales::invoice');
    $routes->get('sales_upsell', 'Sales::upsell');
    $routes->get('sales_product', 'Sales::product');
    $routes->get('sales_pricelist', 'Sales::pricelist');
    $routes->get('sales_add_pricelist', 'Sales::addPricelist');
    $routes->get('sales_edit_pricelist', 'Sales::editPricelist');
    $routes->get('sales_add_product', 'Sales::addProduct');
    $routes->get('sales_report', 'Sales::report');

    $routes->get('faktur', function () {
        return view('Admin/sales/faktur');
    });

    // menu sign
    $routes->get('sign', 'Sign::sign');
    $routes->get('sign_detail', 'Sign::detail');
    $routes->get('sign_edit', 'Sign::edit');
    $routes->get('sign_savings', 'Sign::savings');

    // menu penyewaan
    $routes->get('penyewaan', 'Penyewaan::penyewaan');
    $routes->get('penyewaan_customer', 'Penyewaan::customer');
    $routes->get('penyewaan_add_customer', 'Penyewaan::addCostumer');
    $routes->get('penyewaan_product', 'Penyewaan::product');
    $routes->get('penyewaan_add_product', 'Penyewaan::addProduct');
    $routes->get('penyewaan_report', 'Penyewaan::report');

    // menu servis lapanagn
    $routes->get('servis-lapangan', 'ServisLapangan::servisLapangan');
    $routes->get('servisLapangan_add', 'ServisLapangan::addServisLapangan');
    $routes->get('servisLapangan_map', 'ServisLapangan::map');
    $routes->get('servisLapangan_allTasks', 'ServisLapangan::alltasks');
    $routes->get('servisLapangan_schedule', 'ServisLapangan::schedule');
    $routes->get('servisLapangan_invoice', 'ServisLapangan::invoice');
    $routes->get('servisLapangan_report', 'ServisLapangan::report');
});

// Pengoperasian
$routes->group('pengoperasian', static function ($routes) {
    // menu akuntansi
    $routes->get('akuntansi', 'Akuntansi::akuntansi');
    $routes->get('akuntansi_invoice', 'Akuntansi::invoice');
    $routes->get('akuntansi_add_invoice', 'Akuntansi::addInvoice');
    $routes->get('akuntansi_add_credit', 'Akuntansi::addCredit');
    $routes->get('akuntansi_credit', 'Akuntansi::credit');
    $routes->get('akuntansi_payment', 'Akuntansi::payment');
    $routes->get('akuntansi_add_payment', 'Akuntansi::addPayment');
    $routes->get('akuntansi_follow', 'Akuntansi::follow');
    $routes->get('akuntansi_product', 'Akuntansi::product');
    $routes->get('akuntansi_add_product', 'Akuntansi::addProduct');
    $routes->get('akuntansi_costumer', 'Akuntansi::costumer');
    $routes->get('akuntansi_add_costumer', 'Akuntansi::addCostumer');
    $routes->get('akuntansi_faktur', 'Akuntansi::faktur');

    $routes->get('akuntansi_bills', 'Akuntansi::bills');
    $routes->get('akuntansi_add_bills', 'Akuntansi::addBills');
    $routes->get('akuntansi_refunds', 'Akuntansi::refunds');
    $routes->get('akuntansi_add_refunds', 'Akuntansi::addRefunds');
    $routes->get('akuntansi_vendorPayment', 'Akuntansi::vendorPayment');
    $routes->get('akuntansi_add_vendorPayment', 'Akuntansi::addVendorPayment');
    $routes->get('akuntansi_bankAccount', 'Akuntansi::bankAccount');
    $routes->get('akuntansi_add_bankAccount', 'Akuntansi::addBankAccount');
    $routes->get('akuntansi_vendors', 'Akuntansi::vendors');
    $routes->get('akuntansi_add_vendors', 'Akuntansi::addVendors');

    $routes->get('akuntansi_journalEntries', 'Akuntansi::journalEntries');
    $routes->get('akuntansi_add_journalEntries', 'Akuntansi::addJournalEntries');
    $routes->get('akuntansi_journalisItems', 'Akuntansi::journalisItems');
    $routes->get('akuntansi_automaticTransfers', 'Akuntansi::automaticTransfers');
    $routes->get('akuntansi_add_automaticTransfers', 'Akuntansi::addAutomaticTransfers');
    $routes->get('akuntansi_assets', 'Akuntansi::assets');
    $routes->get('akuntansi_add_assets', 'Akuntansi::addAssets');

    $routes->get('akuntansi_balanceSheet', 'Akuntansi::balanceSheet');
    $routes->get('akuntansi_profitLoss', 'Akuntansi::profitLoss');
    $routes->get('akuntansi_cashFlow', 'Akuntansi::cashFlow');
    $routes->get('akuntansi_executiveSummary', 'Akuntansi::executiveSummary');
    $routes->get('akuntansi_taxReport', 'Akuntansi::taxReport');
    $routes->get('akuntansi_generalLedger', 'Akuntansi::generalLedger');
    $routes->get('akuntansi_trialBalance', 'Akuntansi::trialBalance');
    $routes->get('akuntansi_journalReport', 'Akuntansi::journalReport');
    $routes->get('akuntansi_partnerLedger', 'Akuntansi::partnerLedger');
    $routes->get('akuntansi_agendReceivable', 'Akuntansi::agendReceivable');
    $routes->get('akuntansi_agedPayable', 'Akuntansi::agedPayable');

    $routes->get('akuntansi_invoiceAnalysis', 'Akuntansi::invoiceAnalysis');
    $routes->get('akuntansi_analyticReporting', 'Akuntansi::analyticReporting');
    $routes->get('akuntansi_defferedExpense', 'Akuntansi::defferedExpense');
    $routes->get('akuntansi_defferedRevenue', 'Akuntansi::defferedRevenue');
    $routes->get('akuntansi_deprecationSchedule', 'Akuntansi::deprecationSchedule');


    // menu pengetahuan
    $routes->get('pengetahuan', function () {
        return view('Admin/pengoperasian/pengetahuan');
    });

    // menu proyek
    $routes->get('proyek', 'Proyek::proyek');
    $routes->get('proyek_myTasks', 'Proyek::myTasks');
    $routes->get('proyek_add_tasks', 'Proyek::addTasks');
    $routes->get('proyek_allTasks', 'Proyek::allTasks');
    $routes->get('proyek_task_analytyc', 'Proyek::taskAnalytyc');

    $routes->get('timesheet', 'Timesheet::timesheet');
    $routes->get('add_timesheet', 'Timesheet::addTimesheet');
    $routes->get('timesheet_validate', 'Timesheet::validateTimesheet');

    $routes->get('mejabantuan', 'MejaBantuan::mejabantuan');
    $routes->get('mejabantuan_myTickets', 'MejaBantuan::myTickets');
    $routes->get('mejabantuan_add_myTickets', 'MejaBantuan::addMyTickets');
    $routes->get('mejabantuan_allTickets', 'MejaBantuan::allTickets');
    $routes->get('mejabantuan_add_allTickets', 'MejaBantuan::addAllTickets');
    $routes->get('mejabantuan_ticketAnalysis', 'MejaBantuan::ticketAnalysis');
    $routes->get('mejabantuan_slaStaus', 'MejaBantuan::slaStatus');

    $routes->get('/mejabantuan', function () {
        return view('Admin/pengoperasian/');
    });

    $routes->get('inventaris', 'Inventaris::inventaris');
    $routes->get('inventaris_receipt', 'Inventaris::receipt');
    $routes->get('inventaris_add_receipt', 'Inventaris::addReceipt');
    $routes->get('inventaris_delivers', 'Inventaris::delivers');
    $routes->get('inventaris_add_delivers', 'Inventaris::addDelivers');
    $routes->get('inventaris_phsycalInventoery', 'Inventaris::phsycalInventoery');
    $routes->get('inventaris_scrap', 'Inventaris::scrap');
    $routes->get('inventaris_add_scrap', 'Inventaris::addScrap');
    $routes->get('inventaris_replenisment', 'Inventaris::replenisment');
    $routes->get('inventaris_product', 'Inventaris::product');
    $routes->get('inventaris_stock', 'Inventaris::stock');
    $routes->get('inventaris_add_stock', 'Inventaris::addStock');
    $routes->get('inventaris_moves', 'Inventaris::moves');
    $routes->get('inventaris_performance', 'Inventaris::performance');

    $routes->get('pembelian', 'Pembelian::pembelian');
    $routes->get('pembelian_add_order', 'Pembelian::addOrder');
    $routes->get('pembelian_orders', 'Pembelian::orders');
    $routes->get('pembelian_vendors', 'Pembelian::vendors');
    $routes->get('pembelian_add_vendors', 'Pembelian::addVendors');
    $routes->get('pembelian_product', 'Pembelian::product');
    $routes->get('pembelian_add_product', 'Pembelian::addProduct');
    $routes->get('pembelian_reportPurchase', 'Pembelian::reportPurchase');

    $routes->get('dokumen', 'Dokumen::dokumen');
});

//Widget
$routes->group('Widgets', static function ($routes) {
    $routes->get('general-widget', function () {
        return view('Admin/widgets/general-widget');
    });
    $routes->get('chart-widget', function () {
        return view('Admin/widgets/chart-widget');
    });
});
// Page-Layout
$routes->group('page-layout', static function ($routes) {
    $routes->get('box-layout', function () {
        return view('Admin/page-layout/box-layout');
    });
    $routes->get('layout-rtl', function () {
        return view('Admin/page-layout/rlt-layout');
    });
    $routes->get('layout-dark', function () {
        return view('Admin/page-layout/layout-dark');
    });
    $routes->get('hide-on-scroll', function () {
        return view('Admin/page-layout/hide-on-scroll');
    });
    $routes->get('footer-light', function () {
        return view('Admin/page-layout/footer-light');
    });
    $routes->get('footer-dark', function () {
        return view('Admin/page-layout/footer-dark');
    });
    $routes->get('footer-fixed', function () {
        return view('Admin/page-layout/footer-fixed');
    });
});

// project
$routes->group('projects', static function ($routes) {
    $routes->get('project-list', function () {
        return view('Admin/project/projects-list');
    });
    $routes->get('project-create', function () {
        return view('Admin/project/projectcreate');
    });
});

// Ecommerce
$routes->group('ecommerce', static function ($routes) {
    $routes->get('product', function () {
        return view('Admin/ecommerce/product');
    });
    $routes->get('detailed-product-page', function () {
        return view('Admin/ecommerce/product-page');
    });
    $routes->get('detailed-products-list', function () {
        return view('Admin/ecommerce/products-list');
    });
    $routes->get('payment-details', function () {
        return view('Admin/ecommerce/payment-details');
    });
    $routes->get('order-history', function () {
        return view('Admin/ecommerce/order-history');
    });
    $routes->get('invoice-template', function () {
        return view('Admin/ecommerce/invoice-template');
    });
    $routes->get('cart', function () {
        return view('Admin/ecommerce/cart');
    });
    $routes->get('list-wish', function () {
        return view('Admin/ecommerce/list-wish');
    });
    $routes->get('checkout', function () {
        return view('Admin/ecommerce/checkout');
    });
    $routes->get('pricing', function () {
        return view('Admin/ecommerce/pricing');
    });
});

// Email
$routes->group('email', static function ($routes) {
    $routes->get('email-application', function () {
        return view('Admin/email/email-application');
    });
    $routes->get('email-compose', function () {
        return view('Admin/email/email-compose');
    });
});

// Chat
$routes->group('chat', static function ($routes) {
    $routes->get('chat-app', function () {
        return view('Admin/chat/chat');
    });
    $routes->get('video-chat', function () {
        return view('Admin/chat/chat-video');
    });
});

// Users
$routes->group('user', static function ($routes) {
    $routes->get('user-profile', function () {
        return view('Admin/users/user-profile');
    });
    $routes->get('edit-profile', function () {
        return view('Admin/users/edit-profile');
    });
    $routes->get('user-cards', function () {
        return view('Admin/users/user-cards');
    });
});


// Forms

$routes->group('forms', function ($routes) {

    // Forms-Controls  
    $routes->get('form-validation', function () {
        return view('Admin/forms/form-controls/form-validation');
    });
    $routes->get('base-input', function () {
        return view('Admin/forms/form-controls/base-input');
    });
    $routes->get('radio-checkbox-control', function () {
        return view('Admin/forms/form-controls/radio-checkbox-control');
    });
    $routes->get('input-group', function () {
        return view('Admin/forms/form-controls/input-group');
    });
    $routes->get('megaoptions', function () {
        return view('Admin/forms/form-controls/megaoptions');
    });

    // Form Widgets
    $routes->get('datepicker', function () {
        return view('Admin/forms/form-widgets/datepicker');
    });
    $routes->get('time-picker', function () {
        return view('Admin/forms/form-widgets/time-picker');
    });
    $routes->get('datetimepicker', function () {
        return view('Admin/forms/form-widgets/datetimepicker');
    });
    $routes->get('daterangepicker', function () {
        return view('Admin/forms/form-widgets/daterangepicker');
    });
    $routes->get('touchspin', function () {
        return view('Admin/forms/form-widgets/touchspin');
    });
    $routes->get('select2', function () {
        return view('Admin/forms/form-widgets/select2');
    });
    $routes->get('switch', function () {
        return view('Admin/forms/form-widgets/switch');
    });
    $routes->get('typeahead', function () {
        return view('Admin/forms/form-widgets/typeahead');
    });
    $routes->get('clipboard', function () {
        return view('Admin/forms/form-widgets/clipboard');
    });

    // Form Layout
    $routes->get('default-form', function () {
        return view('Admin/forms/form-layout/default-form');
    });
    $routes->get('form-wizard', function () {
        return view('Admin/forms/form-layout/form-wizard');
    });
    $routes->get('second-form-wizard', function () {
        return view('Admin/forms/form-layout/form-wizard-two');
    });
    $routes->get('third-form-wizard', function () {
        return view('Admin/forms/form-layout/form-wizard-three');
    });
});

// Tables 
$routes->group('tables', function ($routes) {

    // Bootstrap Tables
    $routes->get('bootstrap-basic-table', function () {
        return view('Admin/tables/bootstrap-tables/bootstrap-basic-table');
    });
    $routes->get('table-components', function () {
        return view('Admin/tables/bootstrap-tables/table-components');
    });

    // Data Tables
    $routes->get('datatable-basic-init', function () {
        return view('Admin/tables/data-tables/datatable-basic');
    });
    $routes->get('datatable-API', function () {
        return view('Admin/tables/data-tables/datatable-API');
    });
    $routes->get('datatable-data-source', function () {
        return view('Admin/tables/data-tables/datatable-data-source');
    });

    // Ex. Data Tables
    $routes->get('datatable-ext-autofill', function () {
        return view('Admin/tables/ex-data-tables/datatable-ext-autofill');
    });

    // JS Grid Tables
    $routes->get('jsgrid-table', function () {
        return view('Admin/tables/jsgrid-table');
    });
});


// Ui Kits
$routes->group('ui-kits', function ($routes) {
    $routes->get('state-color', function () {
        return view('Admin/ui-kits/state-color');
    });
    $routes->get('typography', function () {
        return view('Admin/ui-kits/typography');
    });
    $routes->get('avatars', function () {
        return view('Admin/ui-kits/avatars');
    });
    $routes->get('helper-classes', function () {
        return view('Admin/ui-kits/helper-classes');
    });
    $routes->get('grid', function () {
        return view('Admin/ui-kits/grid');
    });
    $routes->get('tag-pills', function () {
        return view('Admin/ui-kits/tag-pills');
    });
    $routes->get('progress-bar', function () {
        return view('Admin/ui-kits/progress-bar');
    });
    $routes->get('modal', function () {
        return view('Admin/ui-kits/modal');
    });
    $routes->get('alert', function () {
        return view('Admin/ui-kits/alert');
    });
    $routes->get('popover', function () {
        return view('Admin/ui-kits/popover');
    });
    $routes->get('tooltip', function () {
        return view('Admin/ui-kits/tooltip');
    });
    $routes->get('loader', function () {
        return view('Admin/ui-kits/loader');
    });
    $routes->get('dropdown', function () {
        return view('Admin/ui-kits/dropdown');
    });
    $routes->get('according', function () {
        return view('Admin/ui-kits/according');
    });
    $routes->get('tab-bootstrap', function () {
        return view('Admin/ui-kits/tab/tab-bootstrap');
    });
    $routes->get('tab-material', function () {
        return view('Admin/ui-kits/tab/tab-material');
    });
    $routes->get('box-shadow', function () {
        return view('Admin/ui-kits/box-shadow');
    });
    $routes->get('list', function () {
        return view('Admin/ui-kits/list');
    });
});


// Bonus Ui
$routes->group('Bonus-ui', function ($routes) {
    $routes->get('scrollable', function () {
        return view('Admin/bonus-ui/scrollable');
    });
    $routes->get('tree', function () {
        return view('Admin/bonus-ui/tree');
    });
    $routes->get('bootstrap-notify', function () {
        return view('Admin/bonus-ui/bootstrap-notify');
    });
    $routes->get('rating', function () {
        return view('Admin/bonus-ui/rating');
    });
    $routes->get('dropzone', function () {
        return view('Admin/bonus-ui/dropzone');
    });
    $routes->get('tour', function () {
        return view('Admin/bonus-ui/tour');
    });
    $routes->get('sweet-alert2', function () {
        return view('Admin/bonus-ui/sweet-alert2');
    });
    $routes->get('animated-modal', function () {
        return view('Admin/bonus-ui/modal-animated');
    });
    $routes->get('owl-carousel', function () {
        return view('Admin/bonus-ui/owl-carousel');
    });
    $routes->get('ribbons', function () {
        return view('Admin/bonus-ui/ribbons');
    });
    $routes->get('pagination', function () {
        return view('Admin/bonus-ui/pagination');
    });
    $routes->get('breadcrumb', function () {
        return view('Admin/bonus-ui/breadcrumb');
    });
    $routes->get('range-slider', function () {
        return view('Admin/bonus-ui/range-slider');
    });
    $routes->get('image-cropper', function () {
        return view('Admin/bonus-ui/image-cropper');
    });
    $routes->get('sticky', function () {
        return view('Admin/bonus-ui/sticky');
    });
    $routes->get('basic-card', function () {
        return view('Admin/bonus-ui/basic-card');
    });
    $routes->get('creative-card', function () {
        return view('Admin/bonus-ui/creative-card');
    });
    $routes->get('tabbed-card', function () {
        return view('Admin/bonus-ui/tabbed-card');
    });
    $routes->get('dragable-card', function () {
        return view('Admin/bonus-ui/dragable-card');
    });
    $routes->get('timeline-v-1', function () {
        return view('Admin/bonus-ui/timeline/timeline-v-1');
    });
    $routes->get('timeline-v-2', function () {
        return view('Admin/bonus-ui/timeline/timeline-v-2');
    });
});


// Builders
$routes->group('builders', function ($routes) {
    $routes->get('form-builder-1', function () {
        return view('Admin/builders/form-builder-1');
    });
    $routes->get('form-builder-2', function () {
        return view('Admin/builders/form-builder-2');
    });
    $routes->get('pagebuild', function () {
        return view('Admin/builders/pagebuild');
    });
    $routes->get('button-builder', function () {
        return view('Admin/builders/button-builder');
    });
});


// Animation
$routes->group('animations', function ($routes) {
    $routes->get('animate', function () {
        return view('Admin/animation/animate');
    });
    $routes->get('AOS', function () {
        return view('Admin/animation/AOS');
    });
    $routes->get('scroll-reval', function () {
        return view('Admin/animation/scroll-reval');
    });
    $routes->get('tilt', function () {
        return view('Admin/animation/tilt');
    });
    $routes->get('wow', function () {
        return view('Admin/animation/wow');
    });
});


// Icons
$routes->group('icons', function ($routes) {
    $routes->get('flag-icon', function () {
        return view('Admin/Icons/flag-icon');
    });
    $routes->get('font-awesome', function () {
        return view('Admin/Icons/font-awesome');
    });
    $routes->get('ico-icon', function () {
        return view('Admin/Icons/ico-icon');
    });
    $routes->get('themify-icon', function () {
        return view('Admin/Icons/themify-icon');
    });
    $routes->get('whether-icon', function () {
        return view('Admin/Icons/whether-icon');
    });
    $routes->get('feather-icon', function () {
        return view('Admin/Icons/feather-icon');
    });
});


// Buttons
$routes->group('buttons', function ($routes) {
    $routes->get('default-buttons', function () {
        return view('Admin/buttons/buttons-default');
    });
    $routes->get('flat-buttons', function () {
        return view('Admin/buttons/buttons-flat');
    });
    $routes->get('edge-buttons', function () {
        return view('Admin/buttons/buttons-edge');
    });
    $routes->get('raised-button', function () {
        return view('Admin/buttons/raised-button');
    });
    $routes->get('group-button', function () {
        return view('Admin/buttons/button-group');
    });
});


// Charts
$routes->group('charts', function ($routes) {
    $routes->get('echarts', function () {
        return view('Admin/charts/echarts');
    });
    $routes->get('chart-apex', function () {
        return view('Admin/charts/chart-apex');
    });
    $routes->get('chart-google', function () {
        return view('Admin/charts/chart-google');
    });
    $routes->get('chart-sparkline', function () {
        return view('Admin/charts/chart-sparkline');
    });
    $routes->get('chart-flot', function () {
        return view('Admin/charts/chart-flot');
    });
    $routes->get('chart-knob', function () {
        return view('Admin/charts/chart-knob');
    });
    $routes->get('chart-morris', function () {
        return view('Admin/charts/chart-morris');
    });
    $routes->get('chartjs', function () {
        return view('Admin/charts/chartjs');
    });
    $routes->get('chartist', function () {
        return view('Admin/charts/chartist');
    });
    $routes->get('chart-peity', function () {
        return view('Admin/charts/chart-peity');
    });
});

// Others

// Error-Pages
$routes->group('error-pages', function ($routes) {
    $routes->get('error-400', function () {
        return view('Admin/others/error-page/error-400');
    });
    $routes->get('error-401', function () {
        return view('Admin/others/error-page/error-401');
    });
    $routes->get('error-403', function () {
        return view('Admin/others/error-page/error-403');
    });
    $routes->get('error-404', function () {
        return view('Admin/others/error-page/error-404');
    });
    $routes->get('error-500', function () {
        return view('Admin/others/error-page/error-500');
    });
    $routes->get('error-503', function () {
        return view('Admin/others/error-page/error-503');
    });
});


// Authentication
$routes->group('authentications', function ($routes) {
    $routes->get('login', function () {
        return view('Admin/others/authentication/login');
    });
    $routes->get('login_one', function () {
        return view('Admin/others/authentication/login_one');
    });
    $routes->get('login_two', function () {
        return view('Admin/others/authentication/login_two');
    });
    $routes->get('login-bs-validation', function () {
        return view('Admin/others/authentication/login-bs-validation');
    });
    $routes->get('login-bs-tt-validation', function () {
        return view('Admin/others/authentication/login-bs-tt-validation');
    });
    $routes->get('login-sa-validation', function () {
        return view('Admin/others/authentication/login-sa-validation');
    });
    $routes->get('sign-up', function () {
        return view('Admin/others/authentication/sign-up');
    });
    $routes->get('sign-up-one', function () {
        return view('Admin/others/authentication/sign-up-one');
    });
    $routes->get('sign-up-two', function () {
        return view('Admin/others/authentication/sign-up-two');
    });
    $routes->get('sign-up-wizard', function () {
        return view('Admin/others/authentication/sign-up-wizard');
    });
    $routes->get('unlock', function () {
        return view('Admin/others/authentication/unlock');
    });
    $routes->get('reset-password', function () {
        return view('Admin/others/authentication/reset-password');
    });
    $routes->get('maintenance', function () {
        return view('Admin/others/authentication/maintenance');
    });
    $routes->get('forget-password', function () {
        return view('Admin/others/authentication/forget-password');
    });
});

// Comming-soon
$routes->group('comming-soons', function ($routes) {
    $routes->get('comingsoon', function () {
        return view('Admin/others/coming-soon/comingsoon');
    });
    $routes->get('comingsoon-bg-img', function () {
        return view('Admin/others/coming-soon/comingsoon-bg-img');
    });
    $routes->get('comingsoon-bg-video', function () {
        return view('Admin/others/coming-soon/comingsoon-bg-video');
    });
});


// Email templates
$routes->group('email-templates', function ($routes) {
    $routes->get('basic-template', function () {
        return view('Admin/others/email-templates/basic-template');
    });
    $routes->get('ecommerce-templates', function () {
        return view('Admin/others/email-templates/ecommerce-templates');
    });
    $routes->get('email-header', function () {
        return view('Admin/others/email-templates/email-header');
    });
    $routes->get('email-order-success', function () {
        return view('Admin/others/email-templates/email-order-success');
    });
    $routes->get('basic-template', function () {
        return view('Admin/others/email-templates/basic-template');
    });
    $routes->get('template-email', function () {
        return view('Admin/others/email-templates/template-email');
    });
    $routes->get('template-email-2', function () {
        return view('Admin/others/email-templates/template-email-2');
    });
});


// Gallery
$routes->group('Gallery', function ($routes) {
    $routes->get('gallery', function () {
        return view('Admin/gallery/gallery');
    });
    $routes->get('description-gallery', function () {
        return view('Admin/gallery/gallery-with-description');
    });
    $routes->get('masonry-gallery', function () {
        return view('Admin/gallery/gallery-masonry');
    });
    $routes->get('gallery-hover', function () {
        return view('Admin/gallery/gallery-hover');
    });
    $routes->get('description-masonry-gallery', function () {
        return view('Admin/gallery/masonry-gallery-with-disc');
    });
});

// Blog
$routes->group('blog', function ($routes) {
    $routes->get('blog-details', function () {
        return view('Admin/Blog/blog');
    });
    $routes->get('single-blog', function () {
        return view('Admin/Blog/blog-single');
    });
    $routes->get('add-post', function () {
        return view('Admin/Blog/add-post');
    });
});

// Job Search
$routes->group('job-search', function ($routes) {
    $routes->get('job-cards-view', function () {
        return view('Admin/job-search/job-cards-view');
    });
    $routes->get('job-list-view', function () {
        return view('Admin/job-search/job-list-view');
    });
    $routes->get('job-details', function () {
        return view('Admin/job-search/job-details');
    });
    $routes->get('job-apply', function () {
        return view('Admin/job-search/job-apply');
    });
});

// Learning
$routes->group('learning', function ($routes) {
    $routes->get('learning-list-view', function () {
        return view('Admin/learning/learning-list-view');
    });
    $routes->get('learning-detailed', function () {
        return view('Admin/learning/learning-detailed');
    });
});

// Maps  
$routes->group('map', function ($routes) {
    $routes->get('map-js', function () {
        return view('Admin/Maps/map-js');
    });
    $routes->get('vector-map', function () {
        return view('Admin/Maps/vector-map');
    });
});

// Editors
$routes->group('editors', function ($routes) {
    $routes->get('summernote', function () {
        return view('Admin/editors/summernote');
    });
    $routes->get('ckeditor', function () {
        return view('Admin/editors/ckeditor');
    });
    $routes->get('simple-MDE', function () {
        return view('Admin/editors/simple-MDE');
    });
    $routes->get('ace-code-editor', function () {
        return view('Admin/editors/ace-code-editor');
    });
});



// File Manager
$routes->get('file-manager', function () {
    return view('Admin/file-manager');
});

// Kanban Board
$routes->get('kanban', function () {
    return view('Admin/kanban');
});

// Bookmark
$routes->get('bookmark', function () {
    return view('Admin/bookmark');
});

// Contacts
$routes->get('contacts', function () {
    return view('Admin/contacts');
});

// Task
$routes->get('task', function () {
    return view('Admin/task');
});

// Calendar-Basic
$routes->get('calendar-basic', function () {
    return view('Admin/calendar-basic');
});

// Social-App
$routes->get('social-app', function () {
    return view('Admin/social-app');
});

// To-do
$routes->get('to-do', function () {
    return view('Admin/to-do');
});

// Search
$routes->get('search', function () {
    return view('Admin/search');
});

// Sample Page
$routes->get('sample-page', function () {
    return view('Admin/sample-page');
});

// Internationalization
$routes->get('internationalization', function () {
    return view('Admin/internationalization');
});

// FAQ
$routes->get('faq', function () {
    return view('Admin/faq');
});

// Knowledgebase
$routes->get('knowledgebase', function () {
    return view('Admin/knowledgebase');
});

// Support Ticket
$routes->get('support-ticket', function () {
    return view('Admin/support-ticket');
});




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
