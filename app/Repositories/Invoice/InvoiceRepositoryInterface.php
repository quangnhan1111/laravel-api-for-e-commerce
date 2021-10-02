<?php

namespace App\Repositories\Invoice;
use App\Repositories\BaseRepositoryInterface;

interface InvoiceRepositoryInterface extends BaseRepositoryInterface
{
    public function getInvoicesByCustomer();

    public function getInvoicesByEmployee();

    public function showOneInvoicesAndShowCustomer($id);

    public function showOneInvoicesAndShowEmployee($id);

    public function showInvoicesByIdEmployee($id);

    public function showInvoicesByIdCustomer($id);

    public function getInvoicesForEmployeeStatus();

    public function getInvoicesForCustomerStatus();

    public function getInvoicesForOneEmployeeStatus($id);

    public function getInvoicesForOneCustomerStatus($id);

    public function showOneInvoices( $id);
}
