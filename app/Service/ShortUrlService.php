<?php

namespace App\Service;

use AshAllenDesign\ShortURL\Classes\Builder;
use AshAllenDesign\ShortURL\Classes\Validation;
use AshAllenDesign\ShortURL\Controllers\ShortURLController;
use AshAllenDesign\ShortURL\Exceptions\ShortURLException;
use AshAllenDesign\ShortURL\Exceptions\ValidationException;
use AshAllenDesign\ShortURL\Interfaces\UrlKeyGenerator;
use AshAllenDesign\ShortURL\Models\ShortURL;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Conditionable;

class ShortUrlService extends Builder
{
  /**
   * Create a new class instance.
   */
  public function __construct(Validation $validation, UrlKeyGenerator $urlKeyGenerator)
  {
    $validation->validateConfig();
    $this->keyGenerator = $urlKeyGenerator;
  }
}
