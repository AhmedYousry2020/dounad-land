<?php


use App\Http\Utility\ApiResponseUtility;
use Illuminate\Support\Str;


define('FL', strtoupper('en'));
define('SL', strtoupper('ar'));

function api($success, $code, $message)
{
    return new ApiResponseUtility($success, $code, $message);
}
function api_exception(Exception $e, $code = null, $message = null)
{
    return api(false, $code ?? $e->getCode(), $message ?? $e->getMessage())
        ->add('error', [
            'line' => $e->getLine(),
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'trace' => $e->getTrace(),
        ])->get();
}


if (!function_exists('isActive')) {
  /**
   * @param bool $value if true return success
   * @param bool $reurnArray if true return array instade of span
   * @return html|array
   */
  function isActive($value, $returnArray = false, $trueClass = 'success', $falseClass = 'danger')
  {
      if ($value) {
          $data['icon'] = 'check-circle';
          $data['class'] = $trueClass;
      } else {
          $data['icon'] = 'x-circle';
          $data['class'] = $falseClass;
      }

      return $returnArray ? $data : sprintf('<em class="text-%s"data-feather="%s"></em>', $data['class'], $data['icon']);
  }
}

if (!function_exists('getLocale')) {
  /**
   * @return String
   */
  function getLocale(): String
  {
      return  strtoupper(app()->getLocale());
  }
}


if (!function_exists('storeImage')) {
  function storeImage($photo, $folder)
  {
      $file_extension = $photo->getClientOriginalExtension();
      $file_name = Str::uuid() . '.' . $file_extension;
      $saved = $photo->storeAs($folder, $file_name, ['disk' => 'public']);
      if ($saved) {
          return $file_name;
      }
  }
}
