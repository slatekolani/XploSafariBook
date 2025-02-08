<?php

namespace App\Repositories\Admin\TouristicAttraction\touristicAttractionRules;

use App\Models\TouristicAttractions\touristicAttractionRules\touristicAttractionRules;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class touristicAttractionRulesRepository.
 */
class touristicAttractionRulesRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return touristicAttractionRules::class;
    }
    public function storeTouristicAttractionRule($input)
    {
        $touristicAttractionRule=new touristicAttractionRules();
        $touristicAttractionRule->rule_title=$input['rule_title'];
        $touristicAttractionRule->rule_description=$input['rule_description'];
        $touristicAttractionRule->nation_id=$input['nation_id'];
        $touristicAttractionRule->save();
    }
    public function updateTouristicAttractionRule($input,$touristicAttractionRuleUuid)
    {
        $touristicAttractionRule=touristicAttractionRules::query()->where('uuid',$touristicAttractionRuleUuid)->first();
        $touristicAttractionRule->rule_title=$input['rule_title'];
        $touristicAttractionRule->rule_description=$input['rule_description'];
        $touristicAttractionRule->nation_id=$input['nation_id'];
        $touristicAttractionRule->save();
    }
}
