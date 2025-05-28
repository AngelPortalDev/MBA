<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportAdmin implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select("users.id",DB::raw("CONCAT(users.name,' ',users.last_name) as name"),"users.email",DB::raw("CONCAT(users.mob_code,' ',users.phone) as phone"),'address','users.created_at', DB::raw("CASE WHEN status = 1 THEN 'Active' ELSE 'Inactive' END AS status"))->where('role','admin')->get(); 
    }

    public function headings(): array
    {
        return ["ID", "Name","Email","Phone","Address","Joined","Status"];
    }
}
