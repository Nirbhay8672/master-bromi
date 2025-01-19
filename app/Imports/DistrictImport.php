<?php

namespace App\Imports;

use App\Models\District;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DistrictImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $state = State::where('name',$row['name'])->first();

        $state_id = '';

        if(! $state) {
            $state = State::where('name',$row['state_name'])->where('user_id', Auth::user()->id)->first();

            if($state) {
                $state_id = $state->id;
            } else {
                $new = new State();

                $new->fill([
                    'name' => $row['state_name'],
                    'user_id' => Auth::user()->id,
                    'gst_type' => strtolower($row['state_name']) == 'gujarat' ? 'intra_state' : 'inter_state',
                ])->save();

                $state_id = $new->id;
            }

            return new District([
                'name' => $row['name'],
                'state_id' => $state_id,
                'user_id' => Auth::user()->id,
            ]);
        }
    }
}
