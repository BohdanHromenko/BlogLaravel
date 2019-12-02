<?php

namespace App\Nova;

use Benjaminhirsch\NovaSlugField\Slug;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Waynestate\Nova\CKEditor;
use Benjacho\BelongsToManyField\BelongsToManyField;
use Laravel\Nova\Http\Requests\NovaRequest;

class Post extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Post';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
        'slug',
        'content',
        'description'

    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()
                ->sortable(),
            TextWithSlug::make('Title')
                ->rules('required', 'min:5', 'max:80')
                ->slug('slug')
                ->sortable(),
            Slug::make('Slug')
                ->creationRules('unique:posts,slug')
                ->updateRules('unique:posts,slug,{{resourceId}}'),

            Text::make('Description')
                ->hideFromIndex(),

            BelongsTo::make('Category', 'category'),
            BelongsTo::make('User', 'author'),

            BelongsToManyField::make('Add Tags', 'tags', 'App\Nova\Tag')
                ->optionsLabel('title')
                ->hideFromIndex(),

            Text::make('Views', function () {
                return $this->views;
            })
                ->onlyOnIndex(),
            DateTime::make('Published At', 'published_at')
                ->format('MMM DD, YYYY, HH:MM:SS')
                ->hideFromIndex(),
            Boolean::make('Status'),
            Boolean::make('Featured', 'is_featured'),

            Image::make('image')
                ->disk('public')
                ->prunable()
                ->hideFromIndex(),
            CKEditor::make('Content')
                ->hideFromIndex(),
            HasMany::make('Comments'),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [

        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
