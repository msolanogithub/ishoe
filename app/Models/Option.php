<?php

namespace Modules\Ishoe\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Imagina\Icore\Models\CoreModel;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Option extends CoreModel
{
  use Translatable;

  protected $table = 'ishoe__options';
  public string $transformer = 'Modules\Ishoe\Transformers\OptionTransformer';
  public string $repository = 'Modules\Ishoe\Repositories\OptionRepository';
  public array $requestValidation = [
    'create' => 'Modules\Ishoe\Http\Requests\CreateOptionRequest',
    'update' => 'Modules\Ishoe\Http\Requests\UpdateOptionRequest',
  ];
  public array $modelRelations = [
    'shoes' => 'belongsToMany'
  ];
  //Instance external/internal events to dispatch with extraData
  public array $dispatchesEventsWithBindings = [
    //eg. ['path' => 'path/module/event', 'extraData' => [/*...optional*/]]
    'created' => [],
    'creating' => [],
    'updated' => [],
    'updating' => [],
    'deleting' => [],
    'deleted' => []
  ];

  public array $translatedAttributes = ['title'];
  protected $fillable = ['price', 'parent_id', 'pieces', 'need_cutting', 'is_editable'];

  protected function parentId(): Attribute
  {
    return Attribute::make(
      set: fn($value) => $value ?? 0,
    );
  }

  public function parent(): BelongsTo
  {
    return $this->belongsTo(Option::class, 'parent_id');
  }

  public function shoes(): BelongsToMany
  {
    return $this->belongsToMany(Shoe::class, 'ishoe__shoe_options');
  }
}
