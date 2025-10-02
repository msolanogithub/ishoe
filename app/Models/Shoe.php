<?php

namespace Modules\Ishoe\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Imagina\Icore\Models\CoreModel;

class Shoe extends CoreModel
{
  use Translatable;

  protected $table = 'ishoe__shoes';
  public string $transformer = 'Modules\Ishoe\Transformers\ShoeTransformer';
  public string $repository = 'Modules\Ishoe\Repositories\ShoeRepository';
  public array $requestValidation = [
    'create' => 'Modules\Ishoe\Http\Requests\CreateShoeRequest',
    'update' => 'Modules\Ishoe\Http\Requests\UpdateShoeRequest',
  ];
  public array $modelRelations = [
    'options' => 'belongsToMany',
    'users' => 'belongsToMany',
  ];
  //Instance external/internal events to dispatch with extraData
  public array $dispatchesEventsWithBindings = [
    //eg. ['path' => 'path/module/event', 'extraData' => [/*...optional*/]]
    'created' => [
      ['path' => 'Modules\Imedia\Events\CreateMedia']
    ],
    'creating' => [],
    'updated' => [
      ['path' => 'Modules\Imedia\Events\UpdateMedia']
    ],
    'updating' => [],
    'deleting' => [
      ['path' => 'Modules\Imedia\Events\DeleteMedia']
    ],
    'deleted' => []
  ];
  public array $translatedAttributes = ['title'];
  protected $fillable = ['reference', 'base_price', 'options_price', 'total_price'];
  public array $mediaFillable = [
    'mainimage' => 'single'
  ];
  public function options(): BelongsToMany
  {
    return $this->belongsToMany(Option::class, 'ishoe__shoe_options');
  }

  public function users(): BelongsToMany
  {
    return $this->belongsToMany('Modules\Iuser\Models\User', 'ishoe__user_products')->withPivot('price');
  }
  public function files()
  {
    if (isModuleEnabled('Imedia')) {
      return app(\Modules\Imedia\Relations\FilesRelation::class)->resolve($this);
    }
    return new \Imagina\Icore\Relations\EmptyRelation();
  }
}
