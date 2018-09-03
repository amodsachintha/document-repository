<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DocumentsTableSeeder extends Seeder
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

        DB::table('documents')->insert([
            'form_id'=>str_random(10),
            'form_name'=>str_random(10),
            'form_start_date'=> date('Y-m-d',$int1),
            'form_accepted_date'=> date('Y-m-d',$int2),
            'form_section'=>str_random(5),
            'mf_no'=> 'MF-'.str_random(3),
            'form_sender_name'=>str_random(10),
            'form_receiver_name' => str_random(10),
            'form_recommender_name' => str_random(10),
            'destroyed_on' => date('Y-m-d'),
            'destroyed' => $int1 % 2 ? true : false,
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
