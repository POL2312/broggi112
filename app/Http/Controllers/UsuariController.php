<?php

namespace App\Http\Controllers;

use App\Models\Usuari;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UsuariController extends Controller
{

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = Usuari::where('username', $username)->first();

        if ($user) {
            if ($password === $user->contrasenya) {
                // L'usuari i la contrasenya són correctes, inicia sessió i redirigeix a la pàgina d'inici
                Auth::login($user);
                return redirect('/inici');
            }
        }

        // L'usuari i/o la contrasenya són incorrectes, mostra un missatge d'error
        return redirect('/')->with('error', 'Usuari i/o contrasenya incorrectes');
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recuperar todos los registros de usuarios con paginación de 7 usuarios por página
        $usuaris = Usuari::paginate(5);

        // Pasar los registros de usuarios paginados a la vista
        return view('gestioUsuaris', ['usuaris' => $usuaris]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        // Recuperar los registros de usuarios que coinciden con la búsqueda
        $usuaris = Usuari::where('nom', 'like', "%$search%")
            ->orWhere('cognoms', 'like', "%$search%")
            ->paginate(7);

        // Pasar los registros de usuarios encontrados a la vista
        return view('gestioUsuaris', ['usuaris' => $usuaris]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validamos los campos del formulario
        $request->validate([
            'nom' => 'required',
            'cognoms' => 'required',
            'username' => 'required|unique:usuaris,username',
            'contrasenya' => 'required'
        ], [
            'required' => 'El camp :attribute es obligatori.',
            'unique' => 'El :attribute ja existeix'
        ]);

        // Creamos un nuevo usuario con los datos del formulario
        $usuari = new Usuari;
        $usuari->nom = $request->nom;
        $usuari->cognoms = $request->cognoms;
        $usuari->username = $request->username;
        $usuari->contrasenya = $request->contrasenya; // Hasheamos la contraseña antes de guardarla
        $usuari->tipus_usuaris_id = $request->tipus_usuaris_id;
        $usuari->save();

        // Redirigimos al usuario a la página de la lista de usuarios con mensaje de éxito
        return redirect()->route('gestioUsuaris')->with('success', 'Usuari creat correctament!');

        // Redirigimos al usuario al formulario de creación con mensaje de error
        return redirect()->route('gestioUsuaris')->withErrors(['error' => 'Datos incorrectos, revisar datos introducidos']);
    }


    /**
     * Display the specified resource.
     */
    public function show(Usuari $usuari)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuari = Usuari::find($id);
        return view('modificarUsuari', ['usuari' => $usuari]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuari = Usuari::find($id);
        $usuari->nom = $request->input('nom');
        $usuari->cognoms = $request->input('cognoms');
        $usuari->username = $request->input('username');
        $usuari->tipus_usuaris_id = $request->input('tipus_usuaris_id');

        if ($request->filled('contrasenya')) {
            $usuari->contrasenya = $request->input('contrasenya');
        }

        $usuari->save();

        return redirect()->route('gestioUsuaris')->with('success', 'Usuari modificat correctament');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuari = Usuari::find($id);
        $usuari->delete();
        return redirect()->route('gestioUsuaris')->with('success', 'Usuari eliminat correctament.');
    }
}
