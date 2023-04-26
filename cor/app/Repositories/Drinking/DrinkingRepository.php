<?php
namespace App\Repositories\Drinking;

use App\Repositories\BaseRepository;
use App\Models\Pub;

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

    public function createDrinking($params)
    {
        $dinkking = $this->model->create($params);

        foreach ($params['drinking'] as $value) {
            foreach ($params['amount'] as $amount) {
                if ($amount != null) {
                    $dinkking->drinkingPubs()->attach($value, ['amount' =>  $amount]);
                    $pubs = Pub::find($value);
                    $pubs->amount = intval($pubs->amount) - intval($amount);
                    $pubs->save();
                    continue;
                }
            }
        }
    }

    public function updateDrinking($params, $id)
    {
        $dinkking = $this->model->findOrFail($id)->update($params);

        $data = array();
        foreach ($params['drinking'] as $value) {
            foreach ($params['amount'] as $amount) {
                if ($amount != null) {
                    $data[] = array('pubs_id' => $value, 'amount' => $amount);
                    $pubs = Pub::find($value);
                    $pubs->amount = intval($pubs->amount) - intval($amount);
                    $pubs->save();
                    break;
                }
            }
        }
        $dinkking->drinkingPubs()->sync($data);
    }
}
