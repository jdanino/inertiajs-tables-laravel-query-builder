<?php

namespace ProtoneMedia\LaravelQueryBuilderInertiaJs;

use Illuminate\Support\ServiceProvider;
use Inertia\Response as InertiaResponse;
use Inertia\ResponseFactory;

class InertiaTableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register macros for the Response class
        InertiaResponse::macro('getQueryBuilderProps', function () {
            return $this->props['queryBuilderProps'] ?? [];
        });

        InertiaResponse::macro('table', function (callable $withTableBuilder = null) {
            $tableBuilder = new InertiaTable(request());

            if ($withTableBuilder) {
                $withTableBuilder($tableBuilder);
            }

            return $tableBuilder->applyTo($this);
        });

        // Register the same macros for the ResponseFactory class
        ResponseFactory::macro('getQueryBuilderProps', function () {
            return $this->props['queryBuilderProps'] ?? [];
        });

        ResponseFactory::macro('table', function (callable $withTableBuilder = null) {
            $tableBuilder = new InertiaTable(request());

            if ($withTableBuilder) {
                $withTableBuilder($tableBuilder);
            }

            return $tableBuilder->applyTo($this);
        });
    }
}
