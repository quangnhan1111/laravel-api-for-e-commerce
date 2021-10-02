<?php

namespace App\Services;
use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use App\Models\Post;
use App\Repositories\Invoice\InvoiceRepositoryInterface;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class InvoiceService
{
    private InvoiceRepositoryInterface $invoiceRepositoryInterface;
    public function __construct(InvoiceRepositoryInterface $invoiceRepositoryInterface)
    {
        $this->invoiceRepositoryInterface = $invoiceRepositoryInterface;
    }


    public function getInvoicesByCustomer()
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee() ) {
            $invoices = $this->invoiceRepositoryInterface->getInvoicesByCustomer();
            return $invoices;
        }
        return 'Unauthorized';
    }

    public function getInvoicesByEmployee()
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee() ) {
            $invoices = $this->invoiceRepositoryInterface->getInvoicesByEmployee();
            return $invoices;
        }
        return 'Unauthorized';
    }

    public function getInvoicesForOneEmployeeStatus($id)
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee() ) {
            $invoices = $this->invoiceRepositoryInterface->getInvoicesForOneEmployeeStatus($id);
            return $invoices;
        }
        return 'Unauthorized';
    }

    public function getInvoicesForOneCustomerStatus($id)
    {
        $invoices = $this->invoiceRepositoryInterface->getInvoicesForOneCustomerStatus($id);
        return $invoices;
    }

    public function getInvoicesForEmployeeStatus()
    {
        $invoices = $this->invoiceRepositoryInterface->getInvoicesForEmployeeStatus();
        return $invoices;
    }

    public function getInvoicesForCustomerStatus()
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee() ) {
            $invoices = $this->invoiceRepositoryInterface->getInvoicesForCustomerStatus();
            return $invoices;
        }
        return 'Unauthorized';
    }

    public function showOneInvoices(int $id)
    {
        $invoice = $this->invoiceRepositoryInterface->showOneInvoices($id);
        return $invoice;
    }


    public function showOneInvoicesAndShowEmployee(int $id)
    {
        $invoice = $this->invoiceRepositoryInterface->showOneInvoicesAndShowEmployee($id);
        return $invoice;
    }

    public function showOneInvoicesAndShowCustomer(int $id)
    {
        $invoice = $this->invoiceRepositoryInterface->showOneInvoicesAndShowCustomer($id);
        return $invoice;
    }

    public function showInvoicesByIdEmployee(int $id)
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee()) {
            $invoice = $this->invoiceRepositoryInterface->showInvoicesByIdEmployee($id);
            return $invoice;
        }
        return 'Unauthorized';
    }

    public function showInvoicesByIdCustomer(int $id)
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee()) {
            $invoice = $this->invoiceRepositoryInterface->showInvoicesByIdCustomer($id);
            return $invoice;
        }
        return 'Unauthorized';
    }

    public function store($request)
    {
        $inputs = $request->all();
        $invoice = new Invoice();
        $result = $this->invoiceRepositoryInterface->store($invoice, $inputs);;
        return $result;
    }

    public function update($request, $id)
    {
        $user=Auth::user();
        $invoiceUpdate=Invoice::query()->findOrFail($id);
        if($user->isAdmin() ) {
            $result = $this->invoiceRepositoryInterface->update($invoiceUpdate, $request);
            return $result;
        } else if($user->isEmployee()) {
            if($invoiceUpdate->employee_id!=Auth::user()->getAuthIdentifier()) {
                return 'ko co quyen delete invoice nguoi khac';
            }
            $result = $this->invoiceRepositoryInterface->update($invoiceUpdate, $request);
            return $result;
        }
        return 'Unauthorized';
    }


    public function destroy(int $id)
    {
        $user=Auth::user();
        if($user->isAdmin()) {
            $invoiceDestroy = $this->invoiceRepositoryInterface->destroy($id);
            return $invoiceDestroy;
        }
        else if($user->isEmployee()) {
            $invoice= Invoice::query()->findOrFail($id);
            if($invoice->employee_id!=Auth::user()->getAuthIdentifier()) {
                return 'ko co quyen delete invoice nguoi khac';
            }
            $invoiceDestroy = $this->invoiceRepositoryInterface->destroy($id);
            return $invoiceDestroy;
        }
        return 'Unauthorized';
    }

}
