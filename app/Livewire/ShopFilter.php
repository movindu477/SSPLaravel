<?php

namespace App\Livewire;

use App\Models\Pet;
use Livewire\Component;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\DB;

class ShopFilter extends Component
{
    #[Url]
    public $search = '';

    #[Url]
    public $pet_type = '';

    #[Url]
    public $accessories_type = '';

    #[Url]
    public $min_price = '';

    #[Url]
    public $max_price = '';

    public function getProductsProperty()
    {
        $query = Pet::query();

        if (!empty($this->search)) {
            $query->where('product_name', 'LIKE', '%' . trim($this->search) . '%');
        }

        if (!empty($this->pet_type)) {
            $query->where('pet_type', $this->pet_type);
        }

        if (!empty($this->accessories_type)) {
            $query->where('accessories_type', $this->accessories_type);
        }

        if (!empty($this->min_price)) {
            $query->where('price', '>=', (float) $this->min_price);
        }

        if (!empty($this->max_price)) {
            $query->where('price', '<=', (float) $this->max_price);
        }

        return $query->orderBy('id')->get();
    }

    public function getFavoriteIdsProperty()
    {
        if (auth()->check()) {
            return DB::table('favorites')
                ->where('user_id', auth()->id())
                ->pluck('pet_id')
                ->toArray();
        }
        return [];
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->pet_type = '';
        $this->accessories_type = '';
        $this->min_price = '';
        $this->max_price = '';
    }

    public function getActiveFiltersCountProperty()
    {
        $count = 0;
        if (!empty($this->search)) $count++;
        if (!empty($this->pet_type)) $count++;
        if (!empty($this->accessories_type)) $count++;
        if (!empty($this->min_price)) $count++;
        if (!empty($this->max_price)) $count++;
        return $count;
    }

    public function render()
    {
        return view('livewire.shop-filter', [
            'products' => $this->products,
            'favoriteIds' => $this->favoriteIds,
            'activeFiltersCount' => $this->activeFiltersCount,
        ]);
    }
}
