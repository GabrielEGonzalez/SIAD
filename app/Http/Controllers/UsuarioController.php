<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; //Importa el modelo
use Illuminate\Support\Facades\Hash; // Para cifrar la contraseña
use Illuminate\Support\Facades\Auth; // Para autenticación (Auth facade)

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Usuario::All();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Cifrar la contraseña antes de guardar
        $data = $request->validate([
            'idCedula' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required|email|unique:usuario,correo', // El 'unique' apunta a la tabla 'usuario'
            'contraseña' => 'required',
        ]);
        $data['rol'] = 'admin';
        $textoplanoPass = $data['contraseña'];
        $data['contraseña'] = Hash::make($data['contraseña']);

        // credenciales de auth para autenticacion del usuario y los middleware
        $credenciales = ["correo" => $data['correo'], "password" => $textoplanoPass];
        Usuario::create($data);

        //autenticacion para el usuario y middleware

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();
            return redirect()->intended('panel');
        }

        //manejo de secciones para el usuario 
        $request->session()->put("nombre", $data['nombre']);
        $request->session()->put("rol_user", $data["rol"]);
        return redirect()->route('panel')->with('success', 'Usuario creado.');
    }

    public function register(Request $request)
    {
        // 1. Validar datos
        $data = $request->validate([
            'idCedula' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required|email|unique:usuario,correo',
            'contraseña' => 'required',
        ]);

        // 2. Rol por defecto
        $data['rol'] = 'user';

        // Guardar la contraseña en texto plano para Auth::attempt()
        $passwordPlano = $data['contraseña'];

        // 3. Cifrar la contraseña para guardar en BD
        $data['contraseña'] = Hash::make($data['contraseña']);

        // 4. Crear el usuario
        Usuario::create($data);

        // 5. Intentar autenticación
        if (
            Auth::attempt([
                'correo' => $data['correo'],
                'password' => $passwordPlano
            ])
        ) {
            $request->session()->regenerate();

            // 6. Guardar datos adicionales que necesitas en sesión
            $request->session()->put("nombre", $data['nombre']);
            $request->session()->put("rol_user", $data['rol']);

            return redirect()->route('panel')->with('success', 'Usuario creado.');
        }

        // Si por alguna razón falla el Auth
        // igual guardamos sesión básica
        $request->session()->put("nombre", $data['nombre']);
        $request->session()->put("rol_user", (string) $data['rol']);

        return redirect()->route('panel')->with('success', 'Usuario creado.');
    }

    public function login(Request $request)
    {
        // 1. Validación sencilla
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required'
        ]);

        // 2. Buscar usuario por correo
        $usuario = Usuario::where('correo', $request->correo)->first();

        // Si no existe el usuario
        if (!$usuario) {
            return back()->withErrors([
                'correo' => 'Correo no encontrado.'
            ])->onlyInput('correo');
        }

        // 3. Verificar contraseña manualmente
        if (!Hash::check($request->password, $usuario->contraseña)) {
            return back()->withErrors([
                'password' => 'Contraseña incorrecta.'
            ]);
        }

        // 4. Crear sesión manual
        $request->session()->put('idUsuario', $usuario->id);
        $request->session()->put('nombre', $usuario->nombre);
        $request->session()->put('rol_user', $usuario->rol);

        // 5. Redirigir al panel
        return redirect()->route('panel')
            ->with('success', 'Bienvenido, ' . $usuario->nombre);
    }
    /**
     * Logout the user
     */
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function login1(Request $request)
    {
        // 1. Validar la entrada
        $credentials = $request->validate([
            'correo' => 'required|email',
            'password' => 'required'
        ]);

        // 2. Intentar autenticar
        if (
            Auth::attempt([
                'correo' => $credentials['correo'],
                'password' => $credentials['password']
            ])
        ) {
            // Regenerar sesión
            $request->session()->regenerate();

            // Obtener datos adicionales del usuario
            $usuario = Auth::user();

            // 3. Guardar nombre y rol en sesión
            $request->session()->put("nombre", $usuario->nombre);
            $request->session()->put("rol_user", $usuario->rol);

            // 4. Redirigir al panel
            return redirect()->intended('panel');
        }

        // Si falla
        return back()->withErrors([
            'correo' => 'Credenciales incorrectas.',
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
