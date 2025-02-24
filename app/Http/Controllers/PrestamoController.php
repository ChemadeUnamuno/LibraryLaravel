<?php

namespace App\Http\Controllers;

use App\Models\EjemplarLibro;
use App\Models\Prestamo;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{

    public function index()
    {
        $loans = $this->getUserLoans(true);
        if (auth()->user()->role === 'admin') {
            return view('loans.admin-index', compact('loans'));
        } else {
            return view('loans.index', compact('loans'));
        }
    }

    public function create()
    {
        return view('loans.form');
    }

    public function edit($id)
    {
        $parts = $this->getLoanIds($id);
        list($id_socio, $id_ejemplar, $fecha_prestamo) = $parts;
        $loan = $this->findLoan($id_socio, $id_ejemplar, $fecha_prestamo);
        if (!$loan) {
            return redirect()->route('loans.index')->with('error', 'Préstamo no encontrado');
        }
        return view('loans.form', ['loan' => $loan, 'id' => $id]);
    }

    public function store(Request $request) : RedirectResponse
    {
        $this->validateLoan($request);
        $user = $this->findUser($request);
        if (!$user) {
            return redirect()->back()->with('error', 'No se encontró el usuario.');
        }
        $book = $this->findBook($request);
        if (!$book) {
            return redirect()->back()->with('error', 'No se encontró el libro.');
        }
        $loan = $this->findLoan($user->id,$book->id_ejemplar,$request->fecha_prestamo);
        if ($loan) {
            return redirect()->back()->with('error', "El préstamo ya existe");
        }
        $loan = Prestamo::create([
            'id_socio' => $user->id,
            'id_ejemplar' => $book->id_ejemplar,
            'fecha_prestamo' => $request->fecha_prestamo,
        ]);
        if (!$loan) {
            return redirect()->back()->with('error', 'Algo salió mal al registrar el préstamo.');

        }
        return redirect()->route('loans.index')->with('success', "El préstamo ha sido creado");
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validateLoan($request);
        $parts = $this->getLoanIds($id);
        list($id_socio, $id_ejemplar, $fecha_prestamo) = $parts;
        $loan = $this->findLoan($id_socio, $id_ejemplar, $fecha_prestamo);
        if (!$loan) {
            return redirect()->back()->with('error', "No se encontró el préstamo");
        }
        $user = $this->findUser($request);
        if (!$user) {
            return redirect()->back()->with('error', 'No se encontró el usuario.');
        }
        $book = $this->findBook($request);
        if (!$book) {
            return redirect()->back()->with('error', 'No se encontró el libro.');
        }
        $newLoan = $this->findLoan($user->id,$book->id_ejemplar,$request->fecha_prestamo);
        if ($newLoan) {
            return redirect()->back()->with('error', "El préstamo ya existe");
        }
        $loan = Prestamo::where('id_socio', $id_socio)
            ->where('id_ejemplar', $id_ejemplar)
            ->where('fecha_prestamo', $fecha_prestamo)
            ->update([
                'id_socio' => $user->id,
                'id_ejemplar' => $book->id_ejemplar,
                'fecha_prestamo' => $request->fecha_prestamo,
            ]);
        if (!$loan > 0) {
            return redirect()->back()->with('error', 'Algo salió mal al actualizar el préstamo.');
        }
        return redirect()->route('loans.index')->with('success', "El préstamo ha sido actualizado");
    }

    public function confirmDelete($id)
    {
        return view('loans.confirmDelete', ['id' => $id]);
    }

    public function destroy($id){
        $parts = $this->getLoanIds($id);
        list($id_socio, $id_ejemplar, $fecha_prestamo) = $parts;

//        $user = User::find($id_socio);
//
//        if (!$user) {
//            return redirect()->route('loans.index')->with('error', 'No se encontró el usuario.');
//        }
//        $user->books()->wherePivot('id_ejemplar', $id_ejemplar)->wherePivot('fecha_prestamo', $fecha_prestamo)->detach();

        $loan = Prestamo::where('id_socio', $id_socio)
            ->where('id_ejemplar', $id_ejemplar)
            ->where('fecha_prestamo', $fecha_prestamo)
            ->delete();
        if (!$loan > 0) {
            return redirect()->route('loans.index')->with('error', 'No se encontró ningún préstamo para eliminar');
        }
        return redirect()->route('loans.index')->with('success', 'El préstamo se ha eliminado exitosamente');
    }

    private function validateLoan(Request $request): void
    {
        $request->validate([
            'nombre' => 'required|string|max:255|exists:users,name',
            'apellidos' => 'required|string|max:255|exists:users,surname',
            'titulo' => 'required|string|max:255|exists:ejemplar_libros,titulo',
            'autor' => 'required|string|max:255|exists:ejemplar_libros,autor',
            'editorial' => 'required|string|max:255|exists:ejemplar_libros,editorial',
            'fecha_prestamo' => 'required|date_format:Y-m-d',
        ]);
    }

    private function getLoanIds(string $id): array|RedirectResponse
    {
        $parts = explode(';', $id);
        if (count($parts) !== 3) {
            return redirect()->route('loans.index')->with('error', 'ID del préstamo inválido');
        }
        return $parts;
    }

    private function findLoan(int $id_socio, int $id_ejemplar, string $fecha_prestamo): Prestamo|null
    {
        $loan = Prestamo::where('id_socio', $id_socio)
            ->where('id_ejemplar', $id_ejemplar)
            ->where('fecha_prestamo', $fecha_prestamo)
            ->first();
        if(!$loan) {
            return null;
        }
        return $loan;
    }

    private function findUser(Request $request): User|null
    {
        $user = User::where('name', $request->nombre)
            ->where('surname', $request->apellidos)
            ->first();
        if(!$user) {
            return null;
        }
        return $user;
    }

    private function findBook(Request $request): EjemplarLibro|null
    {
        $book = EjemplarLibro::where('titulo', $request->titulo)
            ->where('autor', $request->autor)
            ->where('editorial', $request->editorial)
            ->first();
        if (!$book) {
            return null;
        }
        return $book;
    }


    public static function getUserLoans(bool $paginate = false)
    {
        if (auth()->user()->role === 'admin') {
            return Prestamo::with('book')->get();
        }
        if ($paginate) {
            return auth()->user()->loans()->with('book')->latest()->paginate(3);
        }
        return auth()->user()->loans()->with('book')->latest()->get();
    }


}
