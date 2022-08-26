<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Post;
use App\Models\User;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;



class PostTable extends DataTableComponent
{
    protected $model = Post::class;


    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSecondaryHeaderEnabled();
        $this->setSearchDisabled();
;

//             ->setTableRowUrlTarget(function($row) {
//             return '_blank';
//             });

    }

    public function columns(): array
    {

        return [
            Column::make("Id", "id")
                ->sortable()
                ->unclickable(),

//            Column::make("Title", "title")
//                ->sortable()
//                ->searchable(),

            LinkColumn::make('Title', 'title')
                ->title(fn($row) => $row->title)
                ->location(fn($row) => route('posts.show', $row))
                ->secondaryHeaderFilter('title')
                ->sortable()
                ->searchable(),

//            Column::make('Upvotes')
//                ->label(
//                    fn($row, Column $column) => $this->getSomeOtherValue($row, $column)
//                )
//                ->sortable()
//                ->format(function($value, $column, $row) {
//                    $post = Post::find($row->id);
//                    return $post->upvotersCount();
//                }),




//
//            LinkColumn::make('Title', 'title')
//                ->sortable()
//                ->searchable()
//                ->title(fn($row) => $row->title)
//                ->location(fn($row) => route('posts.create')),




            Column::make("Author", "user.name")
                ->sortable()
                ->searchable()
                ->secondaryHeader($this->getFilterByKey('author')),
            Column::make('Upvotes')
                ->label(
                    fn($row, Column $column)  => '<strong>'.$row->upvoters_count.'</strong>'
                )
                ->html(),
            Column::make("Created at", "created_at")
                ->sortable()
            ->unclickable(),
            Column::make("Updated at", "updated_at")
                ->sortable()
        ->unclickable(),

        ];

    }
    public function filters(): array
    {
        return [
            TextFilter::make('Title', 'title')
                ->config([
                    'placeholder' => 'Search title',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('title', 'like', '%'.$value.'%');
                }),

            TextFilter::make('author')
                ->config([
                    'placeholder' => 'Search author',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('users.name', 'like', '%'.$value.'%');
                }),
        ];
    }

    public function builder(): Builder
    {
        return Post::query()->select('posts.*')->with('user')->withCount('upvoters');
    }}
//
//    public function builder(): Builder
//    {
//        return Post::query()->select(['posts.*']);
//    }
//}
