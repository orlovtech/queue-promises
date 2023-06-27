<?php

namespace Tochka\Promises\Models\Observers;

use Illuminate\Support\Facades\Event;
use Tochka\Promises\Events\PromiseJobStateChanged;
use Tochka\Promises\Events\StateChanged;
use Tochka\Promises\Models\PromiseJob;

class PromiseJobAfterCommitObserver
{
    public bool $afterCommit = true;

    public function updated(PromiseJob $promiseJob): void
    {
        $oldState = $promiseJob->getChangedState() ?? $promiseJob->state;

        if ($oldState !== $promiseJob->state) {
            Event::dispatch(new StateChanged($promiseJob->getBaseJob(), $oldState, $promiseJob->state));
            Event::dispatch(
                new PromiseJobStateChanged(
                    $promiseJob->getBaseJob(),
                    $oldState,
                    $promiseJob->state,
                    $promiseJob->isNestedEvents()
                )
            );
        }
    }
}
