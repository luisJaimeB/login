<?php 
namespace App\Http\ViewComposers;

use App\Services\CategoryCacheService;
use Illuminate\View\View;

class CategoriesComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $categories = CategoryCacheService::get();
        $view->with('categories', $categories);
    }
}