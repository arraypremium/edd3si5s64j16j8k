<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Model;

/**
 * Cascade soft deletes, force deletes, and restores for configured relationships.
 *
 * Models using this trait must also use `SoftDeletes`, and should override
 * {@see self::relationsToCascade()} to return relationship method names.
 */
trait CascadesSoftDeletes
{
    /**
     * Relationship method names to cascade.
     *
     * @return list<string>
     */
    protected static function relationsToCascade(): array
    {
        return [];
    }

    /**
     * Determine whether a relationship is intentionally cascade-deleted.
     */
    public function cascadesRelationOnDelete(string $relation): bool
    {
        return in_array($relation, static::relationsToCascade(), true);
    }

    /**
     * Register cascade callbacks for Eloquent model events.
     */
    protected static function bootCascadesSoftDeletes(): void
    {
        static::deleting(function (Model $model): void {
            foreach (static::relationsToCascade() as $relation) {
                $query = $model->{$relation}();

                $relatedModel = $query->getRelated();
                $relatedUsesSoftDeletes = in_array(
                    \Illuminate\Database\Eloquent\SoftDeletes::class,
                    class_uses_recursive($relatedModel),
                    true,
                );

                $isForceDeleting = method_exists($model, 'isForceDeleting')
                    && $model->isForceDeleting();

                if ($isForceDeleting) {
                    if ($relatedUsesSoftDeletes) {
                        $query->withTrashed();
                    }

                    $query->get()->each(function (Model $related): void {
                        if (method_exists($related, 'forceDelete')) {
                            $related->forceDelete();

                            return;
                        }

                        $related->delete();
                    });

                    continue;
                }

                $query->get()->each->delete();
            }
        });

        static::restoring(function (Model $model): void {
            foreach (static::relationsToCascade() as $relation) {
                $query = $model->{$relation}();
                $relatedModel = $query->getRelated();

                if (in_array(\Illuminate\Database\Eloquent\SoftDeletes::class, class_uses_recursive($relatedModel), true)) {
                    $query->withTrashed();
                }

                $query->get()->each(function (Model $related): void {
                    if (method_exists($related, 'restore')) {
                        $related->restore();
                    }
                });
            }
        });
    }
}