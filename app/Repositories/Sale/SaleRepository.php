<?php
namespace App\Repositories\Sale;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\User;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class SaleRepository extends BaseRepository implements SaleRepositoryInterface
{
    protected $model;

    public function __construct(InvoiceDetail $model)
    {
        parent::__construct($model);
    }

    public function getTotalProductSoldOut()
    {
        $total = InvoiceDetail::query()->sum('number');
        return $total;
    }

    public function getTotalUser()
    {
        $customers = User::whereHas('roles', function($role) {
            $role->where('name', '=', 'customer');
        })->orderBy('id', 'desc')->get();

        $employees = User::whereHas('roles', function($role) {
            $role->where('name', '=', 'employee');
        })->orderBy('id', 'desc')->get();

        return [count($customers), count($employees)];
    }

    public function getSaleFigureByDay()
    {
        $total = DB::table("invoices")
            ->select(DB::raw("SUM(totalPrice) as SUM, updated_at as Day"))
            ->groupBy(DB::raw("day(updated_at)"))
//            ->groupBy('day(updated_at)')
            ->get();
        return $total;
    }

    public function getSaleFigureByMonth()
    {
        $total = DB::table("invoices")
            ->select(DB::raw("SUM(totalPrice) as SUM, month(updated_at) as Month"))
            ->groupBy(DB::raw("month(updated_at)"))
//            ->groupBy('day(updated_at)')
            ->get();
        return $total;
    }

    public function getSaleFigureByEmployee()
    {
        $total = DB::table('invoices')
            ->join('users','users.id', 'invoices.employee_id')
            ->selectRaw('users.full_name as FullNameEmployee, users.id as IdEmplyee,
            sum(invoices.totalPrice) as TotalMoney, month(invoices.updated_at) as Month')
//            ->whereRaw('invoices.employee_id !=' . 4)
            ->whereRaw('month(invoices.updated_at) =' . Carbon::now()->month)
            ->groupByRaw('month(invoices.updated_at), users.id')
            ->paginate(10);
        return $total;
    }
}
