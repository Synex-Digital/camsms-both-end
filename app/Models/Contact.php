<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function send_history()
    {
        return $this->belongsTo(SendHistory::class);
    }
    public function mail_history()
    {
        return $this->belongsTo(MailHistory::class);
    }
    public function invoice_store()
    {
        return $this->belongsTo(Invoice::class);
    }
}
