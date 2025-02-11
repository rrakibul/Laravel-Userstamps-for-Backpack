<?php

namespace Wildside\Userstamps\Listeners;

use Illuminate\Support\Facades\Auth;

class Creating
{
    /**
     * When the model is being created.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function handle($model)
    {
        if (! $model->isUserstamping() || is_null($model->getCreatedByColumn())) {
            return;
        }

        if (is_null($model->{$model->getCreatedByColumn()})) {
            $model->{$model->getCreatedByColumn()} = backpack_auth()->id() || Auth::id();
        }

        if (is_null($model->{$model->getUpdatedByColumn()}) && ! is_null($model->getUpdatedByColumn())) {
            $model->{$model->getUpdatedByColumn()} = backpack_auth()->id() || Auth::id();
        }
    }
}
