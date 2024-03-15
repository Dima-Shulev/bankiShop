<?php
namespace Helpers;

use App\Models\Image;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class AllHelpers {

    /**
     * @param $post
     * @return \Illuminate\Http\RedirectResponse
     * Обработчик входных данных, сохранения файлов на сервер и сохранения данных в db
     */

    public static function helperForm($post)
    {
        //допустимые форматы, можно добавить :)
        $checkFormats = ['image/webp','image/gif','image/jpeg','image/bmp','image/png'];
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return redirect()->route('all.home')->with('error','error_method');
        }
        if(empty($post['name']) || empty($post['image'])){
            return redirect()->route('all.home')->with('error','error_form_empty');
        }
        $trans = [];
        foreach($post['name'] as $itemName){
            $trans[] = AllHelpers::transliter(trim(htmlspecialchars($itemName)));
        }
        $checkName = Image::whereIn('name',$trans)->get();
        $arrImage = [];
            if($checkName->isEmpty()) {
                foreach ($post->image as $key => $item) {
                    if(in_array($_FILES['image']['type'][$key],$checkFormats)) {
                        $path = Storage::disk('images')->putFile('', new File($post->image[$key]));
                        $arrImage[] = [
                            'name' => $trans[$key],
                            'path' => $path,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                        asset('images/'.$path);
                    }else{
                        return redirect()->route('all.home')->with('error','error_type_image');
                    }
                }
            }else{
                foreach ($post->image as $key => $item) {
                    if(in_array($_FILES['image']['type'][$key],$checkFormats)) {
                        $path = Storage::disk('images')->putFile('', new File($post->image[$key]));
                        $arrImage[] = [
                            'name' => $trans[$key]."#".substr($path,0,5),
                            'path' => $path,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                        asset('images/'.$path);
                    }else{
                        return redirect()->route('all.home')->with('error','error_type_image');
                    }
                }
            }
            Image::insert($arrImage);

        return redirect()->route('all.home')->with('success','success');
    }

    /**
     * @param string $name
     * @return string
     * парсинг строки в латиницу, пробелов в нижний дефис
     */

    public static function transliter(string $name)
    {
            $converter = array(
                'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
                'е' => 'e', 'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
                'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
                'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
                'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
                'ш' => 'sh', 'щ' => 'sch', 'ь' => '', 'ы' => 'y', 'ъ' => '',
                'э' => 'e', 'ю' => 'yu', 'я' => 'ya', ' ' => '-', '(' => '',
                ':' => '', ';' => '', '.' => '', ',' => '', '?' => '',
                '!' => '', '"' => '', '\'' => '', '`' => '',

                'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D',
                'Е' => 'E', 'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I',
                'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N',
                'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
                'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C', 'Ч' => 'Ch',
                'Ш' => 'Sh', 'Щ' => 'Sch', 'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
                'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
            );
            $value = strtr($name, $converter);
            $result = strtolower($value);
            return $result;
    }

    /**
     * @param string $path
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * Создание и передача zip архива изображения
     */

    public static function saveImage(string $path)
    {
        $zip_file = 'invoices/images.zip';
        $zip = new ZipArchive();
        $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $invoice_file = storage_path('app/public/images/'."$path");
        $zip->addFile($invoice_file,"/".$path);
        $zip->close();
        return response()->download($zip_file);
    }

    /**
     * @param $request
     * взаимодействие с внешним API и получение данных о изображения в json формате.
     * также можно получать данные по условию и получения query параметра (пример js = secret) на таком принципе используются токены
     */

    public static function api($request){
        if($_SERVER['REQUEST_METHOD'] === "GET"){
            //if(isset($request['js']) && ($request['js'] === "secret")){
                $data = Image::select(['id','name','created_at'])->orderBy('id','ASC')->get();
                $data = json_encode($data);
                echo $data;
            //}
        }else{
           echo "Ошибка. Не правельный метод !";
           exit;
        }
    }

    public static function sortImage($request){
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

}
