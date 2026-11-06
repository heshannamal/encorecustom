<?php

namespace domain\Services\SalesChannelService;

use App\Models\SalesChannel;
use Carbon\Carbon;

class SalesChannelService
{
    protected $sales_channel;

    public function __construct()
    {
        $this->sales_channel = new SalesChannel();
    }

    public function getAllChannels()
    {
        return $this->sales_channel->all();
    }

    public function getAllActiveChannels()
    {
        return $this->sales_channel->where('is_active', 1)->get();
    }

    public function getChannelById($id)
    {
        return $this->sales_channel->find($id);
    }

    public function getChannelsByIds($ids)
    {
        return $this->sales_channel->whereIn('id', $ids)->get();
    }

    public function storeSalesChannel($data)
    {
        $this->sales_channel->create($data);
    }

    public function updateSalesChannel($data, $id)
    {
        $channel = $this->getChannelById($id);
        $channel->update($data);
        return $channel;
    }

    public function destroySalesChannel($id)
    {
        $channel = $this->getChannelById($id);
        $channel->delete();
    }
}

