<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth']);
    // }

    //lo comente porque el middleware esta en el archivo web.php
    //se pueden agrupar directamente desde las rutas

    public function index()
    {
        $user = User::find(auth()->user()->id);
        return view('profile.index', compact('user'));
    }

    //cambie la logica de store a update porque tiene mas sentido
    //ya que el objetivo es actualizar el nombre de usuario o la imagen
    //con este enfoque, el usuario puede cambiar su nombre de usuario
    //y su imagen de perfil en cualquier momento y borrar la que ya tenia
    public function update(Request $request)
    {
        $request->validate([
            'username' => [
                'required',
                'min:3',
                'max:20',
                'unique:users,username,' . auth()->user()->id,
                'not_in:admin,twitter,facebook,instagram,github,linkedin,gitlab,profile',
            ],
            'image' => ['image', 'max:2048', 'mimes:jpg,jpeg,png,gif', 'dimensions:min_width=240,min_height=240'],
        ]);

        $user = User::find(auth()->user()->id);

        // Verificar si el nombre de usuario ha cambiado
        if ($user->username !== $request->username) {
            $user->username = $request->username;
        }

        // Procesar la imagen si se ha cargado una nueva
        if ($request->hasFile('image')) {
            $image = $request->file('imagwe');
            $imageName = Str::uuid() . "." . $image->extension();

            $serverImage = Image::make($image);
            $serverImage->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $imagePath = 'profiles/' . $imageName;
            Storage::disk('public')->put($imagePath, (string) $serverImage->encode());

            // Borrar la imagen anterior si existe
            if ($user->image) {
                Storage::disk('public')->delete('profiles/' . $user->image);
            }

            $user->image = $imageName;
        }

        // Guardar los cambios si el usuario ha cambiado algo
        if ($user->isDirty()) {
            $user->save();
            return redirect()->route('post.index', $user->username)->with('success', 'Perfil actualizado con éxito');
        }
    }

    //aqui el codigo como lo tenias antes
    //por si deseas volver a usarlo
    
    // public function store(Request $request)
    // {
    //     $request->request->add(['username' => Str::slug($request->username)]);
    //     $this->validate($request, [
    //         'username' => ['required', 'min:3', 'max:20', 'unique:users,username,' . auth()->user()->id, 'not_in:admin,twitter,facebook,instagram,github,linkedin,gitlab,profile,'],
    //     ]);

    //     if ($request->image) {
    //         $input = $request->all();
    //         $image = $request->file('image');
    //         $imageName = Str::uuid() . "." . $image->extension();
    //         $serverImage =  Image::make($image);
    //         $serverImage->fit(1000, 1000);
    //         $imagePath = public_path('profiles') . '/' . $imageName;
    //         $serverImage->save($imagePath);
    //     }

    //     $user = User::find(auth()->user()->id);
    //     $user->username = $request->username;
    //     $user->image = $imageName ?? auth()->user()->image ?? null;
    //     $user->save();

    //     //Return user to profile
    //     return redirect()->route('post.index', $user->username);
    // }
}
