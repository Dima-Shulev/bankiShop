<?php
namespace App\Http\Controllers\All;

use App\Models\Image;
use Helpers\AllHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\All\ValidateForm;
use Illuminate\Http\Request;

class FormBackController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * Метод вывода всех изображений и работа с сортировкой данных
     */

    public function index(Request $request){
        return AllHelpers::sortImage($request);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * Метод вывода шаблона формы
     */


    public function create(){
        return view('all.create');
    }

    /**
     * @param ValidateForm $request
     * @return \Illuminate\Http\RedirectResponse
     * метод сохранение и обработки входных данных
     */

    public function store(ValidateForm $request){
        return AllHelpers::helperForm($request);
    }

    /**
     * @param $path
     * @type string
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * метод сохранение изображений
     */

    public function saveImage(string $path){
        return AllHelpers::saveImage($path);
    }

    /**
     * @param Request $request
     * метод получение данных в формате json
     */

    public function json(Request $request){
        return AllHelpers::api($request);
    }
}
