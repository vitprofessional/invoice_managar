<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Mail\InvoiceMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;

class InvoiceController extends Controller
{
    public function index() {
        $invoices = Invoice::with('customer')->latest()->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    public function create() {
        return view('invoices.create');
    }

    public function store(Request $request) {
        // Store invoice logic...
    }

    public function show(Invoice $invoice) {
        return view('invoices.show', compact('invoice'));
    }

    public function downloadPDF(Invoice $invoice) {
        $pdf = PDF::loadView('invoices.pdf', compact('invoice'));
        return $pdf->download("Invoice-{$invoice->invoice_number}.pdf");
    }

    public function sendEmail(Invoice $invoice) {
        Mail::to($invoice->customer->email)->send(new InvoiceMail($invoice));
        return back()->with('success', 'Invoice emailed successfully.');
    }
}
