<?php

namespace App\Repositories\customerSatisfactionCategory;

use App\Models\customerSatisfactionCategory\customerSatisfactionCategory;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class customerSatisfactionCategoryRepository.
 */
class customerSatisfactionCategoryRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return customerSatisfactionCategory::class;
    }
    public function storeCustomerSatisfactionCategory($input)
    {
        $customerSatisfactionCategory=new customerSatisfactionCategory();
        $customerSatisfactionCategory->customer_satisfaction_name=$input['customer_satisfaction_name'];
        $customerSatisfactionCategory->customer_satisfaction_description=$input['customer_satisfaction_description'];
        $customerSatisfactionCategory->save();
    }
    public function updateCustomerSatisfactionCategory($input,$satisfactionCategoryUuid)
    {
        $customerSatisfactionCategory=customerSatisfactionCategory::query()->where('uuid',$satisfactionCategoryUuid)->first();
        $customerSatisfactionCategory->customer_satisfaction_name=$input['customer_satisfaction_name'];
        $customerSatisfactionCategory->customer_satisfaction_description=$input['customer_satisfaction_description'];
        $customerSatisfactionCategory->save();
    }
}
