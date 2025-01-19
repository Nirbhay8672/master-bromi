<?php

namespace App\Imports;

use App\Models\District;
use App\Models\State;
use App\Models\SuperTaluka;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TalukaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $taluka = SuperTaluka::where('name',$row['name'])->first();

        $state_id = '';
        $district_id = '';

        if(! $taluka) {
            $state = State::where('name',$row['state_name'])->where('user_id', Auth::user()->id)->first();

            if($state) {
                $state_id = $state->id;
            } else {
                $new_state = new State();

                $new_state->fill([
                    'name' => $row['state_name'],
                    'user_id' => Auth::user()->id,
                    'gst_type' => strtolower($row['state_name']) == 'gujarat' ? 'intra_state' : 'inter_state',
                ])->save();

                $state_id = $new_state->id;
            }

            $district = District::where('name',$row['district_name'])->first();

            if($district) {
                $district_id = $district->id;
            } else {
                $new_district = new District();

                $new_district->fill([
                    'name' => $row['district_name'],
                    'state_id' => $state_id,
                    'user_id' => Auth::user()->id,
                ])->save();

                $district_id = $new_district->id;
            }

            return new SuperTaluka([
                'name' => $row['name'],
                'district_id' => $district_id,
            ]);
        }
    }
}
