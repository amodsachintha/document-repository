<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LendingsTableSeedr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $int1= rand(1262055681,1962055681);
        $int2= rand(1262055681,1962055681);

        DB::table('lendings')
            ->insert([
               'form_id'=>strtolower(str_random(5)),
               'form_name'=>strtolower(str_random(10)),
               'lend_date'=>date('Y-m-d',$int1),
               'lent_to'=>str_random(10),
               'return_date'=> $int2 % 2 ? date('Y-m-d',$int2) : null,
               'lent'=> $int2 % 2 ? false : true,
               'archived' => $int1 % 2 ? true : false,
               'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
               'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            ]);
    }
}
