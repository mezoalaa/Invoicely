<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $table = 'invoices_details';

    protected $fillable = [
        'id_Invoice',
        'invoice_number',
        'product',
        'Section',
        'Status',
        'Value_Status',
        'Payment_Date',
        'note',
        'user',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'id_Invoice');
    }
}
