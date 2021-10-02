<?php

namespace App\Http\Controllers;

use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    private InvoiceService $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }//end __construct()


    public function getInvoicesByCustomer()
    {
        $user=Auth::user();
        if($this->authorize('viewAny', $user)) {
            $products = $this->invoiceService->getInvoicesByCustomer();
            return $this->response("successfully", $products, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }

    public function getInvoicesByEmployee()
    {
        $user=Auth::user();
        if($this->authorize('viewAny', $user)) {
            $products = $this->invoiceService->getInvoicesByEmployee();
            return $this->response("successfully", $products, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }

    public function getInvoicesForOneEmployeeStatus($id)
    {
        $products = $this->invoiceService->getInvoicesForOneEmployeeStatus($id);
        return $this->response("successfully", $products, 200, true);
    }

    public function getInvoicesForOneCustomerStatus($id)
    {
        $products = $this->invoiceService->getInvoicesForOneCustomerStatus($id);
        return $this->response("successfully", $products, 200, true);
//        return $this->response("fail", null, 422, false);
    }

    public function getInvoicesForEmployeeStatus()
    {
        $user=Auth::user();
        if($this->authorize('viewAny', $user)) {
            $products = $this->invoiceService->getInvoicesForEmployeeStatus();
            return $this->response("successfully", $products, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }

    public function getInvoicesForCustomerStatus()
    {
        $user=Auth::user();
        if($this->authorize('viewAny', $user)) {
            $products = $this->invoiceService->getInvoicesForCustomerStatus();
            return $this->response("successfully", $products, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }

    public function showOneInvoices($id)
    {
        $invoice = $this->invoiceService->showOneInvoices($id);
        return $this->response("successfully", $invoice, 200, true);
    }

    public function showOneInvoicesAndShowEmployee($id)
    {
        $invoice = $this->invoiceService->showOneInvoicesAndShowEmployee($id);
        return $this->response("successfully", $invoice, 200, true);
    }

    public function showOneInvoicesAndShowCustomer($id)
    {
        $invoice = $this->invoiceService->showOneInvoicesAndShowCustomer($id);
        return $this->response("successfully", $invoice, 200, true);
    }

    public function showInvoicesByIdEmployee($id)
    {
        $user=Auth::user();
        if($this->authorize('view',$user)) {
            $invoice = $this->invoiceService->showInvoicesByIdEmployee($id);
            return $this->response("successfully", $invoice, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }

    public function showInvoicesByIdCustomer($id)
    {
        $user=Auth::user();
        if($this->authorize('view',$user)) {
            $invoice = $this->invoiceService->showInvoicesByIdCustomer($id);
            return $this->response("successfully", $invoice, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }

    public function store(Request $request)
    {
        $invoice = $this->invoiceService->store($request);
        return $this->response("successfully", $invoice, 200, true);
    }


    public function update(int $id, Request $request)
    {
        $user=Auth::user();
        if($this->authorize('update', $user)) {
            $invoice = $this->invoiceService->update($request, $id);
            return $this->response("successfully", $invoice, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function destroy($id)
    {
        $user=Auth::user();
        if($this->authorize('delete', $user)) {
            $invoice = $this->invoiceService->destroy($id);
            return $this->response("successfully", $invoice, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }
}
