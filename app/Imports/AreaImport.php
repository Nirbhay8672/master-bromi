<?php

namespace App\Imports;

use App\Models\State;
use App\Models\SuperAreas;
use App\Models\SuperCity;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AreaImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $area = SuperAreas::where('name', $row['name'])->first();

        $state_id = '';
        $city_id = '';

        if (!$area) {
            $state = State::where('name', $row['state_name'])->where('user_id', Auth::user()->id)->first();

            if ($state) {
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

            $city = SuperCity::where('name', $row['city_name'])->first();

            if ($city) {
                $city_id = $city->id;
            } else {
                $new_city = new SuperCity();

                $new_city->fill([
                    'name' => $row['city_name'],
                    'state_id' => $state_id,
                ])->save();

                $city_id = $new_city->id;
            }

            return new SuperAreas([
                'name' => $row['name'],
                'super_city_id' => $city_id,
                'state_id' => $state_id,
                'pincode' => $row['pincode'],
            ]);
        }
    }
}
