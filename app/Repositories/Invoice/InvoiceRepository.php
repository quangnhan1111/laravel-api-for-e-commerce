<?php
namespace App\Repositories\Invoice;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Invoice\InvoiceRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class InvoiceRepository extends BaseRepository implements InvoiceRepositoryInterface
{

    protected $model;

    public function __construct(Invoice $model)
    {
        parent::__construct($model);
    }

    public function getInvoicesByEmployee()
    {
        $invoices = DB::table('invoices')
            ->join('users','users.id', 'invoices.employee_id')
            ->join('invoice_detail','invoices.id', 'invoice_detail.invoice_id')
            ->join('products','invoice_detail.product_id', 'products.id')
            ->join('images','products.image_id', 'images.id')
            ->join('colors','products.color_id', 'colors.id')
            ->join('genders','products.gender_id', 'genders.id')
            ->selectRaw('invoices.id,invoices.is_paid,invoice_detail.number as numberSoldOut,products.name,
            products.name_size,products.price, products.number AS TotalNumberWareProduct,colors.name AS NameColors,
            genders.name AS NameGender, images.link, users.full_name as FullNameEMployee, invoices.totalPrice as TotalForPay')
            ->whereRaw('invoices.deleted_at IS NULL')
            ->orderBy('invoices.id', 'ASC')
            ->paginate(10);
        return $invoices;
    }

    public function getInvoicesByCustomer()
    {
        $invoices = DB::table('invoices')
            ->join('users','users.id', 'invoices.customer_id')
            ->join('invoice_detail','invoices.id', 'invoice_detail.invoice_id')
            ->join('products','invoice_detail.product_id', 'products.id')
            ->join('images','products.image_id', 'images.id')
            ->join('colors','products.color_id', 'colors.id')
            ->join('genders','products.gender_id', 'genders.id')
            ->selectRaw('invoices.id,invoices.is_paid,invoice_detail.number as numberSoldOut,products.name,
            products.name_size,products.price, products.number AS TotalNumberWareProduct,colors.name AS NameColors,
            genders.name AS NameGender, images.link, users.full_name as FullNameCustomer, invoices.totalPrice as TotalForPay')
            ->whereRaw('invoices.deleted_at IS NULL')
            ->orderBy('invoices.id', 'ASC')
            ->paginate(10);
        return $invoices;
    }

    public function showOneInvoices( $id)
    {
        $invoices = DB::table('invoices')
            ->join('users','users.id', 'invoices.customer_id')
            ->selectRaw('invoices.id,invoices.is_paid,
            invoices.full_name, invoices.address, invoices.phone_number, invoices.email, invoices.message,
            users.full_name as FullNameCustomer, invoices.totalPrice as TotalForPay')
            ->where('invoices.id','=',$id)
            ->orderBy('invoices.id', 'ASC')
            ->paginate(10);
        return $invoices;
    }


    public function showOneInvoicesAndShowCustomer( $id)
    {
        $invoices = DB::table('invoices')
            ->join('users','users.id', 'invoices.customer_id')
            ->join('invoice_detail','invoices.id', 'invoice_detail.invoice_id')
            ->join('products','invoice_detail.product_id', 'products.id')
            ->join('images','products.image_id', 'images.id')
            ->join('colors','products.color_id', 'colors.id')
            ->join('genders','products.gender_id', 'genders.id')
            ->selectRaw('invoices.id,invoices.is_paid,invoice_detail.number as numberSoldOut,products.name,
            products.name_size,products.price, products.number AS TotalNumberWareProduct,colors.name AS NameColors,
            genders.name AS NameGender, images.link, users.full_name as FullNameCustomer, invoices.totalPrice as TotalForPay')
            ->where('invoices.id','=',$id)
            ->orderBy('invoices.id', 'ASC')
            ->paginate(10);
        return $invoices;
    }

    public function showOneInvoicesAndShowEmployee( $id)
    {
        $invoices = DB::table('invoices')
            ->join('users','users.id', 'invoices.employee_id')
            ->join('invoice_detail','invoices.id', 'invoice_detail.invoice_id')
            ->join('products','invoice_detail.product_id', 'products.id')
            ->join('images','products.image_id', 'images.id')
            ->join('colors','products.color_id', 'colors.id')
            ->join('genders','products.gender_id', 'genders.id')
            ->selectRaw('invoices.id,invoices.is_paid,invoice_detail.number as numberSoldOut,products.name,
            products.name_size,products.price, products.number AS TotalNumberWareProduct,colors.name AS NameColors,
            genders.name AS NameGender, images.link, users.full_name as FullNameEmployee, invoices.totalPrice as TotalForPay')
            ->where('invoices.id','=',$id)
            ->orderBy('invoices.id', 'ASC')
            ->paginate(10);
        return $invoices;
    }

    public function showInvoicesByIdEmployee($id)
    {
        $invoices = DB::table('invoices')
            ->join('users','users.id', 'invoices.employee_id')
            ->join('invoice_detail','invoices.id', 'invoice_detail.invoice_id')
            ->join('products','invoice_detail.product_id', 'products.id')
            ->join('images','products.image_id', 'images.id')
            ->join('colors','products.color_id', 'colors.id')
            ->join('genders','products.gender_id', 'genders.id')
            ->selectRaw('invoices.id,invoices.is_paid,invoice_detail.number as numberSoldOut,products.name,
            products.name_size,products.price, products.number AS TotalNumberWareProduct,colors.name AS NameColors,
            genders.name AS NameGender, images.link, users.full_name as FullNameEmployee, invoices.totalPrice as TotalForPay')
            ->where('invoices.employee_id','=',$id)
            ->orderBy('invoices.id', 'ASC')
            ->paginate(10);
        return $invoices;
    }

    public function showInvoicesByIdCustomer($id)
    {
        $invoices = DB::table('invoices')
            ->join('users','users.id', 'invoices.customer_id')
            ->join('invoice_detail','invoices.id', 'invoice_detail.invoice_id')
            ->join('products','invoice_detail.product_id', 'products.id')
            ->join('images','products.image_id', 'images.id')
            ->join('colors','products.color_id', 'colors.id')
            ->join('genders','products.gender_id', 'genders.id')
            ->selectRaw('invoices.id,invoices.is_paid,invoice_detail.number as numberSoldOut,products.name,
            products.name_size,products.price, products.number AS TotalNumberWareProduct,colors.name AS NameColors,
            genders.name AS NameGender, images.link, users.full_name as FullNameCustomer, invoices.totalPrice as TotalForPay')
            ->where('invoices.customer_id','=',$id)
            ->orderBy('invoices.id', 'ASC')
            ->paginate(10);
        return $invoices;
    }

    public function getInvoicesForEmployeeStatus()
    {
        $invoices = DB::table('invoices')
            ->join('users as employee','employee.id', 'invoices.employee_id')
            ->join('users as customer','customer.id', 'invoices.customer_id')
            ->selectRaw('invoices.id,invoices.is_paid, employee.id as IdEmployee,
            invoices.full_name, invoices.address, invoices.phone_number, invoices.email, invoices.message, customer.full_name as FullNameCustomer,
            employee.full_name as FullNameEmployee, invoices.totalPrice as TotalForPay')
            ->whereRaw('invoices.deleted_at IS NULL')
            ->orderBy('invoices.id', 'ASC')
            ->paginate(10);
        return $invoices;
    }

    public function getInvoicesForCustomerStatus()
    {
        $invoices = DB::table('invoices')
            ->join('users as employee','employee.id', 'invoices.employee_id')
            ->join('users as customer','customer.id', 'invoices.customer_id')
            ->selectRaw('invoices.id,invoices.is_paid, customer.id as IdCustomer,
            invoices.full_name, invoices.address, invoices.phone_number, invoices.email, invoices.message, customer.full_name as FullNameCustomer,
            employee.full_name as FullNameEmployee, invoices.totalPrice as TotalForPay')
            ->whereRaw('invoices.deleted_at IS NULL')
            ->orderBy('invoices.id', 'ASC')
            ->paginate(10);
        return $invoices;
    }

    public function getInvoicesForOneEmployeeStatus($id)
    {
        $invoices = DB::table('invoices')
            ->join('users as employee','employee.id', 'invoices.employee_id')
            ->join('users as customer','customer.id', 'invoices.customer_id')
            ->selectRaw('invoices.id,invoices.is_paid, employee.id as IdEmployee,
            invoices.full_name, invoices.address, invoices.phone_number, invoices.email, invoices.message, customer.full_name as FullNameCustomer,
            employee.full_name as FullNameEmployee, invoices.totalPrice as TotalForPay')
            ->where('employee.id', '=', $id)
            ->whereRaw('invoices.deleted_at IS NULL')
            ->orderBy('invoices.id', 'ASC')
            ->paginate(10);
        return $invoices;
    }

    public function getInvoicesForOneCustomerStatus($id)
    {
        $invoices = DB::table('invoices')
            ->join('users as employee','employee.id', 'invoices.employee_id')
            ->join('users as customer','customer.id', 'invoices.customer_id')
            ->selectRaw('invoices.id,invoices.is_paid, customer.id as IdCustomer,
            invoices.full_name, invoices.address, invoices.phone_number, invoices.email, invoices.message, customer.full_name as FullNameCustomer,
            employee.full_name as FullNameEmployee, invoices.totalPrice as TotalForPay')
            ->where('customer.id', '=', $id)
            ->whereRaw('invoices.deleted_at IS NULL')
            ->orderBy('invoices.id', 'ASC')
            ->paginate(10);
        return $invoices;
    }

    public function store($objUpdate, $inputs)
    {
        $objUpdate->message = $inputs['message'];
        $objUpdate->email = $inputs['email'];
        $objUpdate->address = $inputs['address'];
        $objUpdate->phone_number = $inputs['phone_number'];
        $objUpdate->full_name = $inputs['full_name'];
        $objUpdate->customer_id = $inputs['customer_id'];
        $objUpdate->employee_id = $inputs['employee_id'];
        $objUpdate->is_paid = $inputs['is_paid'];
        $objUpdate->save();
        $err = "";
        $allId = array();
        $totalPrice = 0;
        for ($i=0; $i<count($inputs['listProduct']); $i++) {
            if(!in_array($inputs['listProduct'][$i]['id'], $allId)) {
//                them vao details
                $details = new InvoiceDetail();
                $details->invoice_id = $objUpdate->id;
                $details->product_id = $inputs['listProduct'][$i]['id'];
                $details->number = $inputs['listProduct'][$i]['number'];
                $details->save();
                array_push($allId, $inputs['listProduct'][$i]['id']);
//              cap nnhat lai number cua san pham trong kho
                $product = Product::query()->find($inputs['listProduct'][$i]['id']);
                $product->number = $product->number - $inputs['listProduct'][$i]['number'];
                if($product->number<0) {
                    $err = "totalNumber In Warehouse is out of stock";
                    $details->delete();
                    $objUpdate->delete();
                    return $err;
                }
                $product->save();

                $totalPrice += $inputs['listProduct'][$i]['number'] * $product->price;
            }
            else {
//                tang san pham da co trong detail
                $details = InvoiceDetail::query()
                    ->where('invoice_id','=', $objUpdate->id)
                    ->where('product_id','=',$inputs['listProduct'][$i]['id'])->get()->first();
                    $details->number = $inputs['listProduct'][$i]['number'] + $details->number;
                    $details->save();
//              cap nnhat lai number cua san pham trong kho
                    $product = Product::query()->find($inputs['listProduct'][$i]['id']);
                    $product->number = $product->number - $inputs['listProduct'][$i]['number'];
                    if($product->number<0) {
                        $err = "totalNumber In Warehouse is out of stock";
                        $details->delete();
                        $objUpdate->delete();
                        return $err;
                    }
                    $product->save();
                    $totalPrice += $inputs['listProduct'][$i]['number'] * $product->price;
            }
        }
        $objUpdate->totalPrice = $totalPrice;
        $objUpdate->save();
        return $objUpdate;
    }

    public function update($objUpdate, $inputs)
    {
        $objUpdate->is_paid = $inputs['is_paid'];
        $objUpdate->save();
        return $objUpdate;
    }

}
