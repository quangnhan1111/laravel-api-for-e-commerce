<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceDetail extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'number', 'invoice_id','product_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'invoice_detail';

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
