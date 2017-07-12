<?php
use Illuminate\Database\Seeder;
use Pmis\Eloquent\District;
/**
 * Created by PhpStorm.
 * User: amrit
 * Date: 6/28/15
 * Time: 10:42 AM
 */
class VdcTableSeeder extends Seeder
{
    public function run()
    {
        $districts = District::all();
        $data = (array)json_decode(File::get(public_path('vdc.json')),true);
        $collection = collect($data);
        foreach($districts as $district)
        {
            if($collection->has($district->name)){
                $insertData = [];
                $districtModel = District::find($district->id);
                $vdcs = $collection->pull($district->name);
                foreach ($vdcs as $vdc) {
                    $insertData[] = ['name'=>$vdc['name'],'code'=>$vdc['code']];
                }
                $districtModel->vdc()->createMany($insertData);
            }
        }
    }
}