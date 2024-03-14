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
        if(isset($request['sortImage'])){
            if($request['sort'] !== "false"){
                if($request['sort'] === "upTime"){
                    $allImages = Image::select(['name', 'created_at', 'path'])->orderBy('created_at','ASC')->get();
                    return view('all.index',compact('allImages'));
                }else if($request['sort'] === "downTime") {
                    $allImages = Image::select(['name', 'created_at', 'path'])->orderBy('created_at','DESC')->get();
                    return view('all.index',compact('allImages'));
                }else if($request['sort'] === "upName"){
                    $allImages = Image::select(['name', 'created_at', 'path'])->orderBy('name','ASC')->get();
                    return view('all.index',compact('allImages'));
                }else if($request['sort'] === "downName") {
                    $allImages = Image::select(['name', 'created_at', 'path'])->orderBy('name','DESC')->get();
                    return view('all.index',compact('allImages'));
                }else {
                    $allImages = Image::select(['name', 'created_at', 'path'])->get();
                    return view('all.index',compact('allImages'));
                }
            }else {
                $allImages = Image::select(['name', 'created_at', 'path'])->get();
                return view('all.index',compact('allImages'));
            }
        }
        $allImages = Image::select(['name', 'created_at', 'path'])->get();
        return view('all.index',compact('allImages'));
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
     * метод сохранение и обработки входных данных данных
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
