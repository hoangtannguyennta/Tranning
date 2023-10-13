<?php
namespace App\Repositories\Drinking;

use App\Repositories\BaseRepository;
use App\Models\Pub;
use Illuminate\Support\Facades\DB;

class DrinkingRepository extends BaseRepository implements DrinkingRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\drinking::class;
    }

    public function getProduct()
    {
        return $this->model->get(['id', 'name']);
    }

    public function createDrinking($attributes)
    {
        DB::beginTransaction();
        try {
            $files = array();
            if ($attributes->hasFile('images')) {
                foreach ($attributes->images as $value) {
                    $imgName = time().rand(1, 100) . '.' . $value->extension();
                    $value->move(public_path('images/drinking'), $imgName);
                    array_push($files, $imgName);
                }
            }
            $attributes = $attributes->all();

            $getTotal = array_map(function ($id, $amount) {
                return (int) Pub::find($id)->price * (int) $amount;
            }, array_keys($attributes['amount']), $attributes['amount']);

            $attributes['images'] = $files;
            $attributes['total'] = array_sum($getTotal);
            $drinking = $this->model->create($attributes);

            $drinkingPubs = array_map(function ($key, $value) {
                return [
                    'pubs_id' => $key,
                    'amount' => $value,
                ];
            }, array_keys($attributes['amount']), $attributes['amount']);
            $drinking->drinkingPubs()->attach($drinkingPubs);
            foreach (array_filter($drinkingPubs) as $value) {
                $pub = Pub::find($value['pubs_id']);
                $amount = intval($pub->amount) - intval($value['amount']);
                if ($amount >= 0) {
                    $pub->amount = $amount;
                    $pub->save();
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            logger($e);
            DB::rollBack();
            return false;
        }
    }

    public function updateDrinking($attributes, $id)
    {
        DB::beginTransaction();
        try {
            $files = array();
            if ($attributes->hasFile('images')) {
                foreach ($attributes->images as $value) {
                    $imgName = time().rand(1, 100) . '.' . $value->extension();
                    $value->move(public_path('images/drinking'), $imgName);
                    array_push($files, $imgName);
                }
            }

            if (!empty($attributes->images_uploaded)) {
                $files = array_merge($attributes->images_uploaded, $files);
                $filesRemove = array_diff(json_decode($attributes->images_uploaded_origin), $attributes->images_uploaded);
            } else {
                $filesRemove = json_decode($attributes->images_uploaded_origin);
            }

            if (!empty($filesRemove)) {
                $filesRemoveMap = array_map(function ($value) {
                    return file_exists(public_path('images/drinking').'/'.$value);
                }, $filesRemove);
            }

            $drinking = $this->model->findOrFail($id);
            $attributes = $attributes->all();

            if (!empty($attributes['amount'])) {
                $getTotal = array_map(function ($id, $amount) {
                    return (int) Pub::find($id)->price * (int) $amount;
                }, array_keys($attributes['amount']), $attributes['amount']);
                $total = array_sum($getTotal);
            } else {
                $total = null;
            }

            $attributes['images'] = $files;
            $attributes['total'] = $total;
            $drinkingCheck = $drinking->update($attributes);
            if ($drinkingCheck && !empty($filesRemove) && in_array(true, $filesRemoveMap)) {
                foreach ($filesRemove as $image) {
                    unlink(public_path('images/drinking').'/'.$image);
                }
            }

            if (!empty($attributes['amount'])) {
                $drinkingPubs = array_map(function ($key, $value) {
                    return [
                        'pubs_id' => $key,
                        'amount' => $value,
                    ];
                }, array_keys($attributes['amount']), $attributes['amount']);
                $drinking->drinkingPubs()->sync(array_combine(range(1, count($drinkingPubs)), array_values($drinkingPubs)));

                foreach ($drinkingPubs as $value) {
                    $pub = Pub::find($value['pubs_id']);
                    $amount = intval($pub->amount) - intval($value['amount']);
                    if ($amount >= 0) {
                        $pub->amount = $amount;
                        $pub->save();
                    }
                }
            } else {
                $drinking->drinkingPubs()->detach();
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            logger($e);
            DB::rollBack();
            return false;
        }
    }

    public function deleteDrinking($id)
    {
        $attribute = $this->model->findOrFail($id);
        if (!empty($attribute->images)) {
            foreach (json_decode($attribute->images) as $value) {
                unlink(public_path('images/drinking').'/'.$value);
            }
        }
        return $attribute->delete();
    }
}
