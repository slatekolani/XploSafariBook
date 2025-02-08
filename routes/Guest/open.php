<?php

/*Get single code value for select*/
Route::get('getCodeValueForSelect', function() {
    $code_value_id = request()->input('cv_id');
    return view('includes.partials.child.code_values')
        ->with('code_values', code_value()->query()->where('id', $code_value_id)->get());
});
