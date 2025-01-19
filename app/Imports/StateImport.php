<?php

namespace App\Imports;

use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StateImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $states = State::where('name',$row['name'])->where('user_id', Auth::user()->id)->first();

        if(!$states) {
            return new State([
                'name' => $row['name'],
                'user_id' => Auth::user()->id,
                'gst_type' => strtolower($row['name']) == 'gujarat' ? 'intra_state' : 'inter_state',
            ]);
        }
    }
}
