<?php

namespace LamaLama\Wishlist;

use DB;
use Exception;

trait HasWishlists
{
    /**
     * Count wishlist for user.
     *
     * @param  array  $collections
     * @return int
     */
    public function countWishlist(array $collections = []): int
    {
        $query = DB::table('wishlist')->where('user_id', $this->id);

        if (! empty($collections)) {
            $query->whereIn('collection_name', $collections);
        }

        return $query->count();
    }

    /**
     * Add wish to a wishlist.
     *
     * @return void
     */
    public function wish($model = null, string $collectionName = 'default')
    {
        if (! $model) {
            throw new Exception('Model not set');
        }

        if (! $this->wishExists($model, $collectionName)) {
            return $this->createWish($model, $collectionName);
        }
    }

    /**
     * Remove wish from a wishlist.
     *
     * @return void
     */
    public function unwish($model = null, string $collectionName = 'default')
    {
        if (! $model) {
            throw new Exception('Model not set');
        }

        return $this->deleteWish($model, $collectionName);
    }

    /**
     * Has Model On List.
     *
     * @return void
     */
    public function hasModelOnList($model = null, string $collectionName = 'default')
    {
        if (! $model) {
            throw new Exception('Model not set');
        }

        return $this->findWish($model, $collectionName);
    }

    /**
     * Get all wishes for the user.
     */
    public function wishes()
    {
        $items = DB::table('wishlist')
            ->where('user_id', $this->id)
            ->get();

        return $this->wishResponse($items);
    }

    /**
     * Get all wishlists for the user.
     */
    public function wishlists()
    {
        $items = DB::table('wishlist')
            ->where('user_id', $this->id)
            ->get();

        return $this->wishlistResponse($items);
    }

    /**
     * wishlist.
     *
     * @param  string  $collectionName
     * @return void
     */
    public function wishlist(string $collectionName = 'default')
    {
        $items = DB::table('wishlist')
            ->where('user_id', $this->id)
            ->where('collection_name', $collectionName)
            ->get();

        return $this->wishResponse($items);
    }

    /**
     * wishExists.
     *
     * @param  Model  $model
     * @param  string  $collectionName
     * @return Model|bool
     */
    private function wishExists($model, string $collectionName)
    {
        return DB::table('wishlist')
            ->where('user_id', $this->id)
            ->where('model_type', get_class($model))
            ->where('model_id', $model->id)
            ->where('collection_name', $collectionName)
            ->first();
    }

    /**
     * createWish.
     *
     * @param  Model  $model
     * @param  string  $collectionName
     * @return Model
     */
    private function createWish($model, string $collectionName)
    {
        return DB::table('wishlist')
            ->insert([
                'user_id' => $this->id,
                'model_type' => get_class($model),
                'model_id' => $model->id,
                'collection_name' => $collectionName,
            ]);
    }

    /**
     * deleteWish.
     *
     * @param  Model  $model
     * @param  string  $collectionName
     * @return void
     */
    private function deleteWish($model, string $collectionName)
    {
        return DB::table('wishlist')
            ->where('user_id', $this->id)
            ->where('model_type', get_class($model))
            ->where('model_id', $model->id)
            ->where('collection_name', $collectionName)
            ->delete();
    }

    /**
     * findWish.
     *
     * @param  Model  $model
     * @param  string  $collectionName
     * @return Model|bool
     */
    private function findWish($model, string $collectionName)
    {
        return DB::table('wishlist')
            ->where('user_id', $this->id)
            ->where('model_type', get_class($model))
            ->where('model_id', $model->id)
            ->where('collection_name', $collectionName)
            ->first();
    }

    /**
     * wishResponse.
     *
     * @param  [type] $items
     * @return [type]
     */
    private function wishResponse($items)
    {
        if (! $items) {
            return collect([]);
        }

        foreach ($items as $item) {
            $types[$item->model_type][] = $item->model_id;
        }

        if (! isset($types)) {
            return collect([]);
        }

        foreach ($types as $type => $ids) {
            $models[] = $type::whereIn('id', $ids)->get();
        }

        foreach ($models as $model) {
            foreach ($model as $item) {
                $wishes[] = $item;
            }
        }

        return collect($wishes);
    }

    /**
     * wishlistResponse.
     *
     * @param  array  $items
     * @return Illuminate\Database\Eloquent\Collection
     */
    private function wishlistResponse($items)
    {
        if (! $items || empty($items)) {
            return collect([]);
        }

        foreach ($items as $item) {
            $lists[$item->collection_name][] = $item->model_id;
        }

        foreach ($lists as $collectionName => $listItems) {
            foreach ($items as $item) {
                $types[$item->model_type][] = $item->model_id;
            }

            $models = [];
            foreach ($types as $type => $ids) {
                $models[] = $type::whereIn('id', $ids)->get();
            }

            $lists[$collectionName] = $models;
        }

        return collect($lists);
    }
}
