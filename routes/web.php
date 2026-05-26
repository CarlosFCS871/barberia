<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\ServicioController;
use App\Http\Controllers\Admin\HorarioController;
use App\Http\Controllers\Admin\CitaController;
use App\Http\Controllers\Admin\PromocionController;
use App\Http\Controllers\Admin\VentaController;
use App\Http\Controllers\Admin\ContactoController;
use App\Http\Controllers\Admin\TestimonioController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PerfilController;
use App\Http\Controllers\Barbero\ServicioController as BarberoServicioController;
use App\Http\Controllers\Barbero\HorarioController as BarberoHorarioController;
use App\Http\Controllers\Barbero\CitaController as BarberoCitaController;
use App\Http\Controllers\Barbero\VentaController as BarberoVentaController;
use App\Http\Controllers\Barbero\PromocionController as BarberoPromocionController;
use App\Http\Controllers\Barbero\PerfilController as BarberoPerfilController;
use App\Http\Controllers\Barbero\DashboardController as BarberoDashboardController;
use App\Http\Controllers\Cliente\DashboardController as ClienteDashboardController;
use App\Http\Controllers\Cliente\CitaController as ClienteCitaController;
use App\Http\Controllers\Cliente\PerfilController as ClientePerfilController;
use App\Http\Controllers\Cliente\TestimonioController as ClienteTestimonioController;
use App\Http\Controllers\Public\ContactoController as ContactoControllerCliente; 

use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ServicioController as PublicServicioController;
use App\Http\Controllers\Public\PromocionController as PublicPromocionController;
use App\Http\Controllers\Public\BarberoController as PublicBarberoController;
use App\Http\Controllers\Public\TestimonioController as PublicTestimonioController;
use App\Http\Controllers\Public\ContactoPageController as ContactoPageControllerPublic;




/*
|--------------------------------------------------------------------------
| REDIRECCIÓN GENERAL DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    if (!Auth::check()) {

        return redirect('/login');
    }

    if (Auth::user()->rol === 'admin') {

        return redirect()->route('admin.dashboard');
    }

    if (Auth::user()->rol === 'barbero') {

        return redirect()->route('barbero.dashboard');
    }

    return redirect()->route('cliente.dashboard');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:admin'
])->prefix('admin')->group(function () {



    /*
    Route::get('/dashboard', function () {

        return view('admin.dashboard');
    })->name('admin.dashboard');
*/

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');


    Route::get('/usuarios', [UsuarioController::class, 'index'])
        ->name('admin.usuarios.index');

    Route::get('/usuarios/create', [UsuarioController::class, 'create'])
        ->name('admin.usuarios.create');

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::resource('perfil', PerfilController::class);
    });

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::resource('usuarios', UsuarioController::class);
    });

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::resource('servicios', ServicioController::class);
    });


    Route::prefix('admin')->name('admin.')->group(function () {

        Route::resource('horarios', HorarioController::class);
    });

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::resource('citas', CitaController::class);
    });

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::resource('ventas', VentaController::class);
    });

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::resource('promociones', PromocionController::class);
    });


    Route::prefix('admin')->name('admin.')->group(function () {

        Route::resource('testimonios', TestimonioController::class);
    });


    Route::prefix('admin')->name('admin.')->group(function () {

        Route::resource('contactos', ContactoController::class);
    });
});

/*|--------------------------------------------------------------------------
| DASHBOARD BARBERO
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:barbero'
])->prefix('barbero')->group(function () {

    Route::get('/dashboard', [BarberoDashboardController::class, 'index'])
        ->name('barbero.dashboard');

    Route::prefix('barbero')->name('barbero.')->group(function () {

        Route::resource('servicios', BarberoServicioController::class);
    });

    Route::prefix('barbero')->name('barbero.')->group(function () {

        Route::resource('horarios', BarberoHorarioController::class);
    });

    Route::prefix('barbero')->name('barbero.')->group(function () {

        Route::resource('citas', BarberoCitaController::class);
    });

    Route::prefix('barbero')->name('barbero.')->group(function () {

        Route::resource('ventas', BarberoVentaController::class);
    });

    Route::prefix('barbero')->name('barbero.')->group(function () {

        Route::resource('promociones', BarberoPromocionController::class);
    });

    Route::prefix('barbero')->name('barbero.')->group(function () {

        Route::resource('perfil', BarberoPerfilController::class);
    });

    Route::prefix('barbero')->name('barbero.')->group(function () {

        Route::resource('dashboard', BarberoDashboardController::class);
    });
});

/*
|--------------------------------------------------------------------------
| DASHBOARD CLIENTE
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:cliente'
])->prefix('cliente')->group(function () {

    Route::get('/dashboard', function () {

        return view('cliente.dashboard');
    })->name('cliente.dashboard');

    Route::get('/dashboard', [ClienteDashboardController::class, 'index'])
        ->name('cliente.dashboard');
    Route::prefix('cliente')->name('cliente.')->group(function () {

        Route::resource('citas', ClienteCitaController::class);
    });

    Route::prefix('cliente')->name('cliente.')->group(function () {

        Route::resource('testimonios', ClienteTestimonioController::class);
    });

    Route::prefix('cliente')->name('cliente.')->group(function () {

        Route::resource('perfil', ClientePerfilController::class);
    });

    Route::post('/contacto', [ContactoControllerCliente::class, 'store'])
    ->name('contactos.store');
});





// PUBLICO 

Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::get('/servicios', [PublicServicioController::class, 'servicios'])->name('servicios');

Route::get('/promociones', [PublicPromocionController::class, 'index'])->name('promociones');

Route::get('/barberos', [PublicBarberoController::class, 'index'])->name('barberos');

Route::get('/barberos/{id}', [PublicBarberoController::class, 'show'])->name('barberosShow');

Route::get('/testimonios', [PublicTestimonioController::class, 'index'])->name('testimonios');

Route::get('/contacto', [ContactoPageControllerPublic::class, 'index'])->name('contacto');

Route::post('/contacto/enviar', [ContactoPageControllerPublic::class, 'store'])->name('contactos.store');






/*
|--------------------------------------------------------------------------
| PERFIL
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});



use Illuminate\Support\Facades\Artisan;

Route::get('/migrar-base-de-datos', function () {
    try {
        // Ejecuta las migraciones forzadas en producción
        Artisan::call('migrate', ['--force' => true]);
        return '¡Base de datos migrada con éxito! Las tablas se crearon correctamente.';
    } catch (\Exception $e) {
        return 'Error al migrar: ' . $e->getMessage();
    }
});




require __DIR__ . '/auth.php';
