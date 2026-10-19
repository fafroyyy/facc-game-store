<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AccountSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'seller_name',
        'seller_email',
        'whatsapp',
        'game_category',
        'price',
        'login_method',
        'description',
        'screenshot',   // kolom lama (tetap untuk kompatibilitas)
        'screenshots',  // kolom baru JSON untuk multi-screenshot
        'status',
        'payment_method',
        'payment_number',
        'admin_note',
        'bank_type',
        'bank_number',
    ];

    protected $casts = [
        'screenshots' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending'                => 'Menunggu Pemeriksaan Admin',
            'accepted'               => 'Ajuan Akun Diterima',
            'rejected'               => 'Ajuan Akun Ditolak',
            'payment_info_submitted' => 'Nomor Rekening Terkirim',
            'completed'              => 'Pencairan Dana Sukses',
            // status lama (backward compat)
            'secured'                => 'Akun Diamankan',
            'payment_requested'      => 'Menunggu Nomor Transfer',
            'transfer_info_submitted' => 'Nomor Transfer Dikirim',
            default                  => 'Status Tidak Diketahui',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'pending'                => 'yellow',
            'accepted'               => 'green',
            'rejected'               => 'red',
            'payment_info_submitted' => 'blue',
            'completed'              => 'green',
            default                  => 'gray',
        };
    }

    /**
     * Mendapatkan semua path screenshot (gabungan lama & baru)
     */
    public function getAllScreenshots(): array
    {
        $result = [];
        if (!empty($this->screenshots)) {
            $result = $this->screenshots;
        } elseif (!empty($this->screenshot)) {
            $result = [$this->screenshot];
        }
        return $result;
    }
}
