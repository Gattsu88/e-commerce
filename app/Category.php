<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    public function subcategories()
    {
        return $this->hasMany('App\Category', 'parent_id')->where('status', 1);
    }

    public function section()
    {
        return $this->belongsTo('App\Section', 'section_id')->select('id', 'name');
    }

    public function parentCategory()
    {
        return $this->belongsTo('App\Category', 'parent_id')->select('id', 'category_name');
    }

    public static function catDetails($url)
    {
        $catDetails = Category::select('id', 'parent_id', 'category_name', 'url', 'description')->with(['subcategories' => function($query) {
            $query->select('id', 'parent_id', 'category_name', 'url', 'description')->where('status', 1);
        }])->where('url', $url)->first()->toArray();

        if($catDetails['parent_id'] == 0) {
            // Only show main category
            $breadcrumbs = '<a href="'.url($catDetails['url']).'" >'.$catDetails['category_name'].'</a>'; 
        } else {
            $parentCategory = Category::select('category_name', 'url')->where('id', $catDetails['parent_id'])->first()->toArray();
            // Show main category and subcategory
            $breadcrumbs = '<a href="'.url($parentCategory['url']).'" >'.$parentCategory['category_name'].'</a>&nbsp;
                            <span class="divider">/</span>&nbsp;
                            <a href="'.url($catDetails['url']).'" >'.$catDetails['category_name'].'</a>'; 
        }

        $catIDs[] = $catDetails['id'];

        foreach ($catDetails['subcategories'] as $key => $subcat) {
            $catIDs[] = $subcat['id'];
        }

        return ['catIDs' => $catIDs, 'catDetails' => $catDetails, 'breadcrumbs' => $breadcrumbs];
    } 
}