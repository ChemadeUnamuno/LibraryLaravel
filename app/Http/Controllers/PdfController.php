<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PdfController extends Controller
{

    public function __invoke(Request $request): Response
    {
        $loans = PrestamoController::getUserLoans();
        $view = auth()->user()->role === 'admin' ? 'loans.admin-pdf' : 'loans.pdf';
        $pdf = Pdf::loadView($view, compact('loans'));
        return $pdf->stream('prestamos.pdf');
    }

}
