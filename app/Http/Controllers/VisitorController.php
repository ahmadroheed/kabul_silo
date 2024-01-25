<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Comments;
use App\Models\Messages;
use App;

class VisitorController extends Controller
{
    
    public function download_document(Request $request)
    {
        $document_no = $request->input('document');

        switch ($document_no) {
            case 1:
                $file = 'governmental companies law.pdf';
                break;
             case 2:
                $file = 'Legislative Sources.pdf';
                break;
             case 3:
                $file = 'Related Bills.pdf';
                break;
             case 4:
                $file = 'Related Procedures.pdf';
                break;
             case 5:
                $file = 'Duties Bills.pdf';
                break;
             case 6:
                $file = 'Company Statute.pdf';
                break;
             case 7:
                $file = 'Official Reports.pdf';
                break;
            default:
                return 'Not Found';
                break;
        }

        return response()->download(storage_path('app/public/documents/' . $file));
    }

	public function get_latest_news(Request $request)
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


            $data[] = array('id' => encrypt($info->id), 'title' => $title,'news_date' => $news_date,'photo' => $info->photo, 'text' => $text, 'last_person_commented' => $info->last_person_commented, 'comments_amount' => $info->comments_amount);
        }
        return json_encode($data);
    }

    public function search_news(Request $request)
    {
        $search = $request->value;

        $data = array();

        if (App::isLocale('en')) {
            $info = News::where('en_title', 'LIKE', "%{$search}%")
                ->orWhere('en_text', 'LIKE', "%{$search}%")
                ->orderBy('created_at','desc')->get();
        }else if (App::isLocale('dr')){
            $info = News::where('dr_title', 'LIKE', "%{$search}%")
                ->orWhere('dr_text', 'LIKE', "%{$search}%")
                ->orderBy('created_at','desc')->get();
        }else{
            $info = News::where('ps_title', 'LIKE', "%{$search}%")
                ->orWhere('ps_text', 'LIKE', "%{$search}%")
                ->orderBy('created_at','desc')->get();
        }


        foreach ($info as $info) {

            if (App::isLocale('en')) {
                $title = $info->en_title;
                $news_date = date_format(date_create($info->gregorian_date),'M d, Y');
            }else if (App::isLocale('dr')){
                $title = $info->dr_title;
                $day = substr($info->persian_date,8,2);
                $month = $this->toMonth(substr($info->persian_date,5,2));
                $year = substr($info->persian_date,0,4);
                $news_date = $day.' '.$month.', '.$year;
            }else{
                $title = $info->ps_title;
                $day = substr($info->persian_date,8,2);
                $month = $this->toMonth(substr($info->persian_date,5,2));
                $year = substr($info->persian_date,0,4);
                $news_date = $day.' '.$month.', '.$year;
            }
            $data[] = array('id' => encrypt($info->id), 'title' => $title,'news_date' => $news_date,'photo' => $info->photo);
        }
        return json_encode($data);
    }

    public function save_comments(Request $request, Comments $comment)
    {
        $news_id = decrypt($request->news_id);

    	$comment->news_id = $news_id;
    	$comment->name = $request->name;
    	$comment->contact = $request->contact;
    	$comment->comment = $request->comment;

    	$result = $comment->save();
    	if ($result) {
    		$news = News::find(decrypt($request->news_id));
    		$news->last_person_commented = $request->name;
    		$news->comments_amount = Comments::where('news_id',$news_id)->count();
    		$news->update();
    		return 1;
    	}else{
    		return 0;
    	}

    }

    public function save_contact_msg(Request $request, Messages $msg)
    {
        $msg->name = $request->name;
        $msg->contact = $request->contact;
        $msg->msg = $request->msg;

        $result = $msg->save();
        if ($result) {
            return 1;
        }else{
            return 0;
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


    public function localize_diff($diff,$lang)
    {
        if ($lang == 1) { // en
            return $diff;
        }else{ // dr

            $num = (int) filter_var($diff, FILTER_SANITIZE_NUMBER_INT);
            if (strpos($diff, 'second') !== false) {
                $diff = "ثانیه";
            }else if (strpos($diff, 'minets') !== false) {
                $diff = "دقیقه";
            }else if (strpos($diff, 'huers') !== false) {
                $diff = "ساعت";
            }else if (strpos($diff, 'days') !== false) {
                $diff = "روز";
            }else if (strpos($diff, 'week') !== false) {
                $diff = "هفته";
            }else if (strpos($diff, 'month') !== false) {
                $diff = "ماه";
            }else if (strpos($diff, 'year') !== false) {
                $diff = "سال";
            }

            return $num.$diff.' قبل';
        }
    }

}
