<?php

namespace App\Models;

use App\Models\Manager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function manager()
    {
        return $this->hasOne(Manager::class,'id','manager_id');
    }

    // получение полного имени менеджера заказа
    function scopeWithManager($query)
    {
        $query->addSelect(['fullname' => Manager::selectRaw('CONCAT(last_name,' . '" " ' . ', first_name)')
            ->whereColumn('manager_id', 'id')
        ]);
    }
}
