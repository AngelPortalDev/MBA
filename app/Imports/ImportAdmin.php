<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;


class ImportAdmin implements WithHeadingRow,ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            // Check if the record already exists based on two columns (e.g., email and username)
            $existingRecord = User::where('email', $row['email'])->first();
            $userAgent = '';
            $ipAddress = '';
            $timestamp = Carbon::now('Europe/Malta')->format('Y-m-d H:i:s');
            if (!$existingRecord) {
                // Record does not exist, create a new one
             

                $Student = User::create([
                    'name'=> $row['first_name'],
                    'last_name'=> $row['last_name'],
                    'email'=> $row['email'],
                    'phone'=> $row['phone'],
                    'address'=> $row['address'],
                    'role'=>'admin',
                    'password'=> Hash::make($row['password']),
                    'mob_code'=>'+'.$row['mob_code'],
                    'user_agent'=>$userAgent,
                    'last_seen' => $timestamp,
                    'last_session_ip' => $ipAddress
                ]);
                

                // You can also perform additional actions or logging here for new records
            } else {

                $existingRecord->update([
                    'name'=> $row['first_name'],
                    'last_name'=> $row['last_name'],
                    'email'=> $row['email'],
                    'phone'=> $row['phone'],
                    'address'=> $row['address'],
                    'role'=>'admin',
                    'password'=> Hash::make($row['password']),
                    'mob_code'=>'+'.$row['mob_code'],
                    'user_agent'=>$userAgent,
                    'last_seen' => $timestamp,
                    'last_session_ip' => $ipAddress
                ]);
            }

        }
        return $row;
    }
}
