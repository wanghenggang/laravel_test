<?php

namespace App\Services;

use App\Models\Data;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DataService
{

    public static function insertUser(): bool
    {
        DB::table('shop_users')->chunkById(5000, function ($users) {
            $insert = [];
            $ids = [];
            $users->map(function ($doc) use (&$insert, &$ids) {
                $name = $doc->name ? json_decode($doc->name, true) : [];
                $temp = [
                    'site_id'       => $doc->business_shop_id,
                    'is_vip'        => $doc->is_vip,
                    'user_id'       => $doc->customer_id,
                    'first_name'    => Arr::get($name, 'firstname', ''),
                    'last_name'     => Arr::get($name, 'lastname', ''),
                    'email'         => $doc->email,
                    'city'          => '',
                    'province'      => '',
                    'province_code' => '',
                    'country'       => '',
                    'country_code'  => '',
                    'post_code'     => '',
                ];
                if (Str::contains($doc->email, 'qq.com')) {
                    $temp['deleted_at'] = Carbon::now()->format('Y-m-d H:i:s');
                } else {
                    $temp['deleted_at'] = null;
                }
                $insert[] = $temp;
                $ids[] = $doc->id;
            });
            DB::table('datas')->insert($insert);
            $max_id = max($ids);
            echo "{$max_id} exec success" . PHP_EOL;
        });

        return true;
    }

    public static function updateUser()
    {
        Data::query()->orderBy('id')->chunkMap(function ($data) {
            if (empty($data->updated_at)) {
                $address = DB::table('z_sales_flat_order_address')->where('email', $data->email)->first();
                if ($address) {
                    $data->update([
                        'city'         => $address->city ?: '',
                        'province'     => $address->region ?: '',
                        'country'      => $address->country_id ?: '',
                        'country_code' => $address->country_id ?: '',
                        'post_code'    => $address->postcode ?: '',
                        'street'       => $address->street ?: '',
                    ]);
                    $result = 'success';
                    // echo $data->id . '-' . $result . '-' . Carbon::now()->format('Y-m-d H:i:s') . PHP_EOL;

                } else {
                    $result = 'fail';
                }
                echo $data->id . '-' . $result . '-' . Carbon::now()->format('Y-m-d H:i:s') . PHP_EOL;
            }

        }, 500000);

        return true;
    }
}