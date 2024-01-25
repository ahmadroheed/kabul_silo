<?php

namespace App\Http\Controllers; 
 
use Illuminate\Http\Request;
use App\Models\Sliders;
use App\Models\Biography;
use App\Models\Gallary;
use App\Models\Informations;
use App\Models\Products;
use App\Models\News;
use App\Models\Comments;
use App\Models\Messages;
use App\Models\Meeting;
use App\Models\Reports;
use App;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('cpanel.home');
    }

    public function Home(){
        $sliders = Slider::all();
        return view('backend.sliders.view_slider',['sliders' => $sliders]);
    }


    public function update_sliders(Request $request)
    {   

        $id = $request->id;

        if ($id == 1) {
            $dr_title = $request->dr_title_1;
            $ps_title = $request->ps_title_1;
            $en_title = $request->en_title_1;

            $dr_text = $request->dr_text_1;
            $ps_text = $request->ps_text_1;
            $en_text = $request->en_text_1;
            $photo = $request->file('slider_photo_1');
        }

        if ($id == 2) {
            $dr_title = $request->dr_title_2;
            $ps_title = $request->ps_title_2;
            $en_title = $request->en_title_2;

            $dr_text = $request->dr_text_2;
            $ps_text = $request->ps_text_2;
            $en_text = $request->en_text_2;
            $photo = $request->file('slider_photo_2');
        }

        if ($id == 3) {
            $dr_title = $request->dr_title_3;
            $ps_title = $request->ps_title_3;
            $en_title = $request->en_title_3;

            $dr_text = $request->dr_text_3;
            $ps_text = $request->ps_text_3;
            $en_text = $request->en_text_3;
            $photo = $request->file('slider_photo_3');
        }

        if ($id == 4) {
            $dr_title = $request->dr_title_4;
            $ps_title = $request->ps_title_4;
            $en_title = $request->en_title_4;

            $dr_text = $request->dr_text_4;
            $ps_text = $request->ps_text_4;
            $en_text = $request->en_text_4;
            $photo = $request->file('slider_photo_4');
        }

        if ($id == 5) {
            $dr_title = $request->dr_title_5;
            $ps_title = $request->ps_title_5;
            $en_title = $request->en_title_5;

            $dr_text = $request->dr_text_5;
            $ps_text = $request->ps_text_5;
            $en_text = $request->en_text_5;
            $photo = $request->file('slider_photo_5');
        }

        if ($id == 6) {
            $dr_title = $request->dr_title_6;
            $ps_title = $request->ps_title_6;
            $en_title = $request->en_title_6;

            $dr_text = $request->dr_text_6;
            $ps_text = $request->ps_text_6;
            $en_text = $request->en_text_6;
            $photo = $request->file('slider_photo_6');
        }

        $slider = Sliders::find($id);
        $slider->dr_title = $dr_title;
        $slider->ps_title = $ps_title;
        $slider->en_title = $en_title;

        $slider->dr_text = $dr_text;
        $slider->ps_text = $ps_text;
        $slider->en_text = $en_text;

        if ($photo) {
            $fileExt = $photo->getClientOriginalExtension();
            $slider_img = 'slider_'.$id.'_.'.$fileExt;
            $slider->photo = $slider_img;
        }

        $result = $slider->update();
        if ($result) {
            if ($photo) {
                $photo->move('assets/img/slide/', $slider_img);
            }
            return 1;
        }else{
            return 0;
        }
    }

    public function update_information(Request $request)
    {

        $type = $request->type;

        $dr_text = $request->dr_text;
        $ps_text = $request->ps_text;
        $en_text = $request->en_text;

        $info = Informations::find($type); // id and type is equal
        $info->dr_text=$dr_text;
        $info->ps_text=$ps_text;
        $info->en_text=$en_text;
        $result = $info->update();
        if ($result) {
            return 1;
        }else{
            return 0;
        }
    }

    public function update_biography(Request $request)
    {
        $bio = Biography::find(1);

        $bio->name = $request->name;
        $bio->dr_text = $request->dr_text;
        $bio->ps_text = $request->ps_text;
        $bio->en_text = $request->en_text;

        $photo = $request->file('boss_photo');
        if ($photo) {
            $fileExt = $photo->getClientOriginalExtension();
            $slider_img = time().'.'.$fileExt;
        $bio->photo = $slider_img;
        }

        $result = $bio->update();
        if ($result) {
            if ($photo) {
                $photo->move('assets/img/boss/', $slider_img);
            }
            return 1;
        }else{
            return 0;
        }
    }

    public function save_products(Request $request, Products $product)
    {
        $product->name = $request->name;
        $product->type = $request->type;
        $product->size = $request->size;

        $result = $product->save();
        if ($result) {
            return 1;
        }else{
            return 0;
        }
    }

    public function update_product(Request $request)
    {
        $id = $request->id;

        $product = Products::find($id);
        $product->name = $request->name;
        $product->type = $request->type;
        $product->size = $request->size;
        $result = $product->update();
        if ($result) {
            return 1;
        }else{
            return 0;
        }
    }

    public function get_products()
    {
       $info = Products::orderBy('type','asc')->orderBy('name','asc')->get();   
       return $info;
    }

    public function delete_product(Request $request)
    {
       $id = $request->id;
       $result = Products::where('id',$id)->delete();   
       if ($result) {
           return 1;
       }else{
           return 0;
       }
    }

    public function save_photo_gallary(Request $request, Gallary $gallary)
    {

        $gallary->type = $request->type;
        $photo = $request->file('photo');

        if ($photo) {
            $fileExt = $photo->getClientOriginalExtension();
            $gallary_img = time().'.'.$fileExt;
            $gallary->photo = $gallary_img;
        }else{
            return 2;
        }

        $result = $gallary->save();
        if ($result) {
            if ($photo) {
                $photo->move('assets/img/gallary/', $gallary_img);
            }
            return 1;
        }else{
            return 0;
        }
    }

    public function delete_galary_photo(Request $request)
    {
       $id = $request->id;
       $result = Gallary::where('id',$id)->delete();   
       if ($result) {
           return 1;
       }else{
           return 0;
       }
    }

    public function add_news(Request $request, News $news)
    {   

        $news->dr_title = $request->dr_title;
        $news->ps_title = $request->ps_title;
        $news->en_title = $request->en_title;

        $news->dr_text = $request->dr_text;
        $news->ps_text = $request->ps_text;
        $news->en_text = $request->en_text;

        $news->persian_date = $request->persianDate;
        $news->gregorian_date = $request->gregorianDate;

        $file = $request->file('news_photo');
        if ($file) {
            $fileExt = $file->getClientOriginalExtension();
            $photo = time().'.'.$fileExt;
        }else{
            $photo = '0';
        }
        $news->photo = $photo;

        $result = $news->save();
        if ($result) {
            if ($file) {
                $file->move('assets/img/news/', $photo);
            }
            return 1;
        }else{
            return 0;
        }
    }

    public function update_news(Request $request)
    {   

        $id = decrypt($request->news_id);

        $news = News::find($id);

        $news->dr_title = $request->dr_title;
        $news->ps_title = $request->ps_title;
        $news->en_title = $request->en_title;

        $news->dr_text = $request->dr_text;
        $news->ps_text = $request->ps_text;
        $news->en_text = $request->en_text;

        $news->persian_date = $request->persianDate;
        $news->gregorian_date = $request->gregorianDate;

        $file = $request->file('update_news_photo');
        if ($file) {
            $fileExt = $file->getClientOriginalExtension();
            $photo = time().'.'.$fileExt;
            $news->photo = $photo;
        }

        $result = $news->update();
        if ($result) {
            if ($file) {
                $file->move('assets/img/news/', $photo);
            }
            return 1;
        }else{
            return 0;
        }
    }

    public function get_news()
    {
        $info = News::orderBy('created_at','desc')->get();
        return $info;
    }

    public function get_latest_news_for_update(Request $request)
    {
        $max = $request->max;
        $min = $request->min;

        $data = array();

        $info = News::skip($min)->take($max)->orderBy('created_at','desc')->get();
        foreach ($info as $info) {

            if (App::isLocale('en')) {
                $title = $info->en_title;
                $text = substr($info->en_text,0,240);
                $news_date = date_format(date_create($info->gregorian_date),'M d, Y');
                // $diff = $this->localize_diff($info->created_at->diffForHumans(),1); 
            }else if (App::isLocale('dr')){
                $title = $info->dr_title;
                $text = mb_substr($info->dr_text,0,250,'utf-8').'...';
                $day = substr($info->persian_date,8,2);
                $month = $this->toMonth(substr($info->persian_date,5,2));
                $year = substr($info->persian_date,0,4);
                $news_date = $day.' '.$month.', '.$year;

                // $diff = $this->localize_diff($info->created_at->diffForHumans(),2); 
            }else{
                $title = $info->ps_title;
                $text = mb_substr($info->ps_text,0,250,'utf-8').'...';
                $day = substr($info->persian_date,8,2);
                $month = $this->toMonth(substr($info->persian_date,5,2));
                $year = substr($info->persian_date,0,4);
                $news_date = $day.' '.$month.', '.$year;
            }


            $data[] = array('id' => encrypt($info->id), 'title' => $title,'news_date' => $news_date,'photo' => $info->photo, 'text' => $text, 'last_person_commented' => $info->last_person_commented, 'comments_amount' => $info->comments_amount,'dr_title' => $info->dr_title,'ps_title' => $info->ps_title,'en_title' => $info->en_title,'dr_text' => $info->dr_text,'ps_text' => $info->ps_text,'en_text' => $info->en_text,'p_date' => $info->persian_date,'g_date' => $info->gregorian_date);
        }
        return json_encode($data);
    }

    public function delete_delete_news(Request $request)
    {
       $news_id = decrypt($request->id);

       $count = Comments::where('news_id',$news_id)->count();
       if ($count > 0) {
          $result1 = Comments::where('news_id',$news_id)->delete();
          if ($result1) {
            $result2 = News::where('id',$news_id)->delete();   
               if ($result2) {
                   return 1;
               }else{
                   return 0;
               }
          }
       }else{
           $result = News::where('id',$news_id)->delete();   
           if ($result) {
               return 1;
           }else{
               return 0;
           }
       }

    }

   public function toMonth($value){
        switch ($value) {
            case 1:
                $month = 'حمل';
                break;
            case 2:
                $month = 'ثور';
                break;
            case 3:
                $month = 'جوزا';
                break;
            case 4:
                $month = 'سرطان';
                break;
            case 5:
                $month = 'اسد';
                break;
            case 6:
                $month = 'سنبله';
                break;
            case 7:
                $month = 'میزان';
                break;
            case 8:
                $month = 'عقرب';
                break;
            case 9:
                $month = 'قوس';
                break;
            case 10:
                $month = 'جدی';
                break;
            case 11:
                $month = 'دلو';
                break;
            case 12:
                $month = 'حوت';
                break;
         
        }
        return $month;
    }


    public function update_meeting(Request $request,Meeting $meeting)
    {

        $type = $request->type;

        $dr_text = $request->dr_text;
        $ps_text = $request->ps_text;
        $en_text = $request->en_text;

        $number = $request->number;
        $date = $request->date;

        $pdf_file = $request->file('pdf_file');

        $meeting->type=$type;
        $meeting->dr_text=$dr_text;
        $meeting->ps_text=$ps_text;
        $meeting->en_text=$en_text;
        $meeting->number=$number;
        $meeting->date=$date;

        if ($pdf_file) {
            $fileExt = $pdf_file->getClientOriginalExtension();
            $pdf_file_name = time().'.'.$fileExt;
            $meeting->file = $pdf_file_name;
        }else{
            $meeting->file = '0';
        }
        $result = $meeting->save();

        if ($result) {
            if ($pdf_file) {
                $pdf_file->move('assets/meeting/', $pdf_file_name);
            }
            return 1;
        }else{
            return 0;
        }
    }


    public function delete_report_file(Request $request)
    {
       $id = $request->id;
       $result = Reports::where('id',$id)->delete();   
       if ($result) {
           return 1;
       }else{
           return 0;
       }
    }

    public function delete_meeting_file(Request $request)
    {
       $id = $request->id;
       $result = Meeting::where('id',$id)->delete();   
       if ($result) {
           return 1;
       }else{
           return 0;
       }
    }

    public function create_report(Request $request, Reports $report)
    {
        $report->title = $request->title;
        $report->type = $request->type;
        $file = $request->file('pdf_file');

        if ($file) {
            $fileExt = $file->getClientOriginalExtension();
            if ($fileExt != 'pdf') {
                return 2;
            }
            $report_file = time().'.'.$fileExt;
            $report->report_file = $report_file;
        }else{
            return 3;
        }

        $result = $report->save();
        if ($result) {
            if ($file) {
                $file->move('assets/reports/', $report_file);
            }
            return 1;
        }else{
            return 0;
        }
    }



}
