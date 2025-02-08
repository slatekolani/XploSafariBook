<?php

namespace App\Repositories\Transport;

use App\Models\Transport\transport;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class transportRepository.
 */
class transportRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return transport::class;
    }
    public function storeTransport(array $input)
    {
        $transport=new transport();
        $transport->transport_icon=$input['transport_icon'];
        $transport->transport_name=$input['transport_name'];
        $transport->save();
    }
    public function updateTransport(array $input, $transport)
    {
        $transport=transport::query()->where('uuid',$transport)->first();
        $transport->transport_icon=$input['transport_icon'];
        $transport->transport_name=$input['transport_name'];
        $transport->save();
    }
}
